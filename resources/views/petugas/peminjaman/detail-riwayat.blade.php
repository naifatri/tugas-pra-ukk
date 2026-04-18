<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3">
            <div>
                <a href="{{ route('petugas.riwayat') }}"
                   class="inline-flex items-center justify-center gap-2 self-start rounded-xl border border-emerald-200 bg-white px-4 py-2.5 text-sm font-semibold text-emerald-700 shadow-sm transition hover:-translate-y-0.5 hover:bg-emerald-50 hover:shadow-md dark:border-emerald-800 dark:bg-gray-800 dark:text-emerald-300 dark:hover:bg-emerald-900/20">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Kembali ke Riwayat</span>
                </a>
            </div>
            <div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight tracking-tight">
                    Detail Pengembalian
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Ringkasan lengkap pengembalian alat dan denda yang tercatat.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-6xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-start justify-between gap-4 border-b border-gray-100 pb-4 dark:border-gray-700">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Pengembalian</p>
                            <h3 class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">#{{ $peminjaman->id }}</h3>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                            Selesai
                        </span>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-700/40">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Peminjam</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $peminjaman->user->nama_lengkap }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $peminjaman->user->kelas }} / {{ $peminjaman->user->jurusan }}</p>
                        </div>
                        <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-700/40">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Petugas</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ optional($peminjaman->petugas)->nama_lengkap ?? 'Tidak diketahui' }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Petugas pengembalian</p>
                        </div>
                        <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-700/40">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Tanggal Pinjam</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->isoFormat('DD MMMM YYYY') }}</p>
                        </div>
                        <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-700/40">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Tanggal Kembali</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_real)->isoFormat('DD MMMM YYYY') }}</p>
                        </div>
                        <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-700/40 md:col-span-2">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Metode Pembayaran</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ ucfirst($peminjaman->metode_pembayaran ?? 'belum ditentukan') }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Ringkasan Denda</p>
                    <div class="mt-4 rounded-2xl bg-gradient-to-br from-rose-50 to-orange-50 p-5 dark:from-rose-900/20 dark:to-orange-900/20">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nominal</p>
                        <p class="mt-1 text-3xl font-bold {{ $peminjaman->denda > 0 ? 'text-rose-600 dark:text-rose-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                            Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}
                        </p>
                        <p class="mt-3 text-sm text-gray-700 dark:text-gray-300">
                            {{ $peminjaman->keterangan_denda ?: 'Tidak ada denda pada pengembalian ini.' }}
                        </p>
                        <div class="mt-4">
                            @if($peminjaman->denda > 0 && $peminjaman->status_pembayaran_denda !== 'lunas')
                                <a href="{{ route('petugas.pelunasan.form', $peminjaman->id) }}"
                                   class="inline-flex items-center rounded-2xl bg-red-600 px-4 py-2 text-sm font-bold text-white shadow-md transition hover:bg-red-700">
                                    Bayar Denda Sekarang
                                </a>
                            @elseif($peminjaman->denda > 0)
                                <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-300">
                                    Denda sudah lunas{{ $peminjaman->tgl_pelunasan_denda ? ' pada ' . \Carbon\Carbon::parse($peminjaman->tgl_pelunasan_denda)->isoFormat('DD MMMM YYYY') : '' }}.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Detail Alat Dikembalikan</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Setiap item menampilkan kondisi akhir dan catatan petugas.</p>
                    </div>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/40">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Alat</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Jumlah</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Kondisi Awal</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Kondisi Kembali</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($peminjaman->detail_peminjaman as $detail)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-semibold text-gray-900 dark:text-white">{{ $detail->alat->nama_alat }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $detail->jumlah }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($detail->kondisi_awal ?? 'baik') }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($detail->kondisi_kembali ?? 'baik') }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $detail->deskripsi_kondisi_kembali ?: 'Tidak ada catatan tambahan.' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
