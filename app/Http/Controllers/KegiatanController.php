<?php

namespace App\Http\Controllers;

use App\Models\AsesiModel;
use App\Models\AsesmenModel;
use App\Models\KegiatanDetailModel;
use App\Models\KegiatanJadwalModel;
use App\Models\KegiatanLSPModel;
use App\Models\KegiatanModel;
use App\Models\KegiatanSkemaModel;
use App\Models\LSPModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function __construct()
    {
        View()->share('title', 'Kegiatan');
    }

    // public function jadwalAsesmen()
    // {
    //     return view('admin-panel.kegiatan.jadwal-asesmen');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->loadMissing('lspData');

        $query = KegiatanModel::with([
            // 'kegiatanLsp:ref,kegiatan_ref,lsp_ref,kuota_lsp',
            // 'kegiatanLsp.lsp:ref,lsp_nama',

            'kegiatanJadwal:ref,kegiatan_ref,lsp_ref,kuota_lsp',
            'kegiatanJadwal.lsp:ref,lsp_nama'
        ])->withSum('kegiatanJadwal as total_kuota', 'kuota_lsp');

        if ($user->roles === 'lsp' && $user->lspData) {
            $query->whereHas('kegiatanJadwal', function ($q) use ($user) {
                $q->where('lsp_ref', $user->lspData->ref);
            });
        }

        $data['dataKegiatan'] = $query->get();
        return view('admin-panel.kegiatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataLSP'] = LSPModel::join('users', 'users.ref', '=', 'lsp.user_ref')
            ->where('users.is_active', 1)
            ->select('lsp.ref', 'lsp.lsp_nama')
            ->get();

        $data['dataKegiatan'] = KegiatanModel::select('ref', 'nama_kegiatan')->get();
        return view('admin-panel.kegiatan.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Validator::make($request->all(), [
            'nama_kegiatan' => 'required|unique:kegiatan,nama_kegiatan',
            'mulai_kegiatan' => 'required',
            'selesai_kegiatan' => 'required',
        ], [
            'nama_kegiatan.required' => 'Masukkan nama kegiatan',
            'nama_kegiatan.unique' => 'Nama kegiatan ini sudah ada',
            'mulai_kegiatan.required' => 'Silahkan pilih tanggal mulai',
            'selesai_kegiatan.required' => 'Silahkan pilih tanggal selesai',
        ])->validateWithBag('create_kegiatan');

        DB::transaction(function () use ($request) {

            $kegiatan = KegiatanModel::create([
                'nama_kegiatan' => $request->nama_kegiatan,
                'mulai_kegiatan' => Carbon::createFromFormat('d/m/Y', $request->mulai_kegiatan)->format('Y-m-d'),
                'selesai_kegiatan' => Carbon::createFromFormat('d/m/Y', $request->selesai_kegiatan)->format('Y-m-d'),
                'status' => 1,
                'created_by' => Auth::user()->ref,

            ]);

            // ############################################################## Tambah LSP ke Kegiatan

            foreach ($request->lsp_ref as $i => $lspRef) {

                // Kalau LSP kosong, lewati
                if (!$lspRef) continue;

                Validator::make($request->all(), [
                    "lsp_ref.$i" => 'required',
                    "skema_ref.$i" => ['required', 'array', 'min:1'],
                    "skema_ref.$i.*" => 'required',
                    "kuota_lsp.$i" => ['required', 'integer', 'min:1'],
                    "date_range.$i" => ['required', 'regex:/^\d{2}-\d{2}-\d{4}\s-\s\d{2}-\d{2}-\d{4}$/'],
                ], [
                    'lsp_ref.*.required'     => 'LSP wajib dipilih',
                    'skema_ref.*.required'   => 'Minimal 1 skema harus dipilih',
                    'kuota_lsp.*.required'   => 'Kuota wajib diisi',
                    'kuota_lsp.*.min'        => 'Kuota minimal 1',
                    'date_range.*.required'  => 'Tanggal wajib diisi',
                ])->validate();

                $lsp    = $request->lsp_ref[$i];
                $skemas = $request->skema_ref[$i] ?? [];
                $kuota  = (int) ($request->kuota_lsp[$i] ?? 0);
                $range  = $request->date_range[$i] ?? null;

                // Jika skema kosong, kuota 0, atau date range kosong, skip/lewati
                if (!$skemas || !$kuota || !$range) continue;

                foreach ($skemas as $i => $skema) {

                    KegiatanSkemaModel::create([
                        'kegiatan_ref' => $kegiatan->ref,
                        'lsp_ref'    => $lsp,
                        'skema_ref'    => $skema,
                        'created_by'   => Auth::user()->ref,
                    ]);
                }

                // $kegiatanLSP = KegiatanLSPModel::create([
                //     'kegiatan_ref' => $kegiatan->ref,
                //     'lsp_ref' => $lsp,
                //     'kuota_lsp' => $kuota,
                //     'created_by'   => Auth::user()->ref,

                // ]);

                [$start, $end] = array_map('trim', explode(' - ', $range));
                $startDate = Carbon::createFromFormat('d-m-Y', $start);
                $endDate   = Carbon::createFromFormat('d-m-Y', $end);

                KegiatanJadwalModel::create([
                    'lsp_ref'         => $lsp,
                    'kegiatan_ref' => $kegiatan->ref,
                    'kegiatan_lsp_ref' => NULL,
                    'mulai_asesmen'   => $startDate->format('Y-m-d'),
                    'selesai_asesmen' => $endDate->format('Y-m-d'),
                    'kuota_lsp' => $kuota,
                    'created_by'      => Auth::user()->ref,
                ]);
            }
        });

        return redirect('/kegiatan')
            ->with('flashData', [
                'title' => 'Tambah Data Success',
                'message' => 'Kegiatan Baru Berhasil Ditambahkan',
                'type' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->loadMissing('lspData');
        // dd($user);
        // $data['dataLSP'] = LSPModel::get();

        $query = KegiatanModel::where('ref', $id)
            ->withSum(
                'kegiatanJadwal as total_peserta',
                'kuota_lsp',
            )->withCount('skemas', 'asesi');      // total skema kegiatan
        if ($user->roles === 'lsp' && $user->lspData) {
            $query->whereHas('kegiatanJadwal', function ($q) use ($user) {
                $q->where('lsp_ref', $user->lspData->ref);
            })
                ->with([
                    'kegiatanJadwal' => function ($q) use ($user) {
                        $q->where('lsp_ref', $user->lspData->ref);
                    }
                ]);
        }
        $data['dataKegiatan'] = $query->firstOrFail();

        $data['dataSkema'] = $data['dataKegiatan']->skemas->groupBy('lsp_ref');
        $data['dataAsesi'] = AsesiModel::with('asesmen')->get()->groupBy('asesmen_ref');
        $data['jadwalKegiatan'] = $data['dataKegiatan']->jadwalAsesmen->groupBy('nama_lsp');

        return view('admin-panel.kegiatan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        KegiatanModel::where('ref', $id)->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'mulai_kegiatan' => Carbon::createFromFormat('d/m/Y', $request->mulai_kegiatan)->format('Y-m-d'),
            'selesai_kegiatan' => Carbon::createFromFormat('d/m/Y', $request->selesai_kegiatan)->format('Y-m-d'),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('kegiatan.index')
            ->with('flashData', [
                'title' => 'Edit Data Success',
                'message' => 'Skema Berhasil Diubah',
                'type' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        KegiatanModel::where('ref', $id)->delete();
        $flashData = [
            'judul' => 'Hapus Data Success',
            'pesan' => 'Kegiatan Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json($flashData);
    }


    // Function untuk menambahkan data LSP baru pada page details kegiatan
    public function add_lsp($id)
    {
        // dd($id);
        $data['dataLSP'] = LSPModel::whereDoesntHave('kegiatanDetails')->get();

        // Jika data kegiatan sudah dibuat, maka tidak ditampilkan lagi

        $data['dataKegiatan'] = KegiatanModel::where('ref', $id)->first();
        return view('admin-panel.kegiatan.create-lsp', $data);
    }

    public function sertifikatUpdate(Request $request)
    {
        $asesi = AsesiModel::where('ref', $request->ref)->first();

        if (!$asesi) {
            return response()->json([
                'success' => false,
                'message' => 'Data Asesi tidak ditemukan'
            ], 404);
        }

        // update kolom dinamis
        $asesi->update([
            $request->id => $request->value,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'No Sertifikat -' . $asesi->nama_lengkap . ' Berhasil Ditambahkan!'
        ]);
    }

    public function uploadSertifikat(Request $request)
    {
        $request->validate([
            'ref' => 'required',
            'sertifikat_file' => 'required|file|mimes:pdf|max:2048',
        ]);

        $asesi = AsesiModel::where('ref', $request->ref)->first();

        if (!$asesi) {
            return response()->json([
                'success' => false,
                'message' => 'Data Asesi tidak ditemukan'
            ], 404);
        }

        $ext  = $request->file('sertifikat_file')->extension();
        $time = time();
        $nik  = $asesi->nik;
        $filename = Str::uuid() . ".{$ext}";

        // hapus file lama
        if ($asesi->sertifikat_file && Storage::disk('sertifikat')->exists($asesi->sertifikat_file)) {
            Storage::disk('sertifikat')->delete($asesi->sertifikat_file);
        }

        // simpan file
        $path = Storage::disk('sertifikat')->putFileAs("sertifikat", $request->file('sertifikat_file'), $filename);

        //update tb
        $asesi->update(['sertifikat_file' => $filename]);

        return response()->json([
            'success' => true,
            'message' => 'Sertifikat Kompetensi - ' . $asesi->nama_lengkap . ' berhasil diupload',
            'path'    => $path,
            'url'     => route('files.asesi.sertifikat', ['filename' => basename($path)]),

        ]);
    }

    public function uploadBuktiAsesmen(Request $request)
    {
        $request->validate([
            'ref' => 'required',
            'bukti_asesmen' => 'required|file|mimes:pdf|max:2048',
        ]);

        $asesmen = AsesmenModel::where('ref', $request->ref)->first();

        if (!$asesmen) {
            return response()->json([
                'success' => false,
                'message' => 'Data Asesi tidak ditemukan'
            ], 404);
        }

        $ext  = $request->file('bukti_asesmen')->extension();
        $time = time();
        $lsp  = $asesmen->nama_lsp;
        $tuk  = $asesmen->nama_tuk;
        $tgl  = $asesmen->jadwal_asesmen;
        $filename = "BUKTI-ASESMEN-" . Str::uuid() . ".{$ext}";

        // hapus file lama
        if ($asesmen->bukti_asesmen && Storage::disk('bukti_asesmen')->exists($asesmen->bukti_asesmen)) {
            Storage::disk('bukti_asesmen')->delete($asesmen->bukti_asesmen);
        }

        // simpan file
        $path = Storage::disk('bukti_asesmen')->putFileAs("bukti_asesmen", $request->file('bukti_asesmen'), $filename);

        //update tb
        $asesmen->update(['bukti_asesmen' => $filename]);

        return response()->json([
            'success' => true,
            'message' => 'Bukti Asesmen - ' . $asesmen->nama_lsp . ' - ' . $asesmen->nama_tuk . ' - ' . $asesmen->jadwal_asesmen . ' berhasil diupload',
            'path'    => $path,
            'url'     => route('files.asesmen.bukti_asesmen', ['filename' => basename($path)]),

        ]);
    }

    public function uploadDokumentasiAsesmen(Request $request)
    {
        $request->validate([
            'ref' => 'required',
            // Max file 10MB
            'dokumentasi_asesmen' => 'required|file|mimes:pdf|max:10240',
        ]);

        $asesmen = AsesmenModel::where('ref', $request->ref)->first();

        if (!$asesmen) {
            return response()->json([
                'success' => false,
                'message' => 'Data Asesi tidak ditemukan'
            ], 404);
        }

        $ext  = $request->file('dokumentasi_asesmen')->extension();
        $time = time();
        $lsp  = $asesmen->nama_lsp;
        $tuk  = $asesmen->nama_tuk;
        $tgl  = $asesmen->jadwal_asesmen;
        $filename = Str::uuid() . ".{$ext}";

        // hapus file lama
        if ($asesmen->dokumentasi_asesmen && Storage::disk('dokumentasi_asesmen')->exists($asesmen->dokumentasi_asesmen)) {
            Storage::disk('dokumentasi_asesmen')->delete($asesmen->dokumentasi_asesmen);
        }

        // simpan file
        $path = Storage::disk('dokumentasi_asesmen')->putFileAs("dokumentasi_asesmen", $request->file('dokumentasi_asesmen'), $filename);

        //update tb
        $asesmen->update(['dokumentasi_asesmen' => $filename]);

        return response()->json([
            'success' => true,
            'message' => 'Dokumentasi Asesmen - ' . $asesmen->nama_lsp . ' - ' . $asesmen->nama_tuk . ' - ' . $asesmen->jadwal_asesmen . ' berhasil diupload',
            'path'    => $path,
            'url'     => route('files.asesmen.dokumentasi_asesmen', ['filename' => basename($path)]),

        ]);
    }

    public function uploadLaporanAsesmen(Request $request)
    {
        $request->validate([
            'ref' => 'required',
            // Max file 50MB
            'file' => 'required|file|mimes:pdf|max:51200',
        ]);

        $jadwal = KegiatanJadwalModel::with(['lsp', 'kegiatan'])->where('ref', $request->ref)->first();

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Data Asesi tidak ditemukan'
            ], 404);
        }

        $index = $request->index;
        $field = 'laporan_asesmen' . ($index == 1 ? '' : $index);

        $ext  = $request->file('file')->extension();
        $time = time();
        $lsp  = $jadwal->lsp->lsp_nama;
        $kegiatan  = $jadwal->kegiatan->nama_kegiatan;
        $filename = "LAPORAN-{$index}-{$kegiatan}-{$lsp}-{$time}.{$ext}";

        // hapus file lama
        if ($jadwal->$field && Storage::disk('laporan_asesmen')->exists($jadwal->$field)) {
            Storage::disk('laporan_asesmen')->delete($jadwal->$field);
        }

        // simpan file
        $path = Storage::disk('laporan_asesmen')->putFileAs("laporan_asesmen", $request->file('file'), $filename);

        //update tb
        $jadwal->update([$field => $path]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan - ' . $index . ' - ' . $kegiatan . ' - ' . $lsp . ' berhasil diupload',
            'path'    => $path,
            'url'     => route('files.asesmen', ['filename' => basename($path)]),

        ]);
    }

    public function uploadBuktiTerimaSertifikat(Request $request)
    {
        $request->validate([
            'ref' => 'required',
            // Max file 10MB
            'bukti_terima_sertifikat' => 'required|file|mimes:pdf|max:10240',
        ]);

        $asesmen = AsesmenModel::where('ref', $request->ref)->first();

        if (!$asesmen) {
            return response()->json([
                'success' => false,
                'message' => 'Data Asesi tidak ditemukan'
            ], 404);
        }

        $ext  = $request->file('bukti_terima_sertifikat')->extension();
        $time = time();
        $lsp  = $asesmen->nama_lsp;
        $tuk  = $asesmen->nama_tuk;
        $tgl  = $asesmen->jadwal_asesmen;
        $filename = Str::uuid() . ".{$ext}";

        // hapus file lama
        if ($asesmen->bukti_terima_sertifikat && Storage::disk('bukti_terima_sertifikat')->exists($asesmen->bukti_terima_sertifikat)) {
            Storage::disk('bukti_terima_sertifikat')->delete($asesmen->bukti_terima_sertifikat);
        }

        // simpan file
        $path = Storage::disk('bukti_terima_sertifikat')->putFileAs("bukti_terima_sertifikat", $request->file('bukti_terima_sertifikat'), $filename);

        //update tb
        $asesmen->update(['bukti_terima_sertifikat' => $filename]);

        return response()->json([
            'success' => true,
            'message' => 'Bukti Terima Sertifikat - ' . $asesmen->nama_lsp . ' - ' . $asesmen->nama_tuk . ' - ' . $asesmen->jadwal_asesmen . ' berhasil diupload',
            'path'    => $path,
            'url'     => route('files.asesmen.bukti_terima_sertifikat', ['filename' => basename($path)]),

        ]);
    }
}
