<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pengembalian</title>
</head>
<body style="margin:0; padding:24px; background:#eef2f7; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
    <div style="max-width:680px; margin:0 auto; background:#ffffff; border-radius:20px; overflow:hidden; border:1px solid #dbe3ef; box-shadow:0 18px 45px rgba(15, 23, 42, 0.08);">
        <div style="padding:28px; background:linear-gradient(135deg, #0f766e, #14b8a6); color:#ffffff;">
            <p style="margin:0 0 8px; font-size:12px; letter-spacing:0.18em; text-transform:uppercase; opacity:0.85;">SIPUT</p>
            <h1 style="margin:0; font-size:28px; line-height:1.2;">Pengembalian Berhasil Diproses</h1>
            <p style="margin:10px 0 0; font-size:14px; line-height:1.6; opacity:0.95;">Berikut ringkasan pengembalian alat yang baru saja dicatat oleh petugas.</p>
        </div>

        <div style="padding:28px;">
            <p style="margin:0 0 16px; font-size:15px; line-height:1.7;">Halo <strong>{{ $peminjaman->user->nama_lengkap }}</strong>,</p>
            <p style="margin:0 0 20px; font-size:15px; line-height:1.7;">
                Pengembalian untuk peminjaman <strong>#{{ $peminjaman->id }}</strong> telah diproses pada
                <strong>{{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_real)->isoFormat('DD MMMM YYYY') }}</strong>.
            </p>

            <div style="margin:0 0 24px; padding:18px; border:1px solid #b7efe4; background:#f0fdfa; border-radius:16px;">
                <div style="display:block; margin-bottom:10px;">
                    <span style="display:inline-block; padding:6px 10px; border-radius:999px; background:#0f766e; color:#ffffff; font-size:12px; font-weight:bold;">Status: Selesai</span>
                </div>
                <p style="margin:0 0 8px; font-size:14px;"><strong>Metode Pembayaran:</strong> {{ ucfirst($peminjaman->metode_pembayaran ?? 'belum ditentukan') }}</p>
                <p style="margin:0 0 8px; font-size:14px;"><strong>Total Denda:</strong> Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</p>
                <p style="margin:0; font-size:14px;"><strong>Keterangan:</strong> {{ $peminjaman->keterangan_denda ?: 'Tidak ada denda pada pengembalian ini.' }}</p>
            </div>

            <div style="margin:0 0 24px;">
                <h2 style="margin:0 0 12px; font-size:18px; color:#0f172a;">Detail Alat</h2>
                <div style="border:1px solid #e5e7eb; border-radius:16px; overflow:hidden;">
                @foreach($peminjaman->detail_peminjaman as $detail)
                    <div style="padding:14px 16px; border-bottom:1px solid #e5e7eb; background:#ffffff;">
                        <p style="margin:0 0 6px; font-size:14px; font-weight:bold; color:#111827;">{{ $detail->alat->nama_alat }}</p>
                        <p style="margin:0; font-size:13px; color:#4b5563;">
                            Jumlah: {{ $detail->jumlah }} item
                            @if($detail->kondisi_kembali)
                                | Kondisi kembali: {{ ucfirst($detail->kondisi_kembali) }}
                            @endif
                        </p>
                        @if($detail->deskripsi_kondisi_kembali)
                            <p style="margin:8px 0 0; font-size:13px; color:#6b7280;">Catatan: {{ $detail->deskripsi_kondisi_kembali }}</p>
                        @endif
                    </div>
                @endforeach
                </div>
            </div>

            <div style="padding:16px 18px; border-radius:16px; background:#f8fafc; border:1px solid #e2e8f0;">
                <p style="margin:0; font-size:14px; line-height:1.7; color:#475569;">
                    Terima kasih telah menggunakan layanan peminjaman alat. Jika ada data yang tidak sesuai, silakan hubungi petugas laboratorium.
                </p>
            </div>
        </div>

        <div style="padding:18px 28px; border-top:1px solid #e5e7eb; background:#fcfcfd;">
            <p style="margin:0; font-size:12px; line-height:1.6; color:#6b7280;">
                Email ini dikirim otomatis oleh sistem SIPUT. Mohon tidak membalas email ini secara langsung.
            </p>
        </div>
    </div>
</body>
</html>
