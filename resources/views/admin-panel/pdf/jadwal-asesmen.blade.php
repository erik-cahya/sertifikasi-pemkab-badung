<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Jadwal Asesmen</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #000;
            margin: 15px;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #1e5aa8;
            padding-bottom: 10px;
            margin-bottom: 5px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .center {
            text-align: center;
        }

        .info-section {
            margin: 8px 0;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            line-height: 1.8;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: middle;
            font-size: 11px;
        }

        table.data th {
            text-align: center;
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .no-col {
            text-align: center;
            width: 4%;
        }

        .tanggal-col {
            text-align: center;
            width: 10%;
        }

        .nama-col {
            width: 22%;
        }

        .asesor-col {
            width: 20%;
            text-align: center;
        }

        .bidang-col {
            width: 20%;
            text-align: center;
        }

        .tuk-col {
            width: 24%;
            text-align: center;
        }
    </style>
</head>

<body>
    {{-- HEADER --}}
    <table class="header-table">
        <tr>
            <td width="100%" class="center">
                <img src="{{ public_path('img/letterhead.png') }}" width="100%;">
            </td>
        </tr>
    </table>

    {{-- INFO SECTION --}}
    <div class="info-section center">
        JADWAL PELAKSANAAN UJI KOMPETENSI
        <br>
        BULAN {{ strtoupper($bulan) }}
        <br>
        LEMBAGA PELAKSANA {{ $lspNama }}
    </div>

    {{-- TABEL DATA --}}
    <table class="data">
        <thead>
            <tr>
                <th class="no-col">NO</th>
                <th class="tanggal-col">TANGGAL</th>
                <th class="nama-col">NAMA PESERTA</th>
                <th class="asesor-col">ASESOR</th>
                <th class="bidang-col">BIDANG</th>
                <th class="tuk-col">TEMPAT UJI KOMPETENSI</th>
            </tr>
        </thead>
        <tbody>
            @php $groupNo = 0; @endphp
            @forelse ($grouped as $tanggal => $asesmenList)
                @php
                    // Untuk setiap tanggal, bisa ada beberapa asesmen (skema berbeda)
                    // Kita perlu hitung total asesi di semua asesmen pada tanggal ini
                    $totalAsesiPerTanggal = $asesmenList->sum(function ($asesmen) {
                        return $asesmen->asesis->count();
                    });

                    // Jika tidak ada asesi sama sekali, minimal 1 row
                    if ($totalAsesiPerTanggal == 0) {
                        $totalAsesiPerTanggal = $asesmenList->count();
                    }

                    $groupNo++;
                    $isFirstRowOfDate = true;
                @endphp

                @foreach ($asesmenList as $asesmen)
                    @php
                        $asesiCount = $asesmen->asesis->count();
                        $rowspanAsesmen = max($asesiCount, 1);
                    @endphp

                    @if ($asesiCount > 0)
                        @foreach ($asesmen->asesis as $index => $asesi)
                            <tr>
                                @if ($isFirstRowOfDate)
                                    <td class="no-col" rowspan="{{ $totalAsesiPerTanggal }}">{{ $groupNo }}.</td>
                                    <td class="tanggal-col" rowspan="{{ $totalAsesiPerTanggal }}">
                                        Tanggal
                                        <br>
                                        {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}
                                    </td>
                                    @php $isFirstRowOfDate = false; @endphp
                                @endif

                                <td class="nama-col">{{ ucwords(strtolower($asesi->nama_lengkap)) }}</td>

                                @if ($index === 0)
                                    <td class="asesor-col" rowspan="{{ $rowspanAsesmen }}">{{ $asesmen->nama_asesor }}</td>
                                    <td class="bidang-col" rowspan="{{ $rowspanAsesmen }}">
                                        Skema {{ $asesmen->nama_skema }}
                                    </td>
                                    <td class="tuk-col" rowspan="{{ $rowspanAsesmen }}">
                                        {{ $asesmen->nama_tuk }}
                                        @if ($asesmen->alamat_tuk)
                                            ({{ $asesmen->alamat_tuk }})
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        {{-- Asesmen tanpa asesi --}}
                        <tr>
                            @if ($isFirstRowOfDate)
                                <td class="no-col" rowspan="{{ $totalAsesiPerTanggal }}">{{ $groupNo }}.</td>
                                <td class="tanggal-col" rowspan="{{ $totalAsesiPerTanggal }}">
                                    Tanggal
                                    <br>
                                    {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}
                                </td>
                                @php $isFirstRowOfDate = false; @endphp
                            @endif
                            <td class="nama-col">&nbsp;</td>
                            <td class="asesor-col">{{ $asesmen->nama_asesor }}</td>
                            <td class="bidang-col">Skema {{ $asesmen->nama_skema }}</td>
                            <td class="tuk-col">
                                {{ $asesmen->nama_tuk }}
                                @if ($asesmen->alamat_tuk)
                                    ( {{ $asesmen->alamat_tuk }} )
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            @empty
                <tr>
                    <td colspan="6" class="center">Tidak ada data asesmen pada bulan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
