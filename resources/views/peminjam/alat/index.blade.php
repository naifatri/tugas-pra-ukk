<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Alat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <p class="font-bold">Sukses!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($alat as $a)
                        <div class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm hover:shadow-md transition duration-300 overflow-hidden flex flex-col">
                            <div class="relative h-48 bg-gray-200 dark:bg-gray-600">
                                @if($a->foto_alat)
                                    <img src="{{ Storage::url($a->foto_alat) }}" alt="{{ $a->nama_alat }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-500 dark:text-gray-400">
                                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-0 right-0 m-2">
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-indigo-500 text-white shadow">
                                        {{ $a->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-4 flex-1 flex flex-col">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $a->nama_alat }}</h3>
                                <div class="mb-4">
                                    <span class="inline-block bg-gray-100 dark:bg-gray-600 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 dark:text-gray-300 mr-2 mb-2">
                                        Stok: {{ $a->stok }}
                                    </span>
                                    <span class="inline-block {{ $a->kondisi == 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">
                                        {{ ucfirst($a->kondisi) }}
                                    </span>
                                </div>
                                <div class="mt-auto">
                                    @if($a->stok > 0)
                                        <a href="{{ route('peminjam.pinjam', $a->id) }}" class="block w-full text-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Pinjam Sekarang
                                        </a>
                                    @else
                                        <button disabled class="block w-full text-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest cursor-not-allowed">
                                            Stok Habis
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-12 bg-gray-50 dark:bg-gray-700 rounded-lg border border-dashed border-gray-300 dark:border-gray-600">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada alat</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada alat yang tersedia untuk dipinjam saat ini.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
