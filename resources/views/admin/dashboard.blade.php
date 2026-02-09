<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight tracking-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <span class="text-sm text-gray-500 dark:text-gray-400" id="live-clock"></span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Section - PINDAH KE PALING ATAS -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-emerald-500/10 to-teal-500/10 rounded-full blur-3xl -ml-32 -mb-32"></div>
                
                <div class="relative p-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-6 md:mb-0">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                Selamat Datang, Admin! 👋
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 max-w-xl">
                                Dashboard ini memberikan gambaran umum tentang aktivitas sistem. Gunakan menu navigasi di sebelah kiri atau kalender di bawah untuk mengelola jadwal peminjaman dengan lebih efisien.
                            </p>
                            
                            <div class="mt-6 flex flex-wrap gap-3">
                                <button class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg cursor-pointer">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    Kelola Users
                                </button>
                                <button class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg cursor-pointer">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Kelola Alat
                                </button>
                                <button class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg cursor-pointer">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Tambah Peminjaman
                                </button>
                            </div>
                        </div>
                        
                        <!-- Decorative Element -->
                        <div class="hidden lg:block relative">
                            <div class="w-32 h-32 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-2xl transform rotate-6 opacity-90"></div>
                            <div class="absolute top-4 left-4 w-32 h-32 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl shadow-xl transform -rotate-6 opacity-80"></div>
                            <div class="absolute top-8 left-8 w-32 h-32 bg-white dark:bg-gray-700 rounded-2xl shadow-lg flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Total Users -->
                <div class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 ease-out hover:-translate-y-1 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-500/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Users</p>
                                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300 counter" data-target="{{ $totalUsers }}">
                                        0
                                    </p>
                                </div>
                            </div>
                            <div class="hidden sm:flex flex-col items-end">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    +12%
                                </span>
                                <span class="text-xs text-gray-400 mt-1">vs bulan lalu</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-1.5 rounded-full" style="width: 75%"></div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">75% dari target tahunan</p>
                        </div>
                    </div>
                </div>

                <!-- Total Alat -->
                <div class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 ease-out hover:-translate-y-1 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-emerald-500/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Alat</p>
                                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300 counter" data-target="{{ $totalAlat }}">
                                        0
                                    </p>
                                </div>
                            </div>
                            <div class="hidden sm:flex flex-col items-end">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    +8%
                                </span>
                                <span class="text-xs text-gray-400 mt-1">vs bulan lalu</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span>Tersedia: {{ $totalAlat > 0 ? round(($totalAlat - ($totalPeminjaman ?? 0)) / $totalAlat * 100) : 0 }}%</span>
                                <span>Dipinjam: {{ $totalPeminjaman ?? 0 }}</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 mt-2 overflow-hidden flex">
                                <div class="bg-emerald-500 h-1.5 rounded-l-full" style="width: {{ $totalAlat > 0 ? (($totalAlat - ($totalPeminjaman ?? 0)) / $totalAlat * 100) : 0 }}%"></div>
                                <div class="bg-amber-500 h-1.5 rounded-r-full" style="width: {{ $totalAlat > 0 ? (($totalPeminjaman ?? 0) / $totalAlat * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Peminjaman -->
                <div class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 ease-out hover:-translate-y-1 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-amber-500/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Peminjaman</p>
                                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100 mt-1 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors duration-300 counter" data-target="{{ $totalPeminjaman }}">
                                        0
                                    </p>
                                </div>
                            </div>
                            <div class="hidden sm:flex flex-col items-end">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    +24%
                                </span>
                                <span class="text-xs text-gray-400 mt-1">vs bulan lalu</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex space-x-4 text-xs">
                                <div class="flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                    <span class="text-gray-600 dark:text-gray-400">Aktif: {{ $totalPeminjaman > 0 ? round($totalPeminjaman * 0.7) : 0 }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-gray-400 mr-2"></span>
                                    <span class="text-gray-600 dark:text-gray-400">Selesai: {{ $totalPeminjaman > 0 ? round($totalPeminjaman * 0.3) : 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar & Schedule Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Interactive Calendar -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Jadwal Peminjaman</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400" id="current-month-display"></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button id="prev-month" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button id="today-btn" class="px-3 py-1.5 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-colors">
                                Hari Ini
                            </button>
                            <button id="next-month" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <!-- Calendar Header -->
                        <div class="grid grid-cols-7 gap-2 mb-4">
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider py-2">Min</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider py-2">Sen</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider py-2">Sel</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider py-2">Rab</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider py-2">Kam</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider py-2">Jum</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider py-2">Sab</div>
                        </div>
                        
                        <!-- Calendar Grid -->
                        <div id="calendar-grid" class="grid grid-cols-7 gap-2">
                            <!-- Generated by JavaScript -->
                        </div>
                        
                        <!-- Legend -->
                        <div class="mt-6 flex flex-wrap items-center gap-4 text-xs">
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-indigo-500 mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">Peminjaman Aktif</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-emerald-500 mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">Pengembalian</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-amber-500 mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">Pending</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-red-500 mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">Overdue</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selected Date Details -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Detail Hari Ini
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1" id="selected-date-display">
                            {{ now()->format('d F Y') }}
                        </p>
                    </div>
                    
                    <div class="p-6 space-y-4 max-h-96 overflow-y-auto" id="schedule-list">
                        <!-- Dynamic Content -->
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-sm">Pilih tanggal untuk melihat jadwal</p>
                        </div>
                    </div>
                    
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700">
                        <button class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 flex items-center justify-center cursor-pointer">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Lihat Semua Peminjaman
                        </button>
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
            document.getElementById('live-clock').textContent = now.toLocaleDateString('id-ID', options);
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
                    const increment = target / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            counter.textContent = target.toLocaleString('id-ID');
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.floor(current).toLocaleString('id-ID');
                        }
                    }, 20);
                } else {
                    counter.textContent = '0';
                }
            });
        });

        // Calendar Functionality
        let currentDate = new Date();
        let selectedDate = new Date();
        
        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Simulated booking data (in real app, this comes from backend)
        const bookingData = {
            // Format: 'YYYY-MM-DD': [{type: 'active'|'return'|'pending'|'overdue', title: '...', user: '...'}]
        };

        function generateRandomBookings() {
            // Generate some dummy data for demonstration
            const types = ['active', 'return', 'pending', 'overdue'];
            const titles = ['Laptop Dell', 'Proyektor Epson', 'Kamera Canon', 'Mic Wireless', 'Speaker Bluetooth'];
            const users = ['Ahmad', 'Budi', 'Citra', 'Dewi', 'Eko'];
            
            for (let i = 0; i < 15; i++) {
                const date = new Date();
                date.setDate(date.getDate() + Math.floor(Math.random() * 30) - 5);
                const dateStr = date.toISOString().split('T')[0];
                
                if (!bookingData[dateStr]) bookingData[dateStr] = [];
                
                bookingData[dateStr].push({
                    type: types[Math.floor(Math.random() * types.length)],
                    title: titles[Math.floor(Math.random() * titles.length)],
                    user: users[Math.floor(Math.random() * users.length)],
                    time: `${String(Math.floor(Math.random() * 8) + 8).padStart(2, '0')}:00`
                });
            }
        }

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            document.getElementById('current-month-display').textContent = 
                `${monthNames[month]} ${year}`;
            
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const today = new Date();
            
            const grid = document.getElementById('calendar-grid');
            grid.innerHTML = '';
            
            // Empty cells for days before start of month
            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'h-24';
                grid.appendChild(emptyCell);
            }
            
            // Days
            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const isToday = today.getDate() === day && 
                               today.getMonth() === month && 
                               today.getFullYear() === year;
                const isSelected = selectedDate.getDate() === day && 
                                  selectedDate.getMonth() === month && 
                                  selectedDate.getFullYear() === year;
                
                const bookings = bookingData[dateStr] || [];
                const hasBookings = bookings.length > 0;
                
                const cell = document.createElement('div');
                cell.className = `relative h-24 p-2 rounded-xl border-2 cursor-pointer transition-all duration-200 hover:shadow-md ${
                    isSelected 
                        ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20' 
                        : isToday 
                            ? 'border-indigo-300 dark:border-indigo-700 bg-indigo-50/50 dark:bg-indigo-900/10' 
                            : 'border-gray-100 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'
                }`;
                
                cell.innerHTML = `
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-semibold ${isToday ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-700 dark:text-gray-300'}">
                            ${day}
                        </span>
                        ${isToday ? '<span class="text-xs bg-indigo-500 text-white px-1.5 py-0.5 rounded">Hari Ini</span>' : ''}
                    </div>
                    ${hasBookings ? `
                        <div class="mt-2 space-y-1">
                            ${bookings.slice(0, 3).map(b => `
                                <div class="flex items-center space-x-1">
                                    <span class="w-2 h-2 rounded-full ${getStatusColor(b.type)}"></span>
                                    <span class="text-xs text-gray-600 dark:text-gray-400 truncate">${b.title}</span>
                                </div>
                            `).join('')}
                            ${bookings.length > 3 ? `<span class="text-xs text-gray-400">+${bookings.length - 3} lainnya</span>` : ''}
                        </div>
                    ` : ''}
                `;
                
                cell.addEventListener('click', () => selectDate(year, month, day));
                grid.appendChild(cell);
            }
        }

        function getStatusColor(type) {
            const colors = {
                'active': 'bg-indigo-500',
                'return': 'bg-emerald-500',
                'pending': 'bg-amber-500',
                'overdue': 'bg-red-500'
            };
            return colors[type] || 'bg-gray-500';
        }

        function selectDate(year, month, day) {
            selectedDate = new Date(year, month, day);
            renderCalendar();
            renderScheduleList();
        }

        function renderScheduleList() {
            const dateStr = selectedDate.toISOString().split('T')[0];
            const bookings = bookingData[dateStr] || [];
            const listContainer = document.getElementById('schedule-list');
            
            document.getElementById('selected-date-display').textContent = 
                selectedDate.toLocaleDateString('id-ID', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
            
            if (bookings.length === 0) {
                listContainer.innerHTML = `
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm">Tidak ada peminjaman pada tanggal ini</p>
                    </div>
                `;
                return;
            }
            
            listContainer.innerHTML = bookings.map(booking => `
                <div class="flex items-start space-x-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50 border-l-4 ${getStatusBorderColor(booking.type)}">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">${booking.title}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">${booking.time}</span>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Oleh: ${booking.user}</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium ${getStatusBadgeColor(booking.type)}">
                            ${getStatusLabel(booking.type)}
                        </span>
                    </div>
                </div>
            `).join('');
        }

        function getStatusBorderColor(type) {
            const colors = {
                'active': 'border-indigo-500',
                'return': 'border-emerald-500',
                'pending': 'border-amber-500',
                'overdue': 'border-red-500'
            };
            return colors[type] || 'border-gray-500';
        }

        function getStatusBadgeColor(type) {
            const colors = {
                'active': 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300',
                'return': 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300',
                'pending': 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300',
                'overdue': 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
            };
            return colors[type] || 'bg-gray-100 text-gray-800';
        }

        function getStatusLabel(type) {
            const labels = {
                'active': 'Aktif',
                'return': 'Pengembalian',
                'pending': 'Pending',
                'overdue': 'Overdue'
            };
            return labels[type] || type;
        }

        // Event Listeners
        document.getElementById('prev-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById('next-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        document.getElementById('today-btn').addEventListener('click', () => {
            currentDate = new Date();
            selectedDate = new Date();
            renderCalendar();
            renderScheduleList();
        });

        // Initialize
        generateRandomBookings();
        renderCalendar();
        renderScheduleList();
    </script>
    @endpush
</x-app-layout>