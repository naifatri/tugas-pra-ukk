<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman - {{ $month }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #666; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px 8px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; text-transform: uppercase; font-size: 12px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase; }
        .footer { margin-top: 50px; text-align: right; }
        .signature-box { display: inline-block; width: 200px; text-align: center; }
        .signature-space { height: 80px; }
        @media print {
            @page { margin: 1.5cm; }
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="background: #fdf6e3; padding: 10px; margin-bottom: 20px; text-align: center; border: 1px solid #eee;">
        <button onclick="window.print()" style="padding: 8px 16px; cursor: pointer;">Cetak Sekarang</button>
        <button onclick="window.close()" style="padding: 8px 16px; cursor: pointer;">Tutup</button>
    </div>

    <div class="header">
        <h1>Laporan Peminjaman Alat</h1>
        <p>Laboratorium Tugas Pra UKK</p>
    </div>

    <div class="info">
        <p><strong>Bulan:</strong> {{ \Carbon\Carbon::parse($month)->isoFormat('MMMM YYYY') }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th>Detail Alat</th>
                <th class="text-right">Denda</th>
            </tr>
        </thead>
        <tbody>
            @php $totalDenda = 0; @endphp
            @forelse($peminjaman as $p)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>
                    <strong>{{ $p->user->nama_lengkap }}</strong><br>
                    <small>{{ $p->user->username }} / {{ $p->user->kelas }}</small>
                </td>
                <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->isoFormat('DD MMM YYYY') }}</td>
                <td class="text-center">{{ strtoupper($p->status_pinjam) }}</td>
                <td>
                    @foreach($p->detail_peminjaman as $detail)
                        • {{ $detail->alat->nama_alat }} ({{ $detail->jumlah }})<br>
                    @endforeach
                </td>
                <td class="text-right">
                    @if($p->denda > 0)
                        Rp {{ number_format($p->denda, 0, ',', '.') }}
                        @php $totalDenda += $p->denda; @endphp
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
        @if($peminjaman->isNotEmpty())
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total Pendapatan Denda:</th>
                <th class="text-right">Rp {{ number_format($totalDenda, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        <div class="signature-box">
            <p>{{ \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') }}</p>
            <p>Petugas Perpustakaan,</p>
            <div class="signature-space"></div>
            <p><strong>{{ Auth::user()->nama_lengkap }}</strong></p>
            <p>NIP. .........................</p>
        </div>
    </div>
</body>
</html>
