<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M4 19h16"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-800 leading-tight">
                    Sistem Informasi Pengajuan Surat<br>
                    <span class="text-sm font-medium text-blue-600">Pengantar PKL dan Penelitian</span>
                </span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                
                <a href="{{ route('dashboard') }}" 
                   class="{{ Request::routeIs('dashboard') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }} pb-1 transition">
                   Dashboard
                </a>

                @if(Auth::user()->role == 'admin')
                    {{-- Menu Khusus Admin --}}
                    <a href="{{ route('admin.verifikasi.index') }}" 
                        class="{{ Request::routeIs('admin.verifikasi*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }} pb-1 transition">
                        Verifikasi
                    </a>
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition pb-1">Arsip</a>
                
                @else
                    {{-- Menu Khusus User --}}
                    <a href="{{ route('status-pengajuan.index') }}" 
                       class="{{ Request::is('status-pengajuan*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }} pb-1 transition">
                       Status Pengajuan
                    </a>
                @endif
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-50 text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-100 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>