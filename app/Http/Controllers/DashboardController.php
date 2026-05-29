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

    /*
    |--------------------------------------------------------------------------
    | PENELITIAN
    |--------------------------------------------------------------------------
    */

    $jumlahPengajuanPenelitian = PengajuanPenelitian::where(
        'user_id',
        $userId
    )->count();

    $batasPengajuanPenelitian = $jumlahPengajuanPenelitian >= 5;

    $pengajuanPenelitianTerakhir = PengajuanPenelitian::where(
        'user_id',
        $userId
    )->latest()->first();

    /*
    |--------------------------------------------------------------------------
    | PKL
    |--------------------------------------------------------------------------
    */

    $jumlahPengajuanPkl = PengajuanPkl::where(
        'user_id',
        $userId
    )->count();

    $batasPengajuanPkl = $jumlahPengajuanPkl >= 5;

    $pengajuanPklTerakhir = PengajuanPkl::where(
        'user_id',
        $userId
    )->latest()->first();

    return view('dashboard.user', compact(
        'jumlahPengajuanPenelitian',
        'batasPengajuanPenelitian',
        'pengajuanPenelitianTerakhir',

        'jumlahPengajuanPkl',
        'batasPengajuanPkl',
        'pengajuanPklTerakhir'
    ));
}
}