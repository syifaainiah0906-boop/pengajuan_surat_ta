@extends('layouts.app')

@section('title', 'Verifikasi Pengajuan Penelitian')

@section('content')

<div class="w-full px-4 sm:px-6 lg:px-10 py-6 sm:py-8">

    {{-- HEADER --}}
    <div class="mb-5 sm:mb-6">
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800">Pengajuan Surat Penelitian</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola dan verifikasi pengajuan mahasiswa</p>
    </div>

    {{-- Filter Card: Status sebagai Chip --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-3">
    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Filter Status</p>
    <div class="flex flex-wrap gap-2">
        <a href="?status=" class="px-3 py-1.5 rounded-full text-xs font-semibold border
            {{ !request('status') ? 'bg-blue-700 text-white border-blue-700' : 'bg-gray-100 text-gray-500 border-gray-200' }}">
            Semua
        </a>
        <a href="?status=pending" class="px-3 py-1.5 rounded-full text-xs font-semibold border
            {{ request('status') == 'pending' ? 'bg-yellow-100 text-yellow-800 border-yellow-300' : 'bg-gray-100 text-gray-500 border-gray-200' }}">
            ⏳ Menunggu
        </a>
        <a href="?status=disetujui" class="px-3 py-1.5 rounded-full text-xs font-semibold border
            {{ request('status') == 'disetujui' ? 'bg-green-100 text-green-800 border-green-300' : 'bg-gray-100 text-gray-500 border-gray-200' }}">
            ✓ Disetujui
        </a>
        <a href="?status=ditolak" class="px-3 py-1.5 rounded-full text-xs font-semibold border
            {{ request('status') == 'ditolak' ? 'bg-red-100 text-red-800 border-red-300' : 'bg-gray-100 text-gray-500 border-gray-200' }}">
            ✕ Ditolak
        </a>
    </div>
</div>

{{-- Filter Card: Search --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-3">
    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Cari Mahasiswa</p>
    <form method="GET" action="{{ route('admin.verifikasi.penelitian.index') }}" class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2">
        <svg class="h-4 w-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
        </svg>
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari nama atau NIM..."
            class="bg-transparent text-sm w-full focus:outline-none text-gray-700 placeholder-gray-400">
        <input type="hidden" name="status" value="{{ request('status') }}">
    </form>
</div>

{{-- Data List --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100 bg-gray-50">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Daftar Pengajuan</span>
        <span class="text-xs text-gray-400">{{ $data_penelitian->total() }} data</span>
    </div>
    @forelse($data_penelitian as $item)
        @php
            $initials = collect(explode(' ', $item->user->name))->take(2)->map(fn($w) => strtoupper($w[0]))->join('');
            $avatarClass = match($item->status) {
                'disetujui' => 'bg-green-100 text-green-700',
                'ditolak'   => 'bg-red-100 text-red-700',
                default     => 'bg-amber-100 text-amber-700',
            };
            $badgeClass = match($item->status) {
                'disetujui' => 'bg-green-100 text-green-800',
                'ditolak'   => 'bg-red-100 text-red-800',
                default     => 'bg-yellow-100 text-yellow-800',
            };
            $badgeLabel = match($item->status) {
                'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak', default => 'Menunggu'
            };
        @endphp
        <div class="flex items-start justify-between gap-3 px-4 py-3 border-b border-gray-50 last:border-none">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0 mt-0.5 {{ $avatarClass }}">
                    {{ $initials }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ $item->user->name }}</p>
                    <p class="text-xs text-gray-400">NIM: {{ $item->user->nim }}</p>
                    <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->timezone('Asia/Makassar')->translatedFormat('d M Y · H:i') }}</p>
                </div>
            </div>
            <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $badgeClass }}">{{ $badgeLabel }}</span>
                <a href="{{ route('admin.verifikasi.penelitian.show', $item->id) }}" class="text-xs font-semibold text-blue-600">Detail →</a>
                @if($item->status == 'pending')
                    <div class="flex gap-1">
                        <form action="{{ route('admin.verifikasi.penelitian.update', $item->id) }}" method="POST" onsubmit="return confirm('Setujui?')">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="disetujui">
                            <button class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold">✓ Setuju</button>
                        </form>
                        <form action="{{ route('admin.verifikasi.penelitian.update', $item->id) }}" method="POST" onsubmit="return confirm('Tolak?')">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="ditolak">
                            <button class="px-2 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-bold">✕ Tolak</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @empty
    @endforelse

        {{-- Desktop: table --}}
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-600 text-white">
                    <tr>
                        <th class="py-4 px-6 font-semibold text-xs uppercase">No</th>
                        <th class="py-4 px-6 font-semibold text-xs uppercase">Nama Mahasiswa</th>
                        <th class="py-4 px-6 font-semibold text-xs uppercase">NIM</th>
                        <th class="py-4 px-6 font-semibold text-xs uppercase">Tanggal Pengajuan</th>
                        <th class="py-4 px-6 font-semibold text-xs uppercase">Status</th>
                        <th class="py-4 px-6 font-semibold text-xs uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($data_penelitian as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-4 px-6 text-sm">{{ $data_penelitian->firstItem() + $loop->index }}</td>
                        <td class="py-4 px-6 font-medium text-sm">{{ $item->user->name }}</td>
                        <td class="py-4 px-6 text-gray-500 text-sm">{{ $item->user->nim }}</td>
                        <td class="py-4 px-6 text-sm">
                            {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->timezone('Asia/Makassar')->translatedFormat('d F Y H:i') }}
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
                        <td class="py-4 px-6 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.verifikasi.penelitian.show', $item->id) }}"
                                   class="text-blue-600 hover:text-blue-900 font-bold text-sm">Detail</a>

                                @if($item->status == 'pending')
                                    <span class="text-gray-300">|</span>
                                    <form action="{{ route('admin.verifikasi.penelitian.update', $item->id) }}" method="POST"
                                          onsubmit="return confirm('Setujui pengajuan ini?')">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit" class="text-green-600 hover:text-green-900 font-bold text-sm" title="Setujui">&#10003;</button>
                                    </form>
                                    <form action="{{ route('admin.verifikasi.penelitian.update', $item->id) }}" method="POST"
                                          onsubmit="return confirm('Tolak pengajuan ini?')">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm" title="Tolak">&#10005;</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500 italic">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="px-4 sm:px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $data_penelitian->links() }}
        </div>

    </div>
</div>

@endsection