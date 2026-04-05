<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DosenPembimbing;

class DosenPembimbingController extends Controller
{
    public function index()
    {
        $dosen = DosenPembimbing::all();
        return view('admin.dosen.index', compact('dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
        ]);

        DosenPembimbing::create($request->all());
        return redirect()->back()->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $dosen = DosenPembimbing::findOrFail($id);
        $dosen->delete();
        return redirect()->back()->with('success', 'Dosen berhasil dihapus!');
    }
}