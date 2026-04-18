<?php

namespace App\Notifications;

use App\Models\Peminjaman;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PeminjamanBaruNotification extends Notification
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
        $namaPeminjam = $this->peminjaman->user?->nama_lengkap ?? 'Peminjam';
        $jumlahItem = $this->peminjaman->detail_peminjaman->sum('jumlah');

        return [
            'title' => 'Pengajuan peminjaman baru',
            'message' => $namaPeminjam . ' mengajukan peminjaman ' . $jumlahItem . ' item dan menunggu verifikasi.',
            'url' => route('petugas.permintaan'),
            'peminjaman_id' => $this->peminjaman->id,
            'status_pinjam' => $this->peminjaman->status_pinjam,
            'actor_name' => $namaPeminjam,
        ];
    }
}
