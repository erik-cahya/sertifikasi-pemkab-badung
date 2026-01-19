<?php

namespace App\Http\Controllers;

use App\Models\KegiatanDetailModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsesmenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        $data['dataKegiatan'] = KegiatanDetailModel::where('ref', $id)->with('lsp')->with('kegiatan')->firstOrFail();
        return view('admin-panel.asesmen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        KegiatanDetailModel::where('ref', $id)->update([
            'kuota_lsp' => $request->kuota_lsp,
            'mulai_asesmen' => Carbon::createFromFormat('d/m/Y', $request->mulai_asesmen)->setTimeFrom(Carbon::now()->format('Y-m-d H:i:s')),
            'selesai_asesmen' => Carbon::createFromFormat('d/m/Y', $request->selesai_asesmen)->setTimeFrom(Carbon::now()->format('Y-m-d H:i:s')),
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
        KegiatanDetailModel::where('ref', $id)->delete();
        $flashData = [
            'judul' => 'Hapus Data Success',
            'pesan' => 'Kegiatan Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json($flashData);
    }
}
