<?php

namespace App\Http\Controllers;

use App\Models\LSPModel;
use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use App\Models\KegiatanModel;
use App\Models\AsesiModel;
use App\Models\AsesmenModel;
use App\Models\KegiatanLSPModel;
use App\Models\KegiatanSkemaModel;
use App\Models\TUKModel;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;



class AsesiController extends Controller
{
    public function __construct()
    {
        View()->share('title', 'Data Asesi');
    }

    public function getLspByKegiatan($kegiatanRef)
    {

        $data = AsesmenModel::where('kegiatan_ref', $kegiatanRef)->select('nama_lsp')->groupBy('nama_lsp')->get();
        return response()->json($data);
    }

    public function getJadwalByLsp(Request $request)
    {
        $request->validate([
            'kegiatan_ref' => 'required',
            'lsp_ref' => 'required',
        ]);

        $asesiPerAsesmen = AsesiModel::where('kegiatan_ref', $request->kegiatan_ref)
            ->select('asesmen_ref', DB::raw('COUNT(*) as total'))
            ->groupBy('asesmen_ref')
            ->pluck('total', 'asesmen_ref');


        $data = AsesmenModel::where('kegiatan_ref', $request->kegiatan_ref)->where('nama_lsp', $request->lsp_ref)
            ->join('lsp', 'asesmen.nama_lsp', 'lsp.lsp_nama')
            ->select('asesmen.*', 'lsp.nama_cp_1', 'lsp.nomor_cp_1', 'lsp.nama_cp_2', 'lsp.nomor_cp_2')
            ->get()
            ->map(function ($asesmen) use ($asesiPerAsesmen) {

                $terpakai = $asesiPerAsesmen[$asesmen->ref] ?? 0;
                $sisa = max($asesmen->kuota_harian - $terpakai, 0);


                return [
                    'asesmen_ref' => $asesmen->ref,
                    'jadwal_asesmen' => $asesmen->jadwal_asesmen,
                    'kuota_harian' => $asesmen->kuota_harian,
                    'terpakai' => $terpakai,
                    'sisa_kuota' => $sisa,
                    'nama_tuk' => $asesmen->nama_tuk,
                    'nama_skema' => $asesmen->nama_skema,
                    'nama_cp_1' => $asesmen->nama_cp_1,
                    'nomor_cp_1' => $asesmen->nomor_cp_1,
                    'nama_cp_2' => $asesmen->nama_cp_2,
                    'nomor_cp_2' => $asesmen->nomor_cp_2,
                ];
            });


        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departemen = DepartemenModel::all();
        $jabatan = JabatanModel::all();
        $lsp = LSPModel::all();
        // $kegiatan = KegiatanModel::all();
        $kegiatan = KegiatanModel::whereStatus(1)->get();
        $tuk = TUKModel::all();

        return view('pendaftaran.pendaftaran-asesi', [
            'dataDepartemen' => $departemen,
            'dataJabatan' => $jabatan,
            'dataLsp' => $lsp,
            'dataKegiatan' => $kegiatan,
            'dataTUK' => $tuk,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_ref' => 'required',
            'lsp_ref' => 'required',
            // 'tuk_ref' => 'required',
            // 'tgl_asesmen' => 'required',
            // 'skema_asesmen' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
            'kode_pos' => 'required',
            'telp_rumah' => 'nullable',
            'telp_kantor' => 'nullable',
            'telp_hp' => 'required',
            'email' => 'required|email',
            'pendidikan_terakhir' => 'required',
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'departemen' => 'required',
            'jabatan' => 'required',
            'kode_pos_perusahaan' => 'required',
            'telp_perusahaan' => 'required',
            'fax_perusahaan' => 'nullable',
            'email_perusahaan' => 'required|email',
            'nama_kontak_person' => 'required',
            'no_kontak_person' => 'required',

            // FILE VALIDATION
            'sertikom_file' => 'nullable|file|mimes:pdf|max:2048',
            'ijazah_file' => 'nullable|file|mimes:pdf|max:2048',
            'ktp_file' => 'required|file|mimes:pdf|max:2048',
            'keterangan_kerja_file' => 'required|file|mimes:pdf|max:2048',
            'pas_foto_file' => 'required|file|mimes:jpg,png|max:2048',
        ], [
            'kegiatan_ref.required' => 'Kegiatan tidak boleh kosong',
            'lsp_ref.required' => 'LSP tidak boleh kosong',
            'tuk_ref.required' => 'TUK tidak boleh kosong',
            'tgl_asesmen.required' => 'Tanggal asesmen tidak boleh kosong',
            'skema_asesmen.required' => 'Skema asesmen tidak boleh kosong',
            'nama_lengkap.required' => 'Nama lengkap tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'kewarganegaraan.required' => 'Kewarganegaraan tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'kode_pos.required' => 'Kode pos tidak boleh kosong',
            'telp_hp.required' => 'Nomor HP tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir tidak boleh kosong',
            'nama_perusahaan.required' => 'Nama perusahaan tidak boleh kosong',
            'alamat_perusahaan.required' => 'Alamat perusahaan tidak boleh kosong',
            'departemen.required' => 'Departemen tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'kode_pos_perusahaan.required' => 'Kode pos perusahaan tidak boleh kosong',
            'telp_perusahaan.required' => 'Telepon perusahaan tidak boleh kosong',
            'email_perusahaan.required' => 'Email perusahaan tidak boleh kosong',
            'email_perusahaan.email' => 'Format email perusahaan tidak valid',

            // NEW
            'nama_kontak_person.required' => 'Nama Kontak Person Tempat Bekerja/Perusahaan tidak boleh kosong',
            'no_kontak_person.required' => 'Nomor HP Kontak Person Tempat Bekerja/Perusahaan tidak boleh kosong',

            'ktp_file.required' => 'KTP tidak boleh kosong.',
            'ktp_file.mimes'    => 'File KTP harus berformat PDF.',
            'ktp_file.max'      => 'Ukuran file KTP maksimal 2 MB.',

            'keterangan_kerja_file.required' => 'Surat Keterangan Kerja tidak boleh kosong.',
            'keterangan_kerja_file.mimes'    => 'File Surat Keterangan Kerja harus berformat PDF.',
            'keterangan_kerja_file.max'      => 'Ukuran file Surat Keterangan Kerja maksimal 2 MB.',

            'sertikom_file.mimes' => 'File Sertifikat Kompetensi harus berformat PDF.',
            'sertikom_file.max'   => 'Ukuran file Sertifikat Kompetensi maksimal 2 MB.',

            'ijazah_file.mimes' => 'File Ijazah harus berformat PDF.',
            'ijazah_file.max'   => 'Ukuran file Ijazah maksimal 2 MB.',

            'pas_foto_file.required' => 'Pas Foto tidak boleh kosong.',
            'pas_foto_file.mimes'    => 'Pas Foto harus berformat JPG atau PNG.',
            'pas_foto_file.max'      => 'Ukuran Pas Foto maksimal 2 MB.',

        ]);

        // CEK NIK + 3 TAHUN 1 HARI
        $existingAsesi = AsesiModel::where('nik', $request->nik)
            ->orderByDesc('created_at')
            ->first();

        if ($existingAsesi) {
            $batasDaftarUlang = Carbon::parse($existingAsesi->created_at)
                ->addYears(3)
                ->addDay();

            if (now()->lessThan($batasDaftarUlang)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'nik' => 'Maaf NIK sudah terdaftar, anda boleh mendaftar kembali pada '
                        . $batasDaftarUlang->translatedFormat('d F Y'),
                ]);
            }
        }

        // Validasi Kuota LSP (Jika LSP di bypass user)
        $kegiatanRef = $request->kegiatan_ref;
        $lspRef      = $request->lsp_ref;


        // $kuotaLsp = KegiatanLSPModel::where('kegiatan_ref', $kegiatanRef)->where('lsp_ref', $lspRef)->value('kuota_lsp');
        // $totalAsesi = AsesiModel::where('kegiatan_ref', $kegiatanRef)->where('lsp_ref', $lspRef)->count();

        // if ($totalAsesi >= $kuotaLsp) {
        //     throw ValidationException::withMessages([
        //         'lsp_ref' => 'Kuota LSP sudah penuh',
        //     ]);
        // }

        // ================== SIMPAN FILE ==================
        $nik  = $request->nik;
        $time = time();
        $ktp = NULL; $ijazah = NULL; $sertikom = NULL; $skb = NULL; $pasfoto = NULL;
        $filenameKTP = NULL; $filenameIjazah = NULL; $filenameSertikom = NULL; $filenameSKB = NULL; $filenamePasFoto = NULL; 

        /* ================== KTP ================== */
        if ($request->hasFile('ktp_file')) {
            $ext = $request->file('ktp_file')->extension();
            $filenameKTP = Str::uuid() . ".{$ext}";
            $ktp = Storage::disk('KTP')->putFileAs("KTP", $request->file('ktp_file'), $filenameKTP);

            // $validated['ktp_file'] = $request->file('ktp_file')
            //     ->storeAs('asesi/ktp', $filename, 'public');

        }

        /* ================== IJAZAH ================== */
        if ($request->hasFile('ijazah_file')) {
            $ext = $request->file('ijazah_file')->extension();
            $filenameIjazah = Str::uuid() . ".{$ext}";
            $ijazah = Storage::disk('ijazah')->putFileAs("ijazah", $request->file('ijazah_file'), $filenameIjazah);

            // $validated['ijazah_file'] = $request->file('ijazah_file')
            // ->storeAs('asesi/ijazah', $filename, 'public');

        }

        /* ================== SERTIFIKAT KOMPETENSI ================== */
        if ($request->hasFile('sertikom_file')) {
            $ext = $request->file('sertikom_file')->extension();
            $filenameSertikom = Str::uuid() . ".{$ext}";
            $sertikom = Storage::disk('sertikom')->putFileAs("sertikom", $request->file('sertikom_file'), $filenameSertikom);

            // $validated['sertikom_file'] = $request->file('sertikom_file')
            //     ->storeAs('asesi/sertikom', $filename, 'public');
        }

        /* ================== KETERANGAN KERJA ================== */
        if ($request->hasFile('keterangan_kerja_file')) {
            $ext = $request->file('keterangan_kerja_file')->extension();
            $filenameSKB = Str::uuid() . ".{$ext}";
            $skb = Storage::disk('SKB')->putFileAs("SKB", $request->file('keterangan_kerja_file'), $filenameSKB);

            // $validated['keterangan_kerja_file'] = $request->file('keterangan_kerja_file')
            //     ->storeAs('asesi/keterangan_kerja', $filename, 'public');
        }

        /* ================== PAS FOTO ================== */
        if ($request->hasFile('pas_foto_file')) {
            $ext = $request->file('pas_foto_file')->extension();
            $filenamePasFoto = Str::uuid() . ".{$ext}";
            $pasfoto = Storage::disk('pas-foto')->putFileAs("pas-foto", $request->file('pas_foto_file'), $filenamePasFoto);

            // $validated['pas_foto_file'] = $request->file('pas_foto_file')
            //     ->storeAs('asesi/pas_foto', $filename, 'public');
        }


        // AsesiModel::create($validated);
        $lspData = LSPModel::where('lsp_nama', $request->lsp_ref)->select('ref')->first();


        AsesiModel::create([
            'kegiatan_ref' => $request->kegiatan_ref,
            'lsp_ref' => $lspData->ref,
            'asesmen_ref' => $request->asesmen_ref,

            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
            'telp_rumah' => $request->telp_rumah,
            'telp_kantor' => $request->telp_kantor,
            'telp_hp' => $request->telp_hp,
            'email' => $request->email,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'departemen' => $request->departemen,
            'jabatan' => $request->jabatan,
            'kode_pos_perusahaan' => $request->kode_pos_perusahaan,
            'telp_perusahaan' => $request->telp_perusahaan,
            'fax_perusahaan' => $request->fax_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,

            'sertikom_file' => $filenameSertikom,
            'ijazah_file' => $filenameIjazah,
            'ktp_file' => $filenameKTP,
            'keterangan_kerja_file' => $filenameSKB,
            'pas_foto_file' => $filenamePasFoto,

            'nama_kontak_person' => $request->nama_kontak_person,
            'no_kontak_person' => $request->no_kontak_person,

            'status' => NULL,
            'kompeten' => NULL,

            'no_sertifikat' => NULL,
            'sertifikat_file' => NULL,
        ]);

        $flashData = [
            'title' => 'Pendaftaran Calon Asesi Berhasii',
            'message' => 'Data Berhasil Dikirim',
            'type' => 'success',
        ];
        return redirect()->route('asesi.index')->with('flashData', $flashData);
    }

    public function list()
    {
        // $asesi = AsesiModel::join('lsp', 'lsp.ref', '=', 'tuk.lsp_ref')
        // ->select('tuk.*','lsp.lsp_nama')
        // ->orderBy('tuk.created_at', 'desc')
        // ->get();

        $asesi = AsesiModel::with(['kegiatan', 'asesmen'])->get();

        return view('admin-panel.asesi.index', [
            'dataAsesi' => $asesi,
        ]);
    }
}
