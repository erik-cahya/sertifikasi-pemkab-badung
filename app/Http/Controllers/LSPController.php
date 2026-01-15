<?php

namespace App\Http\Controllers;

use App\Models\LSPModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LSPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataLSP'] = LSPModel::select(
            'lsp.ref',
            'lsp.lsp_nama',
            'lsp.lsp_no_lisensi',
            'lsp.lsp_email',
            'lsp.lsp_telp',

            'users.is_active',
            'users.username',
        )
            ->join('users', 'users.ref', '=', 'lsp.user_ref')
            ->get();
        return view('admin-panel.lsp.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-panel.lsp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'lsp_nama' => 'required',
            'lsp_no_lisensi' => 'required',
            'lsp_email' => 'required',
            'lsp_alamat' => 'required',
            'lsp_telp' => 'required',
            'lsp_direktur' => 'required',
            'lsp_direktur_telp' => 'required',
            'lsp_tanggal_lisensi' => 'required',
            'lsp_expired_lisensi' => 'required',

            'name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
        ], [
            'lsp_nama.required' => 'Silahkan inputkan nama LSP',
        ]);

        $userCreated = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'roles' => strtolower(trim('lsp')),
            'is_active' => 1
        ]);

        LSPModel::create([
            'user_ref' => $userCreated->ref,
            'lsp_nama' => trim($request->lsp_nama),
            'lsp_no_lisensi' => $request->lsp_no_lisensi,
            'lsp_alamat' => $request->lsp_alamat,
            'lsp_email' => $request->lsp_email,
            'lsp_telp' => $request->lsp_telp,
            'lsp_direktur' => $request->lsp_direktur,
            'lsp_direktur_telp' => $request->lsp_direktur_telp,
            'lsp_logo' => NULL,
            'lsp_tanggal_lisensi' => $request->lsp_tanggal_lisensi,
            'lsp_expired_lisensi' => $request->lsp_expired_lisensi,
            'created_by' => Auth::user()->ref,

        ]);

        $flashData = [
            'title' => 'Tambah Data Success',
            'message' => 'Data LSP Berhasil Ditambahkan',
            'type' => 'success',
        ];
        return redirect()->route('lsp.index')->with('flashData', $flashData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['dataLSP'] = LSPModel::where('ref', $id)->firstOrFail();

        //     "ref" => "01kf03772shpf27xndrraat76v"
        // "user_ref" => "01kf03772cjdjv3nf01gyz5r0e"
        // "lsp_nama" => "LSP Engineering Hospitality Indonesia"
        // "lsp_no_lisensi" => "BNSP-912394"
        // "lsp_alamat" => "Jln. Mengwi"
        // "lsp_email" => "admin@lsp-eh.com"
        // "lsp_telp" => "0892839219"
        // "lsp_direktur" => "Bapak Nyoman"
        // "lsp_direktur_telp" => "09012343"
        // "lsp_logo" => null
        // "lsp_tanggal_lisensi" => "2026-01-16"
        // "lsp_expired_lisensi" => "2026-01-16"
        // "created_by" => "01kf02ds2k9969vrxv7stm6qfr"
        // "created_at" => "2026-01-15 05:49:26"
        // "updated_at" => "2026-01-15 05:49:26"

        return view('admin-panel.lsp.show', $data);
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
        // LSPModel::where('ref', $id)->delete();

        $lsp = LSPModel::where('ref', $id)->firstOrFail();
        $lsp->delete();
        $flashData = [
            'judul' => 'Hapus Data Success',
            'pesan' => 'Data LSP Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json([
            'judul' => 'Hapus Data Success',
            'pesan' => 'Data LSP Berhasil Dihapus',
            'type'  => 'success',
        ], 200);
    }
}
