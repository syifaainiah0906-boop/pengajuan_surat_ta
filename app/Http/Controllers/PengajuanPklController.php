<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengajuanPklController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $tanggal_sekarang = Carbon::now()->translatedFormat('d F Y'); 
        
        return view('pengajuan.pkl.create', compact('user', 'tanggal_sekarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tempat_pkl' => 'required|string|max:255',
            'alamat_tempat_pkl' => 'required|string',
            'tujuan_surat' => 'required|string|max:255',
            'pembimbing_pkl' => 'required|string|max:255',
            'no_hp_pembimbing' => 'required|string|max:20',
        ]);

        PengajuanPkl::create([
            'user_id' => Auth::id(),
            'tanggal_pengajuan' => Carbon::now(),
            'nomor_surat' => null,
            'tempat_pkl' => $request->tempat_pkl,
            'alamat_tempat_pkl' => $request->alamat_tempat_pkl,
            'tujuan_surat' => $request->tujuan_surat,
            'pembimbing_pkl' => $request->pembimbing_pkl,
            'no_hp_pembimbing' => $request->no_hp_pembimbing,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan Surat Pengantar PKL berhasil dikirim!');
    }
}
