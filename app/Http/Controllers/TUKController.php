<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\TUKModel;
use App\Models\LSPModel;

class TUKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lsp = LSPModel::all();

        return view('pendaftaran.pendaftaran-tuk', [
            'dataLsp' => $lsp
        ]);
    }

    public function added(Request $request)
    {
        dd($request);
        $validated = $request->validate([
            'lsp_ref' => 'required',
            'tuk_nama' => 'required',
            'tuk_alamat' => 'required', 
            'tuk_telp' => 'required', 
            'tuk_email' => 'required', 
            'tuk_cp_nama' => 'required', 
            'tuk_cp_email' => 'required', 
            'tuk_cp_telp' => 'required', 
        ], [
            'lsp_ref' => 'TUK harus memiliki LSP Induk tidak boleh kosong',
            'tuk_nama' => 'Nama TUK tidak boleh kosong',
            'tuk_alamat' => 'Alamat TUK tidak boleh kosong', 
            'tuk_telp' => 'Telp TUK tidak boleh kosong', 
            'tuk_email' => 'Email TUK tidak boleh kosong', 
            'tuk_cp_nama' => 'Nama Kontak Person TUK tidak boleh kosong', 
            'tuk_cp_email' => 'Email Kontak Person TUK tidak boleh kosong', 
            'tuk_cp_telp' => 'Telp Kontak Person TUK tidak boleh kosong',
        ]);

        TUKModel::create([
            'lsp_ref' => $request->lsp_ref,
            'tuk_nama' => $request->tuk_nama,
            'tuk_alamat' => $request->tuk_alamat,
            'tuk_email' => $request->tuk_email,
            'tuk_telp' => $request->tuk_telp,
            'tuk_cp_nama' => $request->tuk_cp_nama,
            'tuk_cp_email' => $request->tuk_cp_email,
            'tuk_cp_telp' => $request->tuk_cp_telp,
            'tuk_verif' => 0,
        ]);

        $flashData = [
            'title' => 'Pendaftaran TUK Berhasii',
            'message' => 'Data TUK Anda Berhasil Didaftarkan',
            'type' => 'success',
        ];
        return redirect()->route('tuk.index')->with('flashData', $flashData);
        
    }

    // TUK ADMIN PANEL
    public function list()
    {
        $tuk = TUKModel::join('lsp', 'lsp.ref', '=', 'tuk.lsp_ref')
        ->select('tuk.*','lsp.lsp_nama')
        ->orderBy('tuk.created_at', 'desc')
        ->get();

        return view('admin-panel.tuk.index', [
            'dataTUK' => $tuk,
        ]);
    }

    public function create()
    {
        $lsp = LSPModel::all();

        return view('admin-panel.tuk.create', [
            'dataLsp' => $lsp
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'lsp_ref' => 'required',
            'tuk_nama' => 'required',
            'tuk_alamat' => 'required', 
            'tuk_telp' => 'required', 
            'tuk_email' => 'required', 
            'tuk_cp_nama' => 'required', 
            'tuk_cp_email' => 'required', 
            'tuk_cp_telp' => 'required', 
        ], [
            'lsp_ref' => 'TUK harus memiliki LSP Induk tidak boleh kosong',
            'tuk_nama' => 'Nama TUK tidak boleh kosong',
            'tuk_alamat' => 'Alamat TUK tidak boleh kosong', 
            'tuk_telp' => 'Telp TUK tidak boleh kosong', 
            'tuk_email' => 'Email TUK tidak boleh kosong', 
            'tuk_cp_nama' => 'Nama Kontak Person TUK tidak boleh kosong', 
            'tuk_cp_email' => 'Email Kontak Person TUK tidak boleh kosong', 
            'tuk_cp_telp' => 'Telp Kontak Person TUK tidak boleh kosong',
        ]);

        TUKModel::create([
            'lsp_ref' => $request->lsp_ref,
            'tuk_nama' => $request->tuk_nama,
            'tuk_alamat' => $request->tuk_alamat,
            'tuk_email' => $request->tuk_email,
            'tuk_telp' => $request->tuk_telp,
            'tuk_cp_nama' => $request->tuk_cp_nama,
            'tuk_cp_email' => $request->tuk_cp_email,
            'tuk_cp_telp' => $request->tuk_cp_telp,
            'tuk_verif' => 0,
        ]);

        $flashData = [
            'title' => 'Tambah Data TUK Berhasii',
            'message' => 'Data TUK Berhasil Ditambahkan',
            'type' => 'success',
        ];
        return redirect()->route('tukAdmin.index')->with('flashData', $flashData);
    }

    public function edit(string $id)
    {
        $tuk = TUKModel::join('lsp', 'lsp.ref', '=', 'tuk.lsp_ref')
        ->select('tuk.*','lsp.lsp_nama')
        ->orderBy('tuk.created_at', 'desc')
        ->get();

        return view('admin-panel.tuk.edit', [
            'dataTUK' => $tuk,
        ]);
    }

    public function update(Request $request, string $id)
    {
        TUKModel::where('ref', $id)->update([
            'tuk_nama' => $request->tuk_nama,
            'tuk_alamat' => $request->tuk_alamat,
            'tuk_email' => $request->tuk_email,
            'tuk_telp' => $request->tuk_telp,
            'tuk_cp_nama' => $request->tuk_cp_nama,
            'tuk_cp_email' => $request->tuk_cp_email,
            'tuk_cp_telp' => $request->tuk_cp_telp,
        ]);

        return redirect()
            ->route('tukAdmin.index')
            ->with('flashData', [
                'title' => 'Edit Data Success',
                'message' => 'Data TUK Berhasil Diubah',
                'type' => 'success',
            ]);
    }

    public function destroy(string $id)
    {
        TUKModel::where('ref', $id)->delete();

        $flashData = [
            'judul' => 'Hapus Data Berhasil',
            'pesan' => 'TUK Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json($flashData);
    }

    public function verifikasi(string $id, $code)
    {
        TUKModel::where('ref', $id)->update([
            'tuk_verif' => $code,
        ]);

        if($code==1)
        return redirect()
            ->route('tukAdmin.index')
            ->with('flashData', [
                'title' => 'Verifikasi TUK Success',
                'message' => 'Data TUK Berhasil Diverifikasi',
                'type' => 'success',
            ]);
        else{
            return redirect()
            ->route('tukAdmin.index')
            ->with('flashData', [
                'title' => 'Nonaktifkan TUK Success',
                'message' => 'Data TUK Berhasil Dinonaktifkan',
                'type' => 'warning',
            ]);
        }
    }
}
