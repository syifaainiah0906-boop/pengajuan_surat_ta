<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPenelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengajuanPenelitianController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $tanggal_sekarang = Carbon::now()->translatedFormat('d F Y');
        
        return view('pengajuan.penelitian.create', compact('user', 'tanggal_sekarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tempat_penelitian' => 'required|string|max:255',
            'alamat_tempat_penelitian' => 'required|string',
            'tujuan_surat' => 'required|string|max:255',
            'judul_ta' => 'required|string|max:255',
            'pembimbing_ta' => 'required|string|max:255',
            'no_hp_pembimbing' => 'required|string|max:20',
        ]);

        PengajuanPenelitian::create([
            'user_id' => Auth::id(),
            'tanggal_pengajuan' => Carbon::now(),
            'nomor_surat' => null,
            'tempat_penelitian' => $request->tempat_penelitian,
            'alamat_tempat_penelitian' => $request->alamat_tempat_penelitian,
            'tujuan_surat' => $request->tujuan_surat,
            'judul_ta' => $request->judul_ta,
            'pembimbing_ta' => $request->pembimbing_ta,
            'no_hp_pembimbing' => $request->no_hp_pembimbing,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan Surat Penelitian berhasil dikirim!');
    }
}
