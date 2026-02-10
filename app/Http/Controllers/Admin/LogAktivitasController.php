<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
     // Fitur: Lihat Riwayat Aktivitas
    public function index(Request $request)
    {
        $query = \App\Models\LogAktivitas::with('user')->latest();

        // Filtering
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('aksi', 'like', "%$search%")
                  ->orWhere('modul', 'like', "%$search%")
                  ->orWhere('detail_teks', 'like', "%$search%")
                  ->orWhereHas('user', function($qu) use ($search) {
                      $qu->where('username', 'like', "%$search%");
                  });
            });
        }

        if ($request->has('aksi') && $request->aksi != '') {
            $query->where('aksi', $request->aksi);
        }

        if ($request->has('modul') && $request->modul != '') {
            $query->where('modul', $request->modul);
        }

        // Get dynamic counts before pagination
        $statsQuery = clone $query;
        $totalLogs = $statsQuery->count();
        $createCount = (clone $statsQuery)->where(function($q) {
            $q->where('aksi', 'like', '%create%')->orWhere('aksi', 'like', '%store%');
        })->count();
        $updateCount = (clone $statsQuery)->where(function($q) {
            $q->where('aksi', 'like', '%update%')->orWhere('aksi', 'like', '%edit%');
        })->count();
        $deleteCount = (clone $statsQuery)->where(function($q) {
            $q->where('aksi', 'like', '%delete%')->orWhere('aksi', 'like', '%destroy%');
        })->count();
        $sessionCount = (clone $statsQuery)->whereIn('aksi', ['login', 'logout'])->count();

        $logs = $query->paginate(10)->withQueryString();

        return view('admin.log_aktivitas.index', compact('logs', 'totalLogs', 'createCount', 'updateCount', 'deleteCount', 'sessionCount'));
    }

    public function destroyAll()
    {
        \App\Models\LogAktivitas::truncate();
        return redirect()->route('log-aktivitas.index')->with('success', 'Semua log aktivitas berhasil dihapus.');
    }
}

