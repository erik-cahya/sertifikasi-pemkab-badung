<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\AsesmenModel;
use App\Exports\JadwalAsesmenExport;
use App\Models\PenandatanganModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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

    public function jadwalAsesmen(Request $request)
    {
        if (!Auth::check()) {
            abort(403, 'Anda tidak memiliki akses');
        }

        $month = $request->query('month');
        $year  = $request->query('year');
        $namaLsp  = $request->query('nama_lsp');
        $kegiatanJadwalRef = $request->query('kegiatan_jadwal_ref');

        $query = AsesmenModel::with(['asesis', 'kegiatanJadwal.lsp'])
            ->has('asesis')
            ->whereMonth('jadwal_asesmen', $month)
            ->whereYear('jadwal_asesmen', $year)
            ->orderBy('jadwal_asesmen', 'asc');

        if ($kegiatanJadwalRef) {
            $query->where('kegiatan_jadwal_ref', $kegiatanJadwalRef);
        }

        $asesmenAll = $query->get();

        // Group asesmen by date
        $grouped = $asesmenAll->groupBy(function ($item) {
            return Carbon::parse($item->jadwal_asesmen)->format('Y-m-d');
        });

        // $lspNama = $asesmenAll->first()?->kegiatanJadwal?->lsp?->lsp_nama;

        // dd($lspNama);

        // Nama bulan Indonesia
        $bulan = Carbon::create($year, $month, 1)
            ->locale('id')->translatedFormat('F');
        $tahun = $year;

        // Get penandatangan data
        $penandatangan = null;
        if ($kegiatanJadwalRef) {
            $penandatangan = PenandatanganModel::where('kegiatan_jadwal_ref', $kegiatanJadwalRef)->first();
        }

        $filename = 'Jadwal-Asesmen-' . strtoupper($namaLsp) . '-' . strtoupper($bulan) . '-' . $tahun . '.xlsx';

        return Excel::download(
            new JadwalAsesmenExport($grouped, $bulan, $tahun, $namaLsp, $penandatangan),
            $filename
        );
    }
}
