<?php

namespace App\Http\Controllers;

use App\Models\KegiatanDetailModel;
use App\Models\KegiatanModel;
use App\Models\LSPModel;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataKegiatan'] = KegiatanModel::with([
            'details.lsp'
        ])->withSum(
            'details as total_kuota_lsp',
            'kuota_lsp'
        )->get();

        // dd($data['dataKegiatan']);

        return view('admin-panel.kegiatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataLSP'] = LSPModel::get();

        // Jika data kegiatan sudah dibuat, maka tidak ditampilkan lagi
        $data['dataKegiatan'] = KegiatanModel::select('ref', 'nama_kegiatan')->whereDoesntHave('details')->get();
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

        KegiatanModel::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'mulai_kegiatan' => Carbon::createFromFormat('d/m/Y', $request->mulai_kegiatan)->format('Y-m-d'),
            'selesai_kegiatan' => Carbon::createFromFormat('d/m/Y', $request->selesai_kegiatan)->format('Y-m-d'),
            'status' => 1,
            'created_by' => Auth::user()->ref,

        ]);

        return redirect('/kegiatan/create#add_lsp')
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

        $data['dataKegiatan'] = KegiatanModel::where('ref', $id)
            ->with([
                'details.lsp',           // detail kuota + LSP
                'skemaPerLsp.lsp',        // total skema per LSP
                'kuotaPerLsp.lsp'      // total kuota per LSP
            ])->withSum(
                'details as total_kuota_lsp',
                'kuota_lsp'
            )->withCount('skemas')        // total skema kegiatan
            ->firstOrFail();

        $data['skemaPerLsp'] = $data['dataKegiatan']->skemaPerLsp
            ->keyBy('lsp_ref');

        // dd($data['skemaPerLsp']);

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
        //
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
}
