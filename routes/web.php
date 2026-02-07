<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// The main dashboard route, accessible only to authenticated users
// The main dashboard route, accessible only to authenticated users
Route::get('/dashboard', function () {
    // Redirect based on role if accessed directly
    $role = auth()->user()->role->nama_role;
    if ($role === 'admin') {
        return redirect()->route('dashboard.admin');
    } elseif ($role === 'petugas') {
        return redirect()->route('dashboard.petugas');
    } elseif ($role === 'peminjam') {
        return redirect()->route('dashboard.peminjam');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Dashboard
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.admin');
    
    // Resource Routes
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
    Route::resource('kategoris', App\Http\Controllers\Admin\KategoriController::class);
    Route::resource('alats', App\Http\Controllers\Admin\AlatController::class);
    Route::get('/log-aktivitas', [App\Http\Controllers\Admin\LogAktivitasController::class, 'index'])->name('log-aktivitas.index');
});

// Petugas Dashboard
Route::middleware(['auth', 'verified', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [App\Http\Controllers\Petugas\DashboardController::class, 'index'])->name('dashboard.petugas');
    Route::get('/petugas/permintaan', [App\Http\Controllers\Petugas\DashboardController::class, 'permintaanPeminjaman'])->name('petugas.permintaan');
    Route::post('/petugas/verifikasi/{id}', [App\Http\Controllers\Petugas\DashboardController::class, 'verifikasiPeminjaman'])->name('petugas.verifikasi');
    Route::get('/petugas/aktif', [App\Http\Controllers\Petugas\DashboardController::class, 'peminjamanAktif'])->name('petugas.aktif');
    Route::get('/petugas/kembali/{id}', [App\Http\Controllers\Petugas\DashboardController::class, 'formPengembalian'])->name('petugas.kembali');
    Route::post('/petugas/kembali/{id}', [App\Http\Controllers\Petugas\DashboardController::class, 'prosesPengembalian'])->name('petugas.proses_kembali');
});

// Peminjam Dashboard
Route::middleware(['auth', 'verified', 'role:peminjam'])->group(function () {
    Route::get('/peminjam/dashboard', [App\Http\Controllers\Peminjam\DashboardController::class, 'index'])->name('dashboard.peminjam');
    Route::get('/peminjam/alat', [App\Http\Controllers\Peminjam\DashboardController::class, 'daftarAlat'])->name('peminjam.alat');
    Route::get('/peminjam/pinjam/{id}', [App\Http\Controllers\Peminjam\DashboardController::class, 'formPinjam'])->name('peminjam.pinjam');
    Route::post('/peminjam/pinjam/{id}', [App\Http\Controllers\Peminjam\DashboardController::class, 'ajukanPinjam'])->name('peminjam.ajukan');
});

// Profile management routes (added by Breeze by default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes (login, register, etc.) are included via a helper file
require __DIR__.'/auth.php';
