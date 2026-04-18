<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Peminjam\DashboardController;

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
    return redirect()->route('login');
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
    Route::delete('/log-aktivitas', [App\Http\Controllers\Admin\LogAktivitasController::class, 'destroyAll'])->name('log-aktivitas.destroyAll');
    
    // Audit History Routes
    Route::get('/audit-riwayat', [App\Http\Controllers\Admin\AuditRiwayatController::class, 'index'])->name('audit-riwayat.index');
    Route::get('/audit-riwayat/export/print', [App\Http\Controllers\Admin\AuditRiwayatController::class, 'export'])->name('audit-riwayat.export');
    Route::get('/audit-riwayat/{id}', [App\Http\Controllers\Admin\AuditRiwayatController::class, 'show'])->whereNumber('id')->name('audit-riwayat.show');
});

// Petugas Dashboard
Route::middleware(['auth', 'verified', 'role:petugas,admin'])->group(function () {
    Route::get('/petugas/dashboard', [App\Http\Controllers\Petugas\DashboardController::class, 'index'])->name('dashboard.petugas');
    Route::get('/petugas/permintaan', [App\Http\Controllers\Petugas\DashboardController::class, 'permintaanPeminjaman'])->name('petugas.permintaan');
    Route::post('/petugas/verifikasi/{id}', [App\Http\Controllers\Petugas\DashboardController::class, 'verifikasiPeminjaman'])->name('petugas.verifikasi');
    Route::get('/petugas/aktif', [App\Http\Controllers\Petugas\DashboardController::class, 'peminjamanAktif'])->name('petugas.aktif');
    Route::get('/petugas/kembali/{id}', [App\Http\Controllers\Petugas\DashboardController::class, 'formPengembalian'])->name('petugas.kembali');
    Route::post('/petugas/kembali/{id}', [App\Http\Controllers\Petugas\DashboardController::class, 'prosesPengembalian'])->name('petugas.proses_kembali');
    Route::get('/petugas/riwayat', [App\Http\Controllers\Petugas\DashboardController::class, 'riwayatPengembalian'])->name('petugas.riwayat');
    Route::get('/petugas/riwayat/{id}', [App\Http\Controllers\Petugas\DashboardController::class, 'detailRiwayatPengembalian'])->whereNumber('id')->name('petugas.riwayat.detail');
    Route::get('/petugas/pelunasan/{id}', [App\Http\Controllers\Petugas\DashboardController::class, 'formPelunasanDenda'])->whereNumber('id')->name('petugas.pelunasan.form');
    Route::post('/petugas/pelunasan/{id}', [App\Http\Controllers\Petugas\DashboardController::class, 'prosesPelunasanDenda'])->whereNumber('id')->name('petugas.pelunasan.proses');
    Route::post('/petugas/riwayat/{id}/kirim-notifikasi', [App\Http\Controllers\Petugas\DashboardController::class, 'kirimNotifikasiPengembalian'])->whereNumber('id')->name('petugas.riwayat.kirim-notifikasi');
    
    // Audit History Routes
    Route::get('/petugas/audit-riwayat', [App\Http\Controllers\Petugas\AuditRiwayatController::class, 'index'])->name('petugas.audit-riwayat.index');
    Route::get('/petugas/audit-riwayat/export/print', [App\Http\Controllers\Petugas\AuditRiwayatController::class, 'export'])->name('petugas.audit-riwayat.export');
    Route::get('/petugas/audit-riwayat/{id}', [App\Http\Controllers\Petugas\AuditRiwayatController::class, 'show'])->whereNumber('id')->name('petugas.audit-riwayat.show');
    
    // Laporan Routes
    Route::get('/petugas/laporan', [App\Http\Controllers\Petugas\LaporanController::class, 'index'])->name('petugas.laporan.index');
    Route::get('/petugas/laporan/cetak', [App\Http\Controllers\Petugas\LaporanController::class, 'cetak'])->name('petugas.laporan.cetak');
});

// Peminjam Dashboard
Route::middleware(['auth', 'verified', 'role:peminjam'])->group(function () {
    Route::get('/peminjam/dashboard', [App\Http\Controllers\Peminjam\DashboardController::class, 'index'])->name('dashboard.peminjam');
    Route::get('/peminjam/alat', [App\Http\Controllers\Peminjam\DashboardController::class, 'daftarAlat'])->name('peminjam.alat');
    Route::get('/peminjam/pinjam/{id}', [App\Http\Controllers\Peminjam\DashboardController::class, 'formPinjam'])->name('peminjam.pinjam');
    Route::post('/peminjam/pinjam/{id}', [App\Http\Controllers\Peminjam\DashboardController::class, 'ajukanPinjam'])->name('peminjam.ajukan');

  // Daftar pinjaman
    Route::get('/peminjam/pinjaman', [DashboardController::class, 'daftarPinjaman'])
        ->name('peminjam.pinjaman');

    // Detail pinjaman
    Route::get('/peminjam/pinjaman/{id}', [DashboardController::class, 'detailPinjaman'])
        ->name('peminjam.pinjaman.show');

    // Pengembalian
    Route::get('/peminjam/pengembalian/{peminjaman_id}', [DashboardController::class, 'formPengembalian'])
        ->name('peminjam.pengembalian');
    Route::post('/peminjam/pengembalian/{peminjaman_id}', [DashboardController::class, 'prosesPengembalian'])
        ->name('peminjam.pengembalian.proses');
});

// Profile management routes (added by Breeze by default)
Route::middleware('auth')->group(function () {
    Route::post('/notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes (login, register, etc.) are included via a helper file
require __DIR__.'/auth.php';
