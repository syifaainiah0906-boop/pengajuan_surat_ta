@extends('layouts.app')

@section('title', 'Data Total Ditolak')

@section('content')

<div class="w-full px-4 sm:px-6 lg:px-10 py-6 sm:py-8">

    {{-- TITLE --}}
    <div class="mb-5 sm:mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Jumlah Pengajuan Ditolak
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Data pengajuan surat yang telah ditolak
        </p>
    </div>

    {{-- FILTER JENIS --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-3">

        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
            Filter Jenis Surat
        </p>

        <div class="flex flex-wrap gap-2">

            <a href="?jenis=&search={{ request('search') }}"
               class="px-3 py-1.5 rounded-full text-xs font-semibold border
               {{ !request('jenis') ? 'bg-blue-700 text-white border-blue-700' : 'bg-gray-100 text-gray-500 border-gray-200' }}">
                Semua
            </a>

            <a href="?jenis=PKL&search={{ request('search') }}"
               class="px-3 py-1.5 rounded-full text-xs font-semibold border
               {{ request('jenis') == 'PKL' ? 'bg-blue-100 text-blue-800 border-blue-300' : 'bg-gray-100 text-gray-500 border-gray-200' }}">
                PKL
            </a>

            <a href="?jenis=Penelitian&search={{ request('search') }}"
               class="px-3 py-1.5 rounded-full text-xs font-semibold border
               {{ request('jenis') == 'Penelitian' ? 'bg-sky-100 text-sky-800 border-sky-300' : 'bg-gray-100 text-gray-500 border-gray-200' }}">
                Penelitian
            </a>

        </div>
    </div>

    {{-- SEARCH --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-4">

        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
            Cari Mahasiswa
        </p>

        <form method="GET"
              action="{{ route('admin.verifikasi.ditolak.index') }}"
              class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2">

            <svg class="h-4 w-4 text-gray-400 flex-shrink-0"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari nama mahasiswa..."
                   class="bg-transparent text-sm w-full focus:outline-none text-gray-700 placeholder-gray-400">

            <input type="hidden"
                   name="jenis"
                   value="{{ request('jenis') }}">
        </form>
    </div>

    {{-- MOBILE CARD --}}
    <div class="block sm:hidden bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100 bg-gray-50">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                Data Ditolak
            </span>

            <span class="text-xs text-gray-400">
                {{ $data_ditolak->total() }} data
            </span>
        </div>

        @forelse($data_ditolak as $item)

        <div class="flex items-start justify-between gap-3 px-4 py-3 border-b border-gray-50 last:border-none">

            <div class="min-w-0">

                <p class="text-sm font-semibold text-gray-800">
                    {{ $item->user->name }}
                </p>

                <p class="text-xs text-gray-400 mt-0.5">
                    NIM: {{ $item->user->nim }}
                </p>

                <p class="text-xs text-gray-400 mt-1">
                    {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)
                        ->timezone('Asia/Makassar')
                        ->translatedFormat('d M Y · H:i') }}
                </p>

                <div class="flex items-center gap-2 mt-2">

                    @if($item->jenis_surat == 'PKL')

                        <span class="bg-blue-100 text-blue-800 px-2.5 py-1 rounded-full text-[11px] font-bold">
                            PKL
                        </span>

                    @else

                        <span class="bg-sky-100 text-sky-800 px-2.5 py-1 rounded-full text-[11px] font-bold">
                            Penelitian
                        </span>

                    @endif

                    <span class="bg-red-100 text-red-800 px-2.5 py-1 rounded-full text-[11px] font-bold">
                        Ditolak
                    </span>

                </div>

            </div>

            <div class="flex-shrink-0">

                @if($item->jenis_surat == 'PKL')

                    <a href="{{ route('admin.verifikasi.pkl.show', $item->id) }}"
                       class="text-xs font-semibold text-blue-600">
                        Detail →
                    </a>

                @else

                    <a href="{{ route('admin.verifikasi.penelitian.show', $item->id) }}"
                       class="text-xs font-semibold text-blue-600">
                        Detail →
                    </a>

                @endif

            </div>

        </div>

        @empty

        <div class="py-8 text-center text-gray-500 italic text-sm">
            Belum ada data yang ditolak.
        </div>

        @endforelse

    </div>

    {{-- DESKTOP TABLE --}}
    <div class="hidden sm:block bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mt-4">

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead class="bg-gray-600 text-white">

                    <tr>
                        <th class="py-4 px-6 font-semibold text-sm uppercase">No</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase">Nama Mahasiswa</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase">Jenis</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase">Tanggal Pengajuan</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase">Status</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody class="text-gray-700">

                @forelse($data_ditolak as $item)

                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">

                    <td class="py-4 px-6">
                        {{ $data_ditolak->firstItem() + $loop->index }}
                    </td>

                    <td class="py-4 px-6 font-medium">

                        {{ $item->user->name }}

                        <div class="text-xs text-gray-500">
                            {{ $item->user->nim }}
                        </div>

                    </td>

                    <td class="py-4 px-6">

                        @if($item->jenis_surat == 'PKL')

                            <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded text-xs font-bold">
                                PKL
                            </span>

                        @else

                            <span class="bg-sky-100 text-sky-800 py-1 px-3 rounded text-xs font-bold">
                                Penelitian
                            </span>

                        @endif

                    </td>

                    <td class="py-4 px-6">

                        {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)
                            ->timezone('Asia/Makassar')
                            ->translatedFormat('d F Y, H:i') }}

                    </td>

                    <td class="py-4 px-6">

                        <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold">
                            Ditolak
                        </span>

                    </td>

                    <td class="py-4 px-6 text-center">

                        @if($item->jenis_surat == 'PKL')

                            <a href="{{ route('admin.verifikasi.pkl.show', $item->id) }}"
                               class="text-blue-600 hover:text-blue-900 font-bold text-sm bg-blue-50 px-3 py-1 rounded hover:bg-blue-100 transition">

                                Detail
                            </a>

                        @else

                            <a href="{{ route('admin.verifikasi.penelitian.show', $item->id) }}"
                               class="text-blue-600 hover:text-blue-900 font-bold text-sm bg-blue-50 px-3 py-1 rounded hover:bg-blue-100 transition">

                                Detail
                            </a>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6"
                        class="py-8 text-center text-gray-500 italic">
                        Belum ada data yang ditolak.
                    </td>
                </tr>

                @endforelse

                </tbody>

            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="px-4 sm:px-6 py-4 bg-gray-50 border border-gray-100 rounded-b-2xl">
        {{ $data_ditolak->links() }}
    </div>

</div>

@endsection