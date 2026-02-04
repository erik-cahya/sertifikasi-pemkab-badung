<?php

namespace App\Http\Controllers;

use App\Models\LSPModel;
use App\Models\SkemaDetailModel;
use App\Models\SkemaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SkemaController extends Controller
{
    public function __construct()
    {
        View()->share('title', 'Skema');
    }

    public function getByLsp(string $lspRef)
    {
        $skema = SkemaModel::where('lsp_ref', $lspRef)
            ->select('ref', 'skema_judul')
            ->orderBy('skema_judul')
            ->get();

        return response()->json($skema);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = SkemaModel::select(
            'skema.ref',
            'skema.lsp_ref',
            'skema.skema_judul',
            'skema.skema_kode',
            'skema.skema_kategori',

            'lsp.lsp_nama'

        )->withCount('details as unitCount')->with('details')->join('lsp', 'lsp.ref', '=', 'skema.lsp_ref');

        if (Auth::user()->roles !== 'master') {
            $dataLSP = LSPModel::where('user_ref', Auth::user()->ref)->firstOrFail();
            $query->where('lsp_ref', $dataLSP->ref);
        }

        return view('admin-panel.skema.index', [
            'dataSkema' => $query->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        $dataLsp = LSPModel::where('user_ref', $user->ref)
            ->select('ref as lspRef', 'lsp_nama', 'lsp_no_lisensi')
            ->firstOrFail();

        // if (!$dataLsp) {
        //     abort(403, 'Anda belum terdaftar sebagai LSP.');
        // }

        $dataSkema = SkemaModel::where('lsp_ref', $dataLsp->lspRef)->select('ref', 'skema_judul')->get();

        return view('admin-panel.skema.create', compact('dataLsp', 'dataSkema'));
    }

    /**
     * Function Create Skema
     */
    public function store(Request $request)
    {
        // dd($request->all());

        Validator::make($request->all(), [
            'skema_judul' => 'required',
            'skema_kode' => 'required',
            'skema_kategori' => 'required',
        ], [
            'skema_judul.required' => 'Silahkan inputkan nama skema',
            'skema_kode.required' => 'Silahkan inputkan kode skema',
            'skema_kategori.required' => 'Silahkan pilih kategori skema',
        ])->validateWithBag('create_skema');

        $dataLSP = LSPModel::where('user_ref', Auth::user()->ref)->first();
        SkemaModel::create([
            'lsp_ref' => $dataLSP->ref,
            'skema_judul' => $request->skema_judul,
            'skema_kode' => $request->skema_kode,
            'skema_kategori' => $request->skema_kategori,
            'created_by' => Auth::user()->ref,
        ]);


        return redirect()
            ->back()
            ->with('active_tab', 'create_skema')
            ->with('flashData', [
                'title' => 'Tambah Data Success',
                'message' => 'Skema Baru Berhasil Ditambahkan',
                'type' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['skema'] = SkemaModel::where('ref', $id)->with('details')->firstOrFail();

        return view('admin-panel.skema.show', $data);
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
        SkemaModel::where('ref', $id)->update([
            'skema_judul' => $request->skema_judul,
            'skema_kode' => $request->skema_kode,
            'skema_kategori' => $request->skema_kategori,
        ]);

        return redirect()
            ->route('skema.index')
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
        SkemaModel::where('ref', $id)->delete();
        $flashData = [
            'judul' => 'Hapus Data Success',
            'pesan' => 'Data Skema Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json($flashData);
    }
}
