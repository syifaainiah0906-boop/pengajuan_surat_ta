@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

<div class="w-full min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-white px-4 sm:px-6 lg:px-10 py-6 sm:py-10">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">

        <div>
            <h1 class="text-3xl sm:text-4xl font-black text-gray-800 leading-tight">
                Dashboard 
            </h1>

            <p class="mt-2 text-gray-600 text-sm sm:text-base">
                Selamat datang,
                <span class="font-bold text-blue-600">{{ Auth::user()->name }}</span> 👋
            </p>

            <p class="text-gray-500 text-sm mt-1">
                Kelola pengajuan surat PKL dan penelitian dengan mudah.
            </p>
        </div>

    </div>

    

    {{-- MAIN CARD --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mt-2">

        {{-- PKL --}}
        <div class="relative overflow-hidden rounded-3xl bg-white border border-blue-100 shadow-[0_15px_40px_rgba(59,130,246,0.08)] p-8 group hover:-translate-y-1 transition-all duration-300">

            <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-100 rounded-full opacity-50 blur-2xl"></div>

            <div class="relative z-10">

                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center shadow-lg mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-black text-gray-800 mb-3">
                    Surat Pengantar PKL
                </h2>

                <p class="text-gray-600 leading-relaxed mb-6">
                    Ajukan surat pengantar PKL untuk keperluan magang atau praktik kerja lapangan ke instansi tujuan.
                </p>

                {{-- STATUS --}}
                @if($punyaPengajuanAktifPkl)

                    @php
                        $statusPkl = $pengajuanPklTerakhir->status ?? null;
                    @endphp

                    <div class="mb-6">

                        @if($statusPkl == 'pending')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                Pengajuan Sedang Diproses
                            </span>

                        @elseif($statusPkl == 'disetujui')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-100 text-green-700 border border-green-200">
                                Sudah Mengajukan Surat
                            </span>

                        @endif

                    </div>

                    <button onclick="showModal()"
                        class="inline-flex items-center bg-gray-100 text-gray-400 px-5 py-3 rounded-xl font-semibold cursor-not-allowed">
                        Isi Form Pengajuan
                    </button>
                @else
                    <a href="{{ route('pengajuan.pkl.create') }}"
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-bold shadow-lg transition-all duration-300 hover:scale-[1.02]">
                        Isi Form Pengajuan

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 ml-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif

            </div>
        </div>

        {{-- PENELITIAN --}}
        <div class="relative overflow-hidden rounded-3xl bg-white border border-yellow-100 shadow-[0_15px_40px_rgba(234,179,8,0.08)] p-8 group hover:-translate-y-1 transition-all duration-300">

            <div class="absolute -top-10 -right-10 w-40 h-40 bg-yellow-100 rounded-full opacity-50 blur-2xl"></div>

            <div class="relative z-10">

                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 text-white flex items-center justify-center shadow-lg mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-black text-gray-800 mb-3">
                    Surat Pengantar Penelitian
                </h2>

                <p class="text-gray-600 leading-relaxed mb-6">
                    Ajukan surat izin penelitian untuk kebutuhan skripsi, tugas akhir, maupun riset akademik lainnya.
                </p>

                @if($punyaPengajuanAktif)
                    <div class="mb-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                            Pengajuan Sedang Diproses
                        </span>
                    </div>

                    <button onclick="showModal()"
                        class="inline-flex items-center bg-gray-100 text-gray-400 px-5 py-3 rounded-xl font-semibold cursor-not-allowed">
                        Isi Form Pengajuan
                    </button>
                @else
                    <a href="{{ route('pengajuan.penelitian.create') }}"
                        class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-3 rounded-xl font-bold shadow-lg transition-all duration-300 hover:scale-[1.02]">
                        Isi Form Pengajuan

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 ml-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif

            </div>
        </div>

    </div>

</div>

{{-- MODAL --}}
<div id="modalAlert"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">

    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl text-center animate-fadeIn">

        <div class="w-20 h-20 rounded-full bg-yellow-100 flex items-center justify-center mx-auto mb-5">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-10 w-10 text-yellow-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8v4m0 4h.01"/>
            </svg>
        </div>

        <h2 class="text-2xl font-black text-gray-800 mb-2">
            Pengajuan Tidak Bisa Dilakukan
        </h2>

        <p class="text-gray-500 leading-relaxed mb-6">
            Anda masih memiliki pengajuan aktif yang sedang diproses.
        </p>

        <button onclick="closeModal()"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold transition">
            Mengerti
        </button>

    </div>
</div>

<script>
function showModal() {
    document.getElementById('modalAlert').classList.remove('hidden');
    document.getElementById('modalAlert').classList.add('flex');
}

function closeModal() {
    document.getElementById('modalAlert').classList.add('hidden');
    document.getElementById('modalAlert').classList.remove('flex');
}
</script>

@endsection