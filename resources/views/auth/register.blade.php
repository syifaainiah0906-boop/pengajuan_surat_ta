<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Pengajuan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Buat Akun</h2>
            <p class="text-gray-500 mt-2">Daftar untuk pengajuan PKL & Tugas Akhir</p>
        </div>

        <form action="#" method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Masukkan nama lengkap">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">NIM / NIK</label>
                <input type="text" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Contoh: 20210001">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300">
                Daftar Sekarang
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? <a href="/login" class="text-blue-600 font-bold hover:underline">Masuk di sini</a>
        </p>
    </div>
</body>
</html>