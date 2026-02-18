@extends('layouts.app')

@section('title', 'Status Pengajuan Surat')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Data Pengajuan Surat</h1>
            <p class="text-gray-500 mt-1">Silahkan Klik Tab Dibawah untuk melihat status pengajuan Anda.</p>
        </div>

        <div class="flex space-x-1 bg-gray-200 p-1 rounded-t-lg w-fit md:w-auto">
            <button onclick="switchTab('pkl')" id="tab-pkl" 
                class="px-6 py-3 text-sm font-bold rounded-t-lg transition-colors duration-200 bg-white text-blue-600 shadow-sm border-t border-l border-r border-gray-200">
                Surat Pengantar PKL
            </button>
            <button onclick="switchTab('penelitian')" id="tab-penelitian" 
                class="px-6 py-3 text-sm font-bold rounded-t-lg transition-colors duration-200 text-gray-500 hover:text-gray-700 hover:bg-gray-100">
                Surat Pengantar Penelitian
            </button>
        </div>

        <div class="bg-white rounded-b-lg rounded-tr-lg shadow-lg border border-gray-200 overflow-hidden min-h-[400px]">
            
            <div id="content-pkl" class="block">
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-700">Data Pengajuan Surat Pengantar PKL</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-600 text-white uppercase text-sm font-semibold tracking-wider">
                            <tr>
                                <th class="px-6 py-4 rounded-tl-lg">No</th>
                                <th class="px-6 py-4">Jenis Pengajuan</th>
                                <th class="px-6 py-4">Tanggal Pengajuan</th>
                                <th class="px-6 py-4">Tanggal Diterima</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 rounded-tr-lg">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-gray-50">
                            @forelse($pkls as $index => $pkl)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-gray-700 font-medium">Surat Pengantar PKL</td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ \Carbon\Carbon::parse($pkl->created_at)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{-- Tanggal diterima (updated_at) hanya muncul jika disetujui --}}
                                    @if($pkl->status == 'disetujui')
                                        {{ \Carbon\Carbon::parse($pkl->updated_at)->translatedFormat('d F Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($pkl->status == 'disetujui')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold border border-green-200">
                                            Disetujui
                                        </span>
                                    @elseif($pkl->status == 'ditolak')
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold border border-red-200">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold border border-yellow-200">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($pkl->status == 'disetujui')
                                        <a href="#" class="text-blue-600 hover:text-blue-800 font-bold hover:underline flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Download
                                        </a>
                                    @else
                                        <span class="text-gray-400 cursor-not-allowed text-sm">Download</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                                    Belum ada pengajuan surat PKL.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="content-penelitian" class="hidden">
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-700">Data Pengajuan Surat Pengantar Penelitian</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-600 text-white uppercase text-sm font-semibold tracking-wider">
                            <tr>
                                <th class="px-6 py-4 rounded-tl-lg">No</th>
                                <th class="px-6 py-4">Jenis Pengajuan</th>
                                <th class="px-6 py-4">Tanggal Pengajuan</th>
                                <th class="px-6 py-4">Tanggal Diterima</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 rounded-tr-lg">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-gray-50">
                            @forelse($penelitians as $index => $penelitian)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-gray-700 font-medium">Surat Pengantar Penelitian</td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ \Carbon\Carbon::parse($penelitian->created_at)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if($penelitian->status == 'disetujui')
                                        {{ \Carbon\Carbon::parse($penelitian->updated_at)->translatedFormat('d F Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($penelitian->status == 'disetujui')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold border border-green-200">
                                            Disetujui
                                        </span>
                                    @elseif($penelitian->status == 'ditolak')
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold border border-red-200">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold border border-yellow-200">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($penelitian->status == 'disetujui')
                                        <a href="#" class="text-blue-600 hover:text-blue-800 font-bold hover:underline flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Download
                                        </a>
                                    @else
                                        <span class="text-gray-400 cursor-not-allowed text-sm">Download</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                                    Belum ada pengajuan surat penelitian.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function switchTab(tabName) {
        const contentPkl = document.getElementById('content-pkl');
        const contentPenelitian = document.getElementById('content-penelitian');
        const tabPkl = document.getElementById('tab-pkl');
        const tabPenelitian = document.getElementById('tab-penelitian');

        const inactiveClass = "text-gray-500 hover:text-gray-700 hover:bg-gray-100 bg-transparent shadow-none border-transparent";
        const activeClass = "bg-white text-blue-600 shadow-sm border-t border-l border-r border-gray-200";

        if (tabName === 'pkl') {
            contentPkl.classList.remove('hidden');
            contentPenelitian.classList.add('hidden');

            tabPkl.className = "px-6 py-3 text-sm font-bold rounded-t-lg transition-colors duration-200 " + activeClass;
            tabPenelitian.className = "px-6 py-3 text-sm font-bold rounded-t-lg transition-colors duration-200 " + inactiveClass;
        } else {
            contentPkl.classList.add('hidden');
            contentPenelitian.classList.remove('hidden');

            tabPkl.className = "px-6 py-3 text-sm font-bold rounded-t-lg transition-colors duration-200 " + inactiveClass;
            tabPenelitian.className = "px-6 py-3 text-sm font-bold rounded-t-lg transition-colors duration-200 " + activeClass;
        }
    }
</script>
@endsection