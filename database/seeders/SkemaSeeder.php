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

        $lspEhi = LSPModel::where('lsp_nama', 'LSP Indonesia')
            ->with('user')
            ->firstOrFail();

        $lspTekno = LSPModel::where('lsp_nama', 'LSP P3 Teknologi Digital')
            ->with('user')
            ->firstOrFail();

        $TeknisiRefrigerasi = SkemaModel::create([
            'lsp_ref' => $lspEhi->ref,
            'skema_judul' => 'Teknisi Refrigerasi Domestik',
            'skema_kode' => 'SKM/0139/00306/2/1020/2',
            'skema_kategori' => 'Klaster',
            'created_by' => $lspEhi->user->ref,
        ]);


        $skema_lspTekno = [
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Operator Komputer Muda',
                'skema_kode' => '01/OK01/LSPTI/SKEMA/2020',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Operator Komputer Muda',
                'skema_kode' => 'SKM-BNSP-TI-001',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Teknisi Komputer Junior',
                'skema_kode' => 'SKM-BNSP-TI-002',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Junior Network Administrator',
                'skema_kode' => 'SKM-BNSP-TI-003',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Teknisi Jaringan Komputer',
                'skema_kode' => 'SKM-BNSP-TI-004',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Junior Web Programmer',
                'skema_kode' => 'SKM-BNSP-TI-005',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Junior Mobile Programmer',
                'skema_kode' => 'SKM-BNSP-TI-006',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Analis Sistem Informasi',
                'skema_kode' => 'SKM-BNSP-TI-007',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'IT Support Officer',
                'skema_kode' => 'SKM-BNSP-TI-008',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Database Administrator Junior',
                'skema_kode' => 'SKM-BNSP-TI-009',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],
            [
                'lsp_ref' => $lspTekno->ref,
                'skema_judul' => 'Teknisi Keamanan Sistem Informasi',
                'skema_kode' => 'SKM-BNSP-TI-010',
                'skema_kategori' => 'Okupasi',
                'created_by' => $lspTekno->user->ref,
            ],

        ];

        foreach ($skema_lspTekno as $row) {
            SkemaModel::create($row);
        }

        $skema = [
            [
                'lsp_ref' => $lspEhi->ref,
                'skema_judul' => 'Perawatan Mesin Pendingin / AC',
                'skema_kode' => 'SKM/0219/33006/12/2020/6',
                'skema_kategori' => 'Klaster',
                'created_by' => $lspEhi->user->ref,
            ],
            [
                'lsp_ref' => $lspEhi->ref,
                'skema_judul' => 'Pelaksanaan Instalasi AC',
                'skema_kode' => 'SKM/0239/32006/2/2021/6',
                'skema_kategori' => 'Klaster',
                'created_by' => $lspEhi->user->ref,
            ],
            [
                'lsp_ref' => $lspEhi->ref,
                'skema_judul' => 'Teknisi Lemari Pendingin',
                'skema_kode' => 'SKM/0419/23006/2/2020/6',
                'skema_kategori' => 'Klaster',
                'created_by' => $lspEhi->user->ref,
            ],
            [
                'lsp_ref' => $lspEhi->ref,
                'skema_judul' => 'Mekanik Ventilation Dan Air Condition (HVAC)',
                'skema_kode' => 'SKM/1119/4306/2/2020/6',
                'skema_kategori' => 'Klaster',
                'created_by' => $lspEhi->user->ref,
            ]
        ];

        foreach ($skema as $row) {
            SkemaModel::create($row);
        }

        $kode_unit = [
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'C.281930.029.01',
                'judul_unit' => 'Melakukan Proses Brazing',
                'created_by' =>  $lspEhi->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.001.1',
                'judul_unit' => 'Menerapkan Keselamatan dan Kesehatan Kerja dan Lingkungan Hidup (K3-LH)',
                'created_by' =>  $lspEhi->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.002.1',
                'judul_unit' => 'Menerapkan Komunikasi di Tempat Kerja',
                'created_by' =>  $lspEhi->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.003.1',
                'judul_unit' => 'Menerapkan Kerjasama di Tempat Kerja',
                'created_by' =>  $lspEhi->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.006.1',
                'judul_unit' => 'Merangkai Sistem Kelistrikan Sederhana',
                'created_by' =>  $lspEhi->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.007.1',
                'judul_unit' => 'Merangkai Sistem Pemipaan Sederhana',
                'created_by' =>  $lspEhi->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.008.1',
                'judul_unit' => 'Menggunakan Alat Ukur Refrigerasi dan Tata Udara',
                'created_by' =>  $lspEhi->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.010.1',
                'judul_unit' => 'Memeriksa Kebocoran Refrigeran',
                'created_by' =>  $lspEhi->user->ref,
            ],
            [
                'skema_ref' => $TeknisiRefrigerasi->ref,
                'kode_unit' => 'F.43RAC01.012.1',
                'judul_unit' => 'Mengevakuasi Sistem Refrigerasi dan Tata Udara',
                'created_by' =>  $lspEhi->user->ref,
            ],
        ];

        foreach ($kode_unit as $row) {
            SkemaDetailModel::create($row);
        }
    }
}
