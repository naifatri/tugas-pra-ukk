<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // User stats
        $totalUsers = User::count();
        $userAktif = User::where('status_akun', 'aktif')->count();

        // Alat stats
        $totalAlat = Alat::count();
        $totalStok = Alat::sum('stok');
        $alatBaik = Alat::where('kondisi', 'baik')->count();
        $alatRusak = Alat::where('kondisi', 'rusak')->count();

        // Peminjaman stats
        $totalPeminjaman = Peminjaman::count();
        $peminjamanMenunggu = Peminjaman::where('status_pinjam', 'menunggu')->count();
        $peminjamanDisetujui = Peminjaman::where('status_pinjam', 'disetujui')->count();
        $peminjamanAktif = Peminjaman::whereIn('status_pinjam', ['disetujui', 'telat'])->count();
        $peminjamanTelat = Peminjaman::where('status_pinjam', 'telat')->count();

        // Recent activity
        $recentPeminjaman = Peminjaman::with(['user', 'detail_peminjaman.alat'])
            ->latest()
            ->limit(6)
            ->get();

        $recentLogs = LogAktivitas::latest()->limit(6)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'userAktif',
            'totalAlat',
            'totalStok',
            'alatBaik',
            'alatRusak',
            'totalPeminjaman',
            'peminjamanMenunggu',
            'peminjamanDisetujui',
            'peminjamanAktif',
            'peminjamanTelat',
            'recentPeminjaman',
            'recentLogs'
        ));
    }

    public function kelolaUser()
    {
        // Logic user management
        return view('admin.user.index');
    }
}
