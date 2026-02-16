<x-layouts> 
    <x-slot:title>Dashboard Pengajuan Surat</x-slot:title>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-blue-600 rounded-2xl p-6 shadow-lg shadow-blue-200">
                <p class="text-blue-100 text-sm font-semibold uppercase">Pengajuan PKL</p>
                <h3 class="text-4xl font-bold text-white mt-2">24</h3>
            </div>
            <div class="bg-sky-500 rounded-2xl p-6 shadow-lg shadow-sky-100">
                <p class="text-sky-100 text-sm font-semibold uppercase">Penelitian</p>
                <h3 class="text-4xl font-bold text-white mt-2">12</h3>
            </div>
            <div class="bg-yellow-400 rounded-2xl p-6 shadow-lg shadow-yellow-100">
                <p class="text-yellow-900 text-sm font-semibold uppercase">Total Disetujui</p>
                <h3 class="text-4xl font-bold text-yellow-900 mt-2">30</h3>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-lg">
                <p class="text-gray-400 text-sm font-semibold uppercase">Total Ditolak</p>
                <h3 class="text-4xl font-bold text-red-500 mt-2">6</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col items-center justify-center">
                <h2 class="text-lg font-bold text-gray-800 mb-6">Proporsi Pengajuan</h2>
                <div class="relative w-48 h-48">
                    <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90">
                        <circle cx="18" cy="18" r="16" fill="none" class="text-gray-100" stroke="currentColor" stroke-width="4"></circle>
                        <circle cx="18" cy="18" r="16" fill="none" class="text-blue-600" stroke="currentColor" stroke-width="4" stroke-dasharray="70 100"></circle>
                        <circle cx="18" cy="18" r="16" fill="none" class="text-yellow-400" stroke="currentColor" stroke-width="4" stroke-dasharray="30 100" stroke-dashoffset="-70"></circle>
                    </svg>
                </div>
                <div class="mt-6 space-y-2 w-full">
                    <div class="flex justify-between items-center text-sm">
                        <span class="flex items-center"><span class="w-3 h-3 bg-blue-600 rounded-full mr-2"></span> Penelitian</span>
                        <span class="font-bold text-gray-700">70%</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="flex items-center"><span class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></span> PKL</span>
                        <span class="font-bold text-gray-700">30%</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-800">Pengajuan Terbaru</h2>
                    <button class="text-blue-600 text-sm font-semibold hover:underline">Lihat Semua</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-semibold">
                            <tr>
                                <th class="px-6 py-4">Mahasiswa</th>
                                <th class="px-6 py-4">Jenis</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">Budi Santoso</td>
                                <td class="px-6 py-4 text-gray-500">PKL</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending</span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-600 hover:text-blue-800 font-medium">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">Siti Aminah</td>
                                <td class="px-6 py-4 text-gray-500">Penelitian</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Disetujui</span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-600 hover:text-blue-800 font-medium">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</x-layouts>