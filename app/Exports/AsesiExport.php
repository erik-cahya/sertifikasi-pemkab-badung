<?php

namespace App\Exports;

use App\Models\AsesiModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class AsesiExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = AsesiModel::with(['kegiatan', 'asesmen'])
            ->select('asesi.*');

        // Role-based filter (handled in controller usually, but passed filters should include identity)
        if (isset($this->filters['user_role']) && $this->filters['user_role'] === 'lsp' && isset($this->filters['lsp_ref_identity'])) {
            $query->where('lsp_ref', $this->filters['lsp_ref_identity']);
        }

        // Filter per LSP
        if (!empty($this->filters['filter_lsp'])) {
            $query->where('lsp_ref', $this->filters['filter_lsp']);
        }

        // Filter berdasarkan kegiatan
        if (!empty($this->filters['filter_kegiatan'])) {
            $query->where('kegiatan_ref', $this->filters['filter_kegiatan']);
        }

        // Filter based on date
        $filterType = $this->filters['filter_type'] ?? null;
        $filterValue = $this->filters['filter_value'] ?? null;

        if ($filterType && $filterValue) {
            switch ($filterType) {
                case 'tanggal':
                    $query->whereDate('created_at', $filterValue);
                    break;
                case 'bulan':
                    $query->whereYear('created_at', substr($filterValue, 0, 4))
                        ->whereMonth('created_at', substr($filterValue, 5, 2));
                    break;
                case 'tahun':
                    $query->whereYear('created_at', $filterValue);
                    break;
            }
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'Sertifikasi',
            'Nama Lengkap',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Kewarganegaraan',
            'Alamat',
            'No. HP',
            'No. Telp Rumah',
            'No. Telp Kantor',
            'Email',
            'Pendidikan Terakhir',
            'Nama Perusahaan',
            'Alamat Perusahaan',
            'Departemen',
            'Jabatan',
            'Telp Perusahaan',
            'Fax Perusahaan',
            'Email Perusahaan',
            'Nama Kontak Person',
            'No HP Kontak Person',
            'LSP',
            'Tanggal Asesmen',
            'TUK',
            'Skema',
            'Nama Asesor',
            'No Sertifikat',
            'Mendaftar pada',
        ];
    }

    public function map($item): array
    {
        return [
            $item->kegiatan->nama_kegiatan ?? '-',
            $item->nama_lengkap,
            $item->nik . " ", // Add space to prevent Excel from converting to scientific notation
            $item->tempat_lahir,
            $item->tgl_lahir,
            $item->jenis_kelamin,
            $item->kewarganegaraan,
            $item->alamat,
            $item->telp_hp,
            $item->telp_rumah,
            $item->telp_kantor,
            $item->email,
            $item->pendidikan_terakhir,
            $item->nama_perusahaan,
            $item->alamat_perusahaan,
            $item->departemen,
            $item->jabatan,
            $item->telp_perusahaan,
            $item->fax_perusahaan,
            $item->email_perusahaan,
            $item->nama_kontak_person,
            $item->no_kontak_person,
            $item->asesmen->nama_lsp ?? '-',
            $item->asesmen ? Carbon::parse($item->asesmen->jadwal_asesmen)->format('Y/m/d') : '-',
            $item->asesmen->nama_tuk ?? '-',
            $item->asesmen->nama_skema ?? '-',
            $item->asesmen->nama_asesor ?? '-',
            $item->no_sertifikat,
            $item->created_at->format('Y/m/d H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
