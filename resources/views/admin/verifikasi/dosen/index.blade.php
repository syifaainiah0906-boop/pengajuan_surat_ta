@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-2xl font-bold mb-5">Daftar Dosen Pembimbing PKL</h1>

    <!-- Form Tambah -->
    <form action="{{ route('admin.dosen.store') }}" method="POST" class="mb-5 flex gap-2">
        @csrf
        <input type="text" name="nama" placeholder="Nama Dosen" class="border px-2 py-1 rounded">
        <input type="text" name="prodi" placeholder="Prodi" class="border px-2 py-1 rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Tambah</button>
    </form>

    <!-- Table -->
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Nama Dosen</th>
                <th class="border px-4 py-2">Prodi</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dosen as $key => $d)
            <tr>
                <td class="border px-4 py-2">{{ $key+1 }}</td>
                <td class="border px-4 py-2">{{ $d->nama }}</td>
                <td class="border px-4 py-2">{{ $d->prodi }}</td>
                <td class="border px-4 py-2">
                    <form action="{{ route('admin.dosen.destroy', $d->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection