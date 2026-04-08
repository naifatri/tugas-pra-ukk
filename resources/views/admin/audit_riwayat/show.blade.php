<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('audit-riwayat.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Riwayat Peminjaman
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Detail history untuk: <strong>{{ $alat->nama_alat }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Item Information Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold mb-2">Kode Barang</p>
                            <p class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $alat->kode_alat }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold mb-2">Kategori</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $alat->kategori->nama_kategori ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold mb-2">Stok</p>
                            <p class="text-lg font-bold text-green-600 dark:text-green-400">{{ $alat->stok }} unit</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold mb-2">Kondisi</p>
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium 
                                @if($alat->kondisi === 'Baik')
                                    bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200
                                @elseif($alat->kondisi === 'Bagus')
                                    bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200
                                @elseif($alat->kondisi === 'Rusak Ringan')
                                    bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200
                                @else
                                    bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200
                                @endif
                            ">
                                {{ $alat->kondisi }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold mb-2">Lokasi</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $alat->lokasi_penyimpanan ?? '-' }}</p>
                        </div>
                    </div>
                    @if($alat->deskripsi)
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold mb-2">Deskripsi</p>
                            <p class="text-gray-700 dark:text-gray-300">{{ $alat->deskripsi }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- History Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Riwayat Peminjaman
                    </h3>

                    @if($riwayat->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">No</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Nama Peminjam</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Jumlah</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Tanggal Pinjam</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Harus Kembali</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Tanggal Kembali</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Status</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Kondisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayat as $key => $item)
                                        @php
                                            $peminjaman = $item->peminjaman;
                                            $statusClass = '';
                                            $statusText = '';
                                            if ($peminjaman->status_pinjam === 'disetujui') {
                                                $statusClass = 'bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200';
                                                $statusText = 'Sedang Dipinjam';
                                            } elseif ($peminjaman->status_pinjam === 'telat') {
                                                $statusClass = 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200';
                                                $statusText = 'Telat';
                                            } elseif ($peminjaman->status_pinjam === 'kembali') {
                                                $statusClass = 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200';
                                                $statusText = 'Sudah Dikembalikan';
                                            } elseif ($peminjaman->status_pinjam === 'menunggu') {
                                                $statusClass = 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200';
                                                $statusText = 'Menunggu Persetujuan';
                                            } elseif ($peminjaman->status_pinjam === 'ditolak') {
                                                $statusClass = 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200';
                                                $statusText = 'Ditolak';
                                            } else {
                                                $statusClass = 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200';
                                                $statusText = $peminjaman->status_pinjam;
                                            }

                                            $kondisiClass = '';
                                            if ($item->kondisi_kembali === 'Baik') {
                                                $kondisiClass = 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200';
                                            } elseif ($item->kondisi_kembali === 'Bagus') {
                                                $kondisiClass = 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200';
                                            } elseif ($item->kondisi_kembali === 'Rusak Ringan') {
                                                $kondisiClass = 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200';
                                            } elseif ($item->kondisi_kembali === 'Rusak Berat') {
                                                $kondisiClass = 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200';
                                            } else {
                                                $kondisiClass = 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200';
                                            }
                                        @endphp
                                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ ($riwayat->currentPage() - 1) * 15 + $key + 1 }}</td>
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100 font-medium">
                                                {{ $peminjaman->user->nama_user }}
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $peminjaman->user->username }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-200">
                                                    {{ $item->jumlah }} unit
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $peminjaman->tgl_pinjam->format('d M Y H:i') }}</td>
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $peminjaman->tgl_harus_kembali->format('d M Y') }}</td>
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                                @if($peminjaman->tgl_kembali_real)
                                                    {{ $peminjaman->tgl_kembali_real->format('d M Y H:i') }}
                                                @else
                                                    <span class="text-gray-400 dark:text-gray-500">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }}">
                                                    {{ $statusText }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $kondisiClass }}">
                                                    {{ $item->kondisi_kembali ?? '-' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6 flex justify-center">
                            {{ $riwayat->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada riwayat</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Barang ini belum pernah dipinjam.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
