@extends('layouts.app')

@section('title', 'Verifikasi Pengajuan Penelitian')

@section('content')
<div class="w-full min-h-screen bg-gradient-to-br from-gray-100 via-gray-50 to-gray-200 py-8">
    <div class="w-full px-4 sm:px-6 lg:px-10">

        <!-- Title -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Pengajuan Surat Penelitian</h1>
            <p class="text-gray-500 text-sm">Kelola dan verifikasi pengajuan mahasiswa</p>
        </div>

        <!-- Filter -->
        <div class="bg-white/80 backdrop-blur-md shadow-md rounded-2xl p-6 mb-6 border border-gray-200 w-full">
            <form method="GET" action="{{ route('admin.verifikasi.penelitian.index') }}" 
                  class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">

                <!-- Status -->
                <div class="w-full md:w-1/4">
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Status</label>
                    <select name="status" onchange="this.form.submit()" 
                        class="w-full bg-gray-50 border border-gray-300 py-2.5 px-4 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Search -->
                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Cari Mahasiswa</label>
                    <div class="flex bg-gray-50 border border-gray-300 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-blue-500">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Cari nama mahasiswa..." 
                            class="w-full px-4 py-2.5 bg-transparent focus:outline-none text-sm">
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
                        <th class="py-4 px-6 font-semibold text-sm uppercase">NIM</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase">Tanggal Pengajuan</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase">Status</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">
                    @forelse($data_penelitian as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">

                        <td class="py-4 px-6">
                            {{ $data_penelitian->firstItem() + $loop->index }}
                        </td>

                        <td class="py-4 px-6 font-medium">
                            {{ $item->user->name }}
                        </td>

                        <td class="py-4 px-6 text-gray-500">
                            {{ $item->user->nim }}
                        </td>

                        <td class="py-4 px-6">
                            {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)
                                ->timezone('Asia/Makassar')
                                ->translatedFormat('d F Y H:i') }}
                        </td>

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

                            <!-- ✅ DETAIL KE SHOW -->
                            <a href="{{ route('admin.verifikasi.penelitian.show', $item->id) }}"
                               class="text-blue-600 hover:text-blue-900 font-bold text-sm">
                                Detail
                            </a>

                            @if($item->status == 'pending')
                                <span class="text-gray-300">|</span>

                                <form action="{{ route('admin.verifikasi.penelitian.update', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Setujui pengajuan ini?')">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit"
                                            class="text-green-600 hover:text-green-900 font-bold text-sm"
                                            title="Setujui">&#10003;</button>
                                </form>

                                <form action="{{ route('admin.verifikasi.penelitian.update', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Tolak pengajuan ini?')">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900 font-bold text-sm"
                                            title="Tolak">&#10005;</button>
                                </form>
                            @endif

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500 italic">
                            Data tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-6 py-4 bg-gray-50">
                {{ $data_penelitian->links() }}
            </div>

        </div>
    </div>
</div>
@endsection