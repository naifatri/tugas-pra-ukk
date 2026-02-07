<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Proses Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Detail Peminjam</h3>
                        <p>Nama: {{ $peminjaman->user->nama_lengkap }}</p>
                        <p>Kelas: {{ $peminjaman->user->kelas }}</p>
                        <p>Tgl Pinjam: {{ $peminjaman->tgl_pinjam }}</p>
                        <p>Tgl Harus Kembali: {{ $peminjaman->tgl_harus_kembali }}</p>
                    </div>

                    <form action="{{ route('petugas.proses_kembali', $peminjaman->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="tgl_kembali_real" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Kembali Real</label>
                            <input type="date" name="tgl_kembali_real" id="tgl_kembali_real" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>

                        <h3 class="text-lg font-semibold mb-2">Kondisi Alat Kembali</h3>
                        <table class="min-w-full divide-y divide-gray-200 mb-4">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Alat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kondisi Kembali</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                @foreach($peminjaman->detail_peminjaman as $detail)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->alat->nama_alat }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->jumlah }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="kondisi_kembali[{{ $detail->id }}]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                            <option value="baik">Baik</option>
                                            <option value="rusak">Rusak</option>
                                            <option value="hilang">Hilang</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Pengembalian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
