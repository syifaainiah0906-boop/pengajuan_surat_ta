<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanPkl;
use App\Models\PengajuanPenelitian;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        }
        if ($user->role === 'baa') {
        return redirect()->route('admin.arsip.index');
    }

        return $this->userDashboard();
    }

    private function adminDashboard()
    {

        $countPkl = PengajuanPkl::count();
        $countPenelitian = PengajuanPenelitian::count();

        $countDisetujui = PengajuanPkl::where('status', 'disetujui')->count() 
                        + PengajuanPenelitian::where('status', 'disetujui')->count();
                        
        $countDitolak   = PengajuanPkl::where('status', 'ditolak')->count() 
                        + PengajuanPenelitian::where('status', 'ditolak')->count();

        $latestPkl = PengajuanPkl::with('user')->latest()->take(5)->get();
        $latestPenelitian = PengajuanPenelitian::with('user')->latest()->take(5)->get();
        $merged = $latestPkl->concat($latestPenelitian); 
        $terbaru = $merged->sortByDesc('created_at')->take(5);

        return view('dashboard.admin', [
            'total_pkl' => $countPkl,
            'total_penelitian' => $countPenelitian,
            'total_disetujui' => $countDisetujui,
            'total_ditolak' => $countDitolak,
            'pengajuan_terbaru' => $terbaru
        ]);
    }

   private function userDashboard()
{
    $userId = Auth::id();

    // CEK PENELITIAN (AMBIL DATA TERAKHIR)
    $lastPenelitian = \App\Models\PengajuanPenelitian::where('user_id', $userId)
        ->latest()
        ->first();

    $punyaPengajuanAktif = $lastPenelitian 
        ? in_array($lastPenelitian->status, ['pending', 'disetujui']) 
        : false;

    // CEK PKL (AMBIL DATA TERAKHIR)
    $lastPkl = \App\Models\PengajuanPkl::where('user_id', $userId)
        ->latest()
        ->first();

    $punyaPengajuanAktifPkl = $lastPkl 
        ? in_array($lastPkl->status, ['pending', 'disetujui']) 
        : false;

    return view('dashboard.user', compact(
        'punyaPengajuanAktif',
        'punyaPengajuanAktifPkl'
    ));
}
}