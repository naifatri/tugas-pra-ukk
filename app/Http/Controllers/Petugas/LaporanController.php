<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $filters = $this->getFilters($request);
        $alatOptions = Alat::orderBy('nama_alat')->get(['id', 'nama_alat', 'kode_alat']);

        $transaksiQuery = Peminjaman::query()
            ->when($filters['date_from'], function ($query, $dateFrom) {
                $query->whereDate('tgl_pinjam', '>=', $dateFrom);
            })
            ->when($filters['date_to'], function ($query, $dateTo) {
                $query->whereDate('tgl_pinjam', '<=', $dateTo);
            })
            ->when($filters['alat_id'], function ($query, $alatId) {
                $query->whereHas('detail_peminjaman', function ($detailQuery) use ($alatId) {
                    $detailQuery->where('alat_id', $alatId);
                });
            });

        $detailQuery = DetailPeminjaman::query()
            ->select('detail_peminjaman.*')
            ->join('peminjaman', 'detail_peminjaman.peminjaman_id', '=', 'peminjaman.id')
            ->with([
                'alat:id,nama_alat,kode_alat',
                'peminjaman.user:id,nama_lengkap,username',
            ])
            ->when($filters['alat_id'], function ($query, $alatId) {
                $query->where('detail_peminjaman.alat_id', $alatId);
            })
            ->when($filters['date_from'], function ($query, $dateFrom) {
                $query->whereDate('peminjaman.tgl_pinjam', '>=', $dateFrom);
            })
            ->when($filters['date_to'], function ($query, $dateTo) {
                $query->whereDate('peminjaman.tgl_pinjam', '<=', $dateTo);
            })
            ->orderBy('peminjaman.' . $filters['sort'], $filters['order'])
            ->orderBy('detail_peminjaman.id', 'desc');

        $stats = [
            'total_peminjaman' => (clone $transaksiQuery)->count(),
            'total_detail' => (clone $detailQuery)->count(),
            'total_unit' => (clone $detailQuery)->sum('detail_peminjaman.jumlah'),
        ];

        $details = $detailQuery->paginate(15)->withQueryString();

        return view('petugas.laporan.index', compact('details', 'stats', 'filters', 'alatOptions'));
    }

    public function cetak(Request $request)
    {
        $filters = $this->getFilters($request);
        $selectedAlat = $filters['alat_id']
            ? Alat::select('id', 'nama_alat', 'kode_alat')->find($filters['alat_id'])
            : null;

        $transaksiQuery = Peminjaman::query()
            ->when($filters['date_from'], function ($query, $dateFrom) {
                $query->whereDate('tgl_pinjam', '>=', $dateFrom);
            })
            ->when($filters['date_to'], function ($query, $dateTo) {
                $query->whereDate('tgl_pinjam', '<=', $dateTo);
            })
            ->when($filters['alat_id'], function ($query, $alatId) {
                $query->whereHas('detail_peminjaman', function ($detailQuery) use ($alatId) {
                    $detailQuery->where('alat_id', $alatId);
                });
            });

        $details = DetailPeminjaman::query()
            ->select('detail_peminjaman.*')
            ->join('peminjaman', 'detail_peminjaman.peminjaman_id', '=', 'peminjaman.id')
            ->with([
                'alat:id,nama_alat,kode_alat',
                'peminjaman.user:id,nama_lengkap,username',
            ])
            ->when($filters['alat_id'], function ($query, $alatId) {
                $query->where('detail_peminjaman.alat_id', $alatId);
            })
            ->when($filters['date_from'], function ($query, $dateFrom) {
                $query->whereDate('peminjaman.tgl_pinjam', '>=', $dateFrom);
            })
            ->when($filters['date_to'], function ($query, $dateTo) {
                $query->whereDate('peminjaman.tgl_pinjam', '<=', $dateTo);
            })
            ->orderBy('peminjaman.' . $filters['sort'], $filters['order'])
            ->orderBy('detail_peminjaman.id', 'desc')
            ->get();

        $stats = [
            'total_peminjaman' => (clone $transaksiQuery)->count(),
            'total_detail' => $details->count(),
            'total_unit' => $details->sum('jumlah'),
        ];

        return view('petugas.laporan.print', compact('details', 'stats', 'filters', 'selectedAlat'));
    }

    private function getFilters(Request $request): array
    {
        $sort = in_array($request->get('sort'), ['tgl_pinjam', 'tgl_kembali_real'], true)
            ? $request->get('sort')
            : 'tgl_pinjam';

        return [
            'alat_id' => $request->filled('alat_id') ? (int) $request->alat_id : null,
            'date_from' => $request->filled('date_from')
                ? Carbon::parse($request->date_from)->toDateString()
                : null,
            'date_to' => $request->filled('date_to')
                ? Carbon::parse($request->date_to)->toDateString()
                : null,
            'sort' => $sort,
            'order' => $request->get('order') === 'asc' ? 'asc' : 'desc',
        ];
    }
}
