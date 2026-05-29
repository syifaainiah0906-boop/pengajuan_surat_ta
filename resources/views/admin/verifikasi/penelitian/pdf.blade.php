<!DOCTYPE html>
<html>
<head>
    <title>Surat Penelitian</title>

    <style>
        @page {
            size: A4;
            margin: 10mm 25mm 20mm 25mm;
        }

        body{
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: black;
        }

        .header{
            width: 100%;
            margin-top: -10px;
        }

        .header td{
            vertical-align: top;
        }

        .logo{
            width: 180px;
        }

        .kampus{
            font-size: 18px;
            font-weight: bold;
        }

        .tagline{
            font-style: italic;
            font-size: 12px;
        }

        .tanggal{
            text-align: right;
            margin-top: 10px;
        }

        .judul{
            margin-top: 20px;
            width: 100%;
        }

        .judul td{
            padding: 2px 0;
        }

        .isi{
            text-align: justify;
            margin-top: 15px;
        }

        .data{
            width: 100%;
            margin-top: 10px;
            margin-left: 30px;
        }

        .data td{
            padding: 2px 0;
            vertical-align: top;
        }

        .ttd{
            width: 250px;
            margin-left: auto;
            text-align: center;
            margin-top: 25px;
        }

        .footer{
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 9pt;
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
<table class="header" style="margin-top: -20px;">
    <tr>
        <td width="100">
            <img src="{{ public_path('images/logo-polhas.png') }}" 
                 style="width: 300px;">
        </td>
    </tr>
</table>

@php
    \Carbon\Carbon::setLocale('id');
@endphp

<!-- TANGGAL -->
<div class="tanggal">
    Barito Kuala, {{ \Carbon\Carbon::parse($penelitian->updated_at)->translatedFormat('d F Y') }}
</div>

<!-- NOMOR -->
<table class="judul">
    <tr>
        <td width="40">Nomor</td>
        <td>: {{ $penelitian->nomor_surat ?? '-' }}</td>
    </tr>

    <tr>
        <td>Perihal</td>
        <td>: <b>PERMOHONAN IZIN PENELITIAN</b></td>
    </tr>
</table>

<br>

<!-- TUJUAN -->
<b>Kepada Yth.</b> <br>
<b>{{ $penelitian->tujuan_surat ?? '-' }}</b> <br>
<b>Di - Tempat</b>

<br><br>

<div class="isi">
    Dengan hormat, disampaikan kepada Bapak/Ibu bahwa mahasiswa Program Studi
    D3 Teknik Informatika dibawah ini:
</div>

<!-- DATA -->
<table class="data">
    <tr>
        <td width="115">Nama</td>
        <td>: {{ $penelitian->user->name }}</td>
    </tr>

    <tr>
        <td>NIM</td>
        <td>: {{ $penelitian->user->nim }}</td>
    </tr>

    <tr>
        <td>Dosen Pembimbing</td>
        <td>: {{ $penelitian->pembimbing_ta ?? '-' }}</td>
    </tr>

    <tr>
        <td>Judul Tugas Akhir</td>
        <td>: {{ $penelitian->judul_ta ?? '-' }}</td>
    </tr>

    <tr>
        <td>Tempat Penelitian</td>
        <td>: {{ $penelitian->alamat_tempat_penelitian ?? '-' }}</td>
    </tr>
</table>

<div class="isi">
    Bermaksud melakukan permintaan data dan izin penelitian di
    <b>{{ strtoupper($penelitian->tempat_penelitian ?? '-') }}</b>.
    Untuk maksud tersebut, kami mohon kesediaan Bapak/Ibu dapat
    mengizinkan mahasiswa kami untuk melakukan penelitian dan memperoleh
    data yang diperlukan sebagai dasar pembuatan Laporan Tugas Akhir. <br>
    Demikian permohonan kami, atas bantuan dan kerjasamanya disampaikan
    terimakasih.
</div>

<!-- TTD -->
<div class="ttd"
     style="
        position: relative;
        text-align: left;
        width: 260px;
        margin-left: auto;
        margin-top: 0;
        line-height: 1.5;
     ">
    <br>
    Hormat Kami,<br>
    Koordinator Program Studi<br>
    D3 Teknik Informatika

    <!-- FOTO TTD -->
    <img src="{{ public_path('images/ttd-kaprodi.png') }}"
         alt="Tanda Tangan"
         style="
            width: 170px;
            position: relative;
            top: -10px;
            left: 0px;
            z-index: 2;
            opacity: 0.95;
         ">

    <div style="
        margin-top: -40px;
        position: relative;
        z-index: 1;
    ">
        <b>Yazid Aufar, M.Kom.</b><br>
        <b>NIK. 190224</b>
    </div>

</div>

<!-- FOOTER -->
<div class="footer">
    <table>
        <tr>
            <td class="footer-left" style="padding-right: 15px;">
                <b><span style="color: #20436e;">POLITEKNIK HASNUR</b><br>

                <span style="color: #4F81BD;">
                    Jl. Brigjen H. Hasan Basri, Handil Bakti Ray V,
                    Kec. Alalak, Kab. Barito Kuala,
                    Prov. Kalimantan Selatan, 70125
                </span>
            </td>

            <!-- GARIS PEMBATAS -->
            <td style="
                width: 1px;
                border-left: 1px solid #000000;
            "></td>

            <td class="footer-right" style="padding-left: 15px;">
                <span style="color: #d41743;"> Telepon</span> <span style="color: #4F81BD;">0511-3306886</span>
                <span style="color: #d41743;"> Fax</span> <span style="color: #4F81BD;">0511-3301765</span><br>

                <span style="color: #d41743;"> Website</span> <span style="color: #4F81BD;">polihasnur.ac.id</span><br>

                <span style="color: #d41743;"> E-mail</span> <span style="color: #4F81BD;">polihasnur@polihasnur.ac.id</span>
            </td>
        </tr>
    </table>
</div>

</body>
</html>