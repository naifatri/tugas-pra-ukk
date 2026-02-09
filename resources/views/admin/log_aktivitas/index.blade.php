<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ __('Log Aktivitas') }}
            </h2>
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                Live Monitoring
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 border-l-4 border-blue-500 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Total Log</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $logs->total() }}</p>
                        </div>
                        <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 border-l-4 border-green-500 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Create</p>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400" id="countCreate">0</p>
                        </div>
                        <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 border-l-4 border-yellow-500 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Update</p>
                            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400" id="countUpdate">0</p>
                        </div>
                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 border-l-4 border-red-500 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Delete</p>
                            <p class="text-2xl font-bold text-red-600 dark:text-red-400" id="countDelete">0</p>
                        </div>
                        <div class="p-2 bg-red-100 dark:bg-red-900 rounded-lg">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Toolbar -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div class="flex items-center gap-2">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Riwayat Aktivitas</h3>
                            <span class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-full" id="showingInfo">
                                Halaman {{ $logs->currentPage() }} dari {{ $logs->lastPage() }}
                            </span>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <!-- Filter Aksi -->
                            <select id="filterAksi" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
                                <option value="">Semua Aksi</option>
                                <option value="create">Create</option>
                                <option value="update">Update</option>
                                <option value="delete">Delete</option>
                                <option value="login">Login</option>
                                <option value="logout">Logout</option>
                            </select>

                            <!-- Filter Modul -->
                            <select id="filterModul" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
                                <option value="">Semua Modul</option>
                                @php
                                    $moduls = $logs->pluck('modul')->unique()->filter();
                                @endphp
                                @foreach($moduls as $modul)
                                    <option value="{{ $modul }}">{{ $modul }}</option>
                                @endforeach
                            </select>

                            <!-- Search -->
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="searchLog" 
                                    placeholder="Cari log..." 
                                    class="pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 w-full sm:w-64"
                                >
                                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <!-- Refresh Button -->
                            <button onclick="window.location.reload()" class="p-2 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors" title="Refresh">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="logTable">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-48">
                                        Waktu
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        User
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Modul
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="logTableBody">
                                @forelse($logs as $log)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group" data-aksi="{{ strtolower($log->aksi) }}" data-modul="{{ strtolower($log->modul) }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $log->created_at->format('d M Y') }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $log->created_at->format('H:i:s') }}
                                            </span>
                                            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                {{ $log->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold">
                                                {{ strtoupper(substr($log->user ? $log->user->username : 'S', 0, 1)) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $log->user ? $log->user->username : 'System' }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $log->user ? $log->user->email : 'Automated Process' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $aksiClass = match(strtolower($log->aksi)) {
                                                'create', 'store' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 border-green-200 dark:border-green-800',
                                                'update', 'edit' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300 border-yellow-200 dark:border-yellow-800',
                                                'delete', 'destroy' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 border-red-200 dark:border-red-800',
                                                'login' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border-blue-200 dark:border-blue-800',
                                                'logout' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-600',
                                                default => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300 border-purple-200 dark:border-purple-800'
                                            };
                                            
                                            $aksiIcon = match(strtolower($log->aksi)) {
                                                'create', 'store' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>',
                                                'update', 'edit' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>',
                                                'delete', 'destroy' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>',
                                                'login' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>',
                                                'logout' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>',
                                                default => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $aksiClass }}">
                                            {!! $aksiIcon !!}
                                            {{ ucfirst($log->aksi) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            {{ $log->modul }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-600 dark:text-gray-300 max-w-md truncate" title="{{ $log->detail_teks }}">
                                            {{ $log->detail_teks ?? '-' }}
                                        </div>
                                        @if($log->detail_teks && strlen($log->detail_teks) > 50)
                                            <button onclick="toggleDetail(this)" class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mt-1 focus:outline-none">
                                                Lihat selengkapnya
                                            </button>
                                            <div class="hidden mt-2 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg text-sm text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                                {{ $log->detail_teks }}
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                            <svg class="w-16 h-16 mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <p class="text-lg font-medium">Tidak ada data log</p>
                                            <p class="text-sm mt-1">Belum ada aktivitas yang tercatat</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex items-center justify-between">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Menampilkan <span class="font-medium">{{ $logs->firstItem() ?? 0 }}</span> sampai <span class="font-medium">{{ $logs->lastItem() ?? 0 }}</span> dari <span class="font-medium">{{ $logs->total() }}</span> hasil
                        </div>
                        <div class="flex items-center gap-2">
                            {{ $logs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        /* Pagination styling override */
        .pagination {
            display: flex;
            gap: 0.25rem;
        }
        .pagination li a, .pagination li span {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
        }
        .pagination li.active span {
            background-color: #3b82f6;
            color: white;
        }
        .pagination li a:hover {
            background-color: #f3f4f6;
        }
    </style>

    <script>
        // Count statistics from visible rows
        function updateStats() {
            const rows = document.querySelectorAll('#logTableBody tr[data-aksi]');
            let create = 0, update = 0, deleteCount = 0;
            
            rows.forEach(row => {
                const aksi = row.getAttribute('data-aksi');
                if (aksi.includes('create') || aksi.includes('store')) create++;
                else if (aksi.includes('update') || aksi.includes('edit')) update++;
                else if (aksi.includes('delete') || aksi.includes('destroy')) deleteCount++;
            });

            // Animate numbers
            animateValue('countCreate', 0, create, 500);
            animateValue('countUpdate', 0, update, 500);
            animateValue('countDelete', 0, deleteCount, 500);
        }

        function animateValue(id, start, end, duration) {
            const obj = document.getElementById(id);
            const range = end - start;
            const minTimer = 50;
            let stepTime = Math.abs(Math.floor(duration / range));
            stepTime = Math.max(stepTime, minTimer);
            let startTime = new Date().getTime();
            let endTime = startTime + duration;
            let timer;
            
            function run() {
                let now = new Date().getTime();
                let remaining = Math.max((endTime - now) / duration, 0);
                let value = Math.round(end - (remaining * range));
                obj.innerHTML = value;
                if (value == end) clearInterval(timer);
            }
            
            timer = setInterval(run, stepTime);
            run();
        }

        // Filter functionality
        function filterTable() {
            const aksiFilter = document.getElementById('filterAksi').value.toLowerCase();
            const modulFilter = document.getElementById('filterModul').value.toLowerCase();
            const searchFilter = document.getElementById('searchLog').value.toLowerCase();
            const rows = document.querySelectorAll('#logTableBody tr[data-aksi]');
            
            let visibleCount = 0;
            
            rows.forEach(row => {
                const aksi = row.getAttribute('data-aksi');
                const modul = row.getAttribute('data-modul');
                const text = row.textContent.toLowerCase();
                
                const matchAksi = !aksiFilter || aksi.includes(aksiFilter);
                const matchModul = !modulFilter || modul.includes(modulFilter);
                const matchSearch = !searchFilter || text.includes(searchFilter);
                
                if (matchAksi && matchModul && matchSearch) {
                    row.style.display = '';
                    row.classList.add('animate-fade-in');
                    setTimeout(() => row.classList.remove('animate-fade-in'), 300);
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide empty state
            const emptyRow = document.querySelector('#logTableBody tr:not([data-aksi])');
            if (emptyRow) {
                emptyRow.style.display = visibleCount === 0 ? '' : 'none';
            }
        }

        // Event listeners
        document.getElementById('filterAksi').addEventListener('change', filterTable);
        document.getElementById('filterModul').addEventListener('change', filterTable);
        document.getElementById('searchLog').addEventListener('keyup', filterTable);

        // Toggle detail
        function toggleDetail(btn) {
            const detail = btn.nextElementSibling;
            if (detail.classList.contains('hidden')) {
                detail.classList.remove('hidden');
                btn.textContent = 'Sembunyikan';
            } else {
                detail.classList.add('hidden');
                btn.textContent = 'Lihat selengkapnya';
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateStats();
        });

        // Auto refresh every 30 seconds (optional)
        // setInterval(() => window.location.reload(), 30000);
    </script>
</x-app-layout>