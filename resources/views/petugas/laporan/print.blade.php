<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.5; color: #222; margin: 0; padding: 24px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 12px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 4px 0 0; color: #666; }
        .meta { margin-bottom: 18px; font-size: 13px; }
        .stats { display: table; width: 100%; margin-bottom: 20px; table-layout: fixed; }
        .stat { display: table-cell; border: 1px solid #ddd; padding: 12px; text-align: center; }
        .stat .label { font-size: 12px; color: #666; text-transform: uppercase; }
        .stat .value { font-size: 24px; font-weight: bold; margin-top: 6px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px 8px; font-size: 12px; vertical-align: top; }
        th { background: #f3f4f6; text-align: left; }
        .footer { margin-top: 28px; font-size: 12px; color: #666; text-align: right; }
        .no-print { margin-bottom: 16px; text-align: center; }
        .no-print button { padding: 8px 14px; cursor: pointer; }
        @media print {
            @page { margin: 1.2cm; }
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print">
        <button onclick="window.print()">Cetak Sekarang</button>
    </div>

    <div class="header">
        <h1>Laporan Peminjaman Alat</h1>
        <p>Sistem Manajemen Peminjaman Barang</p>
    </div>

    <div class="meta">
        <div><strong>Tanggal Cetak:</strong> {{ now()->format('d M Y H:i') }}</div>
        <div><strong>Filter Alat:</strong> {{ $selectedAlat?->nama_alat ? $selectedAlat->nama_alat . ' (' . $selectedAlat->kode_alat . ')' : 'Semua alat' }}</div>
        <div><strong>Rentang Tanggal:</strong> {{ $filters['date_from'] ?? '-' }} s/d {{ $filters['date_to'] ?? '-' }}</div>
        <div><strong>Urutan:</strong> {{ $filters['sort'] === 'tgl_kembali_real' ? 'Tanggal Kembali' : 'Tanggal Pinjam' }} ({{ strtoupper($filters['order']) }})</div>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="label">Total Peminjaman</div>
            <div class="value">{{ $stats['total_peminjaman'] }}</div>
        </div>
        <div class="stat">
            <div class="label">Baris Detail</div>
            <div class="value">{{ $stats['total_detail'] }}</div>
        </div>
        <div class="stat">
            <div class="label">Total Unit</div>
            <div class="value">{{ $stats['total_unit'] }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Alat</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($details as $detail)
                <tr>
                    <td>{{ $detail->alat?->nama_alat ?? '-' }}</td>
                    <td>{{ $detail->peminjaman?->user?->nama_lengkap ?? $detail->peminjaman?->user?->username ?? 'Pengguna tidak ditemukan' }}</td>
                    <td>{{ \Carbon\Carbon::parse($detail->peminjaman->tgl_pinjam)->format('d M Y') }}</td>
                    <td>
                        @if($detail->peminjaman?->tgl_kembali_real)
                            {{ \Carbon\Carbon::parse($detail->peminjaman->tgl_kembali_real)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $detail->kondisi_kembali ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Tidak ada data detail peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh {{ auth()->user()->nama_lengkap ?? auth()->user()->username }}
    </div>
</body>
</html>
