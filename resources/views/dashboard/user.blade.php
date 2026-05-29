@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

<div class="w-full min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-white px-4 sm:px-6 lg:px-10 py-6 sm:py-10">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">

        <div>
            <h1 class="text-3xl sm:text-4xl font-black text-gray-800 leading-tight">
                Dashboard
            </h1>

            <p class="mt-2 text-gray-600 text-sm sm:text-base">
                Selamat datang,
                <span class="font-bold text-blue-600">
                    {{ Auth::user()->name }}
                </span> 👋
            </p>

            <p class="text-gray-500 text-sm mt-1">
                Kelola pengajuan surat PKL dan penelitian dengan mudah.
            </p>
        </div>

    </div>

    {{-- MAIN CARD --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mt-2">

        {{-- CARD PKL --}}
        <div class="relative overflow-hidden rounded-3xl bg-white border border-blue-100 shadow-[0_15px_40px_rgba(59,130,246,0.08)] p-8 group hover:-translate-y-1 transition-all duration-300">

            <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-100 rounded-full opacity-50 blur-2xl"></div>

            <div class="relative z-10">

                {{-- ICON --}}
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center shadow-lg mb-6">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745"/>
                    </svg>

                </div>

                {{-- TITLE --}}
                <h2 class="text-2xl font-black text-gray-800 mb-3">
                    Surat Pengantar PKL
                </h2>

                {{-- DESC --}}
                <p class="text-gray-600 leading-relaxed mb-4">
                    Ajukan surat pengantar PKL untuk keperluan magang atau praktik kerja lapangan ke instansi tujuan.
                </p>

                {{-- INFO JUMLAH --}}
                <div class="mb-6">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-blue-100 text-blue-700 border border-blue-200">
                        Total Pengajuan:
                        {{ $jumlahPengajuanPkl }}/5
                    </span>
                </div>

                {{-- BUTTON --}}
                @if($batasPengajuanPkl)

                    <div class="mb-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-100 text-red-700 border border-red-200">
                            Batas Maksimal 5 Pengajuan Tercapai
                        </span>
                    </div>

                    <button onclick="showModalPkl()"
                        class="inline-flex items-center bg-gray-100 text-gray-400 px-5 py-3 rounded-xl font-semibold cursor-not-allowed">

                        Isi Form Pengajuan

                    </button>

                @else

                    <a href="{{ route('pengajuan.pkl.create') }}"
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-bold shadow-lg transition-all duration-300 hover:scale-[1.02]">

                        Isi Form Pengajuan

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 ml-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"/>
                        </svg>

                    </a>

                @endif

            </div>
        </div>

        {{-- CARD PENELITIAN --}}
        <div class="relative overflow-hidden rounded-3xl bg-white border border-yellow-100 shadow-[0_15px_40px_rgba(234,179,8,0.08)] p-8 group hover:-translate-y-1 transition-all duration-300">

            <div class="absolute -top-10 -right-10 w-40 h-40 bg-yellow-100 rounded-full opacity-50 blur-2xl"></div>

            <div class="relative z-10">

                {{-- ICON --}}
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 text-white flex items-center justify-center shadow-lg mb-6">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7"/>
                    </svg>

                </div>

                {{-- TITLE --}}
                <h2 class="text-2xl font-black text-gray-800 mb-3">
                    Surat Pengantar Penelitian
                </h2>

                {{-- DESC --}}
                <p class="text-gray-600 leading-relaxed mb-4">
                    Ajukan surat izin penelitian untuk kebutuhan skripsi, tugas akhir, maupun riset akademik lainnya.
                </p>

                {{-- INFO JUMLAH --}}
                <div class="mb-6">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                        Total Pengajuan:
                        {{ $jumlahPengajuanPenelitian }}/5
                    </span>
                </div>

                {{-- BUTTON --}}
                @if($batasPengajuanPenelitian)

                    <div class="mb-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-100 text-red-700 border border-red-200">
                            Batas Maksimal 5 Pengajuan Tercapai
                        </span>
                    </div>

                    <button onclick="showModalPenelitian()"
                        class="inline-flex items-center bg-gray-100 text-gray-400 px-5 py-3 rounded-xl font-semibold cursor-not-allowed">

                        Isi Form Pengajuan

                    </button>

                @else

                    <a href="{{ route('pengajuan.penelitian.create') }}"
                        class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-3 rounded-xl font-bold shadow-lg transition-all duration-300 hover:scale-[1.02]">

                        Isi Form Pengajuan

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 ml-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"/>
                        </svg>

                    </a>

                @endif

            </div>
        </div>

    </div>

</div>

{{-- MODAL PKL --}}
<div id="modalPkl"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">

    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl text-center">

        <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-5">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-10 w-10 text-red-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8v4m0 4h.01"/>
            </svg>

        </div>

        <h2 class="text-2xl font-black text-gray-800 mb-2">
            Pengajuan Tidak Bisa Dilakukan
        </h2>

        <p class="text-gray-500 leading-relaxed mb-6">
            Anda telah mencapai batas maksimal 5 kali pengajuan surat PKL.
        </p>

        <button onclick="closeModalPkl()"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold transition">
            Mengerti
        </button>

    </div>
</div>

{{-- MODAL PENELITIAN --}}
<div id="modalPenelitian"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">

    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl text-center">

        <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-5">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-10 w-10 text-red-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8v4m0 4h.01"/>
            </svg>

        </div>

        <h2 class="text-2xl font-black text-gray-800 mb-2">
            Pengajuan Tidak Bisa Dilakukan
        </h2>

        <p class="text-gray-500 leading-relaxed mb-6">
            Anda telah mencapai batas maksimal 5 kali pengajuan surat penelitian.
        </p>

        <button onclick="closeModalPenelitian()"
            class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-xl font-bold transition">
            Mengerti
        </button>

    </div>
</div>

<script>

function showModalPkl() {
    document.getElementById('modalPkl').classList.remove('hidden');
    document.getElementById('modalPkl').classList.add('flex');
}

function closeModalPkl() {
    document.getElementById('modalPkl').classList.add('hidden');
    document.getElementById('modalPkl').classList.remove('flex');
}

function showModalPenelitian() {
    document.getElementById('modalPenelitian').classList.remove('hidden');
    document.getElementById('modalPenelitian').classList.add('flex');
}

function closeModalPenelitian() {
    document.getElementById('modalPenelitian').classList.add('hidden');
    document.getElementById('modalPenelitian').classList.remove('flex');
}

</script>

@endsection