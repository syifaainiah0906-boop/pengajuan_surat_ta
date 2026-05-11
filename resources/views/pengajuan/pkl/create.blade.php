@extends('layouts.app')

@section('title', 'Form Pengajuan Surat PKL')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8 text-center md:text-left">
            <h1 class="text-3xl font-bold text-gray-800">Form Pengajuan Surat PKL</h1>
            <p class="text-gray-500 mt-2">Isi formulir untuk mengajukan izin praktik kerja lapangan.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

            {{-- ✅ TAMBAHAN: ALERT --}}
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

            <form action="{{ route('pengajuan.pkl.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pengajuan</label>
                    <input type="text" value="{{ $tanggal_sekarang }}" readonly 
                        class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 focus:outline-none cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Surat</label>
                    <input type="text" placeholder="/E/PHS-SB/TI/ (Otomatis dari sistem)" disabled
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

                <hr class="border-gray-100">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Handphone</label>
                    <input type="text" name="nomor_handphone" required placeholder="Masukkan nomor handphone"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div>
    <label class="block text-sm font-bold text-gray-700 mb-2">
        Tanggal Mulai PKL
    </label>

    <input 
        type="date" 
        name="tanggal_mulai"
        required
        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition"
    >
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Tanggal Selesai PKL
            </label>

            <input 
                type="date" 
                name="tanggal_selesai"
                required
                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition"
            >
        </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tempat PKL</label>
                    <input type="text" name="tempat_pkl" required placeholder="Masukkan nama instansi / perusahaan"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Tempat PKL</label>
                    <textarea name="alamat_tempat_pkl" rows="3" required placeholder="Masukkan alamat lengkap instansi"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tujuan Surat (Jabatan)</label>
                    <input type="text" name="tujuan_surat" required placeholder="Contoh: Direktur Politeknik Hasnur, Kepala DISKOMINFO, dll"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <p class="text-xs text-gray-500 mt-1">Surat pengantar ditujukan ke jabatan pimpinan instansi.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pembimbing PKL</label>
                    <select name="pembimbing_pkl" required class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach(App\Models\DosenPembimbing::all() as $dosen)
                            <option value="{{ $dosen->nama }}">{{ $dosen->nama }} - {{ $dosen->prodi }}</option>
                        @endforeach
                    </select>
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

                    {{-- ✅ TAMBAHAN: KONDISI TOMBOL --}}
                    @if($punyaPengajuanAktif)
                        <button type="button" onclick="showModal()" 
                            class="px-8 py-3 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed">
                            Sudah Ada Pengajuan Aktif
                        </button>
                    @else
                        <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                            Ajukan Surat
                        </button>
                    @endif
                </div>

            </form>
        </div>
    </div>
</div>

{{-- ✅ TAMBAHAN: MODAL --}}
<div id="modalAlert" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg text-center">
        <h2 class="font-bold text-lg mb-2">Tidak Bisa Mengajukan</h2>
        <p class="text-gray-600 mb-4">
            Anda masih memiliki pengajuan PKL aktif.
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