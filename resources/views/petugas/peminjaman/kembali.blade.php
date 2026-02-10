<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight tracking-tight">
                {{ __('Proses Pengembalian') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Borrower Detail Card -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 sm:p-8 bg-gradient-to-br from-indigo-50/50 to-white dark:from-gray-800 dark:to-gray-800">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                        <div class="h-20 w-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                            {{ strtoupper(substr($peminjaman->user->nama_lengkap, 0, 1)) }}
                        </div>
                        <div class="flex-1 space-y-1">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $peminjaman->user->nama_lengkap }}</h3>
                            <div class="flex flex-wrap gap-3">
                                <span class="inline-flex items-center px-3 py-1 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 text-xs font-semibold rounded-full">
                                    {{ $peminjaman->user->kelas }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs font-semibold rounded-full">
                                    {{ $peminjaman->user->username }}
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-2 text-right">
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Tgl Pinjam:</span>
                                <span class="font-semibold text-gray-900 dark:text-white ml-1">{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->isoFormat('DD MMM YYYY') }}</span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Tenggat:</span>
                                <span class="font-semibold text-red-600 ml-1">{{ \Carbon\Carbon::parse($peminjaman->tgl_harus_kembali)->isoFormat('DD MMM YYYY') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div class="p-6 sm:p-10">
                    <form action="{{ route('petugas.proses_kembali', $peminjaman->id) }}" method="POST" class="space-y-8">
                        @csrf
                        
                        <!-- Date Picker -->
                        <div class="space-y-3">
                            <label for="tgl_kembali_real" class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Tanggal Pengembalian
                            </label>
                            <div class="relative group">
                                <input type="date" name="tgl_kembali_real" id="tgl_kembali_real" value="{{ date('Y-m-d') }}" 
                                       class="block w-full sm:w-64 px-4 py-3 rounded-2xl border-2 border-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all cursor-pointer shadow-sm group-hover:border-indigo-300" required>
                            </div>
                        </div>

                        <!-- Devices Table -->
                        <div class="space-y-4">
                            <label class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Kondisi Alat Saat Kembali
                            </label>
                            
                            <div class="overflow-hidden border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm">
                                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Alat</th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status Kondisi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-50 dark:divide-gray-700">
                                        @foreach($peminjaman->detail_peminjaman as $detail)
                                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $detail->alat->nama_alat }}</div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                                <span class="inline-flex items-center px-2.5 py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-xs font-bold rounded-lg border border-indigo-100 dark:border-indigo-800">
                                                    {{ $detail->jumlah }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex justify-center">
                                                    <select name="kondisi_kembali[{{ $detail->id }}]" 
                                                            class="block w-40 px-3 py-2 text-sm rounded-xl border-2 border-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all cursor-pointer font-medium" required>
                                                        <option value="baik" class="text-green-600 font-bold">✅ Baik</option>
                                                        <option value="rusak" class="text-orange-600 font-bold">⚠️ Rusak</option>
                                                        <option value="hilang" class="text-red-600 font-bold">❌ Hilang</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Info/Warning Banner -->
                        <div class="flex p-4 rounded-2xl bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800">
                            <svg class="w-6 h-6 text-amber-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm text-amber-800 dark:text-amber-300 leading-relaxed">
                                <span class="font-bold">Informasi:</span> Denda akan dihitung secara otomatis jika tanggal pengembalian melebihi batas waktu (Tenggat). Pastikan semua peralatan telah diperiksa secara fisik.
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('petugas.aktif') }}" 
                               class="px-6 py-3 text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors uppercase tracking-widest">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-bold rounded-2xl shadow-xl shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1 active:translate-y-0 uppercase tracking-widest">
                                Simpan Pengembalian
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
