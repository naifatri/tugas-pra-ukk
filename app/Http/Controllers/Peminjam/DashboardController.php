<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjaman = \App\Models\Peminjaman::where('user_id', auth()->id())
            ->with(['detail_peminjaman.alat'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peminjam.dashboard', compact('peminjaman'));
    }

    public function daftarAlat()
    {
        $alat = \App\Models\Alat::where('stok', '>', 0)->get();
        return view('peminjam.alat.index', compact('alat'));
    }

    public function formPinjam($id)
    {
        $alat = \App\Models\Alat::findOrFail($id);
        return view('peminjam.pinjam.create', compact('alat'));
    }

    public function ajukanPinjam(Request $request, $id) 
    {
        $request->validate([
            'tgl_pinjam' => 'required|date|after_or_equal:today',
            'tgl_harus_kembali' => 'required|date|after:tgl_pinjam',
            'jumlah' => 'required|integer|min:1',
        ]);

        $alat = \App\Models\Alat::findOrFail($id);

        if ($alat->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        // DB Transaction to ensure data integrity
        \Illuminate\Support\Facades\DB::transaction(function () use ($request, $alat) {
            $peminjaman = \App\Models\Peminjaman::create([
                'user_id' => auth()->id(),
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_harus_kembali' => $request->tgl_harus_kembali,
                'status_pinjam' => 'menunggu',
                'denda' => 0,
            ]);

            \App\Models\DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'alat_id' => $alat->id,
                'jumlah' => $request->jumlah,
                'kondisi_awal' => $alat->kondisi, // Assuming borrowing current condition
            ]);

            \App\Models\LogAktivitas::storeLog('Ajukan Peminjaman', 'Peminjaman', 'Mengajukan peminjaman alat: ' . $alat->nama_alat);
        });
        
        return redirect()->route('peminjam.alat')->with('success', 'Peminjaman berhasil diajukan, menunggu persetujuan petugas.');
    }
}
