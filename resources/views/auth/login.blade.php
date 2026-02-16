<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengajuan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Selamat Datang</h2>
            <p class="text-gray-500 mt-2">Silakan masuk ke akun Anda</p>
        </div>

        <form action="#" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">NIM / Email</label>
                <input type="text" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="Masukkan NIM atau Email">
            </div>
            <div>
                <div class="flex justify-between items-center">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <a href="#" class="text-xs text-indigo-600 hover:underline">Lupa Password?</a>
                </div>
                <input type="password" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300">
                Masuk
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun? <a href="/register" class="text-indigo-600 font-bold hover:underline">Daftar Akun Baru</a>
            </p>
        </div>
    </div>
</body>
</html>