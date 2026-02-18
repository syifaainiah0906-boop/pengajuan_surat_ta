@extends('layouts.app')

@section('title', 'Form Pengajuan Surat Penelitian')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Form Pengajuan Surat Penelitian</h1>
            <p class="text-gray-500 mt-2">Isi formulir untuk mengajukan izin penelitian Tugas Akhir / Skripsi.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <form action="{{ route('pengajuan.penelitian.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pengajuan</label>
                    <input type="text" value="{{ $tanggal_sekarang }}" readonly 
                        class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 focus:outline-none cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Surat</label>
                    <input type="text" placeholder="/E/PHS-SB/TI/ (Akan diisi oleh Admin)" disabled
                        class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-500 italic cursor-not-allowed">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama</label>
                        <input type="text" value="{{ $user->name }}" readonly 
                            class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 focus:outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">NIM</label>
                        <input type="text" value="{{ $user->nim }}" readonly 
                            class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 focus:outline-none cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tempat Penelitian</label>
                    <input type="text" name="tempat_penelitian" required placeholder="Masukkan nama instansi / perusahaan"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Tempat Penelitian</label>
                    <textarea name="alamat_tempat_penelitian" rows="3" required placeholder="Masukkan alamat lengkap instansi"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tujuan Surat (Jabatan)</label>
                    <input type="text" name="tujuan_surat" required placeholder="Contoh: Direktur Politeknik Hasnur, Kepala DISKOMINFO, dll"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <p class="text-xs text-gray-500 mt-1">Surat pengantar ditujukan ke jabatan pimpinan instansi.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Tugas Akhir</label>
                    <input type="text" name="judul_ta" required placeholder="Masukkan Judul Skripsi / Tugas Akhir Anda"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pembimbing Tugas Akhir</label>
                    <input type="text" name="pembimbing_ta" required placeholder="Nama Dosen Pembimbing"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor HP Dosen Pembimbing</label>
                    <input type="text" name="no_hp_pembimbing" required placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div class="pt-4 flex items-center justify-end space-x-4">
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                        Ajukan Surat Pengantar Penelitian
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection