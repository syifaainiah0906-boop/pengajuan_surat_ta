<!DOCTYPE html>
<html>
<head>
    <title>Surat PKL</title>

    <style>
        @page {
            size: A4;
            margin: 10mm 25mm 20mm 25mm;
        }

        body{
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: black;
        }

        .header{
            width: 100%;
            margin-top: -10px;
        }

        .tanggal{
            text-align: right;
            margin-top: 15px;
        }

        .judul{
            margin-top: 25px;
            width: 100%;
        }

        .judul td{
            padding: 2px 0;
            vertical-align: top;
        }

        .isi{
            text-align: justify;
            margin-top: 20px;
        }

        .data{
            margin-top: 15px;
            margin-left: 40px;
            width: 100%;
        }

        .data td{
            padding: 2px 0;
            vertical-align: top;
        }

        .ttd{
            width: 260px;
            margin-left: auto;
            margin-top: 25px;
            text-align: center;
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
            padding-right: 15px;
        }

        .footer-right{
            width: 50%;
            text-align: right;
            padding-left: 15px;
        }
    </style>
</head>

<body>

@php
    \Carbon\Carbon::setLocale('id');
@endphp

<!-- HEADER -->
<table class="header">
    <tr>
        <td>
            <img src="{{ public_path('images/logo-polhas.png') }}"
                 style="width: 300px;">
        </td>
    </tr>
</table>

<hr style="
    border: 2px solid #3f6ca4;
    width: calc(100% + 50mm);
    margin-left: -25mm;
    
">

<!-- TANGGAL -->
<div class="tanggal">
    Barito Kuala, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
</div>

<!-- NOMOR -->
<table class="judul">
    <tr>
        <td width="80">Nomor</td>
        <td width="10">:</td>
        <td>{{ $pkl->nomor_surat ?? '-' }}</td>
    </tr>

    <tr>
        <td>Perihal</td>
        <td>:</td>
        <td><b>PRAKTIK KERJA LAPANGAN</b></td>
    </tr>
</table>

<br>

<!-- TUJUAN -->
<b>Kepada Yth.</b><br>
<b>{{ $pkl->tujuan_surat ?? '-' }}</b><br>
<b>Di - Tempat</b>

<br>

<div class="isi">
    <p style="text-align: justify; margin: 0;">
    Dengan Hormat,<br>
    <span style="display:inline-block; text-indent: 40px;">
        Sehubungan dengan pelaksanaan kegiatan Praktik Kerja Lapangan (PKL)
        di Program Studi D3 Teknik Informatika Politeknik Hasnur,
        maka dengan ini kami mohon kepada Bapak/Ibu
    <b>{{ $pkl->tempat_pkl ?? '-' }}</b>
    agar dapat memberikan izin kepada mahasiswa kami untuk melaksanakan
    kegiatan Praktik Kerja Lapangan (PKL) yang akan dilaksanakan pada:
    </span>
</p>
</div>

<!-- DATA -->
<table class="data" style="margin-top: 5;">
    <tr>
        @php
    $start = \Carbon\Carbon::parse($pkl->tanggal_mulai);
    $end = \Carbon\Carbon::parse($pkl->tanggal_selesai);

    $bulan = $start->diffInMonths($end);
@endphp

<td width="115">Tanggal</td>
<td width="10">:</td>
<td>
    {{ $start->translatedFormat('d F Y') }}
    -
    {{ $end->translatedFormat('d F Y') }}
    ({{ (int) $bulan }} Bulan)
</td>
    </tr>

    <tr>
        <td>Tempat</td>
        <td>:</td>
        <td>{{ $pkl->tempat_pkl ?? '-' }}</td>
    </tr>

    <tr>
        <td>Nama (NIM)</td>
        <td>:</td>
        <td>
            {{ $pkl->user->name }}
            ({{ $pkl->user->nim }})
        </td>
    </tr>

    <tr>
        <td>No Handphone</td>
        <td>:</td>
        <td>{{ $pkl->nomor_handphone ?? '-' }}</td>
    </tr>

    <tr>
        <td>Dosen Pembimbing</td>
        <td>:</td>
        <td>{{ $pkl->pembimbing_pkl ?? '-' }}</td>
    </tr>

    <tr>
        <td>No Handphone Dosen</td>
        <td>:</td>
        <td>{{ $pkl->no_hp_pembimbing ?? '-' }}</td>
    </tr>
</table>

<div class="isi" style="margin-top: 5;">
    <p style="margin: 0; text-align: justify; text-indent: 40px;">
        Demikian surat permohonan ini kami sampaikan,
        atas bantuan dan kerjasamanya disampaikan terimakasih.
    </p>
</div>

<!-- TTD -->
<div class="ttd" style="text-align: left; width: 250px; margin-left: auto;">
    Hormat Kami, <br>
    Koordinator Program Studi <br>
    D3 Teknik Informatika

    <br><br><br><br><br>

    Yazid Aufar, M.Kom.<br>
    NIK. 190224
</div>

<!-- FOOTER -->
<div class="footer">
    <table>
        <tr>
            <td class="footer-left">
                <b>
                    <span style="color: #20436e;">
                        POLITEKNIK HASNUR
                    </span>
                </b><br>

                <span style="color: #4F81BD;">
                    Jl. Brigjen H. Hasan Basri, Handil Bakti Ray V,
                    Kec. Alalak, Kab. Barito Kuala,
                    Prov. Kalimantan Selatan, 70125
                </span>
            </td>

            <!-- GARIS -->
            <td style="width:1px; border-left:1px solid black;"></td>

            <td class="footer-right">
                <span style="color: #d41743;">Telepon</span>
                <span style="color: #4F81BD;">0511-3306886</span>

                <span style="color: #d41743;">Fax</span>
                <span style="color: #4F81BD;">0511-3301765</span>
                <br>

                <span style="color: #d41743;">Website</span>
                <span style="color: #4F81BD;">polihasnur.ac.id</span>
                <br>

                <span style="color: #d41743;">E-mail</span>
                <span style="color: #4F81BD;">polihasnur@polihasnur.ac.id</span>
            </td>
        </tr>
    </table>
</div>

</body>
</html>