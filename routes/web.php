<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanPklController;
use App\Http\Controllers\PengajuanPenelitianController;
use App\Http\Controllers\StatusPengajuanController;
use App\Http\Controllers\AdminVerifikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pengajuan/pkl', [PengajuanPklController::class, 'create'])->name('pengajuan.pkl.create');
    Route::post('/pengajuan/pkl', [PengajuanPklController::class, 'store'])->name('pengajuan.pkl.store');

    Route::get('/pengajuan/penelitian', [PengajuanPenelitianController::class, 'create'])->name('pengajuan.penelitian.create');
    Route::post('/pengajuan/penelitian', [PengajuanPenelitianController::class, 'store'])->name('pengajuan.penelitian.store');

    Route::get('/status-pengajuan', [StatusPengajuanController::class, 'index'])->name('status-pengajuan.index');

    Route::get('/verifikasi/pkl', [AdminVerifikasiController::class, 'indexPkl'])->name('admin.verifikasi.pkl.index');
    Route::get('/verifikasi/pkl/{id}', [AdminVerifikasiController::class, 'showPkl'])->name('admin.verifikasi.pkl.show');
    Route::patch('/verifikasi/pkl/{id}', [AdminVerifikasiController::class, 'updateStatusPkl'])->name('admin.verifikasi.pkl.update');

    Route::get('/verifikasi/penelitian', [AdminVerifikasiController::class, 'indexPenelitian'])->name('admin.verifikasi.penelitian.index');
    Route::get('/verifikasi/penelitian/{id}', [AdminVerifikasiController::class, 'showPenelitian'])->name('admin.verifikasi.penelitian.show');
    Route::patch('/verifikasi/penelitian/{id}', [AdminVerifikasiController::class, 'updateStatusPenelitian'])->name('admin.verifikasi.penelitian.update');

    Route::get('/verifikasi/disetujui', [AdminVerifikasiController::class, 'indexDisetujui'])->name('admin.verifikasi.disetujui.index');

    Route::get('/verifikasi/ditolak', [AdminVerifikasiController::class, 'indexDitolak'])->name('admin.verifikasi.ditolak.index');

    Route::get('/verifikasi', [AdminVerifikasiController::class, 'indexGabungan'])->name('admin.verifikasi.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});