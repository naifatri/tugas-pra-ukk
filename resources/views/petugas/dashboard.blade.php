<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Petugas Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Permintaan Menunggu -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Permintaan Menunggu</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $permintaanCount }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('petugas.permintaan') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Aktif -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Peminjaman Aktif</p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $aktifCount }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('petugas.aktif') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat Datang Petugas! Silahkan cek menu permintaan untuk memproses peminjaman baru.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
