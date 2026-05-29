<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PengajuanPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanPklController extends Controller
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

    // CEK APAKAH SUDAH MENCAPAI BATAS 5 PENGAJUAN
    $batasPengajuan = PengajuanPkl::hasActive(Auth::id());

    return view('pengajuan.pkl.create', compact(
        'user',
        'tanggal_sekarang',
        'batasPengajuan'
    ));
}

    // SIMPAN DATA PKL
    public function store(Request $request)
    {
        // BLOK JIKA SUDAH 5 KALI PENGAJUAN
        if (PengajuanPkl::hasActive(Auth::id())) {
            return back()->with(
                'error',
                'Batas maksimal pengajuan PKL adalah 5 kali.'
            );
        }

        $request->validate([
            'nomor_handphone' => 'required|string|max:20',
            'tempat_pkl' => 'required|string|max:255',
            'alamat_tempat_pkl' => 'required|string',
            'tujuan_surat' => 'required|string|max:255',
            'pembimbing_pkl' => 'required|string|max:255',
            'no_hp_pembimbing' => 'required|string|max:20',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        PengajuanPkl::create([
            'user_id' => Auth::id(),
            'tanggal_pengajuan' => Carbon::now('Asia/Makassar'),
            'nomor_surat' => null,
            'nomor_handphone' => $request->nomor_handphone,
            'tempat_pkl' => $request->tempat_pkl,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alamat_tempat_pkl' => $request->alamat_tempat_pkl,
            'tujuan_surat' => $request->tujuan_surat,
            'pembimbing_pkl' => $request->pembimbing_pkl,
            'no_hp_pembimbing' => $request->no_hp_pembimbing,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Pengajuan Surat Pengantar PKL berhasil dikirim!');
    }

    // GENERATE NOMOR SURAT
    private function generateNomorSurat()
    {
        $tahun = now()->year;
        $bulan = now()->month;

        $last = PengajuanPkl::whereYear('created_at', $tahun)->count();

        $no = str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        $romawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];

        return "$no/PKL/PHS/".$romawi[$bulan - 1]."/$tahun";
    }

    // APPROVE PENGAJUAN
    public function approve($id)
    {
        $data = PengajuanPkl::findOrFail($id);

        $data->status = 'disetujui';
        $data->nomor_surat = $this->generateNomorSurat();

        $data->save();

        return back()->with(
            'success',
            'Pengajuan disetujui & nomor surat berhasil dibuat!'
        );
    }

    // CETAK / PREVIEW SURAT
    public function cetakPreview($id)
    {
        $pkl = PengajuanPkl::with('user')->findOrFail($id);

        return view('admin.surat.pkl', compact('pkl'));
    }

    public function preview($id)
    {
        $pkl = PengajuanPkl::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('admin.verifikasi.pkl.surat', compact('pkl'));

        return $pdf->stream('surat_pkl.pdf');
    }

    public function download($id)
    {
        $pkl = PengajuanPkl::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('admin.verifikasi.pkl.surat', compact('pkl'));

        return $pdf->download('surat_pkl.pdf');
    }

    public function showPkl($id)
    {
        $pkl = PengajuanPkl::with('user')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $pdf = Pdf::loadView(
            'admin.verifikasi.pkl.pdf',
            compact('pkl')
        );

        return $pdf->stream('surat_pkl.pdf');
    }
}