<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengajuan</title>
    @vite('resources/css/app.css')
</head>

<body class="relative min-h-screen flex items-center justify-center bg-cover bg-center px-4 py-8"
      style="background-image: url('{{ asset('images/view_baru.jpg') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Card -->
    <div class="relative z-10 max-w-md w-full bg-white p-6 sm:p-8 rounded-xl shadow-md">

        <div class="text-center mb-6 sm:mb-8">
            <img src="{{ asset('images/logo_polhas.png') }}" class="mx-auto mb-4 w-16 h-16 sm:w-24 sm:h-24 object-contain">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Selamat Datang</h2>
            <p class="text-sm sm:text-base text-gray-500 mt-2">Silakan masuk ke akun Anda</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 sm:p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 sm:p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}"
                    class="w-full px-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                    placeholder="Masukkan email" required>
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label class="text-sm font-medium text-gray-700">Password</label>
                    <a href="#" class="text-xs text-indigo-600 hover:underline">Lupa Password?</a>
                </div>
                <input type="password" name="password"
                    class="w-full px-4 py-2.5 sm:py-3 bg-gray-50 border border-gray-300 rounded-lg text-sm sm:text-base focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                    placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 sm:py-3 rounded-lg shadow-md font-medium transition text-sm sm:text-base">
                Masuk
            </button>
        </form>

        <div class="mt-6 sm:mt-8 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Daftar Akun Baru</a>
            </p>
        </div>

    </div>
</body>
</html>