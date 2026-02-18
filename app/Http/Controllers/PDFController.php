<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\AsesmenModel;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function daftarHadir($id)
    {
        // dd(Storage::disk('public')->exists('logo-lsp/lsp-beta-BNSP-000-ID.png'));

        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }
        $asesmen = AsesmenModel::with([
            'asesis',
            'kegiatanJadwal.lsp',
        ])
            ->where('asesmen.ref', $id)
            ->get();

        return Pdf::loadView('admin-panel.pdf.daftar-hadir', compact('asesmen'))
            ->setPaper('A4', 'portrait')
            ->stream('Daftar-Hadir.pdf');
    }

    public function daftarPenerimaan($id)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $asesmen = AsesmenModel::with([
            'asesis',
            'kegiatanJadwal.lsp',
        ])
            ->where('asesmen.ref', $id)
            ->get();

        return Pdf::loadView('admin-panel.pdf.daftar-penerimaan', compact('asesmen'))
            ->setPaper('A4', 'landscape')
            ->stream('Daftar-Penerimaan.pdf');
    }

    public function tandaTerimaSertifikat($id)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $asesmen = AsesmenModel::with([
            'asesis',
            'kegiatanJadwal.lsp',
        ])
            ->where('asesmen.ref', $id)
            ->get();

        return Pdf::loadView('admin-panel.pdf.tanda-terima-sertifikat', compact('asesmen'))
            ->setPaper('A4', 'portrait')
            ->stream('Tanda-Terima-Sertifikat.pdf');
    }
}
