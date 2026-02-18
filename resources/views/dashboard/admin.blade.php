@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <a href="{{ route('admin.verifikasi.pkl.index') }}" class="block transform transition hover:scale-105 duration-300">
                <div class="bg-blue-600 rounded-2xl p-6 shadow-lg shadow-blue-200">
                    <p class="text-blue-100 text-sm font-semibold uppercase">Pengajuan PKL</p>
                    <h3 class="text-4xl font-bold text-white mt-2">{{ $total_pkl }}</h3>
                </div>
            </a>
            <a href="{{ route('admin.verifikasi.penelitian.index') }}" class="block transform transition hover:scale-105 duration-300">
                <div class="bg-sky-500 rounded-2xl p-6 shadow-lg shadow-sky-100">
                    <p class="text-sky-100 text-sm font-semibold uppercase">Penelitian</p>
                    <h3 class="text-4xl font-bold text-white mt-2">{{ $total_penelitian }}</h3>
                </div>
            </a>
            <a href="{{ route('admin.verifikasi.disetujui.index') }}" class="block transform transition hover:scale-105 duration-300">
                <div class="bg-yellow-400 rounded-2xl p-6 shadow-lg shadow-yellow-100">
                    <p class="text-yellow-900 text-sm font-semibold uppercase">Total Disetujui</p>
                    <h3 class="text-4xl font-bold text-yellow-900 mt-2">{{ $total_disetujui }}</h3>
                </div>
            </a>
            <a href="{{ route('admin.verifikasi.ditolak.index') }}" class="block transform transition hover:scale-105 duration-300">
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <p class="text-gray-400 text-sm font-semibold uppercase">Total Ditolak</p>
                    <h3 class="text-4xl font-bold text-red-500 mt-2">{{ $total_ditolak }}</h3>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            @php
                $total_semua = $total_pkl + $total_penelitian;
                $persen_pkl = $total_semua > 0 ? round(($total_pkl / $total_semua) * 100) : 0;
                $persen_penelitian = $total_semua > 0 ? round(($total_penelitian / $total_semua) * 100) : 0;
                
                $stroke_penelitian = $persen_penelitian . " 100";
                $offset_pkl = -($persen_penelitian); 
                $stroke_pkl = $persen_pkl . " 100";
            @endphp

            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col items-center justify-center">
                <h2 class="text-lg font-bold text-gray-800 mb-6">Proporsi Pengajuan</h2>
                <div class="relative w-48 h-48">
                    <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90">
                        <circle cx="18" cy="18" r="16" fill="none" class="text-gray-100" stroke="currentColor" stroke-width="4"></circle>
                        <circle cx="18" cy="18" r="16" fill="none" class="text-sky-500" stroke="currentColor" stroke-width="4" 
                                stroke-dasharray="{{ $stroke_penelitian }}"></circle>
                        <circle cx="18" cy="18" r="16" fill="none" class="text-yellow-400" stroke="currentColor" stroke-width="4" 
                                stroke-dasharray="{{ $stroke_pkl }}" stroke-dashoffset="-{{ $persen_penelitian }}"></circle>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                         <span class="text-3xl font-bold text-gray-800">{{ $total_semua }}</span>
                         <span class="text-xs text-gray-500 uppercase">Total</span>
                    </div>
                </div>

                <div class="mt-6 space-y-2 w-full px-4">
                    <div class="flex justify-between items-center text-sm">
                        <span class="flex items-center"><span class="w-3 h-3 bg-sky-500 rounded-full mr-2"></span> Penelitian</span>
                        <span class="font-bold text-gray-700">{{ $persen_penelitian }}% ({{ $total_penelitian }})</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="flex items-center"><span class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></span> PKL</span>
                        <span class="font-bold text-gray-700">{{ $persen_pkl }}% ({{ $total_pkl }})</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-800">Pengajuan Terbaru</h2>
                    <button class="text-blue-600 text-sm font-semibold hover:underline">Lihat Semua</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-semibold">
                            <tr>
                                <th class="px-6 py-4">Mahasiswa</th>
                                <th class="px-6 py-4">Jenis</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($pengajuan_terbaru as $item)
                                @php
                                    $jenis = $item instanceof App\Models\PengajuanPkl ? 'PKL' : 'Penelitian';
                                    
                                    $statusClass = match($item->status) {
                                        'disetujui' => 'bg-green-100 text-green-700',
                                        'ditolak'   => 'bg-red-100 text-red-700',
                                        default     => 'bg-yellow-100 text-yellow-700', // Pending
                                    };
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $item->user->name ?? 'Mahasiswa Dihapus' }}
                                        <div class="text-xs text-gray-400 font-normal">{{ $item->user->nim ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">
                                        @if($jenis == 'PKL')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">PKL</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-sky-100 text-sky-800">Penelitian</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 text-sm">
                                        {{ $item->created_at->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold capitalize {{ $statusClass }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="text-blue-600 hover:text-blue-800 font-medium text-sm">Detail</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">
                                        Belum ada pengajuan masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

@endsection