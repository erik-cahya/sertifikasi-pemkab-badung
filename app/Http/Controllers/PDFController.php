<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\AsesmenModel;



class PDFController extends Controller
{
    public function daftarHadir($id)
    {
        // dd(Storage::disk('public')->exists('logo-lsp/lsp-beta-BNSP-000-ID.png'));
        $asesmen = AsesmenModel::with([
            'asesis',
            'kegiatanLsp.lsp',
        ])
        ->where('kegiatan_ref', $id)
        ->get();

        return Pdf::loadView('admin-panel.pdf.daftar-hadir', compact('asesmen'))
            ->setPaper('A4', 'portrait')
            ->stream('Daftar-Hadir.pdf');
    }

    public function daftarPenerimaan($id)
    {
        $asesmen = AsesmenModel::with([
            'asesis',
            'kegiatanLsp.lsp',
        ])
        ->where('kegiatan_ref', $id)
        ->get();

        return Pdf::loadView('admin-panel.pdf.daftar-penerimaan', compact('asesmen'))
            ->setPaper('A4', 'landscape')
            ->stream('Daftar-Penerimaan.pdf');
    }

    public function tandaTerimaSertifikat($id)
    {
        $asesmen = AsesmenModel::with([
            'asesis',
            'kegiatanLsp.lsp',
        ])
        ->where('kegiatan_ref', $id)
        ->get();

        return Pdf::loadView('admin-panel.pdf.tanda-terima-sertifikat', compact('asesmen'))
            ->setPaper('A4', 'portrait')
            ->stream('Tanda-Terima-Sertifikat.pdf');
    }
}
