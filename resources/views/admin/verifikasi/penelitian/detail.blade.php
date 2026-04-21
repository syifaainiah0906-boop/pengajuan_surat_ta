<!DOCTYPE html>
<html>
<head>
    <title>Surat Penelitian</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 50px;
            line-height: 1.6;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        table { border-collapse: collapse; }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="text-center">
        <h3>POLITEKNIK HASNUR</h3>
        <p>
            Jl. Brigjen H. Hasan Basri, Handil Bakti <br>
            Kalimantan Selatan
        </p>
        <hr>
    </div>

    <!-- TANGGAL -->
    <p class="text-right">
        Barito Kuala, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </p>

    <!-- NOMOR -->
    <p>
        Nomor : {{ $penelitian->nomor_surat ?? '-' }} <br>
        Perihal : <b>Penelitian</b>
    </p>        

    <br>

    <!-- TUJUAN -->
    <p>
        Kepada Yth. <br>
        {{ $penelitian->instansi ?? '-' }} <br>
        Di - Tempat
    </p>

    <p>Dengan Hormat,</p>

    <p style="text-align: justify;">
        Sehubungan dengan pelaksanaan kegiatan Penelitian,
        maka dengan ini kami mohon izin agar mahasiswa berikut dapat melaksanakan Penelitian:
    </p>

    <table>
        <tr>
            <td width="150">Tanggal</td>
            <td>: {{ $penelitian->tanggal_mulai }} - {{ $penelitian->tanggal_selesai }}</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>: {{ $penelitian->tempat }}</td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <td width="150">Nama (NIM)</td>
            <td>: {{ $penelitian->user->name }} ({{ $penelitian->user->nim }})</td>
        </tr>
        <tr>
            <td>No HP</td>
            <td>: {{ $penelitian->user->no_hp ?? '-' }}</td>
        </tr>
        <tr>
            <td>Dosen Pembimbing</td>
            <td>: {{ $penelitian->dosen ?? '-' }}</td>
        </tr>
        <tr>
            <td>No HP Dosen</td>
            <td>: {{ $penelitian->no_hp_dosen ?? '-' }}</td>
        </tr>
    </table>

    <br>

    <p>
        Demikian surat ini disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.
    </p>

    <br><br>

    <div class="text-right">
        Hormat Kami,<br>
        Koordinator Program Studi<br>
        D3 Teknik Informatika
        <br><br><br>

        <b>Yazid Aufar, M.Kom.</b><br>
        NIK. 190224
    </div>

</body>
</html>