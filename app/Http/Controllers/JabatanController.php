<?php

namespace App\Http\Controllers;

use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{

    public function __construct()
    {
        View()->share('title', 'Jabatan');
    }

    public function getJabatanByDepartemen($departemenNama)
    {
        $departemenRef = DepartemenModel::where('departemen_nama', $departemenNama)->first();
        $data = JabatanModel::where('departemen_ref', $departemenRef->ref)
            ->get()
            ->map(function ($item) {
                return [
                    'jabatan_nama' => $item->jabatan_nama,
                ];
            });
        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = JabatanModel::join('departemen', 'departemen.ref', '=', 'jabatan.departemen_ref')
            ->join('users', 'users.ref', '=', 'jabatan.created_by')
            ->select('jabatan.*', 'departemen.departemen_nama', 'users.name')
            ->orderBy('jabatan.created_at', 'desc')
            ->get();

        $departemen = DepartemenModel::all();

        return view('admin-panel.jabatan.index', [
            'dataJabatan' => $query,
            'dataDepartemen' => $departemen,
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
            'departemen_ref' => 'required',
            'jabatan_nama' => 'required|unique:jabatan,jabatan_nama',
        ], [
            'departemen_ref.required' => 'Departemen tidak boleh kosong',
            'jabatan_nama.required' => 'Jabatan tidak boleh kosong',
            'jabatan_nama.unique' => 'Jabatan ini sudah ada',
        ])->validateWithBag('create_jabatan');

        JabatanModel::create([
            'departemen_ref' => $request->departemen_ref,
            'jabatan_nama' => trim($request->jabatan_nama),
            'created_by' => Auth::user()->ref,
        ]);

        $flashData = [
            'title' => 'Tambah Data Jabatan Berhasii',
            'message' => 'Data Jabatan Berhasil Ditambahkan',
            'type' => 'success',
        ];
        return redirect()->route('jabatan.index')->with('flashData', $flashData);
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
        $query = JabatanModel::join('departemen', 'departemen.ref', '=', 'jabatan.departemen_ref')
            ->join('users', 'users.ref', '=', 'jabatan.created_by')
            ->select('jabatan.*', 'departemen.departemen_nama', 'users.name')
            ->orderBy('jabatan.created_at', 'desc')
            ->where('jabatan.ref', $id)
            ->get();

        $departemen = DepartemenModel::all();

        return view('admin-panel.jabatan.edit', [
            'dataJabatan' => $query,
            'dataDepartemen' => $departemen
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        JabatanModel::where('ref', $id)->update([
            'departemen_ref' => $request->departemen_ref,
            'jabatan_nama' => $request->jabatan_nama,
        ]);

        return redirect()
            ->route('jabatan.index')
            ->with('flashData', [
                'title' => 'Edit Data Success',
                'message' => 'Data Jabatan Berhasil Diubah',
                'type' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JabatanModel::where('ref', $id)->delete();
        $flashData = [
            'judul' => 'Hapus Data Berhasil',
            'pesan' => 'Data Jabatan Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json($flashData);
    }
}
