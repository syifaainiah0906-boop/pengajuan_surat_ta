@extends('layouts.app')

@section('title', 'Arsip Surat')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">

    <div class="w-full px-4 sm:px-6 lg:px-8">

        {{-- TITLE --}}
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-6 sm:mb-8">
            Arsip Surat
        </h1>

        {{-- FILTER --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6">

            <form method="GET"
                  action="{{ route('admin.arsip.index') }}"
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

            @forelse ($arsip as $item)

                @php
                    $badgeJenis = $item->jenis_surat == 'PKL'
                        ? 'bg-blue-100 text-blue-700'
                        : 'bg-green-100 text-green-700';

                    $badgeStatus = match($item->status) {
                        'disetujui' => 'bg-green-100 text-green-700',
                        'ditolak' => 'bg-red-100 text-red-700',
                        default => 'bg-yellow-100 text-yellow-700'
                    };
                @endphp

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">

                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0">

                            <p class="text-sm font-bold text-gray-800">
                                {{ $item->user->name ?? '-' }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $item->nomor_surat ?? '-' }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                                ·
                                {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WITA
                            </p>

                        </div>

                        <div class="flex flex-col items-end gap-2">

                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $badgeJenis }}">
                                {{ $item->jenis_surat }}
                            </span>

                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $badgeStatus }}">
                                {{ ucfirst($item->status) }}
                            </span>

                        </div>

                    </div>

                    <div class="mt-4">

                        @if($item->status == 'ditolak')

                            <span class="w-full inline-flex justify-center bg-gray-100 text-gray-400 px-3 py-2 rounded-xl text-sm font-semibold cursor-not-allowed">
                                Detail
                            </span>

                        @else

                            <a href="{{ $item->route_detail ?? '#' }}"
                               class="w-full inline-flex justify-center bg-blue-50 text-blue-600 px-3 py-2 rounded-xl hover:bg-blue-100 text-sm font-semibold transition">
                                Detail
                            </a>

                        @endif

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-10 text-center text-gray-400 text-sm italic">
                    Tidak ada arsip ditemukan
                </div>

            @endforelse

            {{-- PAGINATION MOBILE --}}
            <div class="pt-2">
                {{ $arsip->links() }}
            </div>

        </div>

        {{-- DESKTOP TABLE --}}
        <div class="hidden sm:block bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

            <div class="overflow-x-auto">

                <table class="w-full text-left border-collapse">

                    <thead class="bg-gray-800">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-white uppercase">No</th>
                            <th class="px-6 py-4 text-xs font-semibold text-white uppercase">Nomor Surat</th>
                            <th class="px-6 py-4 text-xs font-semibold text-white uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-semibold text-white uppercase">Nama Pengaju</th>
                            <th class="px-6 py-4 text-xs font-semibold text-white uppercase">Jenis</th>
                            <th class="px-6 py-4 text-xs font-semibold text-white uppercase">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-white uppercase text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($arsip as $index => $item)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4">
                                {{ $arsip->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->nomor_surat ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                                </div>

                                <div class="text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WITA
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->user->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">

                                @if($item->jenis_surat == 'PKL')

                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        PKL
                                    </span>

                                @else

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Penelitian
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                @if($item->status == 'pending')

                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>

                                @elseif($item->status == 'disetujui')

                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>

                                @else

                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($item->status == 'ditolak')

                                    <span class="bg-gray-100 text-gray-400 px-3 py-1.5 rounded text-sm font-semibold cursor-not-allowed">
                                        Detail
                                    </span>

                                @else

                                    <a href="{{ $item->route_detail ?? '#' }}"
                                       class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded hover:bg-blue-100 text-sm font-semibold transition">
                                        Detail
                                    </a>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7"
                                class="px-6 py-10 text-center text-gray-500 italic">
                                Tidak ada arsip ditemukan
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $arsip->links() }}
            </div>

        </div>

    </div>
</div>
@endsection