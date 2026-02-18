<?php

namespace App\Http\Controllers;

use App\Models\AsesiModel;
use App\Models\AsesmenModel;
use App\Models\KegiatanJadwalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{

    /**
     * Akses file KTP asesi
     */
    public function getKTPAsesi($filename)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }
        $this->checkAsesiFileAuthorization($filename, 'ktp_file');

        $path = storage_path('app/private/asesi_files/KTP/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = AsesiModel::where('ktp_file', $filename)->select('nama_lengkap')->first();
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="KTP - ' . $fileName->nama_lengkap . '"'
        ]);
    }

    /**
     * Akses file ijazah asesi
     */
    public function getIjazahAsesi($filename)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $this->checkAsesiFileAuthorization($filename, 'ijazah_file');

        $path = storage_path('app/private/asesi_files/ijazah/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = AsesiModel::where('ijazah_file', $filename)->select('nama_lengkap')->first();
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="Ijazah - ' . $fileName->nama_lengkap . '"'
        ]);
    }

    /**
     * Akses file sertikom asesi
     */
    public function getSertikomAsesi($filename)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $this->checkAsesiFileAuthorization($filename, 'sertikom_file');

        $path = storage_path('app/private/asesi_files/sertikom/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = AsesiModel::where('sertikom_file', $filename)->select('nama_lengkap')->first();
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="Sertifikat Kompetensi - ' . $fileName->nama_lengkap . '"'
        ]);
    }
    /**
     * Akses file sertifikat asesi
     */
    public function getSertifikatAsesi($filename)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $this->checkAsesiFileAuthorization($filename, 'sertifikat_file');

        $path = storage_path('app/private/asesi_files/sertifikat/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = AsesiModel::where('sertifikat_file', $filename)->select('nama_lengkap')->first();
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="Sertifikat - ' . $fileName->nama_lengkap . '"'
        ]);
    }

    /**
     * Akses file surat keterangan bekerja asesi
     */
    public function getSkbAsesi($filename)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $this->checkAsesiFileAuthorization($filename, 'keterangan_kerja_file');

        $path = storage_path('app/private/asesi_files/SKB/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = AsesiModel::where('keterangan_kerja_file', $filename)->select('nama_lengkap')->first();
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="Surat Keterangan Bekerja - ' . $fileName->nama_lengkap . '"'
        ]);
    }


    /**
     * Akses file pas foto asesi
     */
    public function getPasFotoAsesi($filename)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $this->checkAsesiFileAuthorization($filename, 'pas_foto_file');

        $path = storage_path('app/private/asesi_files/pas-foto/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = AsesiModel::where('pas_foto_file', $filename)->select('nama_lengkap')->first();
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="Pas Foto - ' . $fileName->nama_lengkap . '"'
        ]);
    }


    /**
     * Serve asesmen files (bukti, dokumentasi, laporan) dengan autentikasi
     */
    public function getBuktiAsesmen($filename)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $path = storage_path('app/private/asesmen_files/bukti_asesmen/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = AsesmenModel::where('bukti_asesmen', $filename)->select('nama_lsp')->first();
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="Bukti Asesmen - ' . $fileName->nama_lsp . '"'
        ]);
    }
    public function getDokumentasiAsesmen($filename)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $path = storage_path('app/private/asesmen_files/dokumentasi_asesmen/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = AsesmenModel::where('dokumentasi_asesmen', $filename)->select('nama_lsp')->first();
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="Dokumentasi Asesmen - ' . $fileName->nama_lsp . '"'
        ]);
    }
    public function getBuktiTerimaSertifikat($filename)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $path = storage_path('app/private/asesmen_files/bukti_terima_sertifikat/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = AsesmenModel::where('bukti_terima_sertifikat', $filename)->select('nama_lsp')->first();
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="Bukti Terima Sertifikat - ' . $fileName->nama_lsp . '"'
        ]);
    }

    /**
     * Serve pegawai files dengan autentikasi
     */
    public function servePegawaiFile($filename)
    {
        $user = Auth::user();

        // Pegawai files hanya untuk Dinas/Master
        if ($user->roles === 'lsp') {
            abort(403, 'Anda tidak memiliki akses ke file pegawai');
        }

        $path = storage_path('app/private/pegawai_files/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    /**
     * Check authorization untuk asesi files
     * 
     * @param string $filename
     * @param string $column Database column name untuk file ini
     */
    protected function checkAsesiFileAuthorization($filename, $column)
    {
        $user = Auth::user();

        // Non-LSP roles dapat akses semua file
        if ($user->roles !== 'lsp') {
            return;
        }

        // LSP user harus punya lspData
        if (!$user->lspData) {
            abort(403, 'Data LSP tidak ditemukan');
        }

        // Cari asesi yang memiliki file ini di column yang spesifik
        $asesi = AsesiModel::where($column, 'LIKE', "%{$filename}")->first();

        // Jika file tidak ditemukan di database, biarkan lanjut ke 404
        if (!$asesi) {
            return;
        }

        // Check apakah asesi ini milik LSP user
        if ($asesi->lsp_ref !== $user->lspData->ref) {
            abort(403, 'Anda tidak memiliki akses ke file ini');
        }
    }

    /**
     * Check authorization untuk asesmen files
     */
    protected function checkAsesmenFileAuthorization($filename)
    {
        $user = Auth::user();

        // Non-LSP roles dapat akses semua file
        if ($user->roles !== 'lsp') {
            return;
        }

        // LSP user harus punya lspData
        if (!$user->lspData) {
            abort(403, 'Data LSP tidak ditemukan');
        }

        // Cari di AsesmenModel
        $asesmen = AsesmenModel::where(function ($query) use ($filename) {
            $query->where('bukti_asesmen', 'LIKE', "%{$filename}")
                ->orWhere('dokumentasi_asesmen', 'LIKE', "%{$filename}")
                ->orWhere('bukti_terima_sertifikat', 'LIKE', "%{$filename}");
        })->first();

        if ($asesmen) {
            // Check ownership via nama_lsp
            if ($asesmen->nama_lsp !== $user->lspData->lsp_nama) {
                abort(403, 'Anda tidak memiliki akses ke file ini');
            }
            return;
        }

        // Cari di KegiatanJadwalModel (untuk laporan asesmen)
        $jadwal = KegiatanJadwalModel::where(function ($query) use ($filename) {
            $query->where('laporan_asesmen', 'LIKE', "%{$filename}")
                ->orWhere('laporan_asesmen2', 'LIKE', "%{$filename}")
                ->orWhere('laporan_asesmen3', 'LIKE', "%{$filename}")
                ->orWhere('laporan_asesmen4', 'LIKE', "%{$filename}")
                ->orWhere('laporan_asesmen5', 'LIKE', "%{$filename}");
        })->first();

        if ($jadwal) {
            // Check ownership via lsp_ref
            if ($jadwal->lsp_ref !== $user->lspData->ref) {
                abort(403, 'Anda tidak memiliki akses ke file ini');
            }
            return;
        }

        // File tidak ditemukan di database, biarkan lanjut ke 404
    }
}
