<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Audit Riwayat Peminjaman</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #1a1a1a;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .print-date {
            text-align: right;
            margin-bottom: 20px;
            font-size: 12px;
            color: #666;
        }

        /* Statistics Section */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .stat-box h3 {
            font-size: 12px;
            color: #666;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .stat-box .number {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #4a5568;
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            border: 1px solid #333;
        }

        table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 13px;
        }

        table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        table tbody tr:hover {
            background-color: #efefef;
        }

        /* Badge Styling */
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-code {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .badge-baik {
            background-color: #c8e6c9;
            color: #2e7d32;
        }

        .badge-bagus {
            background-color: #bbdefb;
            color: #1565c0;
        }

        .badge-ringan {
            background-color: #fff9c4;
            color: #f57f17;
        }

        .badge-berat {
            background-color: #ffcdd2;
            color: #c62828;
        }

        .badge-high {
            background-color: #c8e6c9;
            color: #2e7d32;
        }

        .badge-medium {
            background-color: #bbdefb;
            color: #1565c0;
        }

        .badge-low {
            background-color: #f0f0f0;
            color: #666;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            font-size: 12px;
            color: #666;
        }

        /* Page Break */
        .page-break {
            page-break-after: always;
        }

        /* Print Styles */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .container {
                padding: 0;
            }
            a {
                text-decoration: none;
                color: #000;
            }
            table {
                margin-bottom: 30px;
            }
        }

        .no-print {
            display: none;
        }

        @media screen {
            .no-print {
                display: block;
                text-align: center;
                margin-bottom: 20px;
            }

            .no-print button {
                padding: 10px 20px;
                background-color: #4a5568;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
            }

            .no-print button:hover {
                background-color: #2d3748;
            }
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="no-print">
            <button onclick="window.print()">🖨️ Cetak Laporan</button>
        </div>

        <div class="header">
            <h1>Laporan Audit Riwayat Peminjaman Barang</h1>
            <p>Sistem Manajemen Peminjaman Barang</p>
        </div>

        <div class="print-date">
            Tanggal Cetak: {{ now()->format('d M Y H:i') }}
        </div>

        <!-- Statistics Section -->
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

        <!-- Main Table -->
        @if($alats->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 12%;">Kode Barang</th>
                        <th style="width: 20%;">Nama Barang</th>
                        <th style="width: 15%;">Kategori</th>
                        <th style="width: 8%; text-align: center;">Stok</th>
                        <th style="width: 12%; text-align: center;">Kondisi</th>
                        <th style="width: 12%; text-align: center;">Total Dipinjam</th>
                        <th style="width: 12%; text-align: center;">Aktif</th>
                        <th style="width: 20%;">Terakhir Dipinjam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alats as $key => $alat)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><span class="badge badge-code">{{ $alat->kode_alat }}</span></td>
                            <td>{{ $alat->nama_alat }}</td>
                            <td>{{ $alat->kategori }}</td>
                            <td style="text-align: center;">
                                <strong>{{ $alat->stok }}</strong> unit
                            </td>
                            <td style="text-align: center;">
                                <span class="badge
                                    @if($alat->kondisi === 'Baik')
                                        badge-baik
                                    @elseif($alat->kondisi === 'Bagus')
                                        badge-bagus
                                    @elseif($alat->kondisi === 'Rusak Ringan')
                                        badge-ringan
                                    @else
                                        badge-berat
                                    @endif
                                ">
                                    {{ $alat->kondisi }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge
                                    @if($alat->total_pinjam > 20)
                                        badge-high
                                    @elseif($alat->total_pinjam > 10)
                                        badge-medium
                                    @else
                                        badge-low
                                    @endif
                                ">
                                    <strong>{{ $alat->total_pinjam }}</strong> kali
                                </span>
                            </td>
                            <td style="text-align: center;">
                                @if($alat->pinjam_aktif > 0)
                                    <span class="badge badge-ringan"><strong>{{ $alat->pinjam_aktif }}</strong> unit</span>
                                @else
                                    <span class="badge badge-low">-</span>
                                @endif
                            </td>
                            <td>
                                @if($alat->last_borrow)
                                    @php
                                        $date = is_string($alat->last_borrow) ? \Carbon\Carbon::parse($alat->last_borrow) : $alat->last_borrow;
                                    @endphp
                                    {{ $date->format('d M Y') }}
                                @else
                                    Belum pernah
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                Tidak ada data peminjaman yang tercatat.
            </div>
        @endif

        <div class="footer">
            <p>Laporan ini dihasilkan secara otomatis oleh Sistem Manajemen Peminjaman Barang</p>
            <p>© {{ date('Y') }} - Hak Cipta Terlindungi</p>
        </div>
    </div>

    <script>
        // Auto-print on page load (optional)
        // window.print();
    </script>
</body>
</html>
