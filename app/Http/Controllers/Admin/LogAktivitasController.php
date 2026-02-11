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

        // Get global statistics (tidak terpengaruh filter)
        $totalLogs = \App\Models\LogAktivitas::count();
        
        // Create/Tambah actions (mencari kata 'Tambah' atau 'Ajukan')
        $createCount = \App\Models\LogAktivitas::where(function($q) {
            $q->where('aksi', 'like', '%Tambah%')
              ->orWhere('aksi', 'like', '%Ajukan%')
              ->orWhere('aksi', 'like', '%create%')
              ->orWhere('aksi', 'like', '%store%');
        })->count();
        
        // Update/Edit actions (mencari kata 'Edit', 'Update', 'Verifikasi', 'Proses', atau 'Pengembalian')
        $updateCount = \App\Models\LogAktivitas::where(function($q) {
            $q->where('aksi', 'like', '%Edit%')
              ->orWhere('aksi', 'like', '%Update%')
              ->orWhere('aksi', 'like', '%Verifikasi%')
              ->orWhere('aksi', 'like', '%Proses%')
              ->orWhere('aksi', 'like', '%Pengembalian%')
              ->orWhere('aksi', 'like', '%update%')
              ->orWhere('aksi', 'like', '%edit%');
        })->count();
        
        // Delete/Hapus actions (mencari kata 'Hapus')
        $deleteCount = \App\Models\LogAktivitas::where(function($q) {
            $q->where('aksi', 'like', '%Hapus%')
              ->orWhere('aksi', 'like', '%delete%')
              ->orWhere('aksi', 'like', '%destroy%');
        })->count();
        
        // Session actions (login/logout)
        $sessionCount = \App\Models\LogAktivitas::where(function($q) {
            $q->where('aksi', 'like', '%Login%')
              ->orWhere('aksi', 'like', '%Logout%')
              ->orWhere('aksi', 'like', '%login%')
              ->orWhere('aksi', 'like', '%logout%');
        })->count();

        $logs = $query->paginate(10)->withQueryString();

        return view('admin.log_aktivitas.index', compact('logs', 'totalLogs', 'createCount', 'updateCount', 'deleteCount', 'sessionCount'));
    }

    public function destroyAll()
    {
        \App\Models\LogAktivitas::truncate();
        return redirect()->route('log-aktivitas.index')->with('success', 'Semua log aktivitas berhasil dihapus.');
    }
}

