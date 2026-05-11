<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengajuan</title>
    @vite('resources/css/app.css')
</head>

<body class="relative min-h-screen flex items-center justify-center bg-cover bg-center"
      style="background-image: url('{{ asset('images/view_baru.jpg') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Card -->
    <div class="relative z-10 max-w-md w-full bg-white p-8 rounded-xl shadow-md">

        <div class="text-center mb-8">
            <img src="{{ asset('images/logo_polhas.png') }}" class="mx-auto mb-4 w-24 h-24 object-contain">
            <h2 class="text-3xl font-bold text-gray-800">Selamat Datang</h2>
            <p class="text-gray-500 mt-2">Silakan masuk ke akun Anda</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" value="{{ old('username') }}"
                    class="mt-1 w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <div class="flex justify-between">
                    <label class="text-sm font-medium text-gray-700">Password</label>
                    <a href="#" class="text-xs text-indigo-600">Lupa Password?</a>
                </div>
                <input type="password" name="password"
                    class="mt-1 w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg shadow-md">
                Masuk
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold">Daftar Akun Baru</a>
            </p>
        </div>

    </div>
</body>
</html>