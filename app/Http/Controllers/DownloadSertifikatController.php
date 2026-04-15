<?php

namespace App\Http\Controllers;

use App\Models\AsesiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownloadSertifikatController extends Controller
{
    public function index()
    {
        $tahunList = AsesiModel::selectRaw('YEAR(created_at) as tahun')
            ->whereNotNull('created_at')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('pendaftaran.download-sertifikat', [
            'asesiList' => collect(),
            'searched' => false,
            'tahunList' => $tahunList,
            'selectedTahun' => null,
        ]);
    }

    public function search(Request $request)
    {
        $asesiList = collect();
        $nikInput = $request->nik;
        $selectedTahun = $request->tahun;
        $nikArray = array_filter(array_map('trim', explode("\n", $nikInput)));

        if (count($nikArray) > 0) {
            $query = AsesiModel::whereIn('nik', $nikArray);

            if ($selectedTahun) {
                $query->whereYear('created_at', $selectedTahun);
            }

            $asesiData = $query->get()->groupBy('nik');

            foreach ($nikArray as $nik) {
                if ($asesiData->has($nik)) {
                    foreach ($asesiData->get($nik) as $asesi) {
                        $asesi->is_found = true;
                        $asesiList->push($asesi);
                    }
                } else {
                    $asesiList->push((object)[
                        'nik' => $nik,
                        'nama_lengkap' => 'Data tidak ditemukan',
                        'nama_perusahaan' => '-',
                        'no_sertifikat' => '-',
                        'sertifikat_file' => null,
                        'is_found' => false,
                        'created_at' => null,
                    ]);
                }
            }
        }

        $tahunList = AsesiModel::selectRaw('YEAR(created_at) as tahun')
            ->whereNotNull('created_at')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('pendaftaran.download-sertifikat', [
            'asesiList' => $asesiList,
            'searched' => true,
            'nikInput' => $nikInput,
            'tahunList' => $tahunList,
            'selectedTahun' => $selectedTahun,
        ]);
    }

    public function download($filename)
    {
        $path = storage_path('app/private/asesi_files/sertifikat/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File sertifikat tidak ditemukan');
        }

        $asesi = AsesiModel::where('sertifikat_file', $filename)->first();
        $namaLengkap = $asesi ? $asesi->nama_lengkap : 'Asesi';

        return response()->download($path, 'Sertifikat - ' . $namaLengkap . '.pdf');
    }
}
