@extends('layouts.app')

@section('title', 'Form Pengajuan Surat Penelitian')

@section('content')

<div class="w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
    <div class="max-w-3xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-6 sm:mb-8">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800">Form Pengajuan Surat Penelitian</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-2">Isi formulir untuk mengajukan izin penelitian Tugas Akhir / Skripsi.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-5 sm:p-8">

            {{-- ALERT --}}
            @if(session('error'))
                <div class="mb-4 p-3 sm:p-4 bg-red-100 text-red-700 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 p-3 sm:p-4 bg-green-100 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('pengajuan.penelitian.store') }}" method="POST" class="space-y-4 sm:space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Tanggal Pengajuan</label>
                    <input type="text" value="{{ $tanggal_sekarang }}" readonly
                        class="w-full px-4 py-2.5 sm:py-3 bg-gray-100 border border-gray-300 rounded-lg text-sm sm:text-base text-gray-600 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Nomor Surat</label>
                    <input type="text" placeholder="/E/PHS-SB/TI/ (Akan diisi oleh Admin)" disabled
                        class="w-full px-4 py-2.5 sm:py-3 bg-gray-100 border border-gray-300 rounded-lg text-sm sm:text-base text-gray-500 italic cursor-not-allowed">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama</label>
                        <input type="text" value="{{ $user->name }}" readonly
                            class="w-full px-4 py-2.5 sm:py-3 bg-gray-100 border border-gray-300 rounded-lg text-sm sm:text-base text-gray-600 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">NIM</label>
                        <input type="text" value="{{ $user->nim }}" readonly
                            class="w-full px-4 py-2.5 sm:py-3 bg-gray-100 border border-gray-300 rounded-lg text-sm sm:text-base text-gray-600 cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Nomor Handphone</label>
                    <input type="text" name="nomor_handphone" required placeholder="Masukkan nomor handphone"
                        class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Tempat Penelitian</label>
                    <input type="text" name="tempat_penelitian" required placeholder="Masukkan nama instansi"
                        class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Alamat Tempat Penelitian</label>
                    <textarea name="alamat_tempat_penelitian" rows="3" required placeholder="Masukkan alamat lengkap"
                        class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Tujuan Surat</label>
                    <input type="text" name="tujuan_surat" required placeholder="Direktur Politeknik Hasnur, Kepala Diskominfo, dll"
                        class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Judul Tugas Akhir</label>
                    <input type="text" name="judul_ta" required placeholder="Masukkan judul tugas akhir / skripsi"
                        class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Pembimbing</label>
                    <select name="pembimbing_ta" required
                        class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach(App\Models\DosenPembimbing::all() as $dosen)
                            <option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">No HP Pembimbing</label>
                    <input type="text" name="no_hp_pembimbing" required placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                {{-- TOMBOL --}}
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 sm:gap-4 pt-2">
                    <a href="{{ route('dashboard') }}"
                        class="w-full sm:w-auto text-center px-6 py-2.5 sm:py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition text-sm sm:text-base">
                        Batal
                    </a>

                    @if($punyaPengajuanAktif)
                        <button type="button" onclick="showModal()"
                            class="w-full sm:w-auto px-6 py-2.5 sm:py-3 bg-gray-400 text-white font-medium rounded-lg cursor-not-allowed text-sm sm:text-base">
                            Sudah Ada Pengajuan Aktif
                        </button>
                    @else
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-2.5 sm:py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition text-sm sm:text-base">
                            Ajukan Surat
                        </button>
                    @endif
                </div>

            </form>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="modalAlert" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 px-4">
    <div class="bg-white p-6 rounded-2xl text-center w-full max-w-sm shadow-xl">
        <h2 class="font-bold text-lg mb-2">Tidak Bisa Mengajukan</h2>
        <p class="text-gray-600 mb-4 text-sm sm:text-base">
            Anda masih memiliki pengajuan aktif. Silakan tunggu atau ajukan kembali jika ditolak.
        </p>
        <button onclick="closeModal()" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
            OK
        </button>
    </div>
</div>

<script>
function showModal() {
    document.getElementById('modalAlert').classList.remove('hidden');
    document.getElementById('modalAlert').classList.add('flex');
}
function closeModal() {
    document.getElementById('modalAlert').classList.add('hidden');
    document.getElementById('modalAlert').classList.remove('flex');
}
</script>

@endsection