<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Alat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('alats.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="nama_alat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Alat</label>
                                <input type="text" name="nama_alat" id="nama_alat" value="{{ $alat->nama_alat }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="kode_alat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Alat</label>
                                <input type="text" name="kode_alat" id="kode_alat" value="{{ $alat->kode_alat }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="kategori_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id }}" {{ $alat->kategori_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok</label>
                                <input type="number" name="stok" id="stok" value="{{ $alat->stok }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="kondisi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kondisi</label>
                                <select name="kondisi" id="kondisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="baik" {{ $alat->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="rusak" {{ $alat->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                    <option value="hilang" {{ $alat->kondisi == 'hilang' ? 'selected' : '' }}>Hilang</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="lokasi_penyimpanan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi Penyimpanan</label>
                                <input type="text" name="lokasi_penyimpanan" id="lokasi_penyimpanan" value="{{ $alat->lokasi_penyimpanan }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4 col-span-2">
                                <label for="foto_alat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto Alat</label>
                                @if($alat->foto_alat)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($alat->foto_alat) }}" alt="Foto Alat" class="w-32 h-32 object-cover rounded">
                                    </div>
                                @endif
                                <input type="file" name="foto_alat" id="foto_alat" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100
                              " accept="image/*">
                            </div>
                            <div class="mb-4 col-span-2">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $alat->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
