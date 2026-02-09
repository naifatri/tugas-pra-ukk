<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Alat;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Dashboard peminjam
     */
    public function index()
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())
            ->with(['detail_peminjaman.alat'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peminjam.dashboard', compact('peminjaman'));
    }

    /**
     * Daftar alat tersedia
     */
    public function daftarAlat()
    {
        $alat = Alat::where('stok', '>', 0)->get();
        return view('peminjam.alat.index', compact('alat'));
    }

    /**
     * Form peminjaman alat
     */
    public function formPinjam($id)
    {
        $alat = Alat::findOrFail($id);
        return view('peminjam.pinjam.create', compact('alat'));
    }

    /**
     * Ajukan peminjaman
     */
    public function ajukanPinjam(Request $request, $id) 
    {
        $request->validate([
            'tgl_pinjam' => 'required|date|after_or_equal:today',
            'tgl_harus_kembali' => 'required|date|after:tgl_pinjam',
            'jumlah' => 'required|integer|min:1',
        ]);

        $alat = Alat::findOrFail($id);

        if ($alat->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        DB::transaction(function () use ($request, $alat) {

            $peminjaman = Peminjaman::create([
                'user_id' => auth()->id(),
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_harus_kembali' => $request->tgl_harus_kembali,
                'status_pinjam' => 'menunggu',
                'denda' => 0,
            ]);

            DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'alat_id' => $alat->id,
                'jumlah' => $request->jumlah,
                'kondisi_awal' => $alat->kondisi,
            ]);

            LogAktivitas::storeLog(
                'Ajukan Peminjaman',
                'Peminjaman',
                'Mengajukan peminjaman alat: ' . $alat->nama_alat
            );
        });

        return redirect()->route('peminjam.alat')
            ->with('success', 'Peminjaman berhasil diajukan, menunggu persetujuan petugas.');
    }

    /**
     * ============================================================
     * DAFTAR & DETAIL PINJAMAN (DIGABUNG)
     * ============================================================
     */

    /**
     * Menampilkan daftar semua peminjaman user
     */
    public function daftarPinjaman()
    {
        $userId = auth()->id();

        $peminjaman = Peminjaman::where('user_id', $userId)
            ->with(['detail_peminjaman.alat'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'total_pinjam' => Peminjaman::where('user_id', $userId)->count(),
            'menunggu'     => Peminjaman::where('user_id', $userId)->where('status_pinjam', 'menunggu')->count(),
            'disetujui'    => Peminjaman::where('user_id', $userId)->where('status_pinjam', 'disetujui')->count(),
            'kembali'      => Peminjaman::where('user_id', $userId)
                          ->whereIn('status_pinjam', ['kembali', 'telat'])
                         ->count(),
        ];

        return view('peminjam.pinjaman.index', compact('peminjaman', 'stats'));
    }

    /**
     * Detail peminjaman tertentu
     */
    public function detailPinjaman($id)
    {
        $peminjaman = Peminjaman::with(['detail_peminjaman.alat', 'user'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('peminjam.pinjaman.show', compact('peminjaman'));
    }

    /**
     * ============================================================
     * PENGEMBALIAN ALAT
     * ============================================================
     */

    /**
     * Form pengembalian
     */
    public function formPengembalian($peminjaman_id)
    {
        $peminjaman = Peminjaman::with(['detail_peminjaman.alat', 'user'])
            ->where('id', $peminjaman_id)
            ->where('user_id', auth()->id())
            ->where('status_pinjam', 'disetujui')
            ->firstOrFail();

        $tgl_harus_kembali = Carbon::parse($peminjaman->tgl_harus_kembali);
        $tgl_sekarang = Carbon::now();

        $terlambat = $tgl_sekarang->greaterThan($tgl_harus_kembali);
        $hari_terlambat = $terlambat ? $tgl_harus_kembali->diffInDays($tgl_sekarang) : 0;

        $denda_per_hari = 5000;
        $estimasi_denda = 0;

        if ($terlambat) {
            foreach ($peminjaman->detail_peminjaman as $detail) {
                $estimasi_denda += $detail->jumlah * $denda_per_hari * $hari_terlambat;
            }
        }

        return view('peminjam.pengembalian.form', compact(
            'peminjaman',
            'terlambat',
            'hari_terlambat',
            'estimasi_denda',
            'denda_per_hari'
        ));
    }

    /**
     * Proses pengembalian
     */
    public function prosesPengembalian(Request $request, $peminjaman_id)
    {
        $request->validate([
            'kondisi_kembali' => 'required|array',
            'kondisi_kembali.*' => 'required|in:baik,rusak_ringan,rusak_berat,hilang',
            'jumlah_kembali' => 'required|array',
            'jumlah_kembali.*' => 'required|integer|min:0',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $peminjaman = Peminjaman::with('detail_peminjaman.alat')
            ->where('id', $peminjaman_id)
            ->where('user_id', auth()->id())
            ->where('status_pinjam', 'disetujui')
            ->firstOrFail();

        DB::beginTransaction();

        try {
            $tgl_kembali_real = Carbon::now();
            $tgl_harus_kembali = Carbon::parse($peminjaman->tgl_harus_kembali);

            $terlambat = $tgl_kembali_real->greaterThan($tgl_harus_kembali);
            $hari_terlambat = $terlambat ? $tgl_harus_kembali->diffInDays($tgl_kembali_real) : 0;

            $total_denda = 0;
            $denda_per_hari = 5000;

            foreach ($peminjaman->detail_peminjaman as $detail) {

                $kondisi = $request->kondisi_kembali[$detail->id];
                $jumlah  = $request->jumlah_kembali[$detail->id];

                if ($jumlah > $detail->jumlah) {
                    throw new \Exception('Jumlah kembali melebihi jumlah pinjam');
                }

                if ($terlambat) {
                    $total_denda += $jumlah * $denda_per_hari * $hari_terlambat;
                }

                if ($kondisi == 'rusak_ringan') {
                    $total_denda += 10000 * $jumlah;
                } elseif ($kondisi == 'rusak_berat') {
                    $total_denda += 50000 * $jumlah;
                } elseif ($kondisi == 'hilang') {
                    $total_denda += ($detail->alat->harga ?? 100000) * $jumlah;
                }

                $detail->update([
                    'jumlah_kembali' => $jumlah,
                    'kondisi_kembali' => $kondisi,
                ]);

                if ($kondisi != 'hilang' && $jumlah > 0) {
                    $detail->alat->increment('stok', $jumlah);
                }
            }

            $peminjaman->update([
                'status_pinjam' => $terlambat ? 'telat' : 'kembali',
                'tgl_kembali_real' => $tgl_kembali_real,
                'denda' => $total_denda,
                'keterangan_denda' => $request->keterangan,
            ]);

            LogAktivitas::storeLog(
                'Pengembalian Alat',
                'Peminjaman',
                'Pengembalian peminjaman #' . $peminjaman->id
            );

            DB::commit();

            return redirect()->route('dashboard.peminjam')
                ->with('success', 'Pengembalian berhasil. Denda: Rp ' . number_format($total_denda));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
