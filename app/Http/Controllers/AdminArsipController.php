<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPkl;
use App\Models\PengajuanPenelitian;
use Illuminate\Pagination\LengthAwarePaginator;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminArsipController extends Controller
{
    public function index(Request $request)
    {
        // ================= PKL =================
        $pkl = PengajuanPkl::with('user')
            ->whereIn('status', ['disetujui', 'ditolak'])
            ->get()
            ->map(function ($item) {
                $item->jenis_surat = 'PKL';
                $item->nomor_surat = $item->nomor_surat ?? '-';

                // route ke preview (bukan PDF langsung)
                $item->route_detail = route('admin.arsip.preview', ['PKL', $item->id]);

                return $item;
            });

        // ================= PENELITIAN =================
        $penelitian = PengajuanPenelitian::with('user')
            ->whereIn('status', ['disetujui', 'ditolak'])
            ->get()
            ->map(function ($item) {
                $item->jenis_surat = 'Penelitian';
                $item->nomor_surat = $item->nomor_surat ?? '-';

                // route ke preview
                $item->route_detail = route('admin.arsip.preview', ['Penelitian', $item->id]);

                return $item;
            });

        // ================= GABUNG =================
        $data = $pkl->concat($penelitian);

        // ================= FILTER JENIS =================
        if ($request->filled('jenis')) {
            $data = $data->filter(function ($item) use ($request) {
                return $item->jenis_surat === $request->jenis;
            });
        }

        // ================= FILTER STATUS =================
        if ($request->filled('status')) {
            $data = $data->filter(function ($item) use ($request) {
                return strtolower($item->status) === strtolower($request->status);
            });
        }

        // ================= SEARCH =================
        if ($request->filled('search')) {
            $data = $data->filter(function ($item) use ($request) {
                return str_contains(
                    strtolower($item->user->name ?? ''),
                    strtolower($request->search)
                );
            });
        }

        // ================= SORT =================
        $data = $data->sortByDesc('created_at')->values();

        // ================= PAGINATION =================
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;

        $currentItems = $data->slice(
            ($currentPage - 1) * $perPage,
            $perPage
        );

        $arsip = new LengthAwarePaginator(
            $currentItems,
            $data->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query()
            ]
        );

        return view('admin.arsip.index', compact('arsip'));
    }

    // ================= PREVIEW (HTML) =================
    public function preview($jenis, $id)
{
    if ($jenis == 'PKL') {
        $data = PengajuanPkl::with('user')->findOrFail($id);
    } else {
        $data = PengajuanPenelitian::with('user')->findOrFail($id);
    }

    $pdf = Pdf::loadView('surat.template', compact('data', 'jenis'));

    return $pdf->stream('surat_'.$jenis.'.pdf');

    }

    // ================= DOWNLOAD PDF =================
    public function download($jenis, $id)
    {
        if ($jenis == 'PKL') {
            $data = PengajuanPkl::with('user')->findOrFail($id);
        } else {
            $data = PengajuanPenelitian::with('user')->findOrFail($id);
        }

        $pdf = Pdf::loadView('surat.template', compact('data', 'jenis'));

        return $pdf->download('surat_' . strtolower($jenis) . '_' . $id . '.pdf');
    }
}