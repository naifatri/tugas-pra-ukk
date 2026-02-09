<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight tracking-tight">
                {{ __('Pengembalian Alat') }}
            </h2>
            <a href="{{ route('dashboard.peminjam') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Alert Error/Success -->
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                    <p class="font-bold">Error</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Info Peminjaman -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Detail Peminjaman #{{ $peminjaman->id }}
                        </h3>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                            Disetujui
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                            <p class="text-gray-500 dark:text-gray-400 mb-1 text-xs uppercase tracking-wider">Tanggal Pinjam</p>
                            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d M Y') }}</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                            <p class="text-gray-500 dark:text-gray-400 mb-1 text-xs uppercase tracking-wider">Tanggal Harus Kembali</p>
                            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($peminjaman->tgl_harus_kembali)->format('d M Y') }}</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm {{ $terlambat ? 'border-2 border-red-500 bg-red-50 dark:bg-red-900/20' : 'border-2 border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' }}">
                            <p class="text-gray-500 dark:text-gray-400 mb-1 text-xs uppercase tracking-wider">Status Waktu</p>
                            @if($terlambat)
                                <p class="font-bold text-red-600 dark:text-red-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Terlambat {{ $hari_terlambat }} hari
                                </p>
                            @else
                                <p class="font-semibold text-emerald-600 dark:text-emerald-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Tepat Waktu
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Form Pengembalian -->
                <form action="{{ route('peminjam.pengembalian.proses', $peminjaman->id) }}" method="POST" class="p-6" id="formPengembalian">
                    @csrf
                    
                    <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Data Pengembalian Alat
                    </h4>

                    <div class="space-y-4">
                        @foreach($peminjaman->detail_peminjaman as $detail)
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border border-gray-200 dark:border-gray-600 hover:shadow-md transition-shadow">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <!-- Info Alat -->
                                <div class="flex items-center space-x-3 flex-1 min-w-0">
                                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex-shrink-0">
                                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $detail->alat->nama_alat }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Kode: {{ $detail->alat->kode_alat }}</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Kondisi Awal: {{ ucfirst($detail->kondisi_awal) }}</p>
                                    </div>
                                </div>

                                <!-- Jumlah Dipinjam -->
                                <div class="text-center px-4 flex-shrink-0">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Dipinjam</p>
                                    <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400">{{ $detail->jumlah }}</p>
                                </div>

                                <!-- Input Jumlah Kembali -->
                                <div class="w-full md:w-28">
                                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah Kembali</label>
                                    <input type="number" 
                                           name="jumlah_kembali[{{ $detail->id }}]" 
                                           value="{{ $detail->jumlah }}" 
                                           min="0" 
                                           max="{{ $detail->jumlah }}"
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-center font-semibold text-sm"
                                           required
                                           onchange="validateJumlah(this, {{ $detail->jumlah }})">
                                </div>

                                <!-- Select Kondisi -->
                                <div class="w-full md:w-44">
                                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Kondisi Kembali</label>
                                    <select name="kondisi_kembali[{{ $detail->id }}]" 
                                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                            required
                                            onchange="updateEstimasi()">
                                        <option value="baik">Baik</option>
                                        <option value="rusak_ringan">Rusak Ringan</option>
                                        <option value="rusak_berat">Rusak Berat</option>
                                        <option value="hilang">Hilang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Estimasi Denda -->
                    <div class="mt-6 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl" id="dendaBox">
                        <h5 class="font-semibold text-amber-800 dark:text-amber-300 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Rincian Denda
                        </h5>
                        <div class="space-y-2 text-sm" id="rincianDenda">
                            @if($terlambat)
                            <div class="flex justify-between text-amber-700 dark:text-amber-400">
                                <span>Denda Keterlambatan ({{ $hari_terlambat }} hari)</span>
                                <span class="font-semibold">Rp {{ number_format($estimasi_denda, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            <div id="dendaKerusakan" class="hidden">
                                <div class="flex justify-between text-amber-700 dark:text-amber-400">
                                    <span>Denda Kerusakan/Kehilangan</span>
                                    <span class="font-semibold" id="nominalKerusakan">Rp 0</span>
                                </div>
                            </div>
                            <div class="flex justify-between border-t border-amber-200 dark:border-amber-800 pt-2 mt-2">
                                <span class="font-semibold text-amber-800 dark:text-amber-300">Total Estimasi Denda</span>
                                <span class="font-bold text-amber-800 dark:text-amber-300 text-lg" id="totalDenda">
                                    Rp {{ number_format($estimasi_denda, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <p class="text-xs text-amber-600 dark:text-amber-400 mt-2 italic">
                            *Denda final akan dihitung oleh petugas saat verifikasi
                        </p>
                    </div>

                    <!-- Keterangan -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Keterangan Tambahan (Opsional)</label>
                        <textarea name="keterangan" rows="3" 
                                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Tambahkan keterangan jika ada kerusakan atau hal lain yang perlu dilaporkan..."></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <a href="{{ route('dashboard.peminjam') }}" 
                           class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors font-medium">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center"
                                onclick="return confirm('Apakah Anda yakin ingin mengembalikan alat? Data yang sudah dikirim tidak dapat diubah.')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Konfirmasi Pengembalian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const dendaPerHari = {{ $denda_per_hari }};
        const hariTerlambat = {{ $hari_terlambat }};
        const dendaTerlambatAwal = {{ $estimasi_denda }};
        
        const dendaKerusakan = {
            'baik': 0,
            'rusak_ringan': 10000,
            'rusak_berat': 50000,
            'hilang': 100000
        };

        function validateJumlah(input, maxJumlah) {
            if (parseInt(input.value) > maxJumlah) {
                input.value = maxJumlah;
                alert('Jumlah kembali tidak boleh melebihi jumlah pinjam!');
            }
            if (parseInt(input.value) < 0) {
                input.value = 0;
            }
            updateEstimasi();
        }

        function updateEstimasi() {
            let totalKerusakan = 0;
            const details = document.querySelectorAll('.bg-gray-50, .dark\\:bg-gray-700\\/50');
            
            details.forEach((detail, index) => {
                const jumlahInput = detail.querySelector('input[name^="jumlah_kembali"]');
                const kondisiSelect = detail.querySelector('select[name^="kondisi_kembali"]');
                
                if (jumlahInput && kondisiSelect) {
                    const jumlah = parseInt(jumlahInput.value) || 0;
                    const kondisi = kondisiSelect.value;
                    totalKerusakan += jumlah * dendaKerusakan[kondisi];
                }
            });

            const totalDenda = dendaTerlambatAwal + totalKerusakan;
            
            // Update tampilan
            const kerusakanBox = document.getElementById('dendaKerusakan');
            const nominalKerusakan = document.getElementById('nominalKerusakan');
            const totalDendaEl = document.getElementById('totalDenda');
            
            if (totalKerusakan > 0) {
                kerusakanBox.classList.remove('hidden');
                nominalKerusakan.textContent = 'Rp ' + totalKerusakan.toLocaleString('id-ID');
            } else {
                kerusakanBox.classList.add('hidden');
            }
            
            totalDendaEl.textContent = 'Rp ' + totalDenda.toLocaleString('id-ID');
        }

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', updateEstimasi);
    </script>
    @endpush
</x-app-layout>