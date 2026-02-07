<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Fitur: [PEMINJAM] Mengajukan Peminjaman (Create)
    public function store(Request $request)
    {
        // Logika: Peminjam mengirim form peminjaman
        // Membuat record baru di tabel 'peminjaman'
    }

    // Fitur: [ADMIN & PETUGAS] Tampilkan Semua Data Peminjaman (Index)
    public function index()
    {
        // Logika: Melihat daftar peminjaman masuk
    }

    // Fitur: [PEMINJAM] Lihat Riwayat Peminjaman Sendiri
    public function myHistory()
    {
        // Logika: Filter peminjaman berdasarkan user_id yang sedang login
    }

    // Fitur: [ADMIN & PETUGAS] Setujui Peminjaman (Update Status)
    public function approve($id)
    {
        // Logika: Mengubah status peminjaman menjadi 'Disetujui/Dipinjam'
    }

    // Fitur: [ADMIN & PETUGAS] Tolak Peminjaman (Update Status)
    public function reject($id)
    {
        // Logika: Mengubah status peminjaman menjadi 'Ditolak'
    }

    // Fitur: [ADMIN & PETUGAS] Proses Pengembalian (Update Status)
    public function returnItem($id)
    {
        // Logika: Mengubah status menjadi 'Dikembalikan' dan menambah stok alat
    }
}
