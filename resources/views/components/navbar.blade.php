<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="w-full px-6 lg:px-10">
     <div class="flex justify-between h-20 items-center">            
            <!-- LEFT -->
            <div class="flex items-center space-x-4">
                
                <!-- LOGO -->
                <img src="{{ asset('images/logo-polhas.png') }}" 
                     alt="Logo" 
                     class="h-14 w-auto object-contain">

                <!-- TEXT -->
                <span class="text-3xl font-bold text-gray-800 leading-tight">
                    Sistem Informasi Pengajuan Surat<br>
                    <span class="text-xl font-medium text-blue-600">
                        Pengantar PKL dan Penelitian
                    </span>
                </span>

            </div>

            <!-- RIGHT -->
            <div class="hidden md:flex items-center space-x-8">
                
                <a href="{{ route('dashboard') }}" 
                   class="{{ Request::routeIs('dashboard') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }} pb-1 transition">
                   Dashboard
                </a>

                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.verifikasi.index') }}" 
                        class="{{ Request::routeIs('admin.verifikasi*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }} pb-1 transition">
                        Verifikasi
                    </a>
                    <a href="{{ route('admin.arsip.index') }}" 
                       class="{{ Request::routeIs('admin.arsip*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }} pb-1 transition">
                        Arsip
                    </a>
                @else
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