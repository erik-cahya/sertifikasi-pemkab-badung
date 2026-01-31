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
            color: RED;
        }
         .page-break {
            page-break-before: always;
        }
    </style>
</head>
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
                <div class="title">KEGIATAN UJI KOMPETENSI TENAGA KERJA TAHUN <span class="value">GET TAHUN KEGIATAN</span></div>
            </td>
            <td width="15%" class="center">
                <img src="{{ public_path('img/logo_dinas_no_title.png') }}" width="80px">
            </td>
        </tr>
    </table>

    {{-- INFORMASI --}}
    <table class="info-table">
        <tr>
            <td class="info-label">1. Skema</td>
            <td class="value">: Get skema di jadwal asesmen</td>
        </tr>
        <tr>
            <td class="info-label">2. TUK</td>
            <td class="value">: Get TUK di jadwal asesmen</td>
        </tr>
        <tr>
            <td class="info-label">3. Alamat</td>
            <td class="value">: Get alamat TUK</td>
        </tr>
        <tr>
            <td class="info-label">4. Tanggal</td>
            <td class="value">: Get tanggal asesmen</td>
        </tr>
        <tr>
            <td class="info-label">5. Jumlah Peserta</td>
            <td class="value">: 10 Orang</td>
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
            <tr>
                <td class="center">1</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 1.</td>
                <td class="signature"> 1.</td>
                <td class="signature"> 1.</td>
                <td class="signature"> 1.</td>
                <td class="signature"> 1.</td>
            </tr>
             <tr>
                <td class="center">2</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 2.</td>
                <td class="signature"> 2.</td>
                <td class="signature"> 2.</td>
                <td class="signature"> 2.</td>
                <td class="signature"> 2.</td>
            </tr>
             <tr>
                <td class="center">3</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 3.</td>
                <td class="signature"> 3.</td>
                <td class="signature"> 3.</td>
                <td class="signature"> 3.</td>
                <td class="signature"> 3.</td>
            </tr>
            <tr>
                <td class="center">4</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 4.</td>
                <td class="signature"> 4.</td>
                <td class="signature"> 4.</td>
                <td class="signature"> 4.</td>
                <td class="signature"> 4.</td>
            </tr>
             <tr>
                <td class="center">5</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 5.</td>
                <td class="signature"> 5.</td>
                <td class="signature"> 5.</td>
                <td class="signature"> 5.</td>
                <td class="signature"> 5.</td>
            </tr>
             <tr>
                <td class="center">6</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 6.</td>
                <td class="signature"> 6.</td>
                <td class="signature"> 6.</td>
                <td class="signature"> 6.</td>
                <td class="signature"> 6.</td>
            </tr>
            <tr>
                <td class="center">7</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 7.</td>
                <td class="signature"> 7.</td>
                <td class="signature"> 7.</td>
                <td class="signature"> 7.</td>
                <td class="signature"> 7.</td>
            </tr>
             <tr>
                <td class="center">8</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 8.</td>
                <td class="signature"> 8.</td>
                <td class="signature"> 8.</td>
                <td class="signature"> 8.</td>
                <td class="signature"> 8.</td>
            </tr>
             <tr>
                <td class="center">9</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 9.</td>
                <td class="signature"> 9.</td>
                <td class="signature"> 9.</td>
                <td class="signature"> 9.</td>
                <td class="signature"> 9.</td>
            </tr>
            <tr>
                <td class="center">10</td>
                <td>GET NAMA ASESI</td>
                <td class="center">GET TEMPAT BEKERJA</td>
                <td class="signature"> 10.</td>
                <td class="signature"> 10.</td>
                <td class="signature"> 10.</td>
                <td class="signature"> 10.</td>
                <td class="signature"> 10.</td>
            </tr>
            <tr>
                <td class="center">11</td>
                <td>PENANGGUNG JAWAB <br> GET NAMA PENANGGUNG JAWAB</td>
                <td class="center">GET NAMA LSP</td>
                <td class="signature" colspan="4"></td>
                <td class="signature"> 11.</td>
            </tr>
             <tr>
                <td class="center">12</td>
                <td>SEKRETARIAT PENYELENGGARA UJI <br> GET NAMA SEKRETARIAT PENYELENGGARA UJI</td>
                <td class="center">GET NAMA LSP</td>
                <td class="signature" colspan="4"></td>
                <td class="signature"> 12.</td>
            </tr>
             <tr>
                <td class="center">13</td>
                <td>ASESOR <br> GET NAMA ASESOR</td>
                <td class="center">GET NAMA LSP</td>
                <td class="signature" colspan="4"></td>
                <td class="signature"> 13.</td>
            </tr>   
        </tbody>
    </table>


</body>
</html>
