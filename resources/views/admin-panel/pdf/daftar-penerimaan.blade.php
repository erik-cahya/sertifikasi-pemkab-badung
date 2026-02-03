<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Penerimaan</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 70px;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #1e5aa8;*/
            margin:2px 0px;
            padding-bottom:15px;
            margin-top: -30px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 15.5px;
            line-height: 1.5;

        }

        .subtitle {
            font-weight: bold;
            margin-top: 2px;
        }

        .info-table {
            width: 100%;
            margin: 5px 0;
        }

        .info-table td {
            padding: 2px 4px;
            font-weight: bold;
        }

        .info-label {
            width: 140px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th{
            border: 1px solid #000;
            vertical-align: middle;
        }

        table.data td {
            border: 1px solid #000;
            padding: 3px;
            height: 25px;
            vertical-align: middle;
        }

        table.data th {
            text-align: center;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }
        .value{
            /* color: RED; */
            color: #000;
        }
         .page-break {
            page-break-before: always;
        }
    </style>
</head>
@foreach ($asesmen as $item)

@php
    $maxRow = 13;
@endphp

<body>
    {{-- ############# DAFTAR HADIR ASESI --}}

    {{-- HEADER --}}
    <table class="header-table">
        <tr mb-5>
            <td width="15%" class="center">
                <img src="{{ public_path('img/logo_dinas_no_title.png') }}" width="80px;">
            </td>
            <td width="75%" class="center">
                <div class="title">DINAS PERINDUSTRIAN & TENAGA KERJA KABUPATEN BADUNG</div>
                <div class="title">DAFTAR HADIR PESERTA</div>
                <div class="title">KEGIATAN UJI KOMPETENSI TENAGA KERJA TAHUN <span class="value">{{ date('Y', strtotime($item->jadwal_asesmen)) }}</span></div>
            </td>
            <td width="15%" class="center">
                {{-- <img src="{{ public_path('img/logo_dinas_no_title.png') }}" width="80px"> --}}
                <img src="{{public_path('img/'.$item->kegiatanLsp->lsp->lsp_logo) }}"  width="80px">
            </td>
        </tr>
    </table>

    {{-- INFORMASI --}}
    <table class="info-table">
        <tr>
            <td class="info-label">1. Skema</td>
            <td class="value">: {{ $item->nama_skema }}</td>
        </tr>
        <tr>
            <td class="info-label">2. TUK</td>
            <td class="value">: {{ $item->nama_tuk }}</td>
        </tr>
        <tr>
            <td class="info-label">3. Alamat</td>
            <td class="value">: {{ $item->alamat_tuk }}</td>
        </tr>
        <tr>
            <td class="info-label">4. Tanggal</td>
            <td class="value">: {{ date('Y/m/d', strtotime($item->jadwal_asesmen)) }}</td>
        </tr>
        <tr>
            <td class="info-label">5. Jumlah Peserta</td>
            <td class="value">: {{ $item->kuota_harian }} Orang</td>
        </tr>
    </table>

    {{-- TABEL PESERTA --}}
    <table class="data">
        <thead>
             <tr>
                <th width="5%" rowspan="2">NO.</th>
                <th width="25%" rowspan="2">NAMA PESERTA</th>
                <th width="25%" rowspan="2">ORGANISASI/INSTANSI</th>
                <th width="9%" colspan="5">TANDA TERIMA</th>
            </tr>
            <tr>
                <th width="9%">ATK</th>
                <th width="9%">MATERI UJI</th>
                <th width="9%">BAHAN UJI</th>
                <th width="9%">SNACK BOX</th>
                <th width="9%">NASI KOTAK</th>
            </tr>
        </thead>
        <tbody class="value">
            @foreach ($item->asesis as $asesi)
                @if ($loop->iteration <= $maxRow)
                    <tr>
                        <td class="center">{{ $loop->iteration }}</td>
                        <td>{{ $asesi->nama_lengkap }}</td>
                        <td>{{ $asesi->nama_perusahaan }}</td>
                        <td class="signature"> {{ $loop->iteration }}.</td>
                        <td class="signature"> {{ $loop->iteration }}.</td>
                        <td class="signature"> {{ $loop->iteration }}.</td>
                        <td class="signature"> {{ $loop->iteration }}.</td>
                        <td class="signature"> {{ $loop->iteration }}.</td>
                    </tr>
                @endif
            @endforeach

            @for ($i = $item->asesis->count() + 1; $i <= $maxRow; $i++)
                <tr>
                    <td class="center">{{ $i }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="signature">{{ $i }}.</td>
                    <td class="signature">{{ $i }}.</td>
                    <td class="signature">{{ $i }}.</td>
                    <td class="signature">{{ $i }}.</td>
                    <td class="signature">{{ $i }}.</td>
                </tr>
            @endfor
        </tbody>
    </table>


    @endforeach
</body>
</html>
