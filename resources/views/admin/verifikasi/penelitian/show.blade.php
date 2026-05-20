@extends('layouts.app')

@section('title', 'Detail Verifikasi Penelitian')

@section('content')

<div class="w-full px-4 sm:px-6 lg:px-16 py-6 sm:py-10">

    {{-- BACK BUTTON --}}
    <a href="{{ route('admin.verifikasi.penelitian.index') }}"
       class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 mb-5 sm:mb-6 transition">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke Daftar
    </a>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="px-5 sm:px-8 py-4 sm:py-6 border-b border-gray-100 bg-gray-50">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                <div>
                    <h1 class="text-lg sm:text-2xl font-bold text-gray-800">Detail Pengajuan Penelitian</h1>
                    <p class="text-gray-500 text-xs sm:text-sm mt-1">
                        Diajukan pada {{ \Carbon\Carbon::parse($penelitian->tanggal_pengajuan)->translatedFormat('d F Y, H:i') }}
                    </p>
                </div>
                <div class="flex-shrink-0">
                    @if($penelitian->status == 'pending')
                        <span class="inline-block px-3 sm:px-4 py-1.5 sm:py-2 bg-yellow-100 text-yellow-800 rounded-lg text-xs sm:text-sm font-bold border border-yellow-200">
                            Menunggu Verifikasi
                        </span>
                    @elseif($penelitian->status == 'disetujui')
                        <span class="inline-block px-3 sm:px-4 py-1.5 sm:py-2 bg-green-100 text-green-800 rounded-lg text-xs sm:text-sm font-bold border border-green-200">
                            Disetujui
                        </span>
                    @else
                        <span class="inline-block px-3 sm:px-4 py-1.5 sm:py-2 bg-red-100 text-red-800 rounded-lg text-xs sm:text-sm font-bold border border-red-200">
                            Ditolak
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="p-5 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">

            {{-- INFORMASI MAHASISWA --}}
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 sm:mb-4">Informasi Mahasiswa</h3>
                <div class="space-y-3 sm:space-y-4">
                    <div>
                        <label class="text-xs sm:text-sm text-gray-500">Nama Lengkap</label>
                        <p class="font-medium text-gray-800 text-base sm:text-lg">{{ $penelitian->user->name }}</p>
                    </div>
                    <div>
                        <label class="text-xs sm:text-sm text-gray-500">NIM</label>
                        <p class="font-medium text-gray-800 text-sm sm:text-base">{{ $penelitian->user->nim }}</p>
                    </div>
                    <div>
                        <label class="text-xs sm:text-sm text-gray-500">Program Studi</label>
                        <p class="font-medium text-gray-800 text-sm sm:text-base">{{ $penelitian->user->prodi }}</p>
                    </div>
                    <div>
                        <label class="text-xs sm:text-sm text-gray-500">Nomor Handphone</label>
                        <p class="font-medium text-gray-800 text-sm sm:text-base">{{ $penelitian->nomor_handphone ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- DETAIL TEMPAT PENELITIAN --}}
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 sm:mb-4">Detail Tempat Penelitian</h3>
                <div class="space-y-3 sm:space-y-4">
                    <div>
                        <label class="text-xs sm:text-sm text-gray-500">Tempat Penelitian</label>
                        <p class="font-medium text-gray-800 text-sm sm:text-base">{{ $penelitian->tempat_penelitian }}</p>
                    </div>
                    <div>
                        <label class="text-xs sm:text-sm text-gray-500">Tujuan Surat</label>
                        <p class="font-medium text-gray-800 text-sm sm:text-base">{{ $penelitian->tujuan_surat }}</p>
                    </div>
                    <div>
                        <label class="text-xs sm:text-sm text-gray-500">Alamat Lengkap</label>
                        <p class="font-medium text-gray-800 text-sm sm:text-base leading-relaxed">{{ $penelitian->alamat_tempat_penelitian }}</p>
                    </div>
                </div>
            </div>

            {{-- JUDUL TA --}}
            <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-5 sm:pt-6">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 sm:mb-4">Detail Tugas Akhir</h3>
                <div>
                    <label class="text-xs sm:text-sm text-gray-500">Judul Tugas Akhir</label>
                    <p class="font-medium text-gray-800 text-base sm:text-lg italic mt-1">"{{ $penelitian->judul_ta }}"</p>
                </div>
            </div>

            {{-- PEMBIMBING --}}
            <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-5 sm:pt-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs sm:text-sm text-gray-500">Nama Pembimbing</label>
                        <p class="font-medium text-gray-800 text-sm sm:text-base mt-1">{{ $penelitian->pembimbing_ta }}</p>
                    </div>
                    <div>
                        <label class="text-xs sm:text-sm text-gray-500">No HP Pembimbing</label>
                        <p class="font-medium text-gray-800 text-sm sm:text-base mt-1">{{ $penelitian->no_hp_pembimbing }}</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ACTION BUTTONS --}}
        @if($penelitian->status == 'pending')
        <div class="bg-gray-50 px-5 sm:px-8 py-4 sm:py-6 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3">

                <form action="{{ route('admin.verifikasi.penelitian.update', $penelitian->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="ditolak">
                    <button type="submit" onclick="return confirm('Yakin ingin menolak?')"
                        class="w-full sm:w-auto justify-center px-6 py-2.5 sm:py-3 bg-white border border-red-300 text-red-700 font-bold rounded-lg hover:bg-red-50 transition shadow-sm flex items-center text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Tolak
                    </button>
                </form>

                <form action="{{ route('admin.verifikasi.penelitian.update', $penelitian->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="disetujui">
                    <button type="submit" onclick="return confirm('Yakin ingin menyetujui?')"
                        class="w-full sm:w-auto justify-center px-6 py-2.5 sm:py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-md flex items-center text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Setujui
                    </button>
                </form>

            </div>
        </div>
        @else
        <div class="bg-gray-50 px-5 sm:px-8 py-4 sm:py-6 border-t border-gray-200 text-center">
            <p class="text-gray-500 italic text-sm sm:text-base">
                Pengajuan ini telah diproses pada
                {{ $penelitian->updated_at->setTimezone('Asia/Makassar')->translatedFormat('d F Y, H:i') }}
            </p>
        </div>
        @endif

    </div>
</div>

@endsection