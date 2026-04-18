<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight tracking-tight">
                {{ __('Riwayat Pengembalian') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome/Header Banner -->
            <div class="relative overflow-hidden bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-600 rounded-2xl shadow-lg mb-6">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">
                                Arsip Pengembalian 📚
                            </h3>
                            <p class="text-emerald-50 text-sm sm:text-base max-w-xl">
                                Pantau riwayat peminjaman yang telah selesai dan kelola data denda jika ada keterlambatan.
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm text-white text-sm font-medium rounded-lg border border-white/30">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                {{ $stats['total'] }} Data Selesai
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Riwayat</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total'] }}</p>
                        </div>
                        <div class="p-3 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl">
                            <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Denda Terkumpul</p>
                            <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-2">
                                Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-3 bg-red-50 dark:bg-red-900/30 rounded-xl">
                            <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Peminjaman Telat</p>
                            <p class="text-3xl font-bold text-orange-600 dark:text-orange-400 mt-2">
                                {{ $stats['total_telat'] }}
                            </p>
                        </div>
                        <div class="p-3 bg-orange-50 dark:bg-orange-900/30 rounded-xl">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-emerald-100 dark:bg-emerald-900/50 rounded-lg">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Pengembalian Selesai</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total {{ $stats['total'] }} data tersimpan</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-16">No</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Peminjam</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Petugas</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Detail Alat</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deskripsi</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status Denda</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($peminjaman as $p)
                            <tr class="group hover:bg-emerald-50/50 dark:hover:bg-emerald-900/20 transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ ($peminjaman->currentPage() - 1) * $peminjaman->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white text-sm font-bold mr-3 shadow-sm">
                                            {{ strtoupper(substr($p->user->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-emerald-600 transition-colors">
                                                {{ $p->user->nama_lengkap }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.082.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                                {{ $p->user->kelas }} / {{ $p->user->jurusan }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white text-sm font-bold mr-3 shadow-sm">
                                            {{ $p->petugas ? strtoupper(substr($p->petugas->nama_lengkap, 0, 1)) : '-' }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $p->petugas ? $p->petugas->nama_lengkap : 'Tidak Ditentukan' }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                Petugas Pengembalian
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-sm text-gray-900 dark:text-gray-300 font-medium flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Pinjam: {{ \Carbon\Carbon::parse($p->tgl_pinjam)->isoFormat('DD MMM YYYY') }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Kembali: {{ \Carbon\Carbon::parse($p->tgl_kembali_real)->isoFormat('DD MMM YYYY') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($p->detail_peminjaman as $detail)
                                            <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-600 text-xs font-medium text-gray-700 dark:text-gray-300">
                                                <svg class="w-3 h-3 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                                {{ $detail->alat->nama_alat }}
                                                <span class="ml-1.5 px-1.5 py-0.5 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded text-[10px] font-bold">
                                                    {{ $detail->jumlah }}
                                                </span>
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-2 max-w-xs">
                                        <div class="text-sm text-gray-700 dark:text-gray-300">
                                            {{ $p->keterangan_denda ?: 'Tidak ada catatan denda.' }}
                                        </div>
                                        @php
                                            $detailDescriptions = $p->detail_peminjaman
                                                ->filter(fn ($detail) => !empty($detail->deskripsi_kondisi_kembali) || !empty($detail->kondisi_kembali))
                                                ->map(function ($detail) {
                                                    $deskripsi = $detail->deskripsi_kondisi_kembali ?: 'Tanpa catatan tambahan';
                                                    return $detail->alat->nama_alat . ': ' . ucfirst($detail->kondisi_kembali ?? 'baik') . ' - ' . $deskripsi;
                                                })
                                                ->take(2);
                                        @endphp
                                        @if($detailDescriptions->isNotEmpty())
                                            <div class="text-xs text-gray-500 dark:text-gray-400 space-y-1">
                                                @foreach($detailDescriptions as $description)
                                                    <p>{{ $description }}</p>
                                                @endforeach
                                                @if($p->detail_peminjaman->count() > 2)
                                                    <p>+ {{ $p->detail_peminjaman->count() - 2 }} item lainnya</p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($p->denda > 0 && $p->status_pembayaran_denda !== 'lunas')
                                        <div class="inline-flex flex-col items-end gap-1">
                                            <a href="{{ route('petugas.pelunasan.form', $p->id) }}"
                                               class="inline-flex items-center rounded-2xl bg-red-600 px-4 py-2 text-sm font-bold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-red-700">
                                                Rp {{ number_format($p->denda, 0, ',', '.') }}
                                            </a>
                                            @if($p->keterangan_denda)
                                                <span class="text-xs text-red-600 dark:text-red-300 max-w-[220px] text-right">
                                                    {{ $p->keterangan_denda }}
                                                </span>
                                            @endif
                                        </div>
                                    @elseif($p->denda > 0)
                                        <div class="inline-flex flex-col items-end gap-1">
                                            <span class="text-sm font-bold text-white bg-emerald-600 dark:bg-emerald-700 px-3 py-1.5 rounded-xl border border-emerald-700 dark:border-emerald-800 shadow-md inline-flex items-center">
                                                Lunas
                                            </span>
                                            <span class="text-xs text-emerald-600 dark:text-emerald-300 max-w-[220px] text-right">
                                                Rp {{ number_format($p->denda, 0, ',', '.') }}{{ $p->tgl_pelunasan_denda ? ' • ' . \Carbon\Carbon::parse($p->tgl_pelunasan_denda)->isoFormat('DD MMM YYYY') : '' }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="inline-flex flex-col items-end gap-1">
                                            <span class="text-sm font-bold text-white bg-emerald-600 dark:bg-emerald-700 px-3 py-1.5 rounded-xl border border-emerald-700 dark:border-emerald-800 shadow-md inline-flex items-center">
                                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Tidak Ada Denda
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-top">
                                    @php
                                        $email = $p->user->email ?? null;
                                        $nomorWhatsapp = preg_replace('/\D+/', '', $p->user->nomor_whatsapp ?? '');
                                        if ($nomorWhatsapp && str_starts_with($nomorWhatsapp, '0')) {
                                            $nomorWhatsapp = '62' . substr($nomorWhatsapp, 1);
                                        }
                                        $notificationChannel = $p->notifikasi_pengembalian_kanal;
                                    @endphp

                                    <div class="mx-auto flex w-full max-w-[250px] flex-col gap-3 rounded-2xl border border-gray-200 bg-white p-4 text-left shadow-sm dark:border-gray-700 dark:bg-gray-800/80">

                                        <a href="{{ route('petugas.riwayat.detail', $p->id) }}"
                                           class="inline-flex w-full items-center justify-center rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100 dark:border-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                            Detail
                                        </a>

                                        <div
                                            class="{{ $notificationChannel ? '' : 'rounded-2xl border border-gray-200 bg-gray-50/90 p-3.5 dark:border-gray-700 dark:bg-gray-700/30' }}"
                                            data-notification-card
                                            data-url="{{ route('petugas.riwayat.kirim-notifikasi', $p->id) }}"
                                            data-state="{{ $notificationChannel ?: 'pending' }}"
                                        >
                                        

                                            <div class="{{ $notificationChannel ? 'hidden' : 'grid' }} gap-2" data-notification-actions>
                                                <button
                                                    type="button"
                                                    class="notification-trigger inline-flex w-full items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-white px-4 py-2.5 text-sm font-semibold text-emerald-700 shadow-sm transition hover:border-emerald-300 hover:bg-emerald-50 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-100 disabled:text-gray-400 dark:border-emerald-800 dark:bg-gray-800 dark:text-emerald-300 dark:hover:bg-emerald-900/20 dark:disabled:border-gray-700 dark:disabled:bg-gray-800/60 dark:disabled:text-gray-500"
                                                    data-channel="wa"
                                                    {{ $nomorWhatsapp ? '' : 'disabled' }}
                                                >
                                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .2 5.33.2 11.9c0 2.1.55 4.15 1.6 5.96L0 24l6.33-1.66a11.82 11.82 0 005.74 1.47h.01c6.55 0 11.88-5.33 11.88-11.9 0-3.18-1.23-6.16-3.44-8.43zM12.08 21.8h-.01a9.8 9.8 0 01-5-1.37l-.36-.21-3.76.99 1-3.66-.24-.38a9.8 9.8 0 01-1.5-5.25c0-5.42 4.42-9.84 9.86-9.84 2.63 0 5.1 1.02 6.96 2.89a9.77 9.77 0 012.89 6.95c0 5.43-4.43 9.85-9.84 9.85zm5.4-7.35c-.3-.15-1.77-.88-2.05-.98-.27-.1-.47-.15-.66.15-.2.3-.76.98-.94 1.18-.17.2-.35.22-.65.08-.3-.15-1.26-.46-2.39-1.48-.88-.78-1.47-1.74-1.64-2.04-.17-.3-.02-.46.13-.6.14-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.67-1.62-.92-2.22-.24-.58-.48-.5-.66-.51l-.57-.01c-.2 0-.52.08-.79.38-.27.3-1.04 1.02-1.04 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.08 4.49.71.31 1.27.49 1.7.63.72.23 1.38.2 1.9.12.58-.09 1.77-.72 2.02-1.42.25-.7.25-1.31.17-1.43-.07-.12-.27-.2-.57-.35z"/>
                                                    </svg>
                                                    WhatsApp
                                                </button>
                                                <button
                                                    type="button"
                                                    class="notification-trigger inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 disabled:cursor-not-allowed disabled:bg-slate-300"
                                                    data-channel="email"
                                                    {{ $email ? '' : 'disabled' }}
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.945a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                                                    </svg>
                                                    Email
                                                </button>
                                            </div>

                                            <div class="{{ $notificationChannel ? 'flex' : 'hidden' }} justify-center" data-notification-badge>
                                                @if($notificationChannel === 'wa')
                                                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-sm dark:border-emerald-800 dark:bg-gray-800 dark:text-emerald-300">
                                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                            <path d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .2 5.33.2 11.9c0 2.1.55 4.15 1.6 5.96L0 24l6.33-1.66a11.82 11.82 0 005.74 1.47h.01c6.55 0 11.88-5.33 11.88-11.9 0-3.18-1.23-6.16-3.44-8.43zM12.08 21.8h-.01a9.8 9.8 0 01-5-1.37l-.36-.21-3.76.99 1-3.66-.24-.38a9.8 9.8 0 01-1.5-5.25c0-5.42 4.42-9.84 9.86-9.84 2.63 0 5.1 1.02 6.96 2.89a9.77 9.77 0 012.89 6.95c0 5.43-4.43 9.85-9.84 9.85zm5.4-7.35c-.3-.15-1.77-.88-2.05-.98-.27-.1-.47-.15-.66.15-.2.3-.76.98-.94 1.18-.17.2-.35.22-.65.08-.3-.15-1.26-.46-2.39-1.48-.88-.78-1.47-1.74-1.64-2.04-.17-.3-.02-.46.13-.6.14-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.67-1.62-.92-2.22-.24-.58-.48-.5-.66-.51l-.57-.01c-.2 0-.52.08-.79.38-.27.3-1.04 1.02-1.04 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.08 4.49.71.31 1.27.49 1.7.63.72.23 1.38.2 1.9.12.58-.09 1.77-.72 2.02-1.42.25-.7.25-1.31.17-1.43-.07-.12-.27-.2-.57-.35z"/>
                                                        </svg>
                                                        WA
                                                    </span>
                                                @elseif($notificationChannel === 'email')
                                                    <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm dark:border-slate-700 dark:bg-gray-800 dark:text-slate-200">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.945a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                                                        </svg>
                                                        Email
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                        <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-full mb-4">
                                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.082.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum Ada Riwayat</h4>
                                        <p class="text-sm max-w-xs mx-auto text-gray-500">Saat ini belum ada data peminjaman yang telah dikembalikan sepenuhnya.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $peminjaman->links() }}
                </div>

                @if($peminjaman->total() > 0)
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Data riwayat diarsipkan secara permanen untuk keperluan pelaporan.</span>
                        </div>
                        <div>
                            <span>Tampilkan {{ $peminjaman->count() }} data terkini</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const badgeMap = {
                wa: `
                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-sm dark:border-emerald-800 dark:bg-gray-800 dark:text-emerald-300">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .2 5.33.2 11.9c0 2.1.55 4.15 1.6 5.96L0 24l6.33-1.66a11.82 11.82 0 005.74 1.47h.01c6.55 0 11.88-5.33 11.88-11.9 0-3.18-1.23-6.16-3.44-8.43zM12.08 21.8h-.01a9.8 9.8 0 01-5-1.37l-.36-.21-3.76.99 1-3.66-.24-.38a9.8 9.8 0 01-1.5-5.25c0-5.42 4.42-9.84 9.86-9.84 2.63 0 5.1 1.02 6.96 2.89a9.77 9.77 0 012.89 6.95c0 5.43-4.43 9.85-9.84 9.85zm5.4-7.35c-.3-.15-1.77-.88-2.05-.98-.27-.1-.47-.15-.66.15-.2.3-.76.98-.94 1.18-.17.2-.35.22-.65.08-.3-.15-1.26-.46-2.39-1.48-.88-.78-1.47-1.74-1.64-2.04-.17-.3-.02-.46.13-.6.14-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.67-1.62-.92-2.22-.24-.58-.48-.5-.66-.51l-.57-.01c-.2 0-.52.08-.79.38-.27.3-1.04 1.02-1.04 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.08 4.49.71.31 1.27.49 1.7.63.72.23 1.38.2 1.9.12.58-.09 1.77-.72 2.02-1.42.25-.7.25-1.31.17-1.43-.07-.12-.27-.2-.57-.35z"/>
                        </svg>
                        WA
                    </span>
                `,
                email: `
                    <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm dark:border-slate-700 dark:bg-gray-800 dark:text-slate-200">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.945a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                        </svg>
                        Email
                    </span>
                `,
            };

            const activateFinalState = (card, channel) => {
                const actions = card.querySelector('[data-notification-actions]');
                const badge = card.querySelector('[data-notification-badge]');

                if (!actions || !badge || !badgeMap[channel]) {
                    return;
                }

                actions.classList.add('hidden');
                badge.classList.remove('hidden');
                badge.classList.add('flex');
                badge.innerHTML = badgeMap[channel];
                card.className = '';
                card.dataset.state = channel;
            };

            document.querySelectorAll('.notification-trigger').forEach((button) => {
                button.addEventListener('click', async function () {
                    const card = this.closest('[data-notification-card]');
                    const url = card?.dataset.url;
                    const channel = this.dataset.channel;

                    if (!card || !url || !channel || !csrfToken || card.dataset.state !== 'pending') {
                        return;
                    }

                    const buttons = card.querySelectorAll('.notification-trigger');
                    const initialStates = Array.from(buttons).map((item) => item.disabled);
                    const initialLabel = this.innerHTML;

                    buttons.forEach((item) => {
                        item.disabled = true;
                    });
                    this.textContent = 'Memproses...';

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({ kanal: channel }),
                        });

                        const result = await response.json();

                        if (!response.ok || !result.success) {
                            throw new Error(result.message || 'Notifikasi gagal diproses.');
                        }

                        activateFinalState(card, result.kanal);

                        if (result.redirect_url) {
                            window.open(result.redirect_url, '_blank', 'noopener,noreferrer');
                        }
                    } catch (error) {
                        buttons.forEach((item, index) => {
                            item.disabled = initialStates[index];
                        });
                        this.innerHTML = initialLabel;
                        window.alert(error.message || 'Terjadi kesalahan saat mengirim notifikasi.');
                    }
                });
            });
        });
    </script>
</x-app-layout>
