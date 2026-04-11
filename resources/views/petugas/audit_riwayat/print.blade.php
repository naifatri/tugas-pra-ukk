<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Audit Riwayat Peminjaman</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.5; }
        .container { max-width: 1100px; margin: 0 auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 24px; border-bottom: 3px solid #333; padding-bottom: 14px; }
        .header h1 { font-size: 24px; margin-bottom: 4px; }
        .header p, .print-date, .section-note { color: #666; font-size: 13px; }
        .print-date { text-align: right; margin-bottom: 18px; }
        .stats-section { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 26px; }
        .stat-box { border: 1px solid #ddd; padding: 14px; border-radius: 8px; text-align: center; background-color: #f9f9f9; }
        .stat-box h3 { font-size: 12px; color: #666; margin-bottom: 8px; text-transform: uppercase; }
        .stat-box .number { font-size: 28px; font-weight: bold; color: #333; }
        .section-title { margin: 26px 0 10px; font-size: 18px; font-weight: 700; color: #1a1a1a; }
        .alat-title { margin: 18px 0 8px; padding: 10px 12px; background: #f3f4f6; border-left: 4px solid #4a5568; border-radius: 6px; }
        .alat-title strong { font-size: 14px; }
        .alat-meta { font-size: 12px; color: #666; margin-top: 4px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 18px; }
        thead { background-color: #4a5568; color: white; }
        th { padding: 10px 12px; text-align: left; font-weight: 600; font-size: 12px; border: 1px solid #333; }
        td { padding: 9px 12px; border: 1px solid #ddd; font-size: 12px; vertical-align: top; }
        tbody tr:nth-child(even) { background-color: #f8f8f8; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; }
        .badge-code { background-color: #e3f2fd; color: #1976d2; }
        .badge-good { background-color: #c8e6c9; color: #2e7d32; }
        .badge-info { background-color: #bbdefb; color: #1565c0; }
        .badge-warn { background-color: #fff9c4; color: #f57f17; }
        .badge-danger { background-color: #ffcdd2; color: #c62828; }
        .badge-muted { background-color: #f0f0f0; color: #666; }
        .footer { margin-top: 34px; text-align: center; border-top: 1px solid #ddd; padding-top: 14px; font-size: 12px; color: #666; }
        .page-break { page-break-before: always; }
        .no-print { display: none; }
        @media print {
            body { margin: 0; padding: 0; }
            .container { padding: 0; }
            .no-print { display: none !important; }
            table { margin-bottom: 24px; }
        }
        @media screen {
            .no-print { display: block; text-align: center; margin-bottom: 16px; }
            .no-print button { padding: 10px 20px; background-color: #4a5568; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; }
        }
        .no-data { text-align: center; padding: 30px; color: #666; font-style: italic; border: 1px dashed #ccc; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="no-print">
            <button onclick="window.print()">Cetak Laporan</button>
        </div>

        <div class="header">
            <h1>Laporan Audit Riwayat Peminjaman Barang</h1>
            <p>Sistem Manajemen Peminjaman Barang</p>
        </div>

        <div class="print-date">
            Tanggal Cetak: {{ now()->format('d M Y H:i') }}
        </div>

        <div class="stats-section">
            <div class="stat-box">
                <h3>Total Barang</h3>
                <div class="number">{{ $stats['total_alat'] }}</div>
            </div>
            <div class="stat-box">
                <h3>Total Peminjaman</h3>
                <div class="number">{{ $stats['total_pinjam_semua'] }}</div>
            </div>
            <div class="stat-box">
                <h3>Sedang Dipinjam</h3>
                <div class="number">{{ $stats['pinjam_aktif_semua'] }}</div>
            </div>
        </div>

        <div class="section-title">Ringkasan Audit Per Alat</div>
        @if($alats->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 12%;">Kode Barang</th>
                        <th style="width: 18%;">Nama Barang</th>
                        <th style="width: 14%;">Kategori</th>
                        <th style="width: 8%; text-align: center;">Stok</th>
                        <th style="width: 12%; text-align: center;">Kondisi</th>
                        <th style="width: 12%; text-align: center;">Total Dipinjam</th>
                        <th style="width: 9%; text-align: center;">Aktif</th>
                        <th style="width: 10%;">Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alats as $alat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge badge-code">{{ $alat->kode_alat }}</span></td>
                            <td>{{ $alat->nama_alat }}</td>
                            <td>{{ $alat->kategori }}</td>
                            <td style="text-align: center;">{{ $alat->stok }} unit</td>
                            <td style="text-align: center;">{{ $alat->kondisi }}</td>
                            <td style="text-align: center;"><strong>{{ $alat->total_pinjam }}</strong> kali</td>
                            <td style="text-align: center;">{{ $alat->pinjam_aktif > 0 ? $alat->pinjam_aktif . ' unit' : '-' }}</td>
                            <td>
                                @if($alat->last_borrow)
                                    @php $date = is_string($alat->last_borrow) ? \Carbon\Carbon::parse($alat->last_borrow) : $alat->last_borrow; @endphp
                                    {{ $date->format('d M Y') }}
                                @else
                                    Belum pernah
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="section-title">Detail Riwayat Setiap Alat</div>
            <p class="section-note">Bagian ini memuat data yang biasanya tampil pada halaman detail masing-masing alat.</p>

            @foreach($alats as $alat)
                @php
                    $riwayatAlat = $detailRiwayat->get($alat->id, collect());
                @endphp
                <div class="alat-title {{ !$loop->first ? 'page-break' : '' }}">
                    <strong>{{ $alat->nama_alat }}</strong> <span>({{ $alat->kode_alat }})</span>
                    <div class="alat-meta">Kategori: {{ $alat->kategori }} | Kondisi: {{ $alat->kondisi }} | Total peminjaman: {{ $alat->total_pinjam }} kali</div>
                </div>

                @if($riwayatAlat->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 24%;">Nama Peminjam</th>
                                <th style="width: 10%; text-align: center;">Jumlah</th>
                                <th style="width: 16%;">Tanggal Pinjam</th>
                                <th style="width: 16%;">Harus Kembali</th>
                                <th style="width: 16%;">Tanggal Kembali</th>
                                <th style="width: 13%;">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayatAlat as $index => $item)
                                @php
                                    $peminjaman = $item->peminjaman;
                                    $user = $peminjaman?->user;
                                    $namaPeminjam = $user?->nama_lengkap ?? $user?->username ?? 'Pengguna tidak ditemukan';
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $namaPeminjam }}</strong><br>
                                        <span style="color:#666; font-size:11px;">{{ $user?->username ?? '-' }}</span>
                                    </td>
                                    <td style="text-align: center;">{{ $item->jumlah }} unit</td>
                                    <td>{{ $peminjaman?->tgl_pinjam ? \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d M Y H:i') : '-' }}</td>
                                    <td>{{ $peminjaman?->tgl_harus_kembali ? \Carbon\Carbon::parse($peminjaman->tgl_harus_kembali)->format('d M Y') : '-' }}</td>
                                    <td>{{ $peminjaman?->tgl_kembali_real ? \Carbon\Carbon::parse($peminjaman->tgl_kembali_real)->format('d M Y H:i') : '-' }}</td>
                                    <td>{{ $item->kondisi_kembali ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-data">Tidak ada detail riwayat untuk alat ini.</div>
                @endif
            @endforeach
        @else
            <div class="no-data">Tidak ada data peminjaman yang tercatat.</div>
        @endif

        <div class="footer">
            <p>Laporan ini dihasilkan secara otomatis oleh Sistem Manajemen Peminjaman Barang</p>
            <p>&copy; {{ date('Y') }} - Hak Cipta Terlindungi</p>
        </div>
    </div>
</body>
</html>
