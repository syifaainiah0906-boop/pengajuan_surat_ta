@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')

<div class="w-full px-4 sm:px-6 lg:px-10 py-6 sm:py-10 bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl sm:text-4xl font-black text-gray-800 tracking-tight">
                Dashboard 
            </h1>

            <p class="text-gray-500 mt-2 text-sm sm:text-base">
                Monitoring pengajuan surat mahasiswa secara realtime.
            </p>
        </div>

        <div class="hidden lg:flex items-center gap-3">
            <div class="bg-white border border-gray-200 rounded-2xl px-5 py-3 shadow-sm">
                <p class="text-xs text-gray-400 uppercase font-bold">Total Pengajuan</p>
                <h3 class="text-2xl font-black text-gray-800">
                    {{ $total_pkl + $total_penelitian }}
                </h3>
            </div>
        </div>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

        {{-- PKL --}}
        <a href="{{ route('admin.verifikasi.pkl.index') }}"
           class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 to-blue-500 p-6 shadow-xl hover:scale-[1.02] transition duration-300">

            <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full"></div>

            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745"/>
                        </svg>
                    </div>

                    <span class="text-xs font-bold uppercase tracking-widest text-blue-100">
                        PKL
                    </span>
                </div>

                <div class="mt-8">
                    <h2 class="text-4xl font-black text-white">
                        {{ $total_pkl }}
                    </h2>

                    <p class="text-blue-100 mt-1 text-sm">
                        Total pengajuan PKL
                    </p>
                </div>
            </div>
        </a>

        {{-- PENELITIAN --}}
        <a href="{{ route('admin.verifikasi.penelitian.index') }}"
           class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-cyan-500 to-sky-400 p-6 shadow-xl hover:scale-[1.02] transition duration-300">

            <div class="absolute -bottom-10 -right-10 w-36 h-36 bg-white/10 rounded-full"></div>

            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586"/>
                        </svg>
                    </div>

                    <span class="text-xs font-bold uppercase tracking-widest text-cyan-100">
                        Penelitian
                    </span>
                </div>

                <div class="mt-8">
                    <h2 class="text-4xl font-black text-white">
                        {{ $total_penelitian }}
                    </h2>

                    <p class="text-cyan-100 mt-1 text-sm">
                        Total pengajuan penelitian
                    </p>
                </div>
            </div>
        </a>

        {{-- DISETUJUI --}}
        <a href="{{ route('admin.verifikasi.disetujui.index') }}"
           class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-500 to-green-400 p-6 shadow-xl hover:scale-[1.02] transition duration-300">

            <div class="absolute top-0 right-0 w-28 h-28 bg-white/10 rounded-full translate-x-10 -translate-y-10"></div>

            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <span class="text-xs font-bold uppercase tracking-widest text-green-100">
                        Approved
                    </span>
                </div>

                <div class="mt-8">
                    <h2 class="text-4xl font-black text-white">
                        {{ $total_disetujui }}
                    </h2>

                    <p class="text-green-100 mt-1 text-sm">
                        Surat telah disetujui
                    </p>
                </div>
            </div>
        </a>

        {{-- DITOLAK --}}
        <a href="{{ route('admin.verifikasi.ditolak.index') }}"
           class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-rose-500 to-red-400 p-6 shadow-xl hover:scale-[1.02] transition duration-300">

            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -translate-x-10 translate-y-10"></div>

            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>

                    <span class="text-xs font-bold uppercase tracking-widest text-rose-100">
                        Rejected
                    </span>
                </div>

                <div class="mt-8">
                    <h2 class="text-4xl font-black text-white">
                        {{ $total_ditolak }}
                    </h2>

                    <p class="text-rose-100 mt-1 text-sm">
                        Pengajuan ditolak
                    </p>
                </div>
            </div>
        </a>

    </div>

    {{-- BOTTOM SECTION --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- ANALYTICS CARD --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-black text-gray-800">
                        Statistik
                    </h2>

                    <p class="text-sm text-gray-400 mt-1">
                        Ringkasan pengajuan
                    </p>
                </div>

                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    📊
                </div>
            </div>

            @php
                $totalSemua = $total_pkl + $total_penelitian;
                $persenPkl = $totalSemua > 0 ? ($total_pkl / $totalSemua) * 100 : 0;
                $persenPenelitian = $totalSemua > 0 ? ($total_penelitian / $totalSemua) * 100 : 0;
            @endphp

            <div class="space-y-5">

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-700">
                            PKL
                        </span>

                        <span class="text-sm font-bold text-blue-600">
                            {{ round($persenPkl) }}%
                        </span>
                    </div>

                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-blue-500 h-3 rounded-full"
                            style="width: {{ $persenPkl }}%">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-700">
                            Penelitian
                        </span>

                        <span class="text-sm font-bold text-cyan-600">
                            {{ round($persenPenelitian) }}%
                        </span>
                    </div>

                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-cyan-500 h-3 rounded-full"
                            style="width: {{ $persenPenelitian }}%">
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8 grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-2xl p-4 text-center">
                    <p class="text-xs uppercase text-gray-400 font-bold">
                        Total
                    </p>

                    <h3 class="text-2xl font-black text-gray-800 mt-1">
                        {{ $totalSemua }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-2xl p-4 text-center">
                    <p class="text-xs uppercase text-gray-400 font-bold">
                        Aktivitas
                    </p>

                    <h3 class="text-2xl font-black text-emerald-500 mt-1">
                        Live
                    </h3>
                </div>
            </div>

        </div>

        {{-- PENGAJUAN TERBARU --}}
        <div class="xl:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="text-xl sm:text-2xl font-black text-gray-800">
                        Pengajuan Terbaru
                    </h2>

                    <p class="text-sm text-gray-400 mt-1">
                        Data terbaru mahasiswa
                    </p>
                </div>

                <div class="hidden sm:flex items-center gap-2 bg-green-50 text-green-600 px-3 py-1 rounded-full text-xs font-bold">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    Realtime
                </div>
            </div>

            {{-- MOBILE --}}
            <div class="block sm:hidden divide-y divide-gray-100">
                @forelse($pengajuan_terbaru as $item)

                    @php
                        $jenis = $item instanceof App\Models\PengajuanPkl ? 'PKL' : 'Penelitian';

                        $statusClass = match($item->status) {
                            'disetujui' => 'bg-green-100 text-green-700',
                            'ditolak'   => 'bg-red-100 text-red-700',
                            default     => 'bg-yellow-100 text-yellow-700',
                        };

                        $jenisClass = $jenis == 'PKL'
                            ? 'bg-blue-100 text-blue-700'
                            : 'bg-cyan-100 text-cyan-700';
                    @endphp

                    <div class="p-4">

                        <div class="flex items-start justify-between gap-3">

                            <div class="min-w-0">
                                <h3 class="font-bold text-gray-800 truncate">
                                    {{ $item->user->name ?? 'Mahasiswa Dihapus' }}
                                </h3>

                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $item->user->nim ?? '-' }}
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $item->created_at->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            <div class="flex flex-col items-end gap-2">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $jenisClass }}">
                                    {{ $jenis }}
                                </span>

                                <span class="px-2.5 py-1 rounded-full text-xs font-bold capitalize {{ $statusClass }}">
                                    {{ $item->status }}
                                </span>
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="p-8 text-center text-gray-400 italic text-sm">
                        Belum ada pengajuan terbaru.
                    </div>

                @endforelse
            </div>

            {{-- DESKTOP --}}
            <div class="hidden sm:block overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400">Mahasiswa</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400">Jenis</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($pengajuan_terbaru as $item)

                            @php
                                $jenis = $item instanceof App\Models\PengajuanPkl ? 'PKL' : 'Penelitian';

                                $statusClass = match($item->status) {
                                    'disetujui' => 'bg-green-100 text-green-700',
                                    'ditolak'   => 'bg-red-100 text-red-700',
                                    default     => 'bg-yellow-100 text-yellow-700',
                                };
                            @endphp

                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800">
                                        {{ $item->user->name ?? 'Mahasiswa Dihapus' }}
                                    </div>

                                    <div class="text-xs text-gray-400 mt-1">
                                        {{ $item->user->nim ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if($jenis == 'PKL')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                            PKL
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-cyan-100 text-cyan-700">
                                            Penelitian
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $item->created_at->translatedFormat('d F Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold capitalize {{ $statusClass }}">
                                        {{ $item->status }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                                    Belum ada pengajuan terbaru.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection