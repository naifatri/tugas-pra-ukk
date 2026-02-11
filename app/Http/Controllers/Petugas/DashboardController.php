<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $permintaanCount = \App\Models\Peminjaman::where('status_pinjam', 'menunggu')->count();
        $aktifCount = \App\Models\Peminjaman::whereIn('status_pinjam', ['disetujui', 'telat'])->count();
        return view('petugas.dashboard', compact('permintaanCount', 'aktifCount'));
    }

    public function permintaanPeminjaman()
    {
        $peminjaman = \App\Models\Peminjaman::where('status_pinjam', 'menunggu')
            ->with(['user', 'detail_peminjaman.alat'])
            ->orderBy('tgl_pinjam', 'asc')
            ->paginate(10);
            
        return view('petugas.peminjaman.permintaan', compact('peminjaman'));
    }

    public function verifikasiPeminjaman(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $peminjaman = \App\Models\Peminjaman::with('detail_peminjaman.alat')->findOrFail($id);

        if ($request->status == 'disetujui') {
            // Check stock availability
            foreach ($peminjaman->detail_peminjaman as $detail) {
                if ($detail->alat->stok < $detail->jumlah) {
                    return redirect()->back()->with('error', 'Stok alat ' . $detail->alat->nama_alat . ' tidak mencukupi.');
                }
            }

            // Deduct stock
            foreach ($peminjaman->detail_peminjaman as $detail) {
                $detail->alat->decrement('stok', $detail->jumlah);
            }
        }

        $peminjaman->update([
            'status_pinjam' => $request->status,
            'petugas_id' => auth()->id(),
        ]);

        \App\Models\LogAktivitas::storeLog('Verifikasi Peminjaman', 'Peminjaman', 'Memverifikasi peminjaman (ID: ' . $id . ') dengan status: ' . $request->status);

        return redirect()->back()->with('success', 'Peminjaman berhasil ' . $request->status);
    }

    public function peminjamanAktif()
    {
        $peminjaman = \App\Models\Peminjaman::whereIn('status_pinjam', ['disetujui', 'telat'])
            ->with(['user', 'detail_peminjaman.alat'])
            ->orderBy('tgl_harus_kembali', 'asc')
            ->paginate(10);
            
        return view('petugas.peminjaman.aktif', compact('peminjaman'));
    }

    public function formPengembalian($id)
    {
            $peminjaman = \App\Models\Peminjaman::with([
                'user',
                'detail_peminjaman.alat'
            ])->findOrFail($id);

            return view('petugas.peminjaman.kembali', compact('peminjaman'));
        }

    public function prosesPengembalian(Request $request, $id)
    {
        $request->validate([
            'tgl_kembali_real' => 'required|date',
            'kondisi_kembali' => 'required|array',
            'kondisi_kembali.*' => 'required|in:baik,rusak,hilang',
        ]);

        $peminjaman = \App\Models\Peminjaman::with('detail_peminjaman.alat')->findOrFail($id);
        $peminjaman->tgl_kembali_real = $request->tgl_kembali_real;

        // Calculate fine
        $tgl_seharusnya = \Carbon\Carbon::parse($peminjaman->tgl_harus_kembali);
        $tgl_kembali = \Carbon\Carbon::parse($request->tgl_kembali_real);
        
        $denda = 0;
        if ($tgl_kembali->gt($tgl_seharusnya)) {
            $days = $tgl_kembali->diffInDays($tgl_seharusnya);
            $denda = $days * 1000; // Example fine: 1000 per day
            $peminjaman->keterangan_denda = "Terlambat $days hari";
        }

        $peminjaman->denda = $denda;
        $peminjaman->status_pinjam = 'kembali';
        $peminjaman->save();

        \App\Models\LogAktivitas::storeLog('Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: ' . $id . '). Denda: ' . $denda);

        // Update detail and stock
        foreach ($peminjaman->detail_peminjaman as $detail) {
            $kondisi = $request->kondisi_kembali[$detail->id];
            $detail->update([
                'tgl_kembali' => $request->tgl_kembali_real, // If column exists, otherwise skip
                'kondisi_kembali' => $kondisi,
                'jumlah_kembali' => $detail->jumlah, // Assuming full return for now
            ]);

            // Increment stock if item is returned (not lost)
            if ($kondisi != 'hilang') {
                $detail->alat->increment('stok', $detail->jumlah);
            }
        }

        return redirect()->route('petugas.aktif')->with('success', 'Pengembalian berhasil diproses. Denda: Rp ' . number_format($denda));
    }

    public function riwayatPengembalian()
    {
        $query = \App\Models\Peminjaman::where('status_pinjam', 'kembali')
            ->with(['user', 'detail_peminjaman.alat'])
            ->orderBy('tgl_kembali_real', 'desc');

        // Calculate summary stats before pagination
        $stats = [
            'total' => (clone $query)->count(),
            'total_denda' => (clone $query)->sum('denda'),
            'total_telat' => (clone $query)->where('denda', '>', 0)->count(),
        ];

        $peminjaman = $query->paginate(10);
            
        return view('petugas.peminjaman.riwayat', compact('peminjaman', 'stats'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'denda' => 'nullable|numeric|min:0'
        ]);

        $peminjaman = \App\Models\Peminjaman::with('detail_peminjaman.alat')->findOrFail($id);

        $tgl_kembali = now();
        $denda = $request->denda ?? 0;

        $peminjaman->update([
            'tgl_kembali_real' => $tgl_kembali,
            'status_pinjam'    => 'kembali',
            'denda'            => $denda,
            'petugas_id'       => auth()->id(),
            'keterangan_denda' => $denda > 0 ? 'Denda manual petugas' : null
        ]);

        // kembalikan stok
        foreach ($peminjaman->detail_peminjaman as $detail) {
            $detail->update([
                'tgl_kembali'     => $tgl_kembali,
                'jumlah_kembali'  => $detail->jumlah,
                'kondisi_kembali' => 'baik',
            ]);

            $detail->alat->increment('stok', $detail->jumlah);
        }

        return redirect()
            ->route('petugas.aktif')
            ->with('success', 'Pengembalian berhasil. Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }

}
