<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold mb-4">{{ $alat->nama_alat }}</h3>
                    <p class="mb-4">Stok Tersedia: {{ $alat->stok }}</p>

                    <form action="{{ route('peminjam.ajukan', $alat->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Pinjam</label>
                            <input type="number" name="jumlah" id="jumlah" min="1" max="{{ $alat->stok }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="tgl_pinjam" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pinjam</label>
                            <input type="date" name="tgl_pinjam" id="tgl_pinjam" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="tgl_harus_kembali" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Harus Kembali</label>
                            <input type="date" name="tgl_harus_kembali" id="tgl_harus_kembali" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Ajukan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
