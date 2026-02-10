{{-- Clean Admin Dashboard Style --}}
<x-app-layout>
    <x-slot name="title">Daftar Peminjaman</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        {{-- ================= STATS CARDS ================= --}}
        @php
            $statCards = [
                ['key' => 'total_pinjam', 'label' => 'Total Pinjaman', 'icon' => 'clipboard', 'color' => 'indigo'],
                ['key' => 'menunggu', 'label' => 'Menunggu', 'icon' => 'clock', 'color' => 'amber'],
                ['key' => 'disetujui', 'label' => 'Disetujui', 'icon' => 'check', 'color' => 'emerald'],
                ['key' => 'kembali', 'label' => 'Selesai', 'icon' => 'archive', 'color' => 'cyan'],
            ];
        @endphp

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($statCards as $card)
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-{{ $card['color'] }}-50 text-{{ $card['color'] }}-500 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @switch($card['icon'])
                                @case('clipboard')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    @break
                                @case('clock')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @break
                                @case('check')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    @break
                                @case('archive')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    @break
                            @endswitch
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">{{ $card['label'] }}</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats[$card['key']] ?? 0 }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ================= MAIN CARD ================= --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            
            {{-- HEADER --}}
            <div class="p-6 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Daftar Peminjaman</h2>
                            <p class="text-sm text-gray-500">Kelola dan pantau status peminjaman</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        {{-- Search --}}
                        <div class="relative">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Cari peminjaman..." 
                                   class="pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent w-64">
                        </div>

                        {{-- Add Button --}}
                        <a href="{{ route('peminjam.alat') }}"
                           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Pinjam Alat
                        </a>
                    </div>
                </div>

                {{-- Filter Tabs --}}
                <div class="flex gap-2 mt-6" id="filterButtons">
                    <button class="filter-btn active px-4 py-2 rounded-lg text-sm font-medium transition-all" data-filter="all">
                        Semua
                    </button>
                    <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all flex items-center gap-2" data-filter="menunggu">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Menunggu
                    </button>
                    <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all flex items-center gap-2" data-filter="disetujui">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Disetujui
                    </button>
                    <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all flex items-center gap-2" data-filter="selesai">
                        <span class="w-2 h-2 rounded-full bg-cyan-500"></span>
                        Selesai
                    </button>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Periode</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Alat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Denda</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($peminjaman as $index => $pinjam)
                            @php
                                $statusConfig = [
                                    'menunggu' => ['color' => 'amber', 'bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'dot' => 'bg-amber-500'],
                                    'disetujui' => ['color' => 'emerald', 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'dot' => 'bg-emerald-500'],
                                    'ditolak' => ['color' => 'rose', 'bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200', 'dot' => 'bg-rose-500'],
                                    'kembali' => ['color' => 'cyan', 'bg' => 'bg-cyan-50', 'text' => 'text-cyan-700', 'border' => 'border-cyan-200', 'dot' => 'bg-cyan-500'],
                                    'telat' => ['color' => 'rose', 'bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200', 'dot' => 'bg-rose-500'],
                                ];
                                $status = $statusConfig[$pinjam->status_pinjam] ?? $statusConfig['menunggu'];
                            @endphp

                            <tr data-status="{{ $pinjam->status_pinjam }}" class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-900 font-medium">{{ $index + 1 }}</td>
                                
                                <td class="px-6 py-4">
                                    <span class="font-mono text-sm font-semibold text-indigo-600">#{{ $pinjam->id }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($pinjam->tgl_pinjam)->format('d M Y') }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            s/d {{ \Carbon\Carbon::parse($pinjam->tgl_harus_kembali)->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($pinjam->detail_peminjaman as $detail)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gray-100 text-gray-700 text-xs font-medium">
                                                {{ $detail->jumlah }}× {{ $detail->alat->nama_alat }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium {{ $status['bg'] }} {{ $status['text'] }} border {{ $status['border'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $status['dot'] }}"></span>
                                        {{ ucfirst($pinjam->status_pinjam) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if($pinjam->denda > 0)
                                        <span class="text-sm font-semibold text-rose-600">
                                            Rp {{ number_format($pinjam->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('peminjam.pinjaman.show', $pinjam->id) }}"
                                           class="p-2 rounded-lg text-indigo-600 hover:bg-indigo-50 transition-colors"
                                           title="Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>

                                        @if($pinjam->status_pinjam == 'disetujui')
                                            <a href="{{ route('peminjam.pengembalian', $pinjam->id) }}"
                                               class="p-2 rounded-lg text-emerald-600 hover:bg-emerald-50 transition-colors"
                                               title="Kembalikan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-900 font-medium">Belum ada peminjaman</p>
                                        <a href="{{ route('peminjam.alat') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                            Pinjam alat sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($peminjaman->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $peminjaman->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .filter-btn {
            @apply text-gray-600 hover:bg-gray-100;
        }
        .filter-btn.active {
            @apply bg-indigo-600 text-white hover:bg-indigo-700;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.filter-btn');
            const rows = document.querySelectorAll('tbody tr[data-status]');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    buttons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    const filter = btn.dataset.filter;
                    rows.forEach(row => {
                        const status = row.dataset.status;
                        let shouldShow = filter === 'all' || status === filter || (filter === 'selesai' && (status === 'kembali' || status === 'telat'));
                        row.style.display = shouldShow ? '' : 'none';
                    });
                });
            });
        });
    </script>
</x-app-layout>