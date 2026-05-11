<!DOCTYPE html>
<html>
<head>
    <title>Surat Penelitian</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin-top: 35px;
            margin-left: 45px;
            margin-right: 45px;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .header{
            width: 100%;
        }

        .header td{
            vertical-align: top;
        }

        .logo{
            width: 85px;
        }

        .kampus{
            font-size: 20px;
            font-weight: bold;
        }

        .tagline{
            font-style: italic;
            font-size: 14px;
        }

        .tanggal{
            text-align: right;
            margin-top: 20px;
        }

        .judul{
            margin-top: 25px;
        }

        .judul td{
            padding: 2px 0;
        }

        .isi{
            text-align: justify;
            margin-top: 25px;
        }

        .data{
            margin-top: 10px;
            margin-left: 40px;
        }

        .data td{
            padding: 3px 0;
            vertical-align: top;
        }

        .ttd{
            width: 300px;
            float: right;
            text-align: center;
            margin-top: 30px;
        }

        .footer{
            position: fixed;
            bottom: 20px;
            left: 45px;
            right: 45px;
            font-size: 10pt;
        }

        .footer table{
            width: 100%;
        }

        .footer-left{
            width: 50%;
        }

        .footer-right{
            width: 50%;
            text-align: right;
            color: #8B0000;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<table class="header">
    <tr>
        <td width="90">
            <img src="{{ public_path('images/logo-polhas.png') }}" class="logo">
        </td>

        <td>
            <div class="kampus">POLITEKNIK HASNUR</div>
            <div class="tagline">Technopreneur Campus</div>
        </td>
    </tr>
</table>

<!-- TANGGAL -->
<div class="tanggal">
    Barito Kuala, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
</div>

<!-- NOMOR -->
<table class="judul">
    <tr>
        <td width="80">Nomor</td>
        <td>: {{ $penelitian->nomor_surat ?? '-' }}</td>
    </tr>

    <tr>
        <td>Perihal</td>
        <td>: <b>PERMOHONAN IZIN PENELITIAN</b></td>
    </tr>
</table>

<br><br>

<!-- TUJUAN -->
Kepada Yth. <br>
{{ $penelitian->instansi ?? '-' }} <br>
Di - Tempat

<br><br>

Dengan Hormat,

<div class="isi">
    Dengan hormat, disampaikan kepada Bapak/Ibu bahwa mahasiswa Program Studi
    D3 Teknik Informatika dibawah ini:
</div>

<!-- DATA MAHASISWA -->
<table class="data">
    <tr>
        <td width="170">Nama</td>
        <td>: {{ $penelitian->user->name }}</td>
    </tr>

    <tr>
        <td>NIM</td>
        <td>: {{ $penelitian->user->nim }}</td>
    </tr>

    <tr>
        <td>Dosen Pembimbing</td>
        <td>: {{ $penelitian->dosen ?? '-' }}</td>
    </tr>

    <tr>
        <td>Judul Tugas Akhir</td>
        <td>: {{ $penelitian->judul ?? '-' }}</td>
    </tr>

    <tr>
        <td>Tempat Penelitian</td>
        <td>: {{ $penelitian->tempat }}</td>
    </tr>
</table>

<br>

<div class="isi">
    Bermaksud melakukan permintaan data dan izin penelitian di
    <b>{{ strtoupper($penelitian->instansi ?? '-') }}</b>.
    Untuk maksud tersebut, kami mohon kesediaan bapak/ibu dapat
    mengizinkan mahasiswa kami untuk melakukan penelitian dan memperoleh
    data yang diperlukan sebagai dasar pembuatan Laporan Tugas Akhir.
</div>

<br>

<div class="isi">
    Demikian permohonan kami, atas bantuan dan kerjasamanya disampaikan terimakasih.
</div>

<!-- TTD -->
<div class="ttd">
    Hormat Kami, <br>
    Koordinator Program Studi <br><br>

    D3 Teknik Informatika

    <br><br><br><br>

    <b>Yazid Aufar, M.Kom.</b><br>
    NIK. 190224
</div>

<!-- FOOTER -->
<div class="footer">
    <table>
        <tr>
            <td class="footer-left">
                <b>POLITEKNIK HASNUR</b><br>
                Jl. Brigjen H. Hasan Basri, Handil Bakti Ray V,
                Kec. Alalak, Kab. Barito Kuala,
                Prov. Kalimantan Selatan, 70125
            </td>

            <td class="footer-right">
                Telepon 0511-3306886 Fax 0511-3301765<br>
                Website polihasnur.ac.id<br>
                E-mail polihasnur@polihasnur.ac.id
            </td>
        </tr>
    </table>
</div>

</body>
</html>