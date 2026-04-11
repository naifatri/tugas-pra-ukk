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
            foreach ($peminjaman->detail_peminjaman as $detail) {
                if ($detail->alat->stok < $detail->jumlah) {
                    return redirect()->back()->with('error', 'Stok alat ' . $detail->alat->nama_alat . ' tidak mencukupi.');
                }
            }

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
            'kondisi_kembali.*' => 'required|in:baik,rusak ringan,rusak berat,hilang',
            'deskripsi_kondisi_kembali' => 'nullable|array',
            'tipe_denda' => 'required|in:terlambat,kerusakan_lainnya',
            'denda' => 'nullable|numeric|min:0',
        ]);

        $peminjaman = \App\Models\Peminjaman::with('detail_peminjaman.alat')->findOrFail($id);

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $peminjaman->tgl_kembali_real = $request->tgl_kembali_real;
            $peminjaman->petugas_id = auth()->id();

            $denda = (int) ($request->denda ?? 0);
            $keterangan_denda = null;

            if ($denda > 0) {
                $keterangan_denda = $request->tipe_denda === 'terlambat'
                    ? 'Denda terlambat'
                    : 'Denda kerusakan/lainnya';
            }

            $peminjaman->denda = $denda;
            $peminjaman->keterangan_denda = $keterangan_denda;
            $peminjaman->status_pinjam = 'kembali';
            $peminjaman->save();

            foreach ($peminjaman->detail_peminjaman as $detail) {
                $kondisi = $request->kondisi_kembali[$detail->id] ?? null;
                $deskripsi = $request->deskripsi_kondisi_kembali[$detail->id] ?? null;

                if (!$kondisi) {
                    throw new \Exception('Kondisi alat ' . $detail->alat->nama_alat . ' tidak ditemukan.');
                }

                $detail->update([
                    'kondisi_kembali' => $kondisi,
                    'deskripsi_kondisi_kembali' => $deskripsi,
                    'jumlah_kembali' => $detail->jumlah,
                ]);

                if ($kondisi != 'hilang') {
                    $detail->alat->increment('stok', $detail->jumlah);
                }
            }

            \App\Models\LogAktivitas::storeLog('Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: ' . $id . '). Denda: Rp ' . number_format($denda) . '. Tipe: ' . $request->tipe_denda . '. Petugas: ' . auth()->user()->nama_lengkap);

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('petugas.aktif')->with('success', 'Pengembalian berhasil diproses. Denda: Rp ' . number_format($denda));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Log::error('Error processing pengembalian: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal memproses pengembalian: ' . $e->getMessage()])->withInput();
        }
    }

    public function riwayatPengembalian()
    {
        $query = \App\Models\Peminjaman::where('status_pinjam', 'kembali')
            ->with(['user', 'petugas', 'detail_peminjaman.alat'])
            ->orderBy('tgl_kembali_real', 'desc');

        $stats = [
            'total' => (clone $query)->count(),
            'total_denda' => (clone $query)->sum('denda'),
            'total_telat' => (clone $query)->where('denda', '>', 0)->count(),
        ];

        $peminjaman = $query->paginate(10);

        return view('petugas.peminjaman.riwayat', compact('peminjaman', 'stats'));
    }

    public function detailRiwayatPengembalian($id)
    {
        $peminjaman = \App\Models\Peminjaman::with([
            'user',
            'petugas',
            'detail_peminjaman.alat'
        ])->where('status_pinjam', 'kembali')->findOrFail($id);

        return view('petugas.peminjaman.detail-riwayat', compact('peminjaman'));
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

        foreach ($peminjaman->detail_peminjaman as $detail) {
            $detail->update([
                'jumlah_kembali'  => $detail->jumlah,
                'kondisi_kembali' => 'baik',
            ]);

            $detail->alat->increment('stok', $detail->jumlah);
        }

        \App\Models\LogAktivitas::storeLog('Proses Pengembalian', 'Peminjaman', 'Memproses pengembalian (ID: ' . $id . '). Denda: ' . $denda . '. Petugas: ' . auth()->user()->nama_lengkap);

        return redirect()
            ->route('petugas.aktif')
            ->with('success', 'Pengembalian berhasil. Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }
}
