<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                {{ __('Audit Riwayat Peminjaman') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Total Barang</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['total_alat'] }}</p>
                        </div>
                        <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0v10l-8 4m0-10L4 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Total Peminjaman</p>
                            <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $stats['total_pinjam_semua'] }}</p>
                        </div>
                        <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-orange-500 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Sedang Dipinjam</p>
                            <p class="text-3xl font-bold text-orange-600 dark:text-orange-400">{{ $stats['pinjam_aktif_semua'] }}</p>
                        </div>
                        <div class="p-3 bg-orange-50 dark:bg-orange-900/30 rounded-lg">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Aksi & Laporan</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kelola data dan cetak laporan audit riwayat peminjaman</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <a href="{{ route('audit-riwayat.index', array_merge(request()->query(), ['print' => 'true'])) }}" target="_blank" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                🖨️ Cetak Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Pencarian & Filter</h3>
                    <form method="GET" action="{{ route('audit-riwayat.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Cari Barang
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nama atau kode barang..." class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            
                            <div class="flex items-end gap-3">
                                <button type="submit" class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Cari
                                </button>
                                <a href="{{ route('audit-riwayat.index') }}" class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-700 text-gray-800 dark:text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Main Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($alats->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">No</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Kode Barang</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Nama Barang</th>
                                        <th class="px-6 py-4 text-left font-semibold text-gray-900 dark:text-gray-100">Kategori</th>
                                        <th class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-gray-100">
                                            <a href="{{ route('audit-riwayat.index', array_merge(request()->query(), ['sort' => 'stok', 'order' => request('order') === 'asc' && request('sort') === 'stok' ? 'desc' : 'asc'])) }}" class="hover:underline flex items-center justify-center gap-1">
                                                Stok
                                                @if(request('sort') === 'stok')
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        @if(request('order') === 'asc')
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                                        @else
                                                            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/>
                                                        @endif
                                                    </svg>
                                                @endif
                                            </a>
                                        </th>
                                        <th class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-gray-100">
                                            <a href="{{ route('audit-riwayat.index', array_merge(request()->query(), ['sort' => 'kondisi', 'order' => request('order') === 'asc' && request('sort') === 'kondisi' ? 'desc' : 'asc'])) }}" class="hover:underline flex items-center justify-center gap-1">
                                                Kondisi
                                                @if(request('sort') === 'kondisi')
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        @if(request('order') === 'asc')
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                                        @else
                                                            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/>
                                                        @endif
                                                    </svg>
                                                @endif
                                            </a>
                                        </th>
                                        <th class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-gray-100">
                                            <a href="{{ route('audit-riwayat.index', array_merge(request()->query(), ['sort' => 'total_pinjam', 'order' => request('order') === 'asc' && request('sort') === 'total_pinjam' ? 'desc' : 'asc'])) }}" class="hover:underline flex items-center justify-center gap-1">
                                                Total Dipinjam
                                                @if(request('sort') === 'total_pinjam')
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        @if(request('order') === 'asc')
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                                        @else
                                                            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/>
                                                        @endif
                                                    </svg>
                                                @endif
                                            </a>
                                        </th>
                                        <th class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-gray-100">Sedang Dipinjam</th>
                                        <th class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-gray-100">Terakhir Dipinjam</th>
                                        <th class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-gray-100">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alats as $key => $alat)
                                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ ($alats->currentPage() - 1) * $alats->perPage() + $key + 1 }}</td>
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200">
                                                    {{ $alat->kode_alat }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100 font-medium">{{ $alat->nama_alat }}</td>
                                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $alat->kategori }}</td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold 
                                                    @if($alat->stok >= 5)
                                                        bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200
                                                    @elseif($alat->stok >= 2)
                                                        bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200
                                                    @else
                                                        bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200
                                                    @endif
                                                ">
                                                    {{ $alat->stok }} unit
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
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
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="inline-flex items-center px-4 py-2 rounded-lg text-lg font-bold 
                                                    @if($alat->total_pinjam > 20)
                                                        bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-200
                                                    @elseif($alat->total_pinjam > 10)
                                                        bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200
                                                    @else
                                                        bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                                    @endif
                                                ">
                                                    {{ $alat->total_pinjam }} kali
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if($alat->pinjam_aktif > 0)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200">
                                                        {{ $alat->pinjam_aktif }} unit
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                                        -
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                                @if($alat->last_borrow)
                                                    @php
                                                        $date = is_string($alat->last_borrow) ? \Carbon\Carbon::parse($alat->last_borrow) : $alat->last_borrow;
                                                    @endphp
                                                    {{ $date->format('d M Y') }}
                                                @else
                                                    <span class="text-gray-400 dark:text-gray-500">Belum pernah</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <a href="{{ route('audit-riwayat.show', $alat->id) }}" class="inline-flex items-center px-3 py-2 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-200 dark:hover:bg-indigo-900/50 rounded-lg font-medium transition-colors text-xs">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6 flex justify-center">
                            {{ $alats->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada data</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada riwayat peminjaman yang tercatat.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
