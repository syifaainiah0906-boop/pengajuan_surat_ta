<!DOCTYPE html>
<html>
<head>
    <title>Surat Penelitian</title>
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
<div class="text-center">
    <div class="header-title">POLITEKNIK HASNUR</div>

    <div class="header-text">
        Jl. Brigjen H. Hasan Basri, Handil Bakti Ray V, Kec. Alalak,<br>
        Kab. Barito Kuala, Prov. Kalimantan Selatan, 70125 <br>
        Telepon 0511-3306886 Fax 0511-3301765 <br>
        Website polihasnur.ac.id <br>
        E-mail polihasnur@polihasnur.ac.id
    </div>

    <hr>
</div>

<!-- TANGGAL -->
<div class="text-right">
    Barito Kuala, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
</div>

<br>

<!-- NOMOR -->
<table>
    <tr>
        <td width="90">Nomor</td>
        <td>: {{ $penelitian->nomor_surat ?? '-' }}</td>
    </tr>

    <tr>
        <td>Perihal</td>
        <td>: <b>PENELITIAN</b></td>
    </tr>
</table>

<div class="space"></div>

<!-- TUJUAN -->
Kepada Yth. <br>
{{ $penelitian->instansi ?? '-' }} <br>
Di - Tempat

<br><br>

Dengan Hormat,

<p class="justify">
    Sehubungan dengan pelaksanaan kegiatan penelitian mahasiswa
    Program Studi D3 Teknik Informatika Politeknik Hasnur, maka dengan ini
    kami mohon kepada Bapak/Ibu agar dapat memberikan izin kepada mahasiswa kami
    untuk melaksanakan penelitian yang akan dilaksanakan pada:
</p>

<!-- DATA -->
<table>
    <tr>
        <td width="170">Tanggal</td>
        <td>: {{ $penelitian->tanggal_mulai }} - {{ $penelitian->tanggal_selesai }}</td>
    </tr>

    <tr>
        <td>Tempat</td>
        <td>: {{ $penelitian->tempat }}</td>
    </tr>

    <tr>
        <td>Nama (NIM)</td>
        <td>: {{ $penelitian->user->name }} ({{ $penelitian->user->nim }})</td>
    </tr>

    <tr>
        <td>No Handphone</td>
        <td>: {{ $penelitian->user->no_hp ?? '-' }}</td>
    </tr>

    <tr>
        <td>Dosen Pembimbing</td>
        <td>: {{ $penelitian->dosen ?? '-' }}</td>
    </tr>

    <tr>
        <td>No Handphone Dosen</td>
        <td>: {{ $penelitian->no_hp_dosen ?? '-' }}</td>
    </tr>
</table>

<br>

<p class="justify">
    Demikian surat permohonan ini kami sampaikan, atas bantuan dan kerjasamanya
    disampaikan terimakasih.
</p>

<!-- TTD -->
<div class="ttd">
    Hormat Kami, <br>
    Koordinator Program Studi <br>
    D3 Teknik Informatika

    <br><br><br><br>

    <b>Yazid Aufar, M.Kom.</b><br>
    NIK. 190224
</div>

</body>
</html>