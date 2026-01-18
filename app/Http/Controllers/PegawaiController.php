<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\PegawaiModel;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pendaftaran.pendaftaran-pegawai');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pegawai_nama' => 'required',
            'pegawai_nik' => 'required|unique:pegawai,pegawai_nik',
            'pegawai_telp' => 'required', 
            'pegawai_tempat_bekerja' => 'required', 
        ], [
            'pegawai_nama.required' => 'Nama tidak boleh kosong',
            'pegawai_nik.required' => 'NIK tidak boleh kosong',
            'pegawai_nik.unique' => 'NIK sudah terdaftar',
            'pegawai_telp.required' => 'Telp tidak boleh kosong', 
            'pegawai_tempat_bekerja.required' => 'Tempat Bekerja tidak boleh kosong', 
        ]);


       PegawaiModel::create([
            'pegawai_nama' => $request->pegawai_nama,
            'pegawai_nik' => $request->pegawai_nik,
            'pegawai_telp' => $request->pegawai_telp,
            'pegawai_tempat_bekerja' => $request->pegawai_tempat_bekerja,
        ]);

        $flashData = [
            'title' => 'Pendataan Pegawai Berhasii',
            'message' => 'Data Anda Berhasil Didaftarkan',
            'type' => 'success',
        ];
        return redirect()->route('pegawai.index')->with('flashData', $flashData);
        
    }

     // Pegawai ADMIN PANEL
    public function list()
    {
        $pegawai = PegawaiModel::orderBy('created_at', 'desc')->get();

        return view('admin-panel.pegawai.index', [
            'dataPegawai' => $pegawai,
        ]);
    }
}
