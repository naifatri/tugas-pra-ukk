<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight tracking-tight">
                {{ __('Dashboard Peminjam') }}
            </h2>
            <span class="text-sm text-gray-500 dark:text-gray-400" id="live-clock"></span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-emerald-500/10 to-teal-500/10 rounded-full blur-3xl -ml-32 -mb-32"></div>
                
                <div class="relative p-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-6 md:mb-0">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                Selamat Datang, {{ Auth::user()->nama_lengkap }}! 👋
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 max-w-xl">
                                Kelola peminjaman alat Anda dengan mudah. Lihat status peminjaman aktif dan riwayat penggunaan alat.
                            </p>
                            
                            <div class="mt-6">
                                <a href="{{ route('peminjam.alat') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Pinjam Alat Baru
                                </a>
                            </div>
                        </div>
                        
                        <!-- Decorative Element -->
                        <div class="hidden lg:block relative">
                            <div class="w-32 h-32 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-2xl transform rotate-6 opacity-90"></div>
                            <div class="absolute top-4 left-4 w-32 h-32 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl shadow-xl transform -rotate-6 opacity-80"></div>
                            <div class="absolute top-8 left-8 w-32 h-32 bg-white dark:bg-gray-700 rounded-2xl shadow-lg flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Menunggu Persetujuan -->
                <div class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 ease-out hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-amber-500/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Menunggu</p>
                                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors duration-300 counter" data-target="{{ $peminjaman->where('status_pinjam', 'menunggu')->count() }}">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Peminjaman menunggu persetujuan admin</p>
                        </div>
                    </div>
                </div>

                <!-- Sedang Dipinjam -->
                <div class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 ease-out hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-500/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Dipinjam</p>
                                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300 counter" data-target="{{ $peminjaman->where('status_pinjam', 'disetujui')->count() }}">
                                        0
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Peminjaman yang sedang aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Total Peminjaman -->
                <div class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 ease-out hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-emerald-500/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total</p>
                                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300 counter" data-target="{{ $peminjaman->count() }}">
                                        0
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex space-x-4 text-xs">
                                <div class="flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                    <span class="text-gray-600 dark:text-gray-400">Selesai: {{ $peminjaman->where('status_pinjam', 'kembali')->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Riwayat Peminjaman</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $peminjaman->count() }} total peminjaman</p>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tgl Pinjam</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tgl Harus Kembali</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Alat</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($peminjaman as $p)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    #{{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $p->tgl_pinjam }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $p->tgl_harus_kembali }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($p->status_pinjam == 'menunggu')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
                                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-2"></span>
                                            Menunggu
                                        </span>
                                    @elseif($p->status_pinjam == 'disetujui')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full mr-2"></span>
                                            Disetujui
                                        </span>
                                    @elseif($p->status_pinjam == 'kembali')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2"></span>
                                            Kembali
                                        </span>
                                    @elseif($p->status_pinjam == 'ditolak')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
                                            Ditolak
                                        </span>
                                    @elseif($p->status_pinjam == 'telat')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
                                            Telat
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        @foreach($p->detail_peminjaman as $d)
                                            <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                                <span class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></span>
                                                <span class="font-medium">{{ $d->alat->nama_alat }}</span>
                                                <span class="ml-2 text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded-full">
                                                    x{{ $d->jumlah }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($p->status_pinjam == 'disetujui')
                                        <button type="button" onclick="alert('Fitur pengembalian akan segera tersedia')" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                            Kembalikan
                                        </button>
                                    @elseif($p->status_pinjam == 'menunggu')
                                        <span class="inline-flex items-center text-amber-600 dark:text-amber-400 text-xs">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Menunggu persetujuan
                                        </span>
                                    @elseif($p->status_pinjam == 'kembali')
                                        <span class="inline-flex items-center text-emerald-600 dark:text-emerald-400 text-xs">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400">
                                        <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                        </svg>
                                        <p class="text-lg font-medium mb-1">Belum ada riwayat peminjaman</p>
                                        <p class="text-sm">Mulai pinjam alat untuk melihat riwayat di sini</p>
                                        <a href="{{ route('peminjam.alat') }}" class="mt-4 text-indigo-600 hover:text-indigo-700 font-medium text-sm">
                                            Pinjam alat sekarang →
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Live Clock
        function updateClock() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const clockElement = document.getElementById('live-clock');
            if (clockElement) {
                clockElement.textContent = now.toLocaleDateString('id-ID', options);
            }
        }
        updateClock();
        setInterval(updateClock, 60000);

        // Counter Animation
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                if (target > 0) {
                    let current = 0;
                    const increment = target / 30;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            counter.textContent = target.toLocaleString('id-ID');
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.floor(current).toLocaleString('id-ID');
                        }
                    }, 30);
                } else {
                    counter.textContent = '0';
                }
            });
        });
    </script>
    @endpush
</x-app-layout>