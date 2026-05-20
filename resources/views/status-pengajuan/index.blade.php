@extends('layouts.app')

@section('title', 'Status Pengajuan Surat')

@section('content')

<div class="w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-10">

    <div class="mb-5 sm:mb-6">
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800">Data Pengajuan Surat</h1>
        <p class="text-sm sm:text-base text-gray-500 mt-1">Silahkan klik tab di bawah untuk melihat status pengajuan Anda.</p>
    </div>

    {{-- TAB --}}
    <div class="flex space-x-1 bg-gray-200 p-1 rounded-t-lg w-full sm:w-fit">
        <button onclick="switchTab('pkl')" id="tab-pkl"
            class="flex-1 sm:flex-none px-4 sm:px-6 py-2.5 sm:py-3 text-xs sm:text-sm font-bold rounded-t-lg transition-colors duration-200 bg-white text-blue-600 shadow-sm border-t border-l border-r border-gray-200">
            Surat PKL
        </button>
        <button onclick="switchTab('penelitian')" id="tab-penelitian"
            class="flex-1 sm:flex-none px-4 sm:px-6 py-2.5 sm:py-3 text-xs sm:text-sm font-bold rounded-t-lg transition-colors duration-200 text-gray-500 hover:text-gray-700 hover:bg-gray-100">
            Surat Penelitian
        </button>
    </div>

    {{-- CONTENT BOX --}}
    <div class="bg-white rounded-b-lg rounded-tr-lg shadow-xl border border-gray-200 overflow-hidden min-h-64">

        {{-- PKL --}}
<div id="content-pkl" class="block">

    {{-- HEADER --}}
    <div class="p-5 sm:p-6 bg-gradient-to-r from-blue-50 via-white to-indigo-50 border-b border-gray-200">
        <div class="flex items-center justify-between flex-wrap gap-3">

            <div>
                <h2 class="text-lg sm:text-xl font-bold text-gray-800">
                    Surat Pengantar PKL
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Riwayat pengajuan surat pengantar PKL Anda
                </p>
            </div>

            <div class="px-4 py-2 rounded-xl bg-white border border-blue-100 shadow-sm">
                <span class="text-sm font-semibold text-blue-600">
                    Total: {{ count($pkls) }} Pengajuan
                </span>
            </div>

        </div>
    </div>

    {{-- CONTENT --}}
    <div class="p-4 sm:p-6 bg-gradient-to-br from-gray-50 to-white">

        <div class="space-y-4">

            @forelse($pkls as $index => $pkl)

            @php
                $statusClass = match($pkl->status) {
                    'disetujui' => 'bg-green-100 text-green-700 border-green-200',
                    'ditolak'   => 'bg-red-100 text-red-700 border-red-200',
                    default     => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                };

                $statusLabel = match($pkl->status) {
                    'disetujui' => 'Disetujui',
                    'ditolak'   => 'Ditolak',
                    default     => 'Pending',
                };
            @endphp

            <div class="group bg-white border border-gray-200 rounded-2xl p-4 sm:p-5 hover:shadow-xl hover:border-blue-200 transition-all duration-300">

                {{-- TOP --}}
                <div class="flex items-start justify-between gap-3">

                    {{-- LEFT --}}
                    <div class="flex items-start gap-3 sm:gap-4 min-w-0">

                        {{-- NUMBER --}}
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm flex-shrink-0">
                            {{ $index + 1 }}
                        </div>

                        {{-- CONTENT --}}
                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2 mb-2">

                                <h3 class="font-bold text-gray-800 text-sm sm:text-base">
                                    Surat Pengantar PKL
                                </h3>

                                <span class="px-2.5 py-1 rounded-full text-[11px] sm:text-xs font-bold border {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>

                            </div>

                            <div class="text-xs sm:text-sm text-gray-500">
                                Diajukan:
                                <span class="font-medium text-gray-700">
                                    {{ \Carbon\Carbon::parse($pkl->created_at)->translatedFormat('d F Y, H:i') }}
                                </span>
                            </div>

                            @if($pkl->status == 'disetujui')

                            <div class="text-xs sm:text-sm text-green-600 mt-1">
                                Surat telah diterima
                            </div>

                            @elseif($pkl->status == 'pending')

                            <div class="text-xs sm:text-sm text-yellow-600 mt-1">
                                Menunggu verifikasi admin
                            </div>

                            @else

                            <div class="text-xs sm:text-sm text-red-600 mt-1">
                                Pengajuan ditolak
                            </div>

                            @endif

                        </div>

                    </div>

                </div>

                {{-- BOTTOM --}}
                <div class="mt-4 flex items-center justify-between flex-wrap gap-3">

                    {{-- TANGGAL DITERIMA --}}
                    <div>

                        <p class="text-[11px] uppercase tracking-wide text-gray-400 font-semibold">
                            Tanggal Diterima
                        </p>

                        <p class="text-sm text-gray-700 font-medium mt-1">

                            @if($pkl->status == 'disetujui')

                                {{ \Carbon\Carbon::parse($pkl->updated_at)->translatedFormat('d F Y, H:i') }}

                            @else

                                -

                            @endif

                        </p>

                    </div>

                    {{-- BUTTON --}}
                    <div>

                        @if($pkl->status == 'disetujui')

                        <a href="{{ route('admin.verifikasi.pkl.pdf', $pkl->id) }}"
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl transition-all duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12H9m12 0A9 9 0 113 12a9 9 0 0118 0z" />

                            </svg>

                            Lihat Surat

                        </a>

                        @else

                        <button
                            class="bg-gray-100 text-gray-400 text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl cursor-not-allowed">
                            Detail
                        </button>

                        @endif

                    </div>

                </div>

            </div>

            @empty

            {{-- EMPTY --}}
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 py-14 text-center">

                <div class="flex flex-col items-center px-4">

                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">

                        <svg class="w-10 h-10 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>

                        </svg>

                    </div>

                    <h3 class="text-lg font-bold text-gray-700">
                        Belum Ada Pengajuan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 text-center">
                        Pengajuan surat PKL Anda akan muncul di sini.
                    </p>

                </div>

            </div>

            @endforelse

        </div>

    </div>

</div>

        {{-- PENELITIAN --}}
<div id="content-penelitian" class="hidden">

    {{-- HEADER --}}
    <div class="p-5 sm:p-6 bg-gradient-to-r from-emerald-50 via-white to-green-50 border-b border-gray-200">
        <div class="flex items-center justify-between flex-wrap gap-3">

            <div>
                <h2 class="text-lg sm:text-xl font-bold text-gray-800">
                    Surat Pengantar Penelitian
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Riwayat pengajuan surat penelitian Anda
                </p>
            </div>

            <div class="px-4 py-2 rounded-xl bg-white border border-emerald-100 shadow-sm">
                <span class="text-sm font-semibold text-emerald-600">
                    Total: {{ count($penelitians) }} Pengajuan
                </span>
            </div>

        </div>
    </div>

    {{-- CONTENT --}}
    <div class="p-4 sm:p-6 bg-gradient-to-br from-gray-50 to-white">

        <div class="space-y-4">

            @forelse($penelitians as $index => $penelitian)

            @php
                $statusClass = match($penelitian->status) {
                    'disetujui' => 'bg-green-100 text-green-700 border-green-200',
                    'ditolak'   => 'bg-red-100 text-red-700 border-red-200',
                    default     => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                };

                $statusLabel = match($penelitian->status) {
                    'disetujui' => 'Disetujui',
                    'ditolak'   => 'Ditolak',
                    default     => 'Pending',
                };
            @endphp

            <div class="group bg-white border border-gray-200 rounded-2xl p-4 sm:p-5 hover:shadow-xl hover:border-emerald-200 transition-all duration-300">

                {{-- TOP --}}
                <div class="flex items-start justify-between gap-3">

                    {{-- LEFT --}}
                    <div class="flex items-start gap-3 sm:gap-4 min-w-0">

                        {{-- NUMBER --}}
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-emerald-50 text-emerald-600 font-bold flex items-center justify-center text-sm flex-shrink-0">
                            {{ $index + 1 }}
                        </div>

                        {{-- CONTENT --}}
                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2 mb-2">

                                <h3 class="font-bold text-gray-800 text-sm sm:text-base">
                                    Surat Pengantar Penelitian
                                </h3>

                                <span class="px-2.5 py-1 rounded-full text-[11px] sm:text-xs font-bold border {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>

                            </div>

                            <div class="text-xs sm:text-sm text-gray-500">
                                Diajukan:
                                <span class="font-medium text-gray-700">
                                    {{ \Carbon\Carbon::parse($penelitian->created_at)->translatedFormat('d F Y, H:i') }}
                                </span>
                            </div>

                            @if($penelitian->status == 'disetujui')

                            <div class="text-xs sm:text-sm text-green-600 mt-1">
                                Surat telah diterima
                            </div>

                            @elseif($penelitian->status == 'pending')

                            <div class="text-xs sm:text-sm text-yellow-600 mt-1">
                                Menunggu verifikasi admin
                            </div>

                            @else

                            <div class="text-xs sm:text-sm text-red-600 mt-1">
                                Pengajuan ditolak
                            </div>

                            @endif

                        </div>

                    </div>

                </div>

                {{-- BOTTOM --}}
                <div class="mt-4 flex items-center justify-between flex-wrap gap-3">

                    {{-- TANGGAL DITERIMA --}}
                    <div>

                        <p class="text-[11px] uppercase tracking-wide text-gray-400 font-semibold">
                            Tanggal Diterima
                        </p>

                        <p class="text-sm text-gray-700 font-medium mt-1">

                            @if($penelitian->status == 'disetujui')

                                {{ \Carbon\Carbon::parse($penelitian->updated_at)->translatedFormat('d F Y, H:i') }}

                            @else

                                -

                            @endif

                        </p>

                    </div>

                    {{-- BUTTON --}}
                    <div>

                        @if($penelitian->status == 'disetujui')

                        <a href="{{ route('admin.verifikasi.penelitian.pdf', $penelitian->id) }}"
                            class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl transition-all duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12H9m12 0A9 9 0 113 12a9 9 0 0118 0z" />

                            </svg>

                            Lihat Surat

                        </a>

                        @else

                        <button
                            class="bg-gray-100 text-gray-400 text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl cursor-not-allowed">
                            Detail
                        </button>

                        @endif

                    </div>

                </div>

            </div>

            @empty

            {{-- EMPTY --}}
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 py-14 text-center">

                <div class="flex flex-col items-center px-4">

                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">

                        <svg class="w-10 h-10 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>

                        </svg>

                    </div>

                    <h3 class="text-lg font-bold text-gray-700">
                        Belum Ada Pengajuan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 text-center">
                        Pengajuan surat penelitian Anda akan muncul di sini.
                    </p>

                </div>

            </div>

            @endforelse

        </div>

    </div>

</div>

<script>
function switchTab(tabName) {
    const baseClass = 'flex-1 sm:flex-none px-4 sm:px-6 py-2.5 sm:py-3 text-xs sm:text-sm font-bold rounded-t-lg transition-colors duration-200 ';
    const activeClass = 'bg-white text-blue-600 shadow-sm border-t border-l border-r border-gray-200';
    const inactiveClass = 'text-gray-500 hover:text-gray-700 hover:bg-gray-100';

    const contentPkl = document.getElementById('content-pkl');
    const contentPenelitian = document.getElementById('content-penelitian');
    const tabPkl = document.getElementById('tab-pkl');
    const tabPenelitian = document.getElementById('tab-penelitian');

    if (tabName === 'pkl') {
        contentPkl.classList.remove('hidden');
        contentPenelitian.classList.add('hidden');
        tabPkl.className = baseClass + activeClass;
        tabPenelitian.className = baseClass + inactiveClass;
    } else {
        contentPkl.classList.add('hidden');
        contentPenelitian.classList.remove('hidden');
        tabPkl.className = baseClass + inactiveClass;
        tabPenelitian.className = baseClass + activeClass;
    }
}
</script>

@endsection