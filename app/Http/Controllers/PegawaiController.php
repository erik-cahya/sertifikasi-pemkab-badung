<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\PegawaiModel;
use Illuminate\Support\Facades\Storage;

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
            'pegawai_file' => 'required|file|mimes:pdf|max:5120',
        ], [
            'pegawai_nama_hotel.required' => 'Nama tidak boleh kosong',
            'pegawai_hk.required' => 'Data Pegawai Housekeeping tidak boleh kosong',
            'pegawai_fbs.required' => 'Data Pegawai F&B Service tidak boleh kosong',
            'pegawai_fbp.required' => 'Data Pegawai F&B Product tidak boleh kosong',
            'pegawai_fo.required' => 'Data Pegawai Kantor Depan tidak boleh kosong',
            'pegawai_eng.required' => 'Data Pegawai Engineering tidak boleh kosong',
            'pegawai_oth.required' => 'Data Pegawai Lainnya tidak boleh kosong',
            'pegawai_file.required' => 'File Data Pegawai wajib diunggah.',
            'pegawai_file.file'     => 'File tidak valid',
            'pegawai_file.mimes'    => 'Format file harus PDF',
            'pegawai_file.max'      => 'Ukuran file maksimal 5 MB',
        ]);

        $ext  = $request->file('pegawai_file')->extension();
        $time = time();
        $hotel  = $request->pegawai_nama_hotel;
        $filename = "DATA-PEGAWAI-{$hotel}-{$time}.{$ext}";
        $path = Storage::disk('pegawai_hotel')->putFileAs("pegawai_hotel", $request->file('pegawai_file'), $filename);

        PegawaiModel::create([
            'pegawai_nama_hotel' => $request->pegawai_nama_hotel,
            'pegawai_hk' => $request->pegawai_hk,
            'pegawai_fbs' => $request->pegawai_fbs,
            'pegawai_fbp' => $request->pegawai_fbp,
            'pegawai_fo' => $request->pegawai_fo,
            'pegawai_eng' => $request->pegawai_eng,
            'pegawai_oth' => $request->pegawai_oth,
            'pegawai_total' => $request->pegawai_total,
            'pegawai_file' => $path,
        ]);

        $flashData = [
            'title' => 'Pendataan Jumlah Pegawai Hotel Berhasil',
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
        // Validasi data dasar
        $rules = [
            'pegawai_nama_hotel' => 'required',
            'pegawai_hk' => 'required|numeric|min:0',
            'pegawai_fbs' => 'required|numeric|min:0',
            'pegawai_fbp' => 'required|numeric|min:0',
            'pegawai_fo' => 'required|numeric|min:0',
            'pegawai_eng' => 'required|numeric|min:0',
            'pegawai_oth' => 'required|numeric|min:0',
        ];

        $messages = [
            'pegawai_nama_hotel.required' => 'Nama hotel tidak boleh kosong',
            'pegawai_hk.required' => 'Data Pegawai Housekeeping tidak boleh kosong',
            'pegawai_fbs.required' => 'Data Pegawai F&B Service tidak boleh kosong',
            'pegawai_fbp.required' => 'Data Pegawai F&B Product tidak boleh kosong',
            'pegawai_fo.required' => 'Data Pegawai Kantor Depan tidak boleh kosong',
            'pegawai_eng.required' => 'Data Pegawai Engineering tidak boleh kosong',
            'pegawai_oth.required' => 'Data Pegawai Lainnya tidak boleh kosong',
        ];

        if ($request->hasFile('pegawai_file')) {
            $rules['pegawai_file'] = 'file|mimes:pdf|max:5120';
            $messages['pegawai_file.file'] = 'File tidak valid';
            $messages['pegawai_file.mimes'] = 'Format file harus PDF';
            $messages['pegawai_file.max'] = 'Ukuran file maksimal 5 MB';
        }

        $validated = $request->validate($rules, $messages);

        $pegawai = PegawaiModel::findOrFail($ref);

        $total = $request->pegawai_hk + $request->pegawai_fbs + $request->pegawai_fbp +
            $request->pegawai_fo + $request->pegawai_eng + $request->pegawai_oth;

        // Data yang akan diupdate
        $dataToUpdate = [
            'pegawai_nama_hotel' => $request->pegawai_nama_hotel,
            'pegawai_hk' => $request->pegawai_hk,
            'pegawai_fbs' => $request->pegawai_fbs,
            'pegawai_fbp' => $request->pegawai_fbp,
            'pegawai_fo' => $request->pegawai_fo,
            'pegawai_eng' => $request->pegawai_eng,
            'pegawai_oth' => $request->pegawai_oth,
            'pegawai_total' => $total,
        ];

        // Jika ada file yang diupload, proses upload dan hapus file lama
        if ($request->hasFile('pegawai_file')) {
            // Hapus file lama jika ada
            if ($pegawai->pegawai_file && Storage::disk('pegawai_hotel')->exists($pegawai->pegawai_file)) {
                Storage::disk('pegawai_hotel')->delete($pegawai->pegawai_file);
            }

            // Upload file baru
            $ext = $request->file('pegawai_file')->extension();
            $time = time();
            $hotel = $request->pegawai_nama_hotel;
            $filename = "DATA-PEGAWAI-{$hotel}-{$time}.{$ext}";
            $path = Storage::disk('pegawai_hotel')->putFileAs("pegawai_hotel", $request->file('pegawai_file'), $filename);

            // Tambahkan path file ke data yang akan diupdate
            $dataToUpdate['pegawai_file'] = $path;
        }

        $pegawai->update($dataToUpdate);

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

            // Hapus file dari storage jika ada
            if ($pegawai->pegawai_file && Storage::disk('pegawai_hotel')->exists($pegawai->pegawai_file)) {
                Storage::disk('pegawai_hotel')->delete($pegawai->pegawai_file);
            }

            // Hapus data dari database
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
