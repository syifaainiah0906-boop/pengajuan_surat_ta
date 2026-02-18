@extends('layouts.app')

@section('title', 'Verifikasi Pengajuan PKL')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <h1 class="text-3xl font-bold text-gray-700 mb-8">Pengajuan Surat PKL</h1>

        <div class="bg-gray-200 rounded-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.verifikasi.pkl.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                
                <div class="md:col-span-3">
                    <label class="block text-gray-700 font-bold mb-2">Status</label>
                    <div class="relative">
                        <select name="status" onchange="this.form.submit()" class="block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
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
                    @forelse($data_pkl as $index => $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-4 px-6">{{ $index + 1 + ($data_pkl->currentPage() - 1) * $data_pkl->perPage() }}</td>
                        <td class="py-4 px-6 font-medium">
                            {{ $item->user->name }}
                            <div class="text-xs text-gray-500">{{ $item->user->nim }}</div>
                        </td>
                        <td class="py-4 px-6">PKL</td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->translatedFormat('d F Y') }}</td>
                        <td class="py-4 px-6">
                            @if($item->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-xs font-bold">Menunggu</span>
                            @elseif($item->status == 'disetujui')
                                <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold">Disetujui</span>
                            @else
                                <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold">Ditolak</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center space-x-2 flex justify-center items-center">
                            <a href="{{ route('admin.verifikasi.pkl.show', $item->id) }}" class="text-blue-600 hover:text-blue-900 font-bold text-sm">Detail</a>

                            @if($item->status == 'pending')
                                <span class="text-gray-300">|</span>
                                
                                <form action="{{ route('admin.verifikasi.pkl.update', $item->id) }}" method="POST" onsubmit="return confirm('Setujui pengajuan ini?')">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit" class="text-green-600 hover:text-green-900 font-bold text-sm" title="Setujui">
                                        &#10003;
                                    </button>
                                </form>

                                <form action="{{ route('admin.verifikasi.pkl.update', $item->id) }}" method="POST" onsubmit="return confirm('Tolak pengajuan ini?')">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm" title="Tolak">
                                        &#10005;
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500 italic">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="px-6 py-4 bg-gray-50">
                {{ $data_pkl->links() }}
            </div>
        </div>

    </div>
</div>
@endsection