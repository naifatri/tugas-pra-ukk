<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3">
            <a href="{{ route('petugas.riwayat.detail', $peminjaman->id) }}"
               class="inline-flex items-center gap-2 self-start rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Form Pelunasan Denda</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Proses pembayaran denda untuk pengembalian #{{ $peminjaman->id }}.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <form action="{{ route('petugas.pelunasan.proses', $peminjaman->id) }}" method="POST" class="space-y-6">
                @csrf

                <div class="rounded-3xl border border-gray-100 bg-white shadow-sm">
                    <div class="border-b border-gray-100 px-6 py-5">
                        <h3 class="text-lg font-bold text-gray-900">Ringkasan Denda</h3>
                    </div>

                    <div class="grid gap-6 p-6 md:grid-cols-2">
                        <div class="rounded-2xl bg-gray-50 p-5">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Peminjam</p>
                            <p class="mt-2 text-lg font-bold text-gray-900">{{ $peminjaman->user->nama_lengkap }}</p>
                            <p class="text-sm text-gray-500">{{ $peminjaman->user->kelas }} / {{ $peminjaman->user->jurusan }}</p>
                            <div class="mt-4 space-y-2 text-sm text-gray-500">
                                <p><span class="font-semibold text-gray-700">Tanggal Kembali:</span> {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_real)->isoFormat('DD MMMM YYYY') }}</p>
                                <p><span class="font-semibold text-gray-700">Status Denda:</span> {{ ucfirst($peminjaman->status_pembayaran_denda ?? 'belum dibayar') }}</p>
                            </div>
                        </div>
                        <div class="rounded-2xl bg-red-50 p-5">
                            <p class="text-xs font-semibold uppercase tracking-wide text-red-500">Nominal Denda</p>
                            <p class="mt-2 text-3xl font-extrabold text-red-600">Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</p>
                            <p class="mt-2 text-sm text-red-500">{{ $peminjaman->keterangan_denda ?: 'Denda pengembalian.' }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 px-6 py-6">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Detail Pengembalian</h3>
                                <p class="mt-1 text-sm text-gray-500">Informasi alat yang dipinjam, kondisi pengembalian, dan catatan petugas.</p>
                            </div>
                        </div>

                        <div class="mt-5 overflow-x-auto rounded-2xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-gray-500">Alat Dipinjam</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-gray-500">Jumlah</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-gray-500">Kondisi Kembali</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-gray-500">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach($peminjaman->detail_peminjaman as $detail)
                                        <tr>
                                            <td class="px-4 py-4 text-sm font-semibold text-gray-900">{{ $detail->alat->nama_alat }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-600">{{ $detail->jumlah }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-600">{{ ucfirst($detail->kondisi_kembali ?? 'baik') }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-500">{{ $detail->deskripsi_kondisi_kembali ?: 'Tidak ada catatan tambahan.' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 px-6 py-6">
                        <label for="metode_pembayaran" class="mb-2 block text-sm font-semibold text-gray-700">
                            Metode Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="metode_pembayaran"
                            id="metode_pembayaran"
                            required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500 @error('metode_pembayaran') border-red-500 @enderror"
                        >
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="tunai" {{ old('metode_pembayaran') === 'tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="qris" {{ old('metode_pembayaran') === 'qris' ? 'selected' : '' }}>QRIS</option>
                        </select>
                        @error('metode_pembayaran')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="qris_preview_wrapper" class="hidden border-t border-gray-100 bg-gradient-to-br from-slate-50 via-white to-emerald-50 px-6 py-6">
                        <div class="max-w-md rounded-[28px] border border-emerald-200 bg-white p-5 shadow-sm">
                            <div class="flex items-center justify-between gap-3 border-b border-dashed border-gray-200 pb-4">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">Preview QRIS</p>
                                    <h4 class="mt-1 text-lg font-bold text-gray-900">Pelunasan Denda</h4>
                                </div>
                                <span class="rounded-xl bg-emerald-600 px-3 py-1 text-xs font-bold text-white">QRIS</span>
                            </div>

                            <div class="mt-5 flex flex-col items-center">
                                <div class="w-full overflow-hidden rounded-[24px] bg-white p-3 shadow-inner ring-1 ring-gray-200">
                                    <img
                                        src="https://i.pinimg.com/1200x/c6/0c/ce/c60ccefb956fdd094cd5be77a0b75106.jpg"
                                        alt="QRIS pembayaran"
                                        class="h-auto w-full rounded-2xl object-cover"
                                    >
                                </div>

                                <p class="mt-4 text-sm font-semibold text-gray-900">Total Bayar: Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</p>
                                <p class="mt-1 text-xs text-gray-500">Scan QRIS di atas untuk proses pelunasan denda.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('petugas.riwayat.detail', $peminjaman->id) }}"
                       class="rounded-xl border border-gray-300 px-5 py-2.5 text-gray-700 transition hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit"
                            class="rounded-xl bg-emerald-600 px-6 py-2.5 font-semibold text-white transition hover:bg-emerald-700">
                        Konfirmasi Pelunasan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const metodePembayaranField = document.getElementById('metode_pembayaran');
            const qrisPreviewWrapper = document.getElementById('qris_preview_wrapper');

            const updateMetodePembayaranDisplay = () => {
                const metodePembayaran = metodePembayaranField?.value || '';

                if (!qrisPreviewWrapper) {
                    return;
                }

                qrisPreviewWrapper.classList.toggle('hidden', metodePembayaran !== 'qris');
            };

            metodePembayaranField?.addEventListener('change', updateMetodePembayaranDisplay);
            updateMetodePembayaranDisplay();
        });
    </script>
</x-app-layout>
