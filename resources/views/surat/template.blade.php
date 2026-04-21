<!DOCTYPE html>
<html>
<head>
    <title>Surat {{ $jenis }}</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            line-height: 1.6;
            font-size: 14px;
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
        Nomor : {{ $data->nomor_surat ?? '-' }} <br>
        Perihal :
        <b>
            {{ $jenis == 'PKL' ? 'Praktik Kerja Lapangan' : 'Penelitian' }}
        </b>
    </p>

    <br>

    <!-- TUJUAN -->
    <p>
        Kepada Yth. <br>
        {{ $data->instansi ?? '-' }} <br>
        Di - Tempat
    </p>

    <p>Dengan Hormat,</p>

    <!-- ISI -->
    <p style="text-align: justify;">
        @if($jenis == 'PKL')
            Sehubungan dengan pelaksanaan kegiatan Praktik Kerja Lapangan (PKL),
            maka dengan ini kami mohon izin agar mahasiswa berikut dapat melaksanakan PKL:
        @else
            Sehubungan dengan pelaksanaan kegiatan penelitian,
            maka dengan ini kami mohon izin agar mahasiswa berikut dapat melakukan penelitian:
        @endif
    </p>

    <br>

    <!-- DATA KEGIATAN -->
    <table>
        @if($jenis == 'PKL')
            <tr>
                <td width="150">Tanggal</td>
                <td>: {{ $data->tanggal_mulai }} - {{ $data->tanggal_selesai }}</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>: {{ $data->tempat }}</td>
            </tr>
        @else
            <tr>
                <td width="150">Judul</td>
                <td>: {{ $data->judul }}</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>: {{ $data->lokasi }}</td>
            </tr>
        @endif
    </table>

    <br>

    <!-- DATA MAHASISWA -->
    <table>
        <tr>
            <td width="150">Nama (NIM)</td>
            <td>: {{ $data->user->name }} ({{ $data->user->nim }})</td>
        </tr>
        <tr>
            <td>No HP</td>
            <td>: {{ $data->user->no_hp ?? '-' }}</td>
        </tr>
        <tr>
            <td>Dosen Pembimbing</td>
            <td>: {{ $data->dosen ?? '-' }}</td>
        </tr>
        <tr>
            <td>No HP Dosen</td>
            <td>: {{ $data->no_hp_dosen ?? '-' }}</td>
        </tr>
    </table>

    <br>

    <!-- PENUTUP -->
    <p>
        Demikian surat ini disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.
    </p>

    <br><br>

    <!-- TTD -->
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