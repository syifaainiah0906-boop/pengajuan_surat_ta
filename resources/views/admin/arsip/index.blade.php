@extends('layouts.app')

@section('title', 'Arsip Surat')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="w-full px-4 sm:px-6 lg:px-8">

     <h1 class="text-3xl font-bold text-gray-700 mb-8">Arsip Surat</h1>

       <!-- Header -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <form method="GET" action="{{ route('admin.arsip.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                
                <div class="md:col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Surat</label>
                    <select name="jenis" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-300 text-gray-700 rounded-lg px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Jenis</option>
                        <option value="PKL" {{ request('jenis') == 'PKL' ? 'selected' : '' }}>PKL</option>
                        <option value="Penelitian" {{ request('jenis') == 'Penelitian' ? 'selected' : '' }}>Penelitian</option>
                    </select>
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-300 text-gray-700 rounded-lg px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="md:col-span-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Mahasiswa</label>
                    <div class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan nama mahasiswa..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-l-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </form>
        </div>

        <!-- Daftar Arsip -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-white uppercase">No</th>
                            <th class="px-6 py-3 text-xs font-medium text-white uppercase">Nomor Surat</th>
                            <th class="px-6 py-3 text-xs font-medium text-white uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-xs font-medium text-white uppercase">Nama Pengaju</th>
                            <th class="px-6 py-3 text-xs font-medium text-white uppercase">Jenis Surat</th>
                            <th class="px-6 py-3 text-xs font-medium text-white uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium text-white uppercase text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($arsip as $index => $item)
                        <tr class="hover:bg-gray-50">

                            <!-- NO -->
                            <td class="px-6 py-4">
                                {{ $arsip->firstItem() + $index }}
                            </td>

                            <!-- NOMOR SURAT -->
                            <td class="px-6 py-4">
                                {{ $item->nomor_surat ?? '-' }}
                            </td>

                            <!-- TANGGAL -->
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                                </div>

                                <div class="text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WITA
                                </div>
                            </td>

                            <!-- NAMA -->
                            <td class="px-6 py-4">
                                {{ $item->user->name ?? '-' }}
                            </td>

                            <!-- JENIS -->
                            <td class="px-6 py-4">
                                @if($item->jenis_surat == 'PKL')
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        PKL
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        Penelitian
                                    </span>
                                @endif
                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-4">
                                @if($item->status == 'pending')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($item->status == 'disetujui')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @elseif($item->status == 'ditolak')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            <!-- AKSI -->
                            <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">

                                @if($item->status == 'ditolak')
                                    <span class="bg-gray-100 text-gray-400 px-3 py-1.5 rounded text-sm font-semibold cursor-not-allowed">
                                        Detail
                                    </span>
                                @else
                                    <a href="{{ $item->route_detail ?? '#' }}"
                                        class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded hover:bg-blue-100 text-sm font-semibold">
                                        Detail
                                    </a>
                                @endif

                            </div>
                        </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-gray-500">
                                Tidak ada arsip ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 px-6 pb-6">
                {{ $arsip->links() }}
            </div>

        </div>
    </div>
</div>
@endsection