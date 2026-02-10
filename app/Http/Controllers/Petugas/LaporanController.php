<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', date('Y-m'));
        $date = Carbon::parse($month);
        
        $query = Peminjaman::with(['user', 'detail_peminjaman.alat'])
            ->whereYear('tgl_pinjam', $date->year)
            ->whereMonth('tgl_pinjam', $date->month)
            ->orderBy('tgl_pinjam', 'asc');

        // Calculate summary stats before pagination
        $stats = [
            'total' => (clone $query)->count(),
            'total_denda' => (clone $query)->sum('denda'),
            'status_aktif' => (clone $query)->where('status_pinjam', '!=', 'kembali')->count(),
        ];

        $peminjaman = $query->paginate(10)->withQueryString();

        return view('petugas.laporan.index', compact('peminjaman', 'month', 'stats'));
    }

    public function cetak(Request $request)
    {
        $month = $request->get('month', date('Y-m'));
        $date = Carbon::parse($month);
        
        $peminjaman = Peminjaman::with(['user', 'detail_peminjaman.alat'])
            ->whereYear('tgl_pinjam', $date->year)
            ->whereMonth('tgl_pinjam', $date->month)
            ->orderBy('tgl_pinjam', 'asc')
            ->get();

        return view('petugas.laporan.print', compact('peminjaman', 'month'));
    }
}
