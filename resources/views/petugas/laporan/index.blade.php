<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-white tracking-tight">
                {{ __('Laporan Peminjaman') }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Ringkasan total transaksi dan detail peminjaman alat.
            </p>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                        <form method="GET" action="{{ route('petugas.laporan.index') }}" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4 flex-1">
                            <div class="xl:col-span-2">
                                <label for="alat_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Alat</label>
                                <select name="alat_id" id="alat_id" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Semua alat</option>
                                    @foreach($alatOptions as $alat)
                                        <option value="{{ $alat->id }}" @selected($filters['alat_id'] === $alat->id)>
                                            {{ $alat->nama_alat }} ({{ $alat->kode_alat }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Dari</label>
                                <input type="date" name="date_from" id="date_from" value="{{ $filters['date_from'] }}" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="date_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Sampai</label>
                                <input type="date" name="date_to" id="date_to" value="{{ $filters['date_to'] }}" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Urutkan Tanggal</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <select name="sort" id="sort" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="tgl_pinjam" @selected($filters['sort'] === 'tgl_pinjam')>Pinjam</option>
                                        <option value="tgl_kembali_real" @selected($filters['sort'] === 'tgl_kembali_real')>Kembali</option>
                                    </select>
                                    <select name="order" id="order" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="desc" @selected($filters['order'] === 'desc')>Terbaru</option>
                                        <option value="asc" @selected($filters['order'] === 'asc')>Terlama</option>
                                    </select>
                                </div>
                            </div>

                            <div class="md:col-span-2 xl:col-span-5 flex flex-col sm:flex-row gap-3">
                                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700">
                                    Terapkan Filter
                                </button>
                                <a href="{{ route('petugas.laporan.index') }}" class="inline-flex items-center justify-center rounded-xl bg-gray-100 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                    Reset
                                </a>
                            </div>
                        </form>

                        <a href="{{ route('petugas.laporan.cetak', request()->query()) }}" target="_blank" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/20 transition hover:bg-emerald-700">
                            Cetak / PDF
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Peminjaman</p>
                    <p class="mt-2 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $stats['total_peminjaman'] }}</p>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Jumlah seluruh transaksi peminjaman.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Baris Detail</p>
                    <p class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total_detail'] }}</p>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Jumlah detail yang tampil pada laporan.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Unit</p>
                    <p class="mt-2 text-3xl font-bold text-orange-600 dark:text-orange-400">{{ $stats['total_unit'] }}</p>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Akumulasi unit alat yang dipinjam.</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Detail Peminjaman</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Format detail per alat sesuai filter yang dipilih.
                        </p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $stats['total_detail'] }} baris ditemukan
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Nama Alat</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Nama Peminjam</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Tanggal Pinjam</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Tanggal Kembali</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            @forelse($details as $detail)
                                @php
                                    $peminjaman = $detail->peminjaman;
                                    $user = $peminjaman?->user;
                                    $kondisi = $detail->kondisi_kembali ?? '-';
                                    $kondisiClass = match ($kondisi) {
                                        'Baik' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                        'Bagus' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                        'Rusak Ringan' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300',
                                        'Rusak Berat' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    };
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $detail->alat?->nama_alat ?? '-' }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $detail->alat?->kode_alat ?? '-' }} • {{ $detail->jumlah }} unit</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user?->nama_lengkap ?? $user?->username ?? 'Pengguna tidak ditemukan' }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $user?->username ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                        @if($peminjaman?->tgl_kembali_real)
                                            {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_real)->format('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $kondisiClass }}">
                                            {{ $kondisi }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data detail peminjaman untuk filter yang dipilih.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $details->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
