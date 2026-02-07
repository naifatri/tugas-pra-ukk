<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = \App\Models\User::count();
        $totalAlat = \App\Models\Alat::count();
        $totalPeminjaman = \App\Models\Peminjaman::count();
        
        return view('admin.dashboard', compact('totalUsers', 'totalAlat', 'totalPeminjaman'));
    }

    public function kelolaUser()
    {
        // Logic user management
        return view('admin.user.index');
    }
}
