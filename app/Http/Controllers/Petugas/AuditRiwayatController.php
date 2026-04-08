<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class AuditRiwayatController extends Controller
{
    /**
     * Display the audit history with borrowing statistics
     */
    public function index(Request $request)
    {
        // Get all tools with their borrowing statistics
        $alats = Alat::with('kategori')
            ->get()
            ->map(function($alat) {
                // Count total borrowings for this tool (completed/returned)
                $totalPinjam = DetailPeminjaman::where('alat_id', $alat->id)
                    ->whereHas('peminjaman', function($query) {
                        $query->where('status_pinjam', 'kembali');
                    })
                    ->count();
                
                // Count active borrowings (currently borrowed)
                $pinjamAktif = DetailPeminjaman::where('alat_id', $alat->id)
                    ->whereHas('peminjaman', function($query) {
                        $query->whereIn('status_pinjam', ['disetujui', 'telat']);
                    })
                    ->count();
                
                // Get last borrowing date
                $lastBorrow = DetailPeminjaman::where('alat_id', $alat->id)
                    ->whereHas('peminjaman', function($query) {
                        $query->whereIn('status_pinjam', ['disetujui', 'telat', 'kembali']);
                    })
                    ->latest('created_at')
                    ->first();

                return (object)[
                    'id' => $alat->id,
                    'nama_alat' => $alat->nama_alat,
                    'kode_alat' => $alat->kode_alat,
                    'kategori' => $alat->kategori->nama_kategori ?? '-',
                    'kondisi' => $alat->kondisi,
                    'stok' => $alat->stok,
                    'total_pinjam' => $totalPinjam,
                    'pinjam_aktif' => $pinjamAktif,
                    'last_borrow' => $lastBorrow ? $lastBorrow->peminjaman->tgl_pinjam : null,
                ];
            });

        // Apply sorting
        $sortBy = $request->get('sort', 'total_pinjam');
        $sortOrder = $request->get('order', 'desc');
        
        $alats = $alats->sortBy(function($alat) use ($sortBy) {
            return $alat->$sortBy;
        }, SORT_REGULAR, $sortOrder === 'desc');

        // Apply filtering
        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);
            $alats = $alats->filter(function($alat) use ($search) {
                return stripos($alat->nama_alat, $search) !== false 
                    || stripos($alat->kode_alat, $search) !== false
                    || stripos($alat->kategori, $search) !== false;
            });
        }

        // Calculate statistics
        $stats = [
            'total_alat' => Alat::count(),
            'total_pinjam_semua' => DetailPeminjaman::whereHas('peminjaman', function($query) {
                $query->where('status_pinjam', 'kembali');
            })->count(),
            'pinjam_aktif_semua' => DetailPeminjaman::whereHas('peminjaman', function($query) {
                $query->whereIn('status_pinjam', ['disetujui', 'telat']);
            })->count(),
        ];

        // Check if this is a print request
        if ($request->get('print') == 'true') {
            return view('petugas.audit_riwayat.print', [
                'alats' => $alats,
                'stats' => $stats,
            ]);
        }

        // Paginate the collection manually
        $perPage = 20;
        $page = Paginator::resolveCurrentPage();
        $items = $alats->values()->all();
        
        $alats = new LengthAwarePaginator(
            $items = array_slice($items, ($page - 1) * $perPage, $perPage),
            count($alats),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('petugas.audit_riwayat.index', [
            'alats' => $alats,
            'stats' => $stats,
        ]);
    }

    /**
     * Show detail riwayat peminjaman for a specific tool
     */
    public function show($id)
    {
        $alat = Alat::findOrFail($id);
        
        // Get all borrowing history for this tool
        $riwayat = DetailPeminjaman::where('alat_id', $id)
            ->with(['peminjaman' => function($query) {
                $query->with('user');
            }])
            ->latest('created_at')
            ->paginate(15);

        return view('petugas.audit_riwayat.show', [
            'alat' => $alat,
            'riwayat' => $riwayat,
        ]);
    }

    /**
     * Export audit history as PDF
     */
    public function export(Request $request)
    {
        // Get all tools with their borrowing statistics
        $alats = Alat::with('kategori')
            ->get()
            ->map(function($alat) {
                $totalPinjam = DetailPeminjaman::where('alat_id', $alat->id)
                    ->whereHas('peminjaman', function($query) {
                        $query->where('status_pinjam', 'kembali');
                    })
                    ->count();
                
                $pinjamAktif = DetailPeminjaman::where('alat_id', $alat->id)
                    ->whereHas('peminjaman', function($query) {
                        $query->whereIn('status_pinjam', ['disetujui', 'telat']);
                    })
                    ->count();

                return (object)[
                    'nama_alat' => $alat->nama_alat,
                    'kode_alat' => $alat->kode_alat,
                    'kategori' => $alat->kategori->nama_kategori ?? '-',
                    'kondisi' => $alat->kondisi,
                    'total_pinjam' => $totalPinjam,
                    'pinjam_aktif' => $pinjamAktif,
                ];
            });

        $stats = [
            'total_alat' => Alat::count(),
            'total_pinjam_semua' => DetailPeminjaman::whereHas('peminjaman', function($query) {
                $query->where('status_pinjam', 'kembali');
            })->count(),
            'pinjam_aktif_semua' => DetailPeminjaman::whereHas('peminjaman', function($query) {
                $query->whereIn('status_pinjam', ['disetujui', 'telat']);
            })->count(),
        ];

        // Generate PDF (requires barryvdh/laravel-dompdf package)
        // For now, returning the view for print
        return view('petugas.audit_riwayat.print', [
            'alats' => $alats,
            'stats' => $stats,
        ]);
    }
}
