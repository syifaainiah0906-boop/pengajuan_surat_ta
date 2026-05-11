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

            {{-- ALERT --}}
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('pengajuan.penelitian.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pengajuan</label>
                    <input type="text" value="{{ $tanggal_sekarang }}" readonly 
                        class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 cursor-not-allowed">
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
                            class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">NIM</label>
                        <input type="text" value="{{ $user->nim }}" readonly 
                            class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Handphone</label>
                    <input type="text" name="nomor_handphone" required placeholder="Masukkan nomor handphone"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tempat Penelitian</label>
                    <input type="text" name="tempat_penelitian" required placeholder="Masukkan nama instansi"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Tempat Penelitian</label>
                    <textarea name="alamat_tempat_penelitian" rows="3" required placeholder="Masukkan alamat lengkap"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tujuan Surat</label>
                    <input type="text" name="tujuan_surat" required placeholder="Direktur Politeknk Hasnur, kepala Diskominfo, dll"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Tugas Akhir</label>
                    <input type="text" name="judul_ta" required placeholder="Masukkan judul tugas akhir / skripsi"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pembimbing</label>
                    <select name="pembimbing_ta" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach(App\Models\DosenPembimbing::all() as $dosen)
                            <option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">No HP Pembimbing</label>
                    <input type="text" name="no_hp_pembimbing" required placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-200 rounded-lg">
                        Batal
                    </a>

                    @if($punyaPengajuanAktif)
                        <button type="button" onclick="showModal()" 
                            class="px-8 py-3 bg-gray-400 text-white rounded-lg cursor-not-allowed">
                            Sudah Ada Pengajuan Aktif
                        </button>
                    @else
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg">
                            Ajukan Surat
                        </button>
                    @endif
                </div>

            </form>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="modalAlert" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg text-center">
        <h2 class="font-bold text-lg mb-2">Tidak Bisa Mengajukan</h2>
        <p class="text-gray-600 mb-4">
            Anda masih memiliki pengajuan aktif. Silakan tunggu atau ajukan kembali jika ditolak.
        </p>
        <button onclick="closeModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
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
}
</script>

@endsection