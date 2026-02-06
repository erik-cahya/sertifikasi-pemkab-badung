<?php

namespace App\Http\Controllers;

use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepartemenController extends Controller
{

    public function __construct()
    {
        View()->share('title', 'Departemen');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = DepartemenModel::join('users', 'users.ref', '=', 'departemen.created_by')
            ->select('departemen.*', 'users.name')
            ->orderBy('departemen.created_at', 'desc')
            ->get();

        return view('admin-panel.departemen.index', [
            'dataDepartemen' => $query
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Function Create Skema
     */
    public function store(Request $request)
    {


        Validator::make($request->all(), [
            'departemen_nama' => 'required|unique:departemen,departemen_nama',
        ], [
            'departemen_nama.required' => 'Nama departemen tidak boleh kosong',
            'departemen_nama.unique' => 'Nama departemen sudah ada',
        ])->validateWithBag('create_departemen');

        $lastKode = DepartemenModel::max('departemen_kode') ?? 0;

        DepartemenModel::create([
            'departemen_kode' => $lastKode + 1,
            'departemen_nama' => trim($request->departemen_nama),
            'created_by' => Auth::user()->ref,
        ]);

        $flashData = [
            'title' => 'Tambah Data Departemen Berhasii',
            'message' => 'Data Departemen Berhasil Ditambahkan',
            'type' => 'success',
        ];
        return redirect()->route('departemen.index')->with('flashData', $flashData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $query = DepartemenModel::join('users', 'users.ref', '=', 'departemen.created_by')
            ->select('departemen.*', 'users.name')
            ->orderBy('departemen.created_at', 'desc')
            ->where('departemen.ref', $id)
            ->get();

        return view('admin-panel.departemen.edit', [
            'dataDepartemen' => $query
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DepartemenModel::where('ref', $id)->update([
            'departemen_nama' => $request->departemen_nama,
        ]);

        return redirect()
            ->route('departemen.index')
            ->with('flashData', [
                'title' => 'Edit Data Success',
                'message' => 'Departemen Berhasil Diubah',
                'type' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JabatanModel::where('departemen_ref', $id)->delete();
        DepartemenModel::where('ref', $id)->delete();

        $flashData = [
            'judul' => 'Hapus Data Berhasil',
            'pesan' => 'Departemen Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json($flashData);
    }
}
