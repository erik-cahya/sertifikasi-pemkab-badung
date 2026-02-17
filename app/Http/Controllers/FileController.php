<?php

namespace App\Http\Controllers;

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
        // dd(explode(".", $filename)[1]);
        if(!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $path = storage_path('app/private/asesi_files/KTP/' . $filename);
       

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . 'ktp' . '"'
        ]);
    }

    /**
     * Akses file ijazah asesi
     */
    public function getIjazahAsesi($filename)
    {
        if(!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $path = storage_path('app/private/asesi_files/ijazah/' . $filename);
       

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    /**
     * Akses file sertikom asesi
     */
    public function getSertikomAsesi($filename)
    {
        if(!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $path = storage_path('app/private/asesi_files/sertikom/' . $filename);
       

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
    /**
     * Akses file surat keterangan bekerja asesi
     */
    public function getSkbAsesi($filename)
    {
        if(!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $path = storage_path('app/private/asesi_files/SKB/' . $filename);
       

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }


    /**
     * Akses file pas foto asesi
     */
    public function getPasFotoAsesi($filename)
    {
        if(!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $path = storage_path('app/private/asesi_files/pas-foto/' . $filename);
       

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    
    /**
     * Serve asesmen files (bukti, dokumentasi, laporan) dengan autentikasi
     */
    public function serveAsesmenFile($filename)
    {
        $path = storage_path('app/private/asesmen_files/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    /**
     * Serve pegawai files dengan autentikasi
     */
    public function servePegawaiFile($filename)
    {
        $path = storage_path('app/private/pegawai_files/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
}
