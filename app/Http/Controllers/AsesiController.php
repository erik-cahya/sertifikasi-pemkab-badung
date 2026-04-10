<?php

namespace App\Http\Controllers;

use App\Models\LSPModel;
use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use App\Models\KegiatanModel;
use App\Models\AsesiModel;
use App\Models\AsesmenModel;
use App\Models\KegiatanJadwalModel;
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
        $data = DB::table('kegiatan_jadwal')
            ->where('kegiatan_jadwal.kegiatan_ref', $kegiatanRef)
            ->join('lsp', 'kegiatan_jadwal.lsp_ref', '=', 'lsp.ref')
            ->select('lsp.lsp_nama as nama_lsp', 'lsp.nama_cp_1', 'lsp.nomor_cp_1', 'lsp.nama_cp_2', 'lsp.nomor_cp_2')
            ->distinct()
            ->get();
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


        $dataJadwal = AsesmenModel::where('kegiatan_ref', $request->kegiatan_ref)
            ->where('nama_lsp', $request->lsp_ref)
            ->orderBy('jadwal_asesmen', 'asc')
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
                ];
            });

        $dataLsp = LSPModel::where('lsp_nama', $request->lsp_ref)
            ->select('nama_cp_1', 'nomor_cp_1', 'nama_cp_2', 'nomor_cp_2')
            ->first();

        return response()->json([
            'jadwal' => $dataJadwal,
            'lsp' => $dataLsp
        ]);
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
            'asesmen_ref' => 'required',
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
            'asesmen_ref.required' => 'Jadwal asesmen tidak boleh kosong',
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

        // =============================== ByPass Kuota ===============================
        // Ambil Data UUID LSP
        $lspData = LSPModel::where('lsp_nama', $request->lsp_ref)->select('ref')->first();
        $realLspRef = $lspData ? $lspData->ref : null;

        if ($realLspRef) {
            // Validasi Kuota LSP (Jika LSP di bypass user)
            $kegiatanRef = $request->kegiatan_ref;
            $kuotaLsp = KegiatanJadwalModel::where('kegiatan_ref', $kegiatanRef)->where('lsp_ref', $realLspRef)->value('kuota_lsp');
            $totalAsesiLsp = AsesiModel::where('kegiatan_ref', $kegiatanRef)->where('lsp_ref', $realLspRef)->count();

            if (!is_null($kuotaLsp) && $totalAsesiLsp >= $kuotaLsp) {
                throw ValidationException::withMessages([
                    'lsp_ref' => 'Kuota LSP sudah penuh',
                ]);
            }
        }

        // Validasi Kuota Jadwal Asesmen (Jika Jadwal di bypass user)
        if ($request->filled('asesmen_ref')) {
            $asesmen = AsesmenModel::where('ref', $request->asesmen_ref)->first();
            if ($asesmen) {
                $totalAsesiAsesmen = AsesiModel::where('asesmen_ref', $request->asesmen_ref)->count();
                if ($totalAsesiAsesmen >= $asesmen->kuota_harian) {
                    throw ValidationException::withMessages([
                        'asesmen_ref' => 'Kuota Jadwal Asesmen sudah penuh',
                    ]);
                }
            }
        }

        // ================== SIMPAN FILE ==================
        $nik  = $request->nik;
        $time = time();
        $ktp = NULL;
        $ijazah = NULL;
        $sertikom = NULL;
        $skb = NULL;
        $pasfoto = NULL;
        $filenameKTP = NULL;
        $filenameIjazah = NULL;
        $filenameSertikom = NULL;
        $filenameSKB = NULL;
        $filenamePasFoto = NULL;

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
        // $lspData sudah diambil di bagian validasi kuota di atas


        AsesiModel::create([
            'kegiatan_ref' => $request->kegiatan_ref,
            'lsp_ref' => $realLspRef,
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

    public function list(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->loadMissing('lspData');

        // Data LSP untuk filter dropdown (khusus dinas/master)
        $dataLsp = ($user->roles !== 'lsp') ? LSPModel::orderBy('lsp_nama')->get() : collect();

        return view('admin-panel.asesi.index', [
            'dataLsp' => $dataLsp,
            'userRole' => $user->roles,
        ]);
    }

    /**
     * Server-side AJAX endpoint untuk DataTables.
     */
    public function listData(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->loadMissing('lspData');

        $query = AsesiModel::with(['kegiatan', 'asesmen'])
            ->select('asesi.*');

        // Role-based filter: LSP hanya lihat miliknya
        if ($user->roles === 'lsp' && $user->lspData) {
            $query->where('lsp_ref', $user->lspData->ref);
        }

        // Filter per LSP (khusus dinas/master)
        $filterLsp = $request->filter_lsp;
        if ($user->roles !== 'lsp' && $filterLsp) {
            $query->where('lsp_ref', $filterLsp);
        }

        // Filter berdasarkan tanggal/bulan/tahun
        $filterType = $request->filter_type;
        $filterValue = $request->filter_value;

        if ($filterType && $filterValue) {
            switch ($filterType) {
                case 'tanggal':
                    $query->whereDate('created_at', $filterValue);
                    break;
                case 'bulan':
                    $query->whereYear('created_at', substr($filterValue, 0, 4))
                        ->whereMonth('created_at', substr($filterValue, 5, 2));
                    break;
                case 'tahun':
                    $query->whereYear('created_at', $filterValue);
                    break;
            }
        }

        // DataTables server-side parameters
        $draw = (int) $request->input('draw', 1);
        $start = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 25);
        $searchValue = $request->input('search.value', '');
        $orderColumnIdx = (int) $request->input('order.0.column', 23); // default: created_at
        $orderDir = $request->input('order.0.dir', 'desc');

        // Mapping kolom index DataTables ke kolom database
        $columns = [
            0 => 'kegiatan_ref',   // Sertifikasi
            1 => 'nama_lengkap',
            2 => 'nik',
            3 => 'tempat_lahir',
            4 => 'tgl_lahir',
            5 => 'jenis_kelamin',
            6 => 'kewarganegaraan',
            7 => 'alamat',
            8 => 'telp_hp',
            9 => 'email',
            10 => 'pendidikan_terakhir',
            11 => 'nama_perusahaan',
            12 => 'alamat_perusahaan',
            13 => 'departemen',
            14 => 'jabatan',
            15 => 'telp_perusahaan',
            16 => 'email_perusahaan',
            17 => 'nama_kontak_person',
            18 => 'no_kontak_person',
            19 => null, // Dokumen (not sortable)
            20 => null, // Jadwal Asesmen (not sortable)
            21 => 'no_sertifikat',
            22 => null, // Sertifikat file (not sortable)
            23 => 'created_at',
            24 => null, // Action (not sortable)
        ];

        // Total records (sebelum search)
        $totalRecords = (clone $query)->count();

        // Search global
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('nama_lengkap', 'like', "%{$searchValue}%")
                    ->orWhere('nik', 'like', "%{$searchValue}%")
                    ->orWhere('email', 'like', "%{$searchValue}%")
                    ->orWhere('tempat_lahir', 'like', "%{$searchValue}%")
                    ->orWhere('nama_perusahaan', 'like', "%{$searchValue}%")
                    ->orWhere('departemen', 'like', "%{$searchValue}%")
                    ->orWhere('jabatan', 'like', "%{$searchValue}%")
                    ->orWhere('no_sertifikat', 'like', "%{$searchValue}%");
            });
        }

        $filteredRecords = (clone $query)->count();

        // Ordering
        $orderColumn = $columns[$orderColumnIdx] ?? 'created_at';
        if ($orderColumn) {
            $query->orderBy($orderColumn, $orderDir === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $data = $query->skip($start)->take($length)->get();

        // Format data menjadi array untuk DataTables
        $rows = [];
        foreach ($data as $item) {
            $namaKegiatan = $item->kegiatan->nama_kegiatan ?? '-';

            // Dokumen links
            $dokumenHtml = '<table>';
            $dokumenHtml .= '<tr><td>KTP</td><td>: ' . (!empty($item->ktp_file) ? '<a href="' . route('files.asesi.ktp', $item->ktp_file) . '" target="_blank"><i class="mdi mdi-file-pdf-box"></i></a>' : '-') . '</td></tr>';
            $dokumenHtml .= '<tr><td>IJAZAH</td><td>: ' . (!empty($item->ijazah_file) ? '<a href="' . route('files.asesi.ijazah', $item->ijazah_file) . '" target="_blank"><i class="mdi mdi-file-pdf-box"></i></a>' : '-') . '</td></tr>';
            $dokumenHtml .= '<tr><td>SERTIKOM</td><td>: ' . (!empty($item->sertikom_file) ? '<a href="' . route('files.asesi.sertikom', $item->sertikom_file) . '" target="_blank"><i class="mdi mdi-file-pdf-box"></i></a>' : '-') . '</td></tr>';
            $dokumenHtml .= '<tr><td>SKB</td><td>: ' . (!empty($item->keterangan_kerja_file) ? '<a href="' . route('files.asesi.skb', $item->keterangan_kerja_file) . '" target="_blank"><i class="mdi mdi-file-pdf-box"></i></a>' : '-') . '</td></tr>';
            $dokumenHtml .= '<tr><td>PAS FOTO</td><td>: ' . (!empty($item->pas_foto_file) ? '<a href="' . route('files.asesi.pasfoto', $item->pas_foto_file) . '" target="_blank"><i class="mdi mdi-file-image"></i></a>' : '-') . '</td></tr>';
            $dokumenHtml .= '</table>';

            // Jadwal Asesmen
            $jadwalHtml = '<table>';
            if ($item->asesmen) {
                $jadwalHtml .= '<tr><td>LSP</td><td>: ' . e($item->asesmen->nama_lsp) . '</td></tr>';
                $jadwalHtml .= '<tr><td>Tanggal</td><td>: ' . Carbon::parse($item->asesmen->jadwal_asesmen)->locale('id')->translatedFormat('l, d F Y') . '</td></tr>';
                $jadwalHtml .= '<tr><td>TUK</td><td>: ' . e($item->asesmen->nama_tuk) . '</td></tr>';
                $jadwalHtml .= '<tr><td>Skema</td><td>: ' . e($item->asesmen->nama_skema) . '</td></tr>';
            } else {
                $jadwalHtml .= '<tr><td>-</td></tr>';
            }
            $jadwalHtml .= '</table>';

            // Telp
            $telpHtml = '<table>';
            $telpHtml .= '<tr><td>Telp</td><td>: ' . e($item->telp_hp) . '</td></tr>';
            $telpHtml .= '<tr><td>Rumah</td><td>: ' . e($item->telp_rumah) . '</td></tr>';
            $telpHtml .= '<tr><td>Kantor</td><td>: ' . e($item->telp_kantor) . '</td></tr>';
            $telpHtml .= '</table>';

            // Telp Perusahaan
            $telpPerusahaanHtml = '<table>';
            $telpPerusahaanHtml .= '<tr><td>Telp</td><td>: ' . e($item->telp_perusahaan) . '</td></tr>';
            $telpPerusahaanHtml .= '<tr><td>Fax</td><td>: ' . e($item->fax_perusahaan) . '</td></tr>';
            $telpPerusahaanHtml .= '</table>';

            // Sertifikat
            $sertifikatHtml = !empty($item->sertifikat_file)
                ? '<a href="' . asset('asesi_files/' . $item->sertifikat_file) . '" target="_blank"><i class="mdi mdi-file-image"></i></a>'
                : '-';

            // Action
            $actionHtml = '<button class="btn btn-sm btn-dinas btn-edit-asesi" data-ref="' . e($item->ref) . '"><i class="mdi mdi-pencil"></i></button>';

            $rows[] = [
                '<span class="bg-dinas rounded-4 px-2 text-white">' . e($namaKegiatan) . '</span>',
                e($item->nama_lengkap),
                e($item->nik),
                e($item->tempat_lahir),
                date('Y/m/d', strtotime($item->tgl_lahir)),
                e($item->jenis_kelamin),
                e($item->kewarganegaraan),
                e($item->alamat),
                $telpHtml,
                e($item->email),
                e($item->pendidikan_terakhir),
                e($item->nama_perusahaan),
                e($item->alamat_perusahaan),
                e($item->departemen),
                e($item->jabatan),
                $telpPerusahaanHtml,
                e($item->email_perusahaan),
                e($item->nama_kontak_person),
                e($item->no_kontak_person),
                $dokumenHtml,
                $jadwalHtml,
                e($item->no_sertifikat),
                $sertifikatHtml,
                $item->created_at->format('Y/m/d'),
                $actionHtml,
            ];
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $rows,
        ]);
    }

    /**
     * AJAX: Ambil detail satu asesi + jadwal asesmen options (untuk edit modal).
     */
    public function show($id)
    {
        $asesi = AsesiModel::with('asesmen')->findOrFail($id);

        // Ambil jadwal asesmen berdasarkan kegiatan + LSP yang sama
        $jadwalOptions = [];
        if ($asesi->asesmen) {
            $jadwalList = AsesmenModel::where('kegiatan_ref', $asesi->kegiatan_ref)
                ->where('nama_lsp', $asesi->asesmen->nama_lsp)
                ->orderBy('jadwal_asesmen', 'asc')
                ->get();

            foreach ($jadwalList as $jadwal) {
                $jadwalOptions[] = [
                    'ref' => $jadwal->ref,
                    'label' => Carbon::parse($jadwal->jadwal_asesmen)->locale('id')->translatedFormat('l, d F Y')
                        . ' - ' . $jadwal->nama_skema . ' (TUK: ' . $jadwal->nama_tuk . ')',
                    'selected' => $jadwal->ref === $asesi->asesmen_ref,
                ];
            }
        }

        return response()->json([
            'asesi' => $asesi,
            'jadwalOptions' => $jadwalOptions,
            'lspNama' => $asesi->asesmen->nama_lsp ?? '-',
        ]);
    }

    public function update(Request $request, $id)
    {
        $asesi = AsesiModel::findOrFail($id);

        // Validate file uploads
        $request->validate([
            'ktp_file' => 'nullable|file|mimes:pdf|max:2048',
            'ijazah_file' => 'nullable|file|mimes:pdf|max:2048',
            'sertikom_file' => 'nullable|file|mimes:pdf|max:2048',
            'keterangan_kerja_file' => 'nullable|file|mimes:pdf|max:2048',
            'pas_foto_file' => 'nullable|file|mimes:jpg,png|max:2048',
        ], [
            'ktp_file.mimes' => 'File KTP harus berformat PDF.',
            'ktp_file.max' => 'Ukuran file KTP maksimal 2 MB.',
            'ijazah_file.mimes' => 'File Ijazah harus berformat PDF.',
            'ijazah_file.max' => 'Ukuran file Ijazah maksimal 2 MB.',
            'sertikom_file.mimes' => 'File Sertifikat Kompetensi harus berformat PDF.',
            'sertikom_file.max' => 'Ukuran file Sertifikat Kompetensi maksimal 2 MB.',
            'keterangan_kerja_file.mimes' => 'File Surat Keterangan Kerja harus berformat PDF.',
            'keterangan_kerja_file.max' => 'Ukuran file Surat Keterangan Kerja maksimal 2 MB.',
            'pas_foto_file.mimes' => 'Pas Foto harus berformat JPG atau PNG.',
            'pas_foto_file.max' => 'Ukuran Pas Foto maksimal 2 MB.',
        ]);

        // Update text fields (exclude file fields from mass update)
        $asesi->update($request->except(['ktp_file', 'ijazah_file', 'sertikom_file', 'keterangan_kerja_file', 'pas_foto_file']));

        // Handle file uploads
        $fileFields = [
            'ktp_file' => ['disk' => 'KTP', 'folder' => 'KTP'],
            'ijazah_file' => ['disk' => 'ijazah', 'folder' => 'ijazah'],
            'sertikom_file' => ['disk' => 'sertikom', 'folder' => 'sertikom'],
            'keterangan_kerja_file' => ['disk' => 'SKB', 'folder' => 'SKB'],
            'pas_foto_file' => ['disk' => 'pas-foto', 'folder' => 'pas-foto'],
        ];

        foreach ($fileFields as $field => $config) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($asesi->{$field} && Storage::disk($config['disk'])->exists($config['folder'] . '/' . $asesi->{$field})) {
                    Storage::disk($config['disk'])->delete($config['folder'] . '/' . $asesi->{$field});
                }

                // Store new file
                $ext = $request->file($field)->extension();
                $filename = Str::uuid() . ".{$ext}";
                Storage::disk($config['disk'])->putFileAs($config['folder'], $request->file($field), $filename);

                $asesi->update([$field => $filename]);
            }
        }

        $flashData = [
            'title' => 'Data Asesi Berhasil Diupdate',
            'message' => 'Data Berhasil Diupdate',
            'type' => 'success',
        ];
        return redirect()->route('asesiAdmin.index')->with('flashData', $flashData);
    }

    public function destroy($id)
    {
        // $asesi = AsesiModel::findOrFail($id);
        // $asesi->delete();

        AsesiModel::where('ref', $id)->delete();


        $flashData = [
            'judul' => 'Hapus Data Success',
            'pesan' => 'Data Asesi Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json($flashData);
    }
}
