<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPkl;
use App\Models\PengajuanPenelitian;
use Illuminate\Support\Facades\Auth;

class StatusPengajuanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $pkls = PengajuanPkl::where('user_id', $userId)->latest()->get();
        $penelitians = PengajuanPenelitian::where('user_id', $userId)->latest()->get();

        return view('status-pengajuan.index', compact('pkls', 'penelitians'));
    }
}
