<?php

namespace App\Http\Controllers;

use App\Models\AsesiModel;
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

class KegiatanController extends Controller
{


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
            'kegiatanLsp:ref,kegiatan_ref,lsp_ref,kuota_lsp',
            'kegiatanLsp.lsp:ref,lsp_nama'
        ])->withSum('kegiatanLsp as total_kuota', 'kuota_lsp');

        if ($user->roles === 'lsp' && $user->lspData) {
            $query->whereHas('kegiatanLsp', function ($q) use ($user) {
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
        $data['dataLSP'] = LSPModel::get();

        // Jika data kegiatan sudah dibuat, maka tidak ditampilkan lagi
        // $data['dataKegiatan'] = KegiatanModel::select('ref', 'nama_kegiatan')->whereDoesntHave('details')->get();
        $data['dataKegiatan'] = KegiatanModel::select('ref', 'nama_kegiatan')->whereDoesntHave('kegiatanLsp')->get();
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

                $kegiatanLSP = KegiatanLSPModel::create([
                    'kegiatan_ref' => $kegiatan->ref,
                    'lsp_ref' => $lsp,
                    'kuota_lsp' => $kuota,
                    'created_by'   => Auth::user()->ref,

                ]);

                [$start, $end] = array_map('trim', explode(' - ', $range));
                $startDate = Carbon::createFromFormat('d-m-Y', $start);
                $endDate   = Carbon::createFromFormat('d-m-Y', $end);

                KegiatanJadwalModel::create([
                    'lsp_ref'         => $lsp,
                    'kegiatan_ref' => $kegiatan->ref,
                    'kegiatan_lsp_ref' => $kegiatanLSP->ref,
                    'mulai_asesmen'   => $startDate->format('Y-m-d'),
                    'selesai_asesmen' => $endDate->format('Y-m-d'),
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
        $data['dataLSP'] = LSPModel::get();

        $data['dataKegiatan'] = KegiatanModel::where('ref', $id)
            ->with([
                // 'kegiatanLsp.lsp',           // detail kuota + LSP
                // 'kegiatanLsp.jadwal',

                'skemaPerLsp.lsp',        // total skema per LSP
                'kuotaPerLsp.lsp',      // total kuota per LSP
                'asesi.tuk',
                'asesi.skema',
                'kegiatanJadwal.lsp',

                'kegiatanLsp',
                'jadwalAsesmen',

            ])->withSum(
                'kegiatanLsp as total_peserta',
                'kuota_lsp',
            )->withCount('skemas', 'asesi')        // total skema kegiatan
            ->firstOrFail();

        // dd($data['dataKegiatan']);

        $data['skemaPerLsp'] = $data['dataKegiatan']->skemaPerLsp->keyBy('lsp_ref'); // Mengelompokkan skema per LSP berdasarkan lsp_ref
        $data['dataSkema'] = $data['dataKegiatan']->skemas->groupBy('lsp_ref'); // Mengelompokkan data skema berdasarkan lsp_ref
        // $data['dataAsesi'] = $data['dataKegiatan']->asesi->groupBy('tgl_asesmen');

        $data['dataAsesiByLsp'] = AsesiModel::where('kegiatan_ref', $id)->get()->groupBy('lsp_ref');

        // $data['jadwalKegiatan'] = $data['dataKegiatan']->kegiatanLsp->groupBy('lsp_ref'); // Mengelompokkan jadwal kegiatan berdasarkan lsp_ref

        $data['dataAsesi'] = AsesiModel::with('asesmen')->get()->groupBy('asesmen_ref');
        $data['jadwalKegiatan'] = $data['dataKegiatan']->jadwalAsesmen->groupBy('nama_lsp');
        // dd($data['dataAsesi']);


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
}
