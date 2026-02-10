<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Alat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('alats.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="nama_alat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Alat</label>
                                <input type="text" name="nama_alat" id="nama_alat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="kode_alat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Alat</label>
                                <input type="text" name="kode_alat" id="kode_alat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="kategori_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok</label>
                                <input type="number" name="stok" id="stok" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4">
                                <label for="kondisi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kondisi</label>
                                <select name="kondisi" id="kondisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="baik">Baik</option>
                                    <option value="rusak">Rusak</option>
                                    <option value="hilang">Hilang</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="lokasi_penyimpanan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi Penyimpanan</label>
                                <input type="text" name="lokasi_penyimpanan" id="lokasi_penyimpanan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div class="mb-4 col-span-2">
                                <label for="foto_alat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto Alat</label>
                                <div class="mt-2 flex items-center gap-4">
                                    <div id="preview-container" class="hidden">
                                        <img id="image-preview" src="#" alt="Preview" class="w-24 h-24 object-cover rounded-lg border-2 border-indigo-500 shadow-sm">
                                    </div>
                                    <div id="placeholder-preview" class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 border-2 border-dashed border-gray-300 dark:border-gray-600">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" name="foto_alat" id="foto_alat" 
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-indigo-400 transition-all cursor-pointer" 
                                            accept="image/*">
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG, atau WEBP. Maksimal 2MB.</p>
                                    </div>
                                </div>
                                @error('foto_alat')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <script>
                                document.getElementById('foto_alat').addEventListener('change', function(e) {
                                    const previewContainer = document.getElementById('preview-container');
                                    const placeholder = document.getElementById('placeholder-preview');
                                    const previewImage = document.getElementById('image-preview');
                                    const file = e.target.files[0];

                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(event) {
                                            previewImage.src = event.target.result;
                                            previewContainer.classList.remove('hidden');
                                            placeholder.classList.add('hidden');
                                        };
                                        reader.readAsDataURL(file);
                                    } else {
                                        previewContainer.classList.add('hidden');
                                        placeholder.classList.remove('hidden');
                                    }
                                });
                            </script>
                            <div class="mb-4 col-span-2">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
