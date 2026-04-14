<?php

namespace App\Http\Controllers;

use App\Models\AsesiModel;
use Illuminate\Http\Request;

class DownloadSertifikatController extends Controller
{
    public function index()
    {
        return view('pendaftaran.download-sertifikat', [
            'asesiList' => collect(),
            'searched' => false,
        ]);
    }

    public function search(Request $request)
    {
        $asesiList = collect();
        $nikInput = $request->nik;
        $nikArray = array_filter(array_map('trim', explode("\n", $nikInput)));

        if (count($nikArray) > 0) {
            $asesiData = AsesiModel::whereIn('nik', $nikArray)->get()->groupBy('nik');

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
                        'is_found' => false
                    ]);
                }
            }
        }

        return view('pendaftaran.download-sertifikat', [
            'asesiList' => $asesiList,
            'searched' => true,
            'nikInput' => $nikInput,
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
