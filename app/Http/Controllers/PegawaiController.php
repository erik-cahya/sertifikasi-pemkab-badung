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
    public function __construct()
    {
        View()->share('title', 'Pegawai');
    }
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
            'pegawai_nama_hotel' => 'required',
            'pegawai_hk' => 'required',
            'pegawai_fbs' => 'required',
            'pegawai_fbp' => 'required',
            'pegawai_fo' => 'required',
            'pegawai_eng' => 'required',
            'pegawai_oth' => 'required',
        ], [
            'pegawai_nama_hotel.required' => 'Nama tidak boleh kosong',
            'pegawai_hk.required' => 'Data Pegawai Housekeeping tidak boleh kosong',
            'pegawai_fbs.required' => 'Data Pegawai F&B Service tidak boleh kosong',
            'pegawai_fbp.required' => 'Data Pegawai F&B Product tidak boleh kosong',
            'pegawai_fo.required' => 'Data Pegawai Kantor Depan tidak boleh kosong',
            'pegawai_eng.required' => 'Data Pegawai Engineering tidak boleh kosong',
            'pegawai_oth.required' => 'Data Pegawai Lainnya tidak boleh kosong',
        ]);


        PegawaiModel::create([
            'pegawai_nama_hotel' => $request->pegawai_nama_hotel,
            'pegawai_hk' => $request->pegawai_hk,
            'pegawai_fbs' => $request->pegawai_fbs,
            'pegawai_fbp' => $request->pegawai_fbp,
            'pegawai_fo' => $request->pegawai_fo,
            'pegawai_eng' => $request->pegawai_eng,
            'pegawai_oth' => $request->pegawai_oth,
            'pegawai_total' => $request->pegawai_total,
        ]);

        $flashData = [
            'title' => 'Pendataan Jumlah Pegawai Hotel Berhasii',
            'message' => 'Data Anda Berhasil Dikirim',
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

    public function update(Request $request, $ref)
    {
        $validated = $request->validate([
            'pegawai_nama_hotel' => 'required',
            'pegawai_hk' => 'required|numeric|min:0',
            'pegawai_fbs' => 'required|numeric|min:0',
            'pegawai_fbp' => 'required|numeric|min:0',
            'pegawai_fo' => 'required|numeric|min:0',
            'pegawai_eng' => 'required|numeric|min:0',
            'pegawai_oth' => 'required|numeric|min:0',
        ], [
            'pegawai_nama_hotel.required' => 'Nama hotel tidak boleh kosong',
            'pegawai_hk.required' => 'Data Pegawai Housekeeping tidak boleh kosong',
            'pegawai_fbs.required' => 'Data Pegawai F&B Service tidak boleh kosong',
            'pegawai_fbp.required' => 'Data Pegawai F&B Product tidak boleh kosong',
            'pegawai_fo.required' => 'Data Pegawai Kantor Depan tidak boleh kosong',
            'pegawai_eng.required' => 'Data Pegawai Engineering tidak boleh kosong',
            'pegawai_oth.required' => 'Data Pegawai Lainnya tidak boleh kosong',
        ]);

        $pegawai = PegawaiModel::findOrFail($ref);

        $total = $request->pegawai_hk + $request->pegawai_fbs + $request->pegawai_fbp +
            $request->pegawai_fo + $request->pegawai_eng + $request->pegawai_oth;

        $pegawai->update([
            'pegawai_nama_hotel' => $request->pegawai_nama_hotel,
            'pegawai_hk' => $request->pegawai_hk,
            'pegawai_fbs' => $request->pegawai_fbs,
            'pegawai_fbp' => $request->pegawai_fbp,
            'pegawai_fo' => $request->pegawai_fo,
            'pegawai_eng' => $request->pegawai_eng,
            'pegawai_oth' => $request->pegawai_oth,
            'pegawai_total' => $total,
        ]);

        return response()->json([
            'judul' => 'Berhasil!',
            'pesan' => 'Data pegawai berhasil diupdate',
            'type' => 'success',
        ]);
    }

    public function destroy($ref)
    {
        try {
            $pegawai = PegawaiModel::findOrFail($ref);
            $namaHotel = $pegawai->pegawai_nama_hotel;
            $pegawai->delete();

            return response()->json([
                'judul' => 'Berhasil!',
                'pesan' => 'Data pegawai ' . $namaHotel . ' berhasil dihapus',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'judul' => 'Gagal!',
                'pesan' => 'Terjadi kesalahan saat menghapus data',
                'type' => 'error',
            ], 500);
        }
    }
}
