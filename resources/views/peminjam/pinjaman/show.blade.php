{{-- Clean Admin Detail View --}}
<x-app-layout>
    <x-slot name="title">Detail Peminjaman #{{ $peminjaman->id }}</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        {{-- ================= HEADER ================= --}}
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('peminjam.pinjaman') }}" class="hover:text-indigo-600 transition-colors">Peminjaman</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900 font-medium">Detail #{{ $peminjaman->id }}</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Peminjaman</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap transaksi peminjaman</p>
            </div>

            <a href="{{ route('peminjam.pinjaman') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>

        @php
            $statusMap = [
                'menunggu' => ['label' => 'Menunggu', 'color' => 'amber', 'bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'dot' => 'bg-amber-500'],
                'disetujui' => ['label' => 'Disetujui', 'color' => 'emerald', 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'dot' => 'bg-emerald-500'],
                'ditolak' => ['label' => 'Ditolak', 'color' => 'rose', 'bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200', 'dot' => 'bg-rose-500'],
                'kembali' => ['label' => 'Selesai', 'color' => 'cyan', 'bg' => 'bg-cyan-50', 'text' => 'text-cyan-700', 'border' => 'border-cyan-200', 'dot' => 'bg-cyan-500'],
                'telat' => ['label' => 'Terlambat', 'color' => 'rose', 'bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200', 'dot' => 'bg-rose-500'],
            ];
            $status = $statusMap[$peminjaman->status_pinjam] ?? $statusMap['menunggu'];
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ================= LEFT: INFO CARD ================= --}}
            <div class="space-y-6">
                
                {{-- Status Card --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-6 {{ $status['bg'] }} border-b {{ $status['border'] }}">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm">
                                <span class="w-3 h-3 rounded-full {{ $status['dot'] }}"></span>
                            </div>
                            <div>
                                <p class="text-sm font-medium {{ $status['text'] }}">Status Peminjaman</p>
                                <p class="text-lg font-bold {{ $status['text'] }}">{{ $status['label'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-sm text-gray-500">ID Peminjaman</span>
                            <span class="text-sm font-semibold text-gray-900 font-mono">#{{ $peminjaman->id }}</span>
                        </div>

                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-sm text-gray-500">Tanggal Pinjam</span>
                            <span class="text-sm font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d M Y') }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-sm text-gray-500">Batas Kembali</span>
                            <span class="text-sm font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($peminjaman->tgl_harus_kembali)->format('d M Y') }}
                            </span>
                        </div>

                        @if($peminjaman->tgl_kembali_real)
                            <div class="flex justify-between items-center py-2 border-b border-gray-50">
                                <span class="text-sm text-gray-500">Tanggal Kembali</span>
                                <span class="text-sm font-semibold text-emerald-600">
                                    {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_real)->format('d M Y') }}
                                </span>
                            </div>
                        @endif

                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm text-gray-500">Total Denda</span>
                            <span class="text-sm font-bold {{ $peminjaman->denda > 0 ? 'text-rose-600' : 'text-gray-900' }}">
                                {{ $peminjaman->denda > 0 ? 'Rp '.number_format($peminjaman->denda,0,',','.') : 'Rp 0' }}
                            </span>
                        </div>
                    </div>

                    @if($peminjaman->status_pinjam == 'disetujui')
                        <div class="px-6 pb-6">
                            <a href="{{ route('peminjam.pengembalian', $peminjaman->id) }}"
                               class="w-full inline-flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-xl text-sm font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Ajukan Pengembalian
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Denda Alert --}}
                @if($peminjaman->keterangan_denda)
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 p-5 flex gap-3">
                        <svg class="w-5 h-5 text-rose-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-rose-900 mb-1">Keterangan Denda</p>
                            <p class="text-sm text-rose-700">{{ $peminjaman->keterangan_denda }}</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ================= RIGHT: ITEMS TABLE ================= --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    
                    {{-- Card Header --}}
                    <div class="p-6 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Daftar Alat</h2>
                            <p class="text-sm text-gray-500">{{ $peminjaman->detail_peminjaman->count() }} item dipinjam</p>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama Alat</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Kondisi Awal</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Kondisi Kembali</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($peminjaman->detail_peminjaman as $index => $detail)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 text-gray-900 font-medium">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4">
                                            <span class="font-medium text-gray-900">{{ $detail->alat->nama_alat }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-medium">
                                                {{ $detail->jumlah }} unit
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gray-100 text-gray-700 text-xs font-medium">
                                                {{ ucfirst(str_replace('_',' ',$detail->kondisi_awal)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($detail->kondisi_kembali)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-cyan-50 text-cyan-700 text-xs font-medium">
                                                    {{ ucfirst(str_replace('_',' ',$detail->kondisi_kembali)) }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gray-50 text-gray-400 text-xs font-medium border border-dashed border-gray-200">
                                                    Belum
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Summary --}}
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-sm text-gray-500">Total Unit</span>
                        <span class="text-lg font-bold text-gray-900">{{ $peminjaman->detail_peminjaman->sum('jumlah') }} unit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>