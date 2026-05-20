<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Pengajuan</title>
    @vite('resources/css/app.css')
</head>
<body class="relative min-h-screen flex items-center justify-center bg-cover bg-center px-4 py-8"
      style="background-image: url('{{ asset('images/view_baru.jpg') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Card -->
    <div class="relative z-10 max-w-md w-full bg-white p-6 sm:p-8 rounded-xl shadow-lg">

        <div class="text-center mb-6 sm:mb-8">
            <img src="{{ asset('images/logo_polhas.png') }}" class="mx-auto mb-4 w-16 h-16 sm:w-24 sm:h-24 object-contain">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Buat Akun</h2>
            <p class="text-sm sm:text-base text-gray-500 mt-2">Daftar untuk pengajuan PKL & Tugas Akhir</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4 sm:space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Masukkan nama lengkap" required>
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIM / NIK</label>
                <input type="text" name="nim" value="{{ old('nim') }}"
                    class="w-full px-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Contoh: 20210001" required>
                @error('nim') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                <input type="text" name="prodi" value="D3 Teknik Informatika" readonly
                    class="w-full px-4 py-2.5 sm:py-3 bg-gray-100 border border-gray-300 rounded-lg text-sm sm:text-base text-gray-600 cursor-not-allowed">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}"
                    class="w-full px-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Masukkan email" required>
                @error('username') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Masukkan password" required>
                @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 sm:py-3 rounded-lg shadow-md transition duration-300 text-sm sm:text-base">
                Daftar Sekarang
            </button>
        </form>

        <p class="mt-5 sm:mt-6 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk di sini</a>
        </p>
    </div>
</body>
</html>