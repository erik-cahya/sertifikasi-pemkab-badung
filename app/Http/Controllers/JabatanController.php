<?php

namespace App\Http\Controllers;

use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepartemenController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = JabatanModel::join('users', 'users.ref', '=', 'jabatan.created_by')
        ->select('jabatan.*', 'users.name')
        ->orderBy('jabatan.created_at', 'desc')
        ->get();

        return view('admin-panel.jabatan.index', [
            'dataJabatan' => $query
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Function Create Skema
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'departemen_nama' => 'required',
        // ], [
        //     'departemen_nama.required' => 'Nama departemen tidak boleh kosong',
        // ]);

        // JabatanModel::create([
        //     'departemen_nama' => $request->departemen_nama,
        //     'created_by' => Auth::user()->ref,
        // ]);

        // $flashData = [
        //     'title' => 'Tambah Data Departemen Berhasii',
        //     'message' => 'Data Departemen Berhasil Ditambahkan',
        //     'type' => 'success',
        // ];
        // return redirect()->route('departemen.index')->with('flashData', $flashData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
        // Note : harus delete jabatan juga jangan lupa
        JabatanModel::where('ref', $id)->delete();
        $flashData = [
            'judul' => 'Hapus Data Berhasil',
            'pesan' => 'Jabatan Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json($flashData);
    }
}
