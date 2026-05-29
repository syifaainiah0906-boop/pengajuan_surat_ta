@extends('layouts.app')

@section('title', 'Form Pengajuan Surat PKL')

@section('content')

<div class="w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
    <div class="max-w-3xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-6 sm:mb-8">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800">
                Form Pengajuan Surat PKL
            </h1>

            <p class="text-sm sm:text-base text-gray-500 mt-1.5">
                Isi formulir untuk mengajukan izin praktik kerja lapangan.
            </p>
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

            <form action="{{ route('pengajuan.pkl.store') }}"
                  method="POST"
                  class="space-y-4 sm:space-y-6">

                @csrf

                {{-- TANGGAL --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">
                        Tanggal Pengajuan
                    </label>

                    <input type="text"
                           value="{{ $tanggal_sekarang }}"
                           readonly
                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-100 border border-gray-300 rounded-lg text-sm sm:text-base text-gray-600 cursor-not-allowed">
                </div>

                {{-- NOMOR SURAT --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">
                        Nomor Surat
                    </label>

                    <input type="text"
                           placeholder="/E/PHS-SB/TI/ (Otomatis dari sistem)"
                           disabled
                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-100 border border-gray-300 rounded-lg text-sm sm:text-base text-gray-500 italic cursor-not-allowed">
                </div>

                {{-- NAMA & NIM --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">
                            Nama
                        </label>

                        <input type="text"
                               value="{{ $user->name }}"
                               readonly
                               class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-100 border border-gray-300 rounded-lg text-sm sm:text-base text-gray-600 cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">
                            NIM
                        </label>

                        <input type="text"
                               value="{{ $user->nim }}"
                               readonly
                               class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gray-100 border border-gray-300 rounded-lg text-sm sm:text-base text-gray-600 cursor-not-allowed">
                    </div>

                </div>

                <hr class="border-gray-100">

                {{-- NOMOR HP --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">
                        Nomor Handphone
                    </label>

                    <input type="text"
                           name="nomor_handphone"
                           required
                           placeholder="Masukkan nomor handphone"
                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                {{-- TANGGAL PKL --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">
                            Tanggal Mulai PKL
                        </label>

                        <input type="date"
                               name="tanggal_mulai"
                               required
                               class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">
                            Tanggal Selesai PKL
                        </label>

                        <input type="date"
                               name="tanggal_selesai"
                               required
                               class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                </div>

                {{-- TEMPAT PKL --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">
                        Tempat PKL
                    </label>

                    <input type="text"
                           name="tempat_pkl"
                           required
                           placeholder="Masukkan nama instansi / perusahaan"
                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                {{-- ALAMAT --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">
                        Alamat Tempat PKL
                    </label>

                    <textarea name="alamat_tempat_pkl"
                              rows="3"
                              required
                              placeholder="Masukkan alamat lengkap instansi"
                              class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none"></textarea>
                </div>

                {{-- TUJUAN SURAT --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">
                        Tujuan Surat (Jabatan)
                    </label>

                    <input type="text"
                           name="tujuan_surat"
                           required
                           placeholder="Contoh: Direktur, Kepala Dinas, Manager, dll"
                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition">

                    <p class="text-xs text-gray-500 mt-1">
                        Surat pengantar ditujukan ke jabatan pimpinan instansi.
                    </p>
                </div>

                {{-- DOSEN --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">
                        Pembimbing PKL
                    </label>

                    <select name="pembimbing_pkl"
                            required
                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white">

                        <option value="">-- Pilih Dosen --</option>

                        @foreach(App\Models\DosenPembimbing::all() as $dosen)
                            <option value="{{ $dosen->nama }}">
                                {{ $dosen->nama }} - {{ $dosen->prodi }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- NO HP DOSEN --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">
                        Nomor HP Dosen Pembimbing
                    </label>

                    <input type="text"
                           name="no_hp_pembimbing"
                           required
                           placeholder="Contoh: 081234567890"
                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                {{-- TOMBOL --}}
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 sm:gap-4 pt-2">

                    <a href="{{ route('dashboard') }}"
                       class="w-full sm:w-auto text-center px-6 py-2.5 sm:py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition text-sm sm:text-base">
                        Batal
                    </a>

                    @if($batasPengajuan)

                        <button type="button"
                                onclick="showModal()"
                                class="w-full sm:w-auto px-6 py-2.5 sm:py-3 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed text-sm sm:text-base">
                            Batas Pengajuan Tercapai
                        </button>

                    @else

                        <button type="submit"
                                class="w-full sm:w-auto px-8 py-2.5 sm:py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition text-sm sm:text-base">
                            Ajukan Surat
                        </button>

                    @endif

                </div>

            </form>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="modalAlert"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 px-4">

    <div class="bg-white p-6 rounded-2xl text-center w-full max-w-sm shadow-xl">

        <h2 class="font-bold text-lg mb-2">
            Tidak Bisa Mengajukan
        </h2>

        <p class="text-gray-600 mb-4 text-sm sm:text-base">
            Anda telah mencapai batas maksimal 5 kali pengajuan surat PKL.
        </p>

        <button onclick="closeModal()"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
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