<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
     // Fitur: Lihat Riwayat Aktivitas
    public function index()
    {
        $logs = \App\Models\LogAktivitas::with('user')->latest()->paginate(10);
        return view('admin.log_aktivitas.index', compact('logs'));
    }
}
