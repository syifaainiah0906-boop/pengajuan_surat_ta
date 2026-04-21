<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPkl;
use App\Models\PengajuanPenelitian;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminVerifikasiController extends Controller
{
    public function indexPkl(Request $request)
    {
        $query = PengajuanPkl::with('user')->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        $data_pkl = $query->paginate(10)->withQueryString();

        return view('admin.verifikasi.pkl.index', compact('data_pkl'));
    }

    public function showPkl($id)
    {
        $pkl = PengajuanPkl::with('user')->findOrFail($id);

        return view('admin.verifikasi.pkl.show', compact('pkl'));
    }

    public function updateStatusPkl(Request $request, $id)
{
    $pkl = PengajuanPkl::findOrFail($id);

    $request->validate([
        'status' => 'required|in:disetujui,ditolak,pending'
    ]);

    if ($request->status == 'disetujui') {

        if (!$pkl->nomor_surat) {

            $lastPkl = PengajuanPkl::max('nomor_urut') ?? 0;
            $lastPenelitian = PengajuanPenelitian::max('nomor_urut') ?? 0;

            $next = max($lastPkl, $lastPenelitian) + 1;

            $bulanRomawi = [
                1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',
                7=>'VII',8=>'VIII',9=>'IX',10=>'X',11=>'XI',12=>'XII'
            ];

            $nomor = str_pad($next, 3, '0', STR_PAD_LEFT)
                   . '/E/PHS-SB/TI/'
                   . $bulanRomawi[now()->month]
                   . '/' . now()->year;

            $pkl->nomor_urut = $next;
            $pkl->nomor_surat = $nomor;
        }
    } else {
        $pkl->nomor_urut = null;
        $pkl->nomor_surat = null;
    }

    $pkl->status = $request->status;
    $pkl->save();

    return back()->with('success', 'Status berhasil diperbarui');
}

    public function indexPenelitian(Request $request)
    {
        $query = PengajuanPenelitian::with('user')->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        $data_penelitian = $query->paginate(10)->withQueryString();

        return view('admin.verifikasi.penelitian.index', compact('data_penelitian'));
    }

    public function showPenelitian($id)
    {
        $penelitian = PengajuanPenelitian::with('user')->findOrFail($id);

        return view('admin.verifikasi.penelitian.show', compact('penelitian'));
    }

    public function updateStatusPenelitian(Request $request, $id)
{
    $penelitian = PengajuanPenelitian::findOrFail($id);

    $request->validate([
        'status' => 'required|in:disetujui,ditolak,pending'
    ]);

    if ($request->status == 'disetujui') {

        if (!$penelitian->nomor_surat) {

            $lastPkl = PengajuanPkl::max('nomor_urut') ?? 0;
            $lastPenelitian = PengajuanPenelitian::max('nomor_urut') ?? 0;

            $next = max($lastPkl, $lastPenelitian) + 1;

            $bulanRomawi = [
                1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',
                7=>'VII',8=>'VIII',9=>'IX',10=>'X',11=>'XI',12=>'XII'
            ];

            $nomor = str_pad($next, 3, '0', STR_PAD_LEFT)
                   . '/E/PHS-SB/TI/'
                   . $bulanRomawi[now()->month]
                   . '/' . now()->year;

            $penelitian->nomor_urut = $next;
            $penelitian->nomor_surat = $nomor;
        }

    } else {
        $penelitian->nomor_urut = null;
        $penelitian->nomor_surat = null;
    }

    $penelitian->status = $request->status;
    $penelitian->save();

    return back()->with('success', 'Status berhasil diperbarui');
}

    public function indexDisetujui(Request $request)
    {
        $queryPkl = PengajuanPkl::with('user')->where('status', 'disetujui');
        $queryPenelitian = PengajuanPenelitian::with('user')->where('status', 'disetujui');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $queryPkl->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });

            $queryPenelitian->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        $dataPkl = collect([]);
        $dataPenelitian = collect([]);

        if ($request->jenis == 'PKL') {
            $dataPkl = $queryPkl->get();
        } elseif ($request->jenis == 'Penelitian') {
            $dataPenelitian = $queryPenelitian->get();
        } else {
            $dataPkl = $queryPkl->get();
            $dataPenelitian = $queryPenelitian->get();
        }

        $dataPkl->map(function ($item) {
            $item->jenis_surat = 'PKL';
            return $item;
        });

        $dataPenelitian->map(function ($item) {
            $item->jenis_surat = 'Penelitian';
            return $item;
        });

        $merged = $dataPkl->concat($dataPenelitian)->sortByDesc('created_at');

        $page = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 10;
        $items = $merged->forPage($page, $perPage);

        $data_disetujui = new LengthAwarePaginator(
            $items,
            $merged->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('admin.verifikasi.disetujui.index', compact('data_disetujui'));
    }

    public function indexDitolak(Request $request)
    {
        $queryPkl = PengajuanPkl::with('user')->where('status', 'ditolak');
        $queryPenelitian = PengajuanPenelitian::with('user')->where('status', 'ditolak');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $queryPkl->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });

            $queryPenelitian->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        $dataPkl = collect([]);
        $dataPenelitian = collect([]);

        if ($request->jenis == 'PKL') {
            $dataPkl = $queryPkl->get();
        } elseif ($request->jenis == 'Penelitian') {
            $dataPenelitian = $queryPenelitian->get();
        } else {
            $dataPkl = $queryPkl->get();
            $dataPenelitian = $queryPenelitian->get();
        }

        $dataPkl->map(function ($item) {
            $item->jenis_surat = 'PKL';
            return $item;
        });

        $dataPenelitian->map(function ($item) {
            $item->jenis_surat = 'Penelitian';
            return $item;
        });

        $merged = $dataPkl->concat($dataPenelitian)->sortByDesc('updated_at');

        $page = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 10;
        $items = $merged->forPage($page, $perPage);

        $data_ditolak = new LengthAwarePaginator(
            $items,
            $merged->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('admin.verifikasi.ditolak.index', compact('data_ditolak'));
    }

    public function indexGabungan(Request $request)
    {
        $queryPkl = PengajuanPkl::with('user');
        $queryPenelitian = PengajuanPenelitian::with('user');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $queryPkl->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });

            $queryPenelitian->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $queryPkl->where('status', $request->status);
            $queryPenelitian->where('status', $request->status);
        }

        $dataPkl = collect([]);
        $dataPenelitian = collect([]);

        if ($request->jenis == 'PKL') {
            $dataPkl = $queryPkl->get();
        } elseif ($request->jenis == 'Penelitian') {
            $dataPenelitian = $queryPenelitian->get();
        } else {
            $dataPkl = $queryPkl->get();
            $dataPenelitian = $queryPenelitian->get();
        }

        $dataPkl->map(function ($item) {
            $item->jenis_surat = 'PKL';
            $item->route_detail = route('admin.verifikasi.pkl.show', $item->id);
            $item->route_update = route('admin.verifikasi.pkl.update', $item->id);
            return $item;
        });

        $dataPenelitian->map(function ($item) {
            $item->jenis_surat = 'Penelitian';
            $item->route_detail = route('admin.verifikasi.penelitian.show', $item->id);
            $item->route_update = route('admin.verifikasi.penelitian.update', $item->id);
            return $item;
        });

        $merged = $dataPkl->concat($dataPenelitian)->sortByDesc('created_at');

        $page = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 10;
        $items = $merged->forPage($page, $perPage);

        $data_gabungan = new LengthAwarePaginator(
            $items,
            $merged->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('admin.verifikasi.index', compact('data_gabungan'));
    }

    // =========================
    // PDF PKL
    // =========================
    public function previewPkl($id)
    {
        $pkl = PengajuanPkl::with('user')->findOrFail($id);
        $pdf = Pdf::loadView('admin.verifikasi.pkl.detail', compact('pkl'));
        return $pdf->stream('surat_pkl.pdf');
    }

    public function downloadPkl($id)
    {
        $pkl = PengajuanPkl::with('user')->findOrFail($id);
        $pdf = Pdf::loadView('admin.verifikasi.pkl.detail', compact('pkl'));
        return $pdf->download('surat_pkl.pdf');
    }

    // =========================
    // PDF PENELITIAN
    // =========================
    public function previewPenelitian($id)
    {
        $penelitian = PengajuanPenelitian::with('user')->findOrFail($id);
        $pdf = Pdf::loadView('admin.verifikasi.penelitian.detail', compact('penelitian'));
        return $pdf->stream('surat_penelitian.pdf');
    }

    public function downloadPenelitian($id)
    {
        $penelitian = PengajuanPenelitian::with('user')->findOrFail($id);
        $pdf = Pdf::loadView('admin.verifikasi.penelitian.detail', compact('penelitian'));
        return $pdf->download('surat_penelitian.pdf');
    }
    
    public function detailPenelitian($id)
    {
        $penelitian = PengajuanPenelitian::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('admin.verifikasi.penelitian.surat', compact('penelitian'));

        return $pdf->stream('surat_penelitian.pdf');
    }
    public function show($id)
{
    $pkl = \App\Models\PengajuanPkl::with('user')->findOrFail($id);

    return view('admin.verifikasi.pkl.show', compact('pkl'));
}
}