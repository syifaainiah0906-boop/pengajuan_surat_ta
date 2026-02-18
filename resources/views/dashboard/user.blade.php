@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="min-h-screen bg-gray-50">
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-500 mt-2">Selamat datang, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="group bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg hover:border-blue-200 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-yellow-100 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Surat Pengantar PKL</h3>
                    <p class="text-gray-500 mb-8 text-sm leading-relaxed">
                        Ajukan surat pengantar untuk keperluan Praktik Kerja Lapangan ke instansi tujuan.
                    </p>

                    <a href="{{ route('pengajuan.pkl.create') }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors group-hover:underline decoration-yellow-400 decoration-2 underline-offset-4">
                        Lihat Detail
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="group bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg hover:border-yellow-200 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>

                <div class="relative z-10">
                    <div class="w-14 h-14 bg-yellow-50 rounded-xl flex items-center justify-center mb-6 text-yellow-600 group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Surat Pengantar Penelitian</h3>
                    <p class="text-gray-500 mb-8 text-sm leading-relaxed">
                        Ajukan surat izin penelitian untuk keperluan Skripsi atau Tugas Akhir.
                    </p>

                    <a href="{{ route('pengajuan.penelitian.create') }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors group-hover:underline decoration-yellow-400 decoration-2 underline-offset-4">
                        Lihat Detail
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection