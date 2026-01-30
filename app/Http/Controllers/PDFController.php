<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class PDFController extends Controller
{
    // public function daftarHadir()
    // {
    //     return Pdf::loadView('admin-panel.pdf.daftar-hadir')
    //         ->setPaper('A4', 'portrait')
    //         ->stream('Daftar-Hadir.pdf');
    // }

    // public function daftarPenerimaan()
    // {
    //     return Pdf::loadView('admin-panel.pdf.daftar-penerimaan')
    //         ->setPaper('A4', 'landscape')
    //         ->stream('Daftar-Penerimaan.pdf');
    // }

    // public function tandaTerimaSertifikat()
    // {
    //     return Pdf::loadView('admin-panel.pdf.tanda-terima-sertifikat')
    //         ->setPaper('A4', 'portrait')
    //         ->stream('Tanda-Terima-Sertifikat.pdf');
    // }
}
