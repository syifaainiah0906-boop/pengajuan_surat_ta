<!DOCTYPE html>
<html>
<head>
    <title>Surat PKL</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin-top: 35px;
            margin-left: 45px;
            margin-right: 45px;
            margin-bottom: 35px;
            font-size: 12pt;
            line-height: 1.5;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .justify { text-align: justify; }

        .header-title {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 0;
        }

        .header-text {
            font-size: 11pt;
            margin-top: 0;
            line-height: 1.3;
        }

        hr {
            border: 1px solid black;
            margin-top: 8px;
            margin-bottom: 25px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            vertical-align: top;
            padding: 1px 0;
        }

        .ttd {
            width: 280px;
            float: right;
            text-align: center;
            margin-top: 20px;
        }

        .space {
            height: 18px;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<table>
    <tr>
        <td width="90">
    @php
        $path = public_path('images/logo-polhas.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    @endphp

    <img src="{{ $base64 }}" width="80">
</td>

        <td class="center">
            <div class="kop-title">POLITEKNIK HASNUR</div>

            <div class="kop-sub">
                Jl. Brigjen H. Hasan Basri, Handil Bakti Ray V, Kec. Alalak,<br>
                Kab. Barito Kuala, Prov. Kalimantan Selatan, 70125 <br>
                Telepon 0511-3306886 Fax 0511-3301765 <br>
                Website polihasnur.ac.id <br>
                E-mail polihasnur@polihasnur.ac.id
            </div>
        </td>
    </tr>
</table>

<hr class="garis1">
<hr class="garis2">

<!-- TANGGAL -->
<div class="right">
    Barito Kuala, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
</div>

<br>

<!-- NOMOR -->
<table>
    <tr>
        <td width="90">Nomor</td>
        <td>: {{ $pkl->nomor_surat ?? '-' }}</td>
    </tr>
    <tr>
        <td>Perihal</td>
        <td>: <b>PRAKTIK KERJA LAPANGAN</b></td>
    </tr>
</table>

<br>

<!-- TUJUAN -->
Kepada Yth. <br>
{{ $pkl->instansi ?? '-' }} <br>
Di - Tempat

<br><br>

Dengan Hormat,

<p class="justify">
    Sehubungan dengan pelaksanaan kegiatan Praktik Kerja Lapangan (PKL)
    mahasiswa Program Studi D3 Teknik Informatika Politeknik Hasnur,
    maka dengan ini kami mohon kepada Bapak/Ibu agar dapat memberikan
    izin kepada mahasiswa kami untuk melaksanakan kegiatan PKL
    yang akan dilaksanakan pada:
</p>

<table>
    <tr>
        <td width="170">Tanggal</td>
        <td>: {{ $pkl->tanggal_mulai }} - {{ $pkl->tanggal_selesai }}</td>
    </tr>
    <tr>
        <td>Tempat</td>
        <td>: {{ $pkl->tempat }}</td>
    </tr>
    <tr>
        <td>Nama (NIM)</td>
        <td>: {{ $pkl->user->name }} ({{ $pkl->user->nim }})</td>
    </tr>
    <tr>
        <td>No Handphone</td>
        <td>: {{ $pkl->user->no_hp ?? '-' }}</td>
    </tr>
    <tr>
        <td>Dosen Pembimbing</td>
        <td>: {{ $pkl->dosen ?? '-' }}</td>
    </tr>
    <tr>
        <td>No Handphone Dosen</td>
        <td>: {{ $pkl->no_hp_dosen ?? '-' }}</td>
    </tr>
</table>

<br>

<p class="justify">
    Demikian surat permohonan ini kami sampaikan, atas bantuan dan
    kerjasamanya disampaikan terimakasih.
</p>

<!-- TTD -->
<div class="ttd">
    Hormat Kami,<br>
    Koordinator Program Studi<br>
    D3 Teknik Informatika

    <br><br><br><br>

    <b>Yazid Aufar, M.Kom.</b><br>
    NIK. 190224
</div>

</body>
</html>