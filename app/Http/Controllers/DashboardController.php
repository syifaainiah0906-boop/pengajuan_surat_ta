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
        return view('dashboard.user');
    }
}