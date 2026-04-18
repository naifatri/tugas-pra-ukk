<?php

namespace App\Notifications;

use App\Models\Peminjaman;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PengajuanPeminjamanTerkirimNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected Peminjaman $peminjaman
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $jumlahItem = $this->peminjaman->detail_peminjaman->sum('jumlah');

        return [
            'title' => 'Pengajuan berhasil dikirim',
            'message' => 'Pengajuan peminjaman ' . $jumlahItem . ' item berhasil dikirim dan sedang menunggu verifikasi petugas.',
            'url' => route('peminjam.pinjaman'),
            'peminjaman_id' => $this->peminjaman->id,
            'status_pinjam' => $this->peminjaman->status_pinjam,
        ];
    }
}
