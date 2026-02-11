<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight tracking-tight">
                {{ __('Dashboard Admin') }}
            </h2>
            
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Banner with Enhanced Design -->
            <div class="bg-gradient-to-br from-indigo-600 via-indigo-500 to-purple-600 dark:from-indigo-800 dark:via-indigo-700 dark:to-purple-800 overflow-hidden shadow-2xl sm:rounded-3xl relative group">
                <!-- Animated Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
                </div>
                
                <div class="relative p-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-6 md:mb-0">
                            <h3 class="text-3xl font-bold text-white mb-2 flex items-center gap-2">
                                Selamat Datang, Admin! 
                                <span class="animate-wave inline-block">👋</span>
                            </h3>
                            <p class="text-indigo-100 max-w-xl text-lg">
                                Ringkasan aktivitas sistem dan statistik penting ditampilkan di sini.
                            </p>
                            <span class="text-sm text-white dark:text-white" id="live-clock"></span>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('users.index') }}" class="group/btn inline-flex items-center px-6 py-3 bg-white hover:bg-gray-50 text-indigo-600 text-sm font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Kelola Users
                            </a>
                            <a href="{{ route('alats.index') }}" class="group/btn inline-flex items-center px-6 py-3 bg-white hover:bg-gray-50 text-emerald-600 text-sm font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0v10l-8 4m0-10L4 7"/>
                                </svg>
                                Kelola Alat
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards with Enhanced Animation -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users Card -->
                <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-transparent dark:from-indigo-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-indigo-600 text-white flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</p>
                                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Aktif: {{ $userAktif }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Alat Card -->
                <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-50 to-transparent dark:from-cyan-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-600 text-white flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0v10l-8 4m0-10L4 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Alat</p>
                                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalAlat }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    📦 Stok: {{ $totalStok }} unit
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Aktif Card -->
                <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-transparent dark:from-emerald-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Peminjaman Aktif</p>
                                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $peminjamanAktif }}</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                    ⏳ {{ $peminjamanMenunggu }}
                                </span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                    ⚠️ {{ $peminjamanTelat }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Peminjaman Card -->
                <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-transparent dark:from-amber-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 text-white flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Peminjaman</p>
                                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalPeminjaman }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    ✓ Disetujui: {{ $peminjamanDisetujui }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kondisi Alat Quick Stats with Progress Bars -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Kondisi Baik</p>
                        <span class="text-2xl">✅</span>
                    </div>
                    <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mb-2">{{ $alatBaik }}</p>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-2 rounded-full transition-all duration-500" style="width: {{ $totalAlat > 0 ? ($alatBaik / $totalAlat * 100) : 0 }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $totalAlat > 0 ? round($alatBaik / $totalAlat * 100, 1) : 0 }}% dari total alat</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Kondisi Rusak</p>
                        <span class="text-2xl">⚠️</span>
                    </div>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-400 mb-2">{{ $alatRusak }}</p>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-gradient-to-r from-red-500 to-red-600 h-2 rounded-full transition-all duration-500" style="width: {{ $totalAlat > 0 ? ($alatRusak / $totalAlat * 100) : 0 }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $totalAlat > 0 ? round($alatRusak / $totalAlat * 100, 1) : 0 }}% dari total alat</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Total Stok</p>
                        <span class="text-2xl">📦</span>
                    </div>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">{{ $totalStok }}</p>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all duration-500" style="width: 100%"></div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Unit tersedia</p>
                </div>
            </div>

            <!-- Recent Activity Section with Enhanced Design -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Peminjaman -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="bg-gradient-to-r from-indigo-50 to-white dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Peminjaman Terbaru
                            </h3>
                            <span class="text-xs bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 px-2 py-1 rounded-full">
                                {{ $recentPeminjaman->count() }} items
                            </span>
                        </div>
                    </div>
                    <div class="p-6 max-h-96 overflow-y-auto">
                        @if($recentPeminjaman->isEmpty())
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada peminjaman terbaru</p>
                            </div>
                        @else
                            <ul class="space-y-3">
                                @foreach($recentPeminjaman as $p)
                                    <li class="group flex items-start justify-between p-4 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-indigo-200 dark:hover:border-indigo-700 hover:shadow-md transition-all duration-200 bg-gray-50 dark:bg-gray-700/50">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 flex items-center justify-center font-semibold text-sm">
                                                    {{ substr($p->user->name ?? '?', 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                        {{ $p->user->name ?? '—' }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                        {{ $p->tgl_pinjam }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-2 flex items-center gap-2">
                                                @if($p->status_pinjam === 'Telat')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $p->status_pinjam }}
                                                    </span>
                                                @elseif($p->status_pinjam === 'Disetujui')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $p->status_pinjam }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                        {{ $p->status_pinjam }}
                                                    </span>
                                                @endif
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $p->detail_peminjaman->count() }} item
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Recent Logs -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="bg-gradient-to-r from-emerald-50 to-white dark:from-gray-700 dark:to-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Aktivitas Terbaru
                            </h3>
                            <span class="text-xs bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 px-2 py-1 rounded-full">
                                {{ $recentLogs->count() }} logs
                            </span>
                        </div>
                    </div>
                    <div class="p-6 max-h-96 overflow-y-auto">
                        @if($recentLogs->isEmpty())
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada aktivitas</p>
                            </div>
                        @else
                            <ul class="space-y-3">
                                @foreach($recentLogs as $log)
                                    <li class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-emerald-200 dark:hover:border-emerald-700 hover:shadow-md transition-all duration-200 bg-gray-50 dark:bg-gray-700/50">
                                        <div class="w-2 h-2 mt-2 rounded-full bg-emerald-500 flex-shrink-0"></div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                {{ $log->title ?? $log->keterangan }}
                                            </p>
                                            <div class="flex items-center justify-between mt-1">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    {{ $log->created_at->diffForHumans() }}
                                                </p>
                                                @if($log->jenis)
                                                    <span class="text-xs px-2 py-0.5 rounded-full bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300">
                                                        {{ $log->jenis }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(20deg); }
            75% { transform: rotate(-20deg); }
        }
        
        .animate-wave {
            animation: wave 2s ease-in-out infinite;
        }

        .stat-card {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Smooth scroll */
        .overflow-y-auto {
            scroll-behavior: smooth;
        }

        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .dark .overflow-y-auto::-webkit-scrollbar-track {
            background: #374151;
        }

        .dark .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #4b5563;
        }

        .dark .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }
    </style>

    <script>
        // Live clock with enhanced formatting
        (function() {
            const el = document.getElementById('live-clock');
            if (!el) return;
            
            function update() {
                const now = new Date();
                el.textContent = now.toLocaleString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
            
            update();
            setInterval(update, 1000);
        })();

        // Animate stats on load
        document.addEventListener('DOMContentLoaded', function() {
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</x-app-layout>