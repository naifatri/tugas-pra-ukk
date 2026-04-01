@component('layouts.app')

<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">
            Form Pengembalian
        </h2>
        <p class="text-sm text-gray-500">
            Konfirmasi pengembalian alat oleh peminjam
        </p>
    </div>

    {{-- Validation Errors Alert --}}
    @if($errors->any())
    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4 flex items-start justify-between shadow-sm"
         role="alert">
        <div class="flex items-start flex-1">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3 flex-1">
                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Ada kesalahan dalam form:</h3>
                <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-300 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('petugas.proses_kembali', $peminjaman->id) }}"
          method="POST"
          class="space-y-6">
        @csrf

        <div class="bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-4 bg-gray-50 border-b flex justify-between items-center">
                <h3 class="font-semibold text-gray-700">Detail Peminjaman</h3>

                <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">
                    ID #{{ $peminjaman->id }}
                </span>
            </div>

            {{-- Info --}}
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">

                <div>
                    <p class="text-gray-500">Peminjam</p>
                    <p class="font-semibold text-gray-800">
                        {{ optional($peminjaman->user)->nama_lengkap ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Tanggal Pinjam</p>
                    <p class="font-semibold text-gray-800">
                        {{ $peminjaman->tgl_pinjam }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Jatuh Tempo</p>
                    <p class="font-semibold text-gray-800">
                        {{ $peminjaman->tgl_harus_kembali }}
                    </p>
                </div>

            </div>

            {{-- Input Tanggal Kembali --}}
            <div class="px-6 py-6 border-b border-gray-200 bg-white">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Pengembalian <span class="text-red-500">*</span>
                </label>
                <input type="date" name="tgl_kembali_real" required
                       value="{{ old('tgl_kembali_real', now()->toDateString()) }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent
                       @error('tgl_kembali_real') border-red-500 @enderror">
                @error('tgl_kembali_real')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Tanggal pengembalian fisik alat</p>
            </div>

            {{-- Table --}}
            <div class="px-6 pb-6 overflow-x-auto">

                <p class="text-sm font-semibold text-gray-600 mb-3">
                    Konfirmasi Kondisi Alat Dikembalikan
                </p>

                <div class="space-y-4">
                    @foreach($peminjaman->detail_peminjaman as $detail)
                    <div class="border border-gray-200 rounded-xl p-5 bg-gradient-to-br from-gray-50 to-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Nama Alat</p>
                                <p class="text-sm font-bold text-gray-900 mt-1">{{ $detail->alat->nama_alat }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Jumlah Dipinjam</p>
                                <p class="text-sm font-bold text-gray-900 mt-1">{{ $detail->jumlah }} pcs</p>
                            </div>
                        </div>

                        {{-- Kondisi Awal --}}
                        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-xs text-blue-600 font-semibold mb-1">Kondisi Awal Pinjam</p>
                            <p class="text-sm font-medium text-gray-900">
                                @switch($detail->kondisi_awal)
                                    @case('baik')
                                        <span class="inline-flex items-center gap-2">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                            Baik
                                        </span>
                                        @break
                                    @case('rusak ringan')
                                        <span class="inline-flex items-center gap-2">
                                            <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                                            Rusak Ringan
                                        </span>
                                        @break
                                    @case('rusak berat')
                                        <span class="inline-flex items-center gap-2">
                                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                            Rusak Berat
                                        </span>
                                        @break
                                @endswitch
                            </p>
                        </div>

                        {{-- Kondisi Kembali Dropdown --}}
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Kondisi Saat Dikembalikan <span class="text-red-500">*</span>
                            </label>
                            <select name="kondisi_kembali[{{ $detail->id }}]" required
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent
                                    @error('kondisi_kembali.'.$detail->id) border-red-500 @enderror">
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="baik">✓ Baik</option>
                                <option value="rusak ringan">⚠ Rusak Ringan</option>
                                <option value="rusak berat">✗ Rusak Berat</option>
                                <option value="hilang">✗ Hilang</option>
                            </select>
                            @error('kondisi_kembali.'.$detail->id)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi Kondisi (Optional) --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Catatan Kondisi (Opsional)
                            </label>
                            <textarea name="deskripsi_kondisi_kembali[{{ $detail->id }}]" rows="3"
                                      placeholder="Contoh: Lecet di sisi kanan, tombol tidak berfungsi dengan sempurna, dll."
                                      class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent resize-vertical"
                            ></textarea>
                            <p class="text-xs text-gray-500 mt-1">Jelaskan detail kerusakan atau catatan khusus jika ada</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Input Denda --}}
            <div class="px-6 pb-8">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Denda
                </label>

                <input
                    type="text"
                    id="denda_display"
                    value="Rp 0"
                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-green-500 px-4 py-2"
                >

                <input type="hidden" name="denda" id="denda" value="0">

                <p class="text-xs text-gray-400 mt-1">
                    Masukkan nominal denda jika ada keterlambatan atau kerusakan
                </p>

            </div>

        </div>

        {{-- Buttons --}}
        <div class="flex justify-end gap-3">

            <a href="{{ route('petugas.aktif') }}"
               class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100">
                Batal
            </a>

            <button type="submit"
                class="px-6 py-2.5 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700">
                ✓ Konfirmasi Pengembalian
            </button>

        </div>

    </form>

</div>


{{-- Script Rupiah --}}
@push('scripts')
<script>
const display = document.getElementById('denda_display');
const hidden  = document.getElementById('denda');

display.addEventListener('input', function(e){
    let number = e.target.value.replace(/\D/g,'') || 0;

    hidden.value = number;

    display.value = 'Rp ' +
        new Intl.NumberFormat('id-ID').format(number);
});
</script>
@endpush

@endcomponent
