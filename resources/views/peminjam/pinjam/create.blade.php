<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    
                    {{-- Error Alert dengan animasi --}}
                    @if(session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-4 rounded-r-lg mb-6 shadow-sm animate-fade-in" role="alert">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <strong class="font-bold block mb-1">Error!</strong>
                                    <span class="text-sm">{{ session('error') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Header Card dengan Icon --}}
                    <div class="flex items-center mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $alat->nama_alat }}</h3>
                            <div class="flex items-center mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                                    Stok Tersedia: {{ $alat->stok }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('peminjam.ajukan', $alat->id) }}" method="POST" class="space-y-6">
                        @csrf
                        
                        {{-- Jumlah Pinjam --}}
                        <div class="group">
                            <label for="jumlah" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                Jumlah Pinjam
                            </label>
                            <div class="relative">
                                <input 
                                    type="number" 
                                    name="jumlah" 
                                    id="jumlah" 
                                    min="1" 
                                    max="{{ $alat->stok }}" 
                                    class="block w-full pl-4 pr-12 py-3 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                    placeholder="Masukkan jumlah..."
                                    required
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400 text-sm">unit</span>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal {{ $alat->stok }} unit tersedia</p>
                        </div>

                        {{-- Grid untuk Tanggal --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Tanggal Pinjam --}}
                            <div>
                                <label for="tgl_pinjam" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Tanggal Pinjam
                                </label>
                                <input 
                                    type="date" 
                                    name="tgl_pinjam" 
                                    id="tgl_pinjam" 
                                    value="{{ date('Y-m-d') }}" 
                                    class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                    required
                                >
                            </div>

                            {{-- Tanggal Harus Kembali --}}
                            <div>
                                <label for="tgl_harus_kembali" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tanggal Harus Kembali
                                </label>
                                <input 
                                    type="date" 
                                    name="tgl_harus_kembali" 
                                    id="tgl_harus_kembali" 
                                    class="block w-full px-4 py-3 border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                    required
                                >
                            </div>
                        </div>

                        {{-- Info Box --}}
                        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4 flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm text-blue-700 dark:text-blue-300">
                                Pastikan tanggal pengembalian sesuai dengan kebutuhan. Keterlambatan pengembalian dapat dikenakan sanksi.
                            </p>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button 
                                type="button" 
                                onclick="window.history.back()" 
                                class="mr-4 px-6 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out font-medium"
                            >
                                Batal
                            </button>
                            <button 
                                type="submit" 
                                class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-150 ease-in-out flex items-center"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Ajukan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Footer Note --}}
            <p class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
                Formulir peminjaman akan diproses oleh admin setelah pengajuan
            </p>
        </div>
    </div>

    {{-- Tambahkan di CSS/SCSS atau style tag --}}
    @push('styles')
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
    @endpush
</x-app-layout>