@extends('layouts.app')

@section('title', 'Data Total Ditolak')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <h1 class="text-3xl font-bold text-gray-700 mb-8">Total Ditolak</h1>

        <div class="bg-gray-200 rounded-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.verifikasi.ditolak.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                
                <div class="md:col-span-3">
                    <label class="block text-gray-700 font-bold mb-2">Jenis</label>
                    <div class="relative">
                        <select name="jenis" onchange="this.form.submit()" class="block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Semua</option>
                            <option value="PKL" {{ request('jenis') == 'PKL' ? 'selected' : '' }}>PKL</option>
                            <option value="Penelitian" {{ request('jenis') == 'Penelitian' ? 'selected' : '' }}>Penelitian</option>
                        </select>
                    </div>
                </div>

                <div class="md:col-span-4 md:col-start-9">
                    <label class="block text-gray-700 font-bold mb-2">Cari Mahasiswa</label>
                    <div class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Mahasiswa..." class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-r-lg hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
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
                    @forelse($data_ditolak as $index => $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-4 px-6">{{ $index + 1 + ($data_ditolak->currentPage() - 1) * $data_ditolak->perPage() }}</td>
                        <td class="py-4 px-6 font-medium">
                            {{ $item->user->name }}
                            <div class="text-xs text-gray-500">{{ $item->user->nim }}</div>
                        </td>
                        <td class="py-4 px-6">
                            @if($item->jenis_surat == 'PKL')
                                <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded text-xs font-bold">PKL</span>
                            @else
                                <span class="bg-sky-100 text-sky-800 py-1 px-3 rounded text-xs font-bold">Penelitian</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->translatedFormat('d F Y') }}</td>
                        <td class="py-4 px-6">
                            <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold">Ditolak</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($item->jenis_surat == 'PKL')
                                <a href="{{ route('admin.verifikasi.pkl.show', $item->id) }}" class="text-blue-600 hover:text-blue-900 font-bold text-sm bg-blue-50 px-3 py-1 rounded hover:bg-blue-100 transition">Lihat Detail</a>
                            @else
                                <a href="{{ route('admin.verifikasi.penelitian.show', $item->id) }}" class="text-blue-600 hover:text-blue-900 font-bold text-sm bg-blue-50 px-3 py-1 rounded hover:bg-blue-100 transition">Lihat Detail</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500 italic">Belum ada data yang ditolak.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="px-6 py-4 bg-gray-50">
                {{ $data_ditolak->links() }}
            </div>
        </div>

    </div>
</div>
@endsection