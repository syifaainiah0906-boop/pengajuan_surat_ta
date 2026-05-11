<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPenelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanPenelitianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // FORM CREATE
   public function create()
{
    $user = Auth::user();

    $tanggal_sekarang = Carbon::now('Asia/Makassar')
        ->translatedFormat('d F Y, H:i');

    $punyaPengajuanAktif = PengajuanPenelitian::hasActive(Auth::id());

    return view('pengajuan.penelitian.create', compact(
        'user',
        'tanggal_sekarang',
        'punyaPengajuanAktif'
    ));
}

public function store(Request $request)
{
    // ✅ BLOCK kalau masih ada pengajuan
    if (PengajuanPenelitian::hasActive(Auth::id())) {
        return back()->with('error', 'Anda masih memiliki pengajuan (pending/disetujui). Tidak bisa mengajukan lagi!');
    }

    $request->validate([
        'nomor_handphone' => 'required|string|max:20',
        'tempat_penelitian' => 'required|string|max:255',
        'alamat_tempat_penelitian' => 'required|string',
        'tujuan_surat' => 'required|string|max:255',
        'judul_ta' => 'required|string|max:255',
        'pembimbing_ta' => 'required|string|max:255',
        'no_hp_pembimbing' => 'required|string|max:20',
    ]);

    PengajuanPenelitian::create([
        'user_id' => Auth::id(),
        'tanggal_pengajuan' => now(),
        'nomor_surat' => null,
        'nomor_handphone' => $request->nomor_handphone,
        'tempat_penelitian' => $request->tempat_penelitian,
        'alamat_tempat_penelitian' => $request->alamat_tempat_penelitian,
        'tujuan_surat' => $request->tujuan_surat,
        'judul_ta' => $request->judul_ta,
        'pembimbing_ta' => $request->pembimbing_ta,
        'no_hp_pembimbing' => $request->no_hp_pembimbing,
        'status' => 'pending',
    ]);

    return redirect()->route('dashboard')
        ->with('success', 'Pengajuan berhasil!');
}
    // GENERATE NOMOR SURAT
    private function generateNomorSurat()
    {
        $tahun = now()->year;
        $bulan = now()->month;

        $last = PengajuanPenelitian::whereYear('created_at', $tahun)->count();
        $no = str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        $romawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];

        return "$no/PENELITIAN/PHS/".$romawi[$bulan - 1]."/$tahun";
    }

    // APPROVE
    public function approve($id)
    {
        $data = PengajuanPenelitian::findOrFail($id);

        $data->status = 'disetujui';
        $data->nomor_surat = $this->generateNomorSurat();

        $data->save();

        return back()->with('success', 'Pengajuan disetujui & nomor surat berhasil dibuat!');
    }

    // PREVIEW PDF
    public function preview($id)
    {
        $penelitian = PengajuanPenelitian::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('admin.verifikasi.penelitian.surat', compact('penelitian'));

        return $pdf->stream('surat_penelitian.pdf');
    }

    // DOWNLOAD PDF
    public function download($id)
    {
        $penelitian = PengajuanPenelitian::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('admin.verifikasi.penelitian.surat', compact('penelitian'));

        return $pdf->download('surat_penelitian.pdf');
    }
}