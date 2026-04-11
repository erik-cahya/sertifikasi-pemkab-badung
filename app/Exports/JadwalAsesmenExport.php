<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;

class JadwalAsesmenExport implements WithEvents, WithTitle
{
    protected $grouped;
    protected $bulan;
    protected $tahun;
    protected $lspNama;
    protected $penandatangan;

    public function __construct($grouped, $bulan, $tahun, $lspNama, $penandatangan = null)
    {
        $this->grouped = $grouped;
        $this->bulan   = $bulan;
        $this->tahun   = $tahun;
        $this->lspNama = $lspNama;
        $this->penandatangan = $penandatangan;
    }

    public function title(): string
    {
        return 'Jadwal Asesmen';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // ===== Set default font =====
                $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);

                // ===== Column widths =====
                $sheet->getColumnDimension('A')->setWidth(5);   // NO
                $sheet->getColumnDimension('B')->setWidth(14);  // TANGGAL
                $sheet->getColumnDimension('C')->setWidth(35);  // NAMA PESERTA
                $sheet->getColumnDimension('D')->setWidth(30);  // ASESOR
                $sheet->getColumnDimension('E')->setWidth(28);  // BIDANG
                $sheet->getColumnDimension('F')->setWidth(35);  // TEMPAT UJI KOMPETENSI

                // ===== LETTERHEAD IMAGE (rows 1-8) =====
                $letterheadPath = public_path('img/letterhead.png');
                if (file_exists($letterheadPath)) {
                    $drawing = new Drawing();
                    $drawing->setName('Letterhead');
                    $drawing->setDescription('Letterhead');
                    $drawing->setPath($letterheadPath);
                    $drawing->setCoordinates('A1');
                    // Set width to span across all columns (approx 147 chars * 7px = ~1030px)
                    $drawing->setWidth(980);
                    $drawing->setHeight(130);
                    $drawing->setWorksheet($sheet);

                    // Set row heights for letterhead area
                    for ($i = 1; $i <= 8; $i++) {
                        $sheet->getRowDimension($i)->setRowHeight(16);
                    }
                }

                // ===== Separator line (row 9) =====
                $sheet->mergeCells('A9:F9');
                $sheet->getStyle('A9:F9')->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THICK,
                            'color' => ['argb' => 'FF1E5AA8'],
                        ],
                    ],
                ]);
                $sheet->getRowDimension(9)->setRowHeight(5);

                // ===== INFO ROWS (rows 10-12) =====
                $sheet->mergeCells('A10:F10');
                $sheet->setCellValue('A10', 'JADWAL PELAKSANAAN UJI KOMPETENSI');
                $sheet->getStyle('A10')->getFont()->setBold(true)->setSize(11);

                $sheet->mergeCells('A11:F11');
                $sheet->setCellValue('A11', 'BULAN ' . strtoupper($this->bulan));
                $sheet->getStyle('A11')->getFont()->setBold(true)->setSize(11);

                $sheet->mergeCells('A12:F12');
                $sheet->setCellValue('A12', 'LEMBAGA PELAKSANA ' . strtoupper($this->lspNama));
                $sheet->getStyle('A12')->getFont()->setBold(true)->setSize(11);

                // ===== TABLE HEADER (row 13) =====
                $headerRow = 13;
                $headers = ['NO', 'TANGGAL', 'NAMA PESERTA', 'ASESOR', 'BIDANG', 'TEMPAT UJI KOMPETENSI'];
                foreach ($headers as $colIndex => $header) {
                    $col = chr(65 + $colIndex);
                    $sheet->setCellValue($col . $headerRow, $header);
                }

                $headerRange = 'A' . $headerRow . ':F' . $headerRow;
                $sheet->getStyle($headerRange)->applyFromArray([
                    'font' => ['bold' => true, 'size' => 11],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);
                $sheet->getRowDimension($headerRow)->setRowHeight(25);

                // ===== DATA ROWS =====
                $currentRow = $headerRow + 1;
                $groupNo = 0;

                foreach ($this->grouped as $tanggal => $asesmenList) {
                    $groupNo++;

                    // Calculate total asesi for this date group
                    $totalAsesiPerTanggal = $asesmenList->sum(function ($asesmen) {
                        return max($asesmen->asesis->count(), 1);
                    });

                    $dateStartRow = $currentRow;

                    foreach ($asesmenList as $asesmen) {
                        $asesiList   = $asesmen->asesis;
                        $asesiCount  = $asesiList->count();
                        $asesmenStartRow = $currentRow;

                        if ($asesiCount > 0) {
                            foreach ($asesiList as $asesi) {
                                $sheet->setCellValue('C' . $currentRow, ucwords(strtolower($asesi->nama_lengkap)));
                                $sheet->getStyle('C' . $currentRow)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                                $currentRow++;
                            }
                        } else {
                            $sheet->setCellValue('C' . $currentRow, '');
                            $currentRow++;
                        }

                        $asesmenEndRow = $currentRow - 1;
                        $rowsForAsesmen = max($asesiCount, 1);

                        // Merge ASESOR, BIDANG, TEMPAT UJI if multiple rows
                        if ($rowsForAsesmen > 1) {
                            $sheet->mergeCells('D' . $asesmenStartRow . ':D' . $asesmenEndRow);
                            $sheet->mergeCells('E' . $asesmenStartRow . ':E' . $asesmenEndRow);
                            $sheet->mergeCells('F' . $asesmenStartRow . ':F' . $asesmenEndRow);
                        }
                        $sheet->setCellValue('D' . $asesmenStartRow, $asesmen->nama_asesor);
                        $sheet->setCellValue('E' . $asesmenStartRow, 'Skema ' . $asesmen->nama_skema);

                        $tempatUji = $asesmen->nama_tuk;
                        if ($asesmen->alamat_tuk) {
                            $tempatUji .= ' ( ' . $asesmen->alamat_tuk . ' )';
                        }
                        $sheet->setCellValue('F' . $asesmenStartRow, $tempatUji);

                        // Center & wrap for ASESOR, BIDANG, TEMPAT UJI
                        foreach (['D', 'E', 'F'] as $col) {
                            $sheet->getStyle($col . $asesmenStartRow)->getAlignment()
                                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                                ->setVertical(Alignment::VERTICAL_CENTER)
                                ->setWrapText(true);
                        }
                    }

                    $dateEndRow = $currentRow - 1;

                    // Merge NO & TANGGAL for entire date group
                    if ($totalAsesiPerTanggal > 1) {
                        $sheet->mergeCells('A' . $dateStartRow . ':A' . $dateEndRow);
                        $sheet->mergeCells('B' . $dateStartRow . ':B' . $dateEndRow);
                    }
                    $sheet->setCellValue('A' . $dateStartRow, $groupNo . '.');
                    $sheet->setCellValue('B' . $dateStartRow, "Tanggal\n" . \Carbon\Carbon::parse($tanggal)->format('d/m/Y'));

                    // Style NO & TANGGAL
                    $sheet->getStyle('A' . $dateStartRow)->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER);
                    $sheet->getStyle('B' . $dateStartRow)->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                        ->setVertical(Alignment::VERTICAL_CENTER)
                        ->setWrapText(true);
                }

                $lastDataRow = $currentRow - 1;

                // ===== BORDERS for all data rows =====
                if ($lastDataRow >= $headerRow + 1) {
                    $dataRange = 'A' . ($headerRow + 1) . ':F' . $lastDataRow;
                    $sheet->getStyle($dataRange)->applyFromArray([
                        'borders' => [
                            'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                        ],
                        'font' => ['size' => 11],
                    ]);
                }

                // ===== SIGNATURE SECTION =====
                $signRow = $lastDataRow + 3; // Leave 2 empty rows after data

                $ttd = $this->penandatangan;

                // Line 1: "Tempat, [tanggal bulan tahun]"
                $tempatTtd = $ttd->tempat_ttd ?? 'Mangupura';
                $tanggalDate = ($ttd->tanggal_ttd ?? null)
                    ? Carbon::parse($ttd->tanggal_ttd)
                    : Carbon::now();
                $tanggalSurat = $tanggalDate->locale('id')->translatedFormat('j F Y');
                $sheet->mergeCells('D' . $signRow . ':F' . $signRow);
                $sheet->setCellValue('D' . $signRow, $tempatTtd . ', ' . $tanggalSurat);
                $sheet->getStyle('D' . $signRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // Line 2: Nama Dinas
                $signRow++;
                $sheet->mergeCells('D' . $signRow . ':F' . $signRow);
                $sheet->setCellValue('D' . $signRow, $ttd->nama_dinas ?? '');
                $sheet->getStyle('D' . $signRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('D' . $signRow)->getFont()->setItalic(true);

                // Line 3: Jabatan Penandatangan
                $signRow++;
                $sheet->mergeCells('D' . $signRow . ':F' . $signRow);
                $sheet->setCellValue('D' . $signRow, $ttd->jabatan_penandatangan ?? '');
                $sheet->getStyle('D' . $signRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('D' . $signRow)->getFont()->setItalic(true);

                // Leave space for signature (4 empty rows)
                $signRow += 5;

                // Nama (Bold + Underline)
                $sheet->mergeCells('D' . $signRow . ':F' . $signRow);
                $sheet->setCellValue('D' . $signRow, $ttd->nama_penandatangan ?? '');
                $sheet->getStyle('D' . $signRow)->getFont()->setBold(true)->setUnderline(true);
                $sheet->getStyle('D' . $signRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // Pangkat
                $signRow++;
                $sheet->mergeCells('D' . $signRow . ':F' . $signRow);
                $sheet->setCellValue('D' . $signRow, $ttd->pangkat ?? '');
                $sheet->getStyle('D' . $signRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // NIP
                $signRow++;
                $sheet->mergeCells('D' . $signRow . ':F' . $signRow);
                $nip = $ttd->nip ?? '';
                $sheet->setCellValue('D' . $signRow, $nip ? 'NIP. ' . $nip : '');
                $sheet->getStyle('D' . $signRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // ===== Page setup for printing =====
                $sheet->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
            },
        ];
    }
}
