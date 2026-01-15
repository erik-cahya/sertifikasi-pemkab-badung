<?php

namespace Database\Seeders;

use App\Models\LSPModel;
use App\Models\SkemaDetailModel;
use App\Models\SkemaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $lsp = LSPModel::where('lsp_nama', 'LSP Engineering Hospitality Indonesia')
            ->with('user')
            ->firstOrFail();

        $TeknisiRefrigerasi = SkemaModel::create([
            'lsp_ref' => $lsp->ref,
            'skema_judul' => 'Teknisi Refrigerasi Domestik',
            'skema_kode' => 'SKM/0219/00006/2/2020/6',
            'skema_kategori' => 'Klaster',
            'created_by' => $lsp->user->ref,
        ]);

        SkemaModel::create([
            'lsp_ref' => $lsp->ref,
            'skema_judul' => 'Perawatan Mesin Pendingin / AC',
            'skema_kode' => 'SKM/0219/00006/2/2020/6',
            'skema_kategori' => 'Klaster',
            'created_by' => $lsp->user->ref,
        ]);
        SkemaModel::create([
            'lsp_ref' => $lsp->ref,
            'skema_judul' => 'Pelaksanaan Instalasi AC',
            'skema_kode' => 'SKM/0219/00006/2/2020/6',
            'skema_kategori' => 'Klaster',
            'created_by' => $lsp->user->ref,
        ]);
        SkemaModel::create([
            'lsp_ref' => $lsp->ref,
            'skema_judul' => 'Teknisi Lemari Pendingin',
            'skema_kode' => 'SKM/0219/00006/2/2020/6',
            'skema_kategori' => 'Klaster',
            'created_by' => $lsp->user->ref,
        ]);
        SkemaModel::create([
            'lsp_ref' => $lsp->ref,
            'skema_judul' => 'Mekanik Heating, Ventilation Dan Air Condition (HVAC)',
            'skema_kode' => 'SKM/0219/00006/2/2020/6',
            'skema_kategori' => 'Klaster',
            'created_by' => $lsp->user->ref,
        ]);

        $kode_unit = [
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'C.281930.029.01',
                'judul_unit' => 'Melakukan Proses Brazing',
                'created_by' =>  $lsp->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.001.1',
                'judul_unit' => 'Menerapkan Keselamatan dan Kesehatan Kerja dan Lingkungan Hidup (K3-LH)',
                'created_by' =>  $lsp->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.002.1',
                'judul_unit' => 'Menerapkan Komunikasi di Tempat Kerja',
                'created_by' =>  $lsp->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.003.1',
                'judul_unit' => 'Menerapkan Kerjasama di Tempat Kerja',
                'created_by' =>  $lsp->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.006.1',
                'judul_unit' => 'Merangkai Sistem Kelistrikan Sederhana',
                'created_by' =>  $lsp->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.007.1',
                'judul_unit' => 'Merangkai Sistem Pemipaan Sederhana',
                'created_by' =>  $lsp->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.008.1',
                'judul_unit' => 'Menggunakan Alat Ukur Refrigerasi dan Tata Udara',
                'created_by' =>  $lsp->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.010.1',
                'judul_unit' => 'Memeriksa Kebocoran Refrigeran',
                'created_by' =>  $lsp->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.012.1',
                'judul_unit' => 'Mengevakuasi Sistem Refrigerasi dan Tata Udara',
                'created_by' =>  $lsp->user->ref,
            ],
        ];

        foreach ($kode_unit as $row) {
            SkemaDetailModel::create($row);
        }
    }
}
