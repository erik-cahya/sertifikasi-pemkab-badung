<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Hadir Peserta dan Penyelenggara</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
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
            margin: 10px 0;
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

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 3px;
            height: 45px;
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
            color: RED;
            color: #000;
        }
         .page-break {
            page-break-before: always;
        }
    </style>
</head>
@foreach ($asesmen as $item)

@php
    $maxRow = 10;
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
                <th width="5%">NO.</th>
                <th width="40%">NAMA PESERTA</th>
                <th width="35%">ORGANISASI / INSTANSI</th>
                <th width="20%">TANDA TANGAN</th>
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
                    </tr>
                @endif
            @endforeach

            @for ($i = $item->asesis->count() + 1; $i <= $maxRow; $i++)
                <tr>
                    <td class="center">{{ $i }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="signature">{{ $i }}.</td>
                </tr>
            @endfor
        </tbody>
    </table>

    {{-- FOOTER --}}
    <table width="100%" style="margin-top:20px;">
        <tr>
            <td></td>
            <td style="width:300px; text-align:center;">
                Panitia Penyelenggara
                <br><br><br><br><br><br>
                <u class="value" style="font-weight: bold;">( {{ $item->nama_penyelenggara_uji }} )</u>
                <br>
            </td>
        </tr>
    </table>

    <div class="page-break"></div>

    {{-- ############# DAFTAR HADIR PENYELENGGARA --}}

    {{-- HEADER --}}
    <table class="header-table">
        <tr mb-5>
            <td width="15%" class="center">
                <img src="{{ public_path('img/logo_dinas_no_title.png') }}" width="80px;">
            </td>
            <td width="75%" class="center">
                <div class="title">DINAS PERINDUSTRIAN & TENAGA KERJA KABUPATEN BADUNG</div>
                <div class="title">DAFTAR HADIR PESERTA</div>
                <div class="title">KEGIATAN UJI KOMPETENSI TENAGA KERJA TAHUN {{ date('Y', strtotime($item->jadwal_asesmen)) }}</div>
            </td>
            <td width="15%" class="center">
                <img src="{{public_path('img/'.$item->kegiatanLsp->lsp->lsp_logo) }}"  width="80px">
                {{-- <img src="{{ public_path('img/logo_dinas_no_title.png') }}" width="80px"> --}}
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
                <th width="5%">NO.</th>
                <th width="30%">NAMA</th>
                <th width="30%">JABATAN DALAM TIM</th>
                <th width="15%">NOMOR HP</th>
                <th width="20%">TANDA TANGAN</th>
            </tr>
        </thead>
        <tbody class="value">
            <tr>
                <td class="center">1</td>
                <td>{{ $item->nama_penanggung_jawab }}</td>
                <td class="center">Penanggung Jawab</td>
                <td class="center">{{ $item->no_penanggung_jawab }}</td>
                <td class="signature"> 1.</td>
            </tr>
             <tr>
                <td class="center">2</td>
                <td>{{ $item->nama_penyelenggara_uji }}</td>
                <td class="center">Sekretariat Penyelenggara UJK</td>
                <td class="center">{{ $item->no_penyelenggara_uji }}</td>
                <td class="signature"> 2.</td>
            </tr>
             <tr>
                <td class="center">3</td>
                <td>{{ $item->nama_asesor }}</td>
                <td class="center">Asesor</td>
                <td class="center">{{ $item->no_asesor }}</td>
                <td class="signature"> 3.</td>
            </tr>
        </tbody>
    </table>

    {{-- FOOTER --}}
    <table width="100%" style="margin-top:20px;">
        <tr>
            {{-- KIRI --}}
            <td width="60%" style="vertical-align:top;">
                Mengetahui,<br>
                <span class="value">Direktur {{ $item->kegiatanLsp->lsp->lsp_nama}}</span>
                <br><br><br><br><br><br>
                <u class="value" style="font-weight: bold;">{{ $item->kegiatanLsp->lsp->lsp_direktur}}</u>
            </td>

            {{-- KANAN --}}
            <td width="40%" style="text-align:left; vertical-align:top;">
                <br>
                Panitia Penyelenggara
                <br><br><br><br><br><br>
                <u class="value" style="font-weight: bold;">{{ $item->nama_penyelenggara_uji }}</u>
            </td>
        </tr>
    </table>


    
@endforeach
</body>
</html>
