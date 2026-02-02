<?php

namespace App\Http\Controllers;

use App\Models\AsesmenModel;
use App\Models\KegiatanDetailModel;
use App\Models\KegiatanJadwalModel;
use App\Models\KegiatanLSPModel;
use App\Models\KegiatanModel;
use App\Models\TUKModel;
use App\Models\KegiatanSkemaModel;
use App\Models\SkemaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesmenController extends Controller
{
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
        $data['dataTUK'] = TUKModel::where('lsp_ref', $user->lspData->ref)->get();
        $data['dataSkema'] = SkemaModel::where('lsp_ref', $user->lspData->ref)->get();

        // dd($data['dataKegiatan']);
        return view('admin-panel.asesmen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->loadMissing('lspData');

        // dd($user->lspData->ref);

        // $query = KegiatanModel::with([
        //     'kegiatanLsp:ref,kegiatan_ref,lsp_ref,kuota_lsp',
        //     'kegiatanLsp.lsp:ref,lsp_nama'
        // ])->withSum('kegiatanLsp as total_kuota', 'kuota_lsp');

        // if ($user->roles === 'lsp' && $user->lspData) {
        //     $query->whereHas('kegiatanLsp', function ($q) use ($user) {
        //         $q->where('lsp_ref', $user->lspData->ref);
        //     });
        // }

        $data['dataKegiatan'] = KegiatanModel::where('ref', $id)
            ->with([
                'kegiatanLsp.lsp',           // detail kuota + LSP
                'kegiatanLsp.jadwal',
                'skemaPerLsp.lsp',        // total skema per LSP
                'kuotaPerLsp.lsp',      // total kuota per LSP
                'asesi.tuk',
                'asesi.skema'
            ])->withSum(
                'kegiatanLsp as total_peserta',
                'kuota_lsp',
            )->withCount('skemas', 'asesi')        // total skema kegiatan
            ->firstOrFail();

        $data['dataTUK'] = TUKModel::where('lsp_ref', $user->lspData->ref)->get();
        $data['dataSkema'] = KegiatanSkemaModel::with('skema')->where('kegiatan_ref', $id)->where('lsp_ref', $user->lspData->ref)
            ->get();

        // dd($data['dataSkema']);
        $jadwalKegiatan = KegiatanJadwalModel::where('kegiatan_ref', $id)->where('lsp_ref', $user->lspData->ref)->firstOrFail();

        // dd($jadwalKegiatan);
        $data['mulaiKegiatan']   = $jadwalKegiatan->mulai_asesmen;
        $data['selesaiKegiatan'] = $jadwalKegiatan->selesai_asesmen;

        $data['kegiatan_jadwal_ref'] = $jadwalKegiatan->ref;
        $data['kegiatan_ref'] = $jadwalKegiatan->kegiatan_ref;
        $data['kegiatan_lsp_ref'] = $jadwalKegiatan->kegiatan_lsp_ref;

        return view('admin-panel.asesmen.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tuk' => 'required',
            'skema_sertifikasi' => 'required',
            'nama_penanggung_jawab' => 'required',
            'no_penanggung_jawab' => 'required',
            'nama_penyelenggara_uji' => 'required',
            'no_penyelenggara_uji' => 'required',
            'nama_asesor' => 'required',
            'no_asesor' => 'required',
            'no_reg_asesor' => 'required',
        ]);

        $kuotaHarian = 10;

        AsesmenModel::create([
            'kegiatan_ref' => $request->kegiatan_ref,
            'kegiatan_lsp_ref' => $request->kegiatan_lsp_ref,
            'kegiatan_jadwal_ref' => $request->kegiatan_jadwal_ref,

            'nama_lsp' => Auth::user()->lspData->lsp_nama,
            'nama_tuk' => $request->nama_tuk,
            'nama_skema' => $request->skema_sertifikasi,
            'jadwal_asesmen' => Carbon::createFromFormat('d/m/Y', $request->jadwal_asesmen)->format('Y-m-d'),
            'kuota_harian' => $kuotaHarian, // Kuota perhari
            'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
            'no_penanggung_jawab' => $request->no_penanggung_jawab,
            'nama_penyelenggara_uji' => $request->nama_penyelenggara_uji,
            'no_penyelenggara_uji' => $request->no_penyelenggara_uji,
            'nama_asesor' => $request->nama_asesor,
            'no_asesor' => $request->no_asesor,
            'no_reg_asesor' => $request->no_reg_asesor,
            'created_by' => Auth::user()->ref,
        ]);

        return redirect()
            ->route('kegiatan.index')
            ->with('flashData', [
                'title' => 'Tambah Data Success',
                'message' => 'Jadwal Asesmen Berhasil Diubah Diubah',
                'type' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
