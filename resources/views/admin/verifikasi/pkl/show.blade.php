@extends('layouts.app')

@section('title', 'Detail Verifikasi PKL')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <a href="{{ route('admin.verifikasi.pkl.index') }}" class="flex items-center text-gray-600 hover:text-blue-600 mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>

        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Pengajuan PKL</h1>
                    <p class="text-gray-500 text-sm mt-1">Diajukan pada {{ \Carbon\Carbon::parse($pkl->tanggal_pengajuan)->translatedFormat('d F Y, H:i') }}</p>
                </div>
                <div>
                    @if($pkl->status == 'pending')
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg font-bold border border-yellow-200">Menunggu Verifikasi</span>
                    @elseif($pkl->status == 'disetujui')
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg font-bold border border-green-200">Disetujui</span>
                    @else
                        <span class="px-4 py-2 bg-red-100 text-red-800 rounded-lg font-bold border border-red-200">Ditolak</span>
                    @endif
                </div>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="col-span-2 md:col-span-1">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Informasi Mahasiswa</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-500">Nama Lengkap</label>
                            <p class="font-medium text-gray-800 text-lg">{{ $pkl->user->name }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">NIM</label>
                            <p class="font-medium text-gray-800">{{ $pkl->user->nim }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Program Studi</label>
                            <p class="font-medium text-gray-800">{{ $pkl->user->prodi }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Detail Tempat PKL</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-500">Tempat PKL</label>
                            <p class="font-medium text-gray-800">{{ $pkl->tempat_pkl }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Tujuan Surat (Jabatan)</label>
                            <p class="font-medium text-gray-800">{{ $pkl->tujuan_surat }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Alamat Lengkap</label>
                            <p class="font-medium text-gray-800 leading-relaxed">{{ $pkl->alamat_tempat_pkl }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-span-2 border-t border-gray-100 pt-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Dosen Pembimbing</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs text-gray-500">Nama Pembimbing</label>
                            <p class="font-medium text-gray-800">{{ $pkl->pembimbing_pkl }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">No HP Pembimbing</label>
                            <p class="font-medium text-gray-800">{{ $pkl->no_hp_pembimbing }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($pkl->status == 'pending')
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 flex flex-col md:flex-row justify-end space-y-3 md:space-y-0 md:space-x-4">
                
                <form action="{{ route('admin.verifikasi.pkl.update', $pkl->id) }}" method="POST" class="w-full md:w-auto">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="ditolak">
                    <button type="submit" onclick="return confirm('Yakin ingin menolak pengajuan ini?')" 
                        class="w-full justify-center px-6 py-3 bg-white border border-red-300 text-red-700 font-bold rounded-lg hover:bg-red-50 transition shadow-sm flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Tolak Pengajuan
                    </button>
                </form>

                <form action="{{ route('admin.verifikasi.pkl.update', $pkl->id) }}" method="POST" class="w-full md:w-auto">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="disetujui">
                    <button type="submit" onclick="return confirm('Yakin ingin menyetujui pengajuan ini?')" 
                        class="w-full justify-center px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-md flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Setujui Pengajuan
                    </button>
                </form>
            </div>
            @else
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 text-center">
                <p class="text-gray-500 italic">Pengajuan ini telah diproses pada {{ $pkl->updated_at->translatedFormat('d F Y, H:i') }}</p>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection