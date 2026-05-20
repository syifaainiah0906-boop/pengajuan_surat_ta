@extends('layouts.app')

@section('title', 'Verifikasi Pengajuan Surat')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">

    <div class="w-full px-4 sm:px-6 lg:px-8">

        {{-- TITLE --}}
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-6 sm:mb-8">
            Verifikasi Pengajuan Surat
        </h1>

        {{-- FILTER --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6">

            <form method="GET"
                  action="{{ route('admin.verifikasi.index') }}"
                  class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                {{-- FILTER JENIS + STATUS --}}
                <div class="md:col-span-4">
                    <div class="grid grid-cols-2 gap-3">

                        {{-- JENIS --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis
                            </label>

                            <select name="jenis"
                                    onchange="this.form.submit()"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-700 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                                <option value="">Semua</option>

                                <option value="PKL"
                                    {{ request('jenis') == 'PKL' ? 'selected' : '' }}>
                                    PKL
                                </option>

                                <option value="Penelitian"
                                    {{ request('jenis') == 'Penelitian' ? 'selected' : '' }}>
                                    Penelitian
                                </option>

                            </select>
                        </div>

                        {{-- STATUS --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Status
                            </label>

                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-700 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                                <option value="">Semua</option>

                                <option value="pending"
                                    {{ request('status') == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="disetujui"
                                    {{ request('status') == 'disetujui' ? 'selected' : '' }}>
                                    Disetujui
                                </option>

                                <option value="ditolak"
                                    {{ request('status') == 'ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>

                            </select>
                        </div>

                    </div>
                </div>

                {{-- SEARCH --}}
                <div class="md:col-span-8">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Cari Mahasiswa
                    </label>

                    <div class="flex items-center bg-gray-50 border border-gray-300 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-blue-500">

                        <div class="px-3 text-gray-400">
                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                            </svg>
                        </div>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari nama mahasiswa..."
                               class="w-full px-2 py-2.5 bg-transparent focus:outline-none text-sm text-gray-700 placeholder-gray-400">

                        <button type="submit"
                                class="px-4 text-sm font-semibold text-blue-600 hover:text-blue-800">
                            Cari
                        </button>

                    </div>

                </div>

            </form>

        </div>

        {{-- MOBILE CARD --}}
        <div class="block sm:hidden space-y-3">

            @forelse($data_gabungan as $item)

                @php
                    $badgeJenis = $item->jenis_surat == 'PKL'
                        ? 'bg-blue-100 text-blue-700'
                        : 'bg-yellow-100 text-yellow-700';

                    $badgeStatus = match($item->status) {
                        'disetujui' => 'bg-green-100 text-green-700',
                        'ditolak' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700'
                    };
                @endphp

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">

                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0">

                            <p class="text-sm font-bold text-gray-800">
                                {{ $item->user->name }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $item->user->nim }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                                ·
                                {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WITA
                            </p>

                            <p class="text-xs text-gray-500 mt-2">
                                {{ $item->jenis_surat == 'PKL'
                                    ? $item->tempat_pkl
                                    : $item->tempat_penelitian }}
                            </p>

                        </div>

                        <div class="flex flex-col items-end gap-2 flex-shrink-0">

                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $badgeJenis }}">
                                {{ $item->jenis_surat }}
                            </span>

                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $badgeStatus }}">
                                {{ ucfirst($item->status) }}
                            </span>

                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="mt-4 flex items-center justify-between gap-2">

                        <a href="{{ $item->route_detail }}"
                           class="flex-1 text-center bg-blue-50 text-blue-600 px-3 py-2 rounded-xl hover:bg-blue-100 text-sm font-semibold transition">
                            Detail
                        </a>

                        @if($item->status == 'pending')

                            <form action="{{ $item->route_update }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('Setujui pengajuan {{ $item->jenis_surat }} dari {{ $item->user->name }}?')">

                                @csrf
                                @method('PATCH')

                                <input type="hidden"
                                       name="status"
                                       value="disetujui">

                                <button type="submit"
                                        class="w-full bg-green-100 text-green-700 px-3 py-2 rounded-xl hover:bg-green-200 text-sm font-semibold transition">
                                    ✓
                                </button>

                            </form>

                            <form action="{{ $item->route_update }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('Tolak pengajuan {{ $item->jenis_surat }} dari {{ $item->user->name }}?')">

                                @csrf
                                @method('PATCH')

                                <input type="hidden"
                                       name="status"
                                       value="ditolak">

                                <button type="submit"
                                        class="w-full bg-red-100 text-red-700 px-3 py-2 rounded-xl hover:bg-red-200 text-sm font-semibold transition">
                                    ✕
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-10 text-center text-gray-400 text-sm italic">
                    Belum ada data pengajuan.
                </div>

            @endforelse

            {{-- PAGINATION MOBILE --}}
            <div class="pt-2">
                {{ $data_gabungan->links() }}
            </div>

        </div>

        {{-- DESKTOP TABLE --}}
        <div class="hidden sm:block bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

            <div class="overflow-x-auto">

                <table class="w-full text-left border-collapse">

                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-4 px-6 text-sm font-semibold uppercase tracking-wider">No</th>
                            <th class="py-4 px-6 text-sm font-semibold uppercase tracking-wider">Mahasiswa</th>
                            <th class="py-4 px-6 text-sm font-semibold uppercase tracking-wider">Jenis Surat</th>
                            <th class="py-4 px-6 text-sm font-semibold uppercase tracking-wider">Tanggal</th>
                            <th class="py-4 px-6 text-sm font-semibold uppercase tracking-wider">Tujuan</th>
                            <th class="py-4 px-6 text-sm font-semibold uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-sm font-semibold uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($data_gabungan as $item)

                        <tr class="hover:bg-blue-50 transition duration-150">

                            {{-- NO --}}
                            <td class="py-4 px-6 text-sm text-gray-700">
                                {{ $data_gabungan->firstItem() + $loop->index }}
                            </td>

                            {{-- MAHASISWA --}}
                            <td class="py-4 px-6">
                                <div class="font-bold text-gray-800">
                                    {{ $item->user->name }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $item->user->nim }}
                                </div>
                            </td>

                            {{-- JENIS --}}
                            <td class="py-4 px-6">

                                @if($item->jenis_surat == 'PKL')

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                        PKL
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        Penelitian
                                    </span>

                                @endif

                            </td>

                            {{-- TANGGAL --}}
                            <td class="py-4 px-6 text-sm text-gray-600">

                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}

                                <div class="text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WITA
                                </div>

                            </td>

                            {{-- TUJUAN --}}
                            <td class="py-4 px-6 text-sm text-gray-800">

                                {{ $item->jenis_surat == 'PKL'
                                    ? $item->tempat_pkl
                                    : $item->tempat_penelitian }}

                            </td>

                            {{-- STATUS --}}
                            <td class="py-4 px-6">

                                @if($item->status == 'pending')

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1.5"></span>
                                        Pending
                                    </span>

                                @elseif($item->status == 'disetujui')

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                        Disetujui
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                            {{-- AKSI --}}
                            <td class="py-4 px-6">

                                <div class="flex items-center justify-center space-x-2">

                                    <a href="{{ $item->route_detail }}"
                                       class="text-blue-600 hover:text-blue-900 font-semibold text-sm bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded transition">
                                        Detail
                                    </a>

                                    @if($item->status == 'pending')

                                        <div class="h-4 w-px bg-gray-300 mx-1"></div>

                                        <form action="{{ $item->route_update }}"
                                              method="POST"
                                              onsubmit="return confirm('Setujui pengajuan {{ $item->jenis_surat }} dari {{ $item->user->name }}?')">

                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden"
                                                   name="status"
                                                   value="disetujui">

                                            <button type="submit"
                                                    class="p-1.5 bg-green-100 text-green-700 rounded hover:bg-green-200 transition"
                                                    title="Setujui Cepat">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M5 13l4 4L19 7" />

                                                </svg>

                                            </button>

                                        </form>

                                        <form action="{{ $item->route_update }}"
                                              method="POST"
                                              onsubmit="return confirm('Tolak pengajuan {{ $item->jenis_surat }} dari {{ $item->user->name }}?')">

                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden"
                                                   name="status"
                                                   value="ditolak">

                                            <button type="submit"
                                                    class="p-1.5 bg-red-100 text-red-700 rounded hover:bg-red-200 transition"
                                                    title="Tolak Cepat">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12" />

                                                </svg>

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7"
                                class="py-12 text-center">

                                <div class="flex flex-col items-center justify-center text-gray-500">

                                    <svg class="w-12 h-12 text-gray-300 mb-3"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>

                                    </svg>

                                    <span class="text-lg font-medium">
                                        Belum ada data pengajuan.
                                    </span>

                                    <p class="text-sm">
                                        Silakan ubah filter jika mencari data tertentu.
                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $data_gabungan->links() }}
            </div>

        </div>

    </div>
</div>
@endsection