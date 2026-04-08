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
            <div class="px-6 py-6 border-t border-gray-200 bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Tipe Denda --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Tipe Denda <span class="text-red-500">*</span>
                        </label>
                        <div class="space-y-2">
                            <label class="flex items-center p-3 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer hover:bg-white dark:hover:bg-gray-800 transition">
                                <input type="radio" name="tipe_denda" id="tipe_auto" value="auto" checked 
                                       class="w-4 h-4 text-green-600" onchange="toggleDendaInput()">
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Otomatis (Keterlambatan)</span>
                            </label>
                            <label class="flex items-center p-3 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer hover:bg-white dark:hover:bg-gray-800 transition">
                                <input type="radio" name="tipe_denda" id="tipe_manual" value="manual" 
                                       class="w-4 h-4 text-orange-600" onchange="toggleDendaInput()">
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Manual (Kerusakan/Lainnya)</span>
                            </label>
                        </div>
                    </div>

                    {{-- Nominal Denda --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Nominal Denda
                        </label>
                        <input
                            type="text"
                            id="denda_display"
                            value="Rp 0"
                            placeholder="Rp 0"
                            disabled
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 px-4 py-2.5 text-sm font-semibold text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 focus:ring-2 focus:ring-orange-500 disabled:opacity-75"
                        >
                        <input type="hidden" name="denda" id="denda" value="0">
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                            Pilih tipe denda untuk mengisi nominal
                        </p>
                    </div>
                </div>

                {{-- Manual Denda Input (Hidden by default) --}}
                <div id="manual_denda_input" class="hidden mt-6 p-4 rounded-lg bg-white dark:bg-gray-800 border border-orange-200 dark:border-orange-800">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Masukkan Nominal Denda <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-500 font-semibold">Rp</span>
                        <input
                            type="text"
                            id="manual_denda_input_field"
                            placeholder="100000"
                            class="w-full rounded-lg border border-orange-300 dark:border-orange-600 px-4 pl-10 py-2.5 text-sm font-medium text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500"
                            oninput="updateDendaDisplay()"
                        >
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                        Contoh: 50000, 100000, 250000, dst. (tanpa Rp dan tanpa pemisah)
                    </p>
                </div>

                {{-- Info --}}
                <div class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg">
                    <p class="text-xs text-blue-700 dark:text-blue-300 font-medium">
                        <strong>ℹ️ Info:</strong> 
                        Denda otomatis dihitung Rp 1.000 per hari keterlambatan. 
                        Gunakan denda manual untuk kerusakan atau penggantian barang.
                    </p>
                </div>

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


{{-- Script Rupiah & Denda Handler --}}
@push('scripts')
<script>
const displayField = document.getElementById('denda_display');
const hiddenField = document.getElementById('denda');
const manualDendaInput = document.getElementById('manual_denda_input');
const manualDendaInputField = document.getElementById('manual_denda_input_field');
const tipeAutoRadio = document.getElementById('tipe_auto');
const tipeManualRadio = document.getElementById('tipe_manual');

// Toggle manual input visibility
function toggleDendaInput() {
    if (tipeManualRadio.checked) {
        manualDendaInput.classList.remove('hidden');
        displayField.disabled = false;
        displayField.classList.remove('opacity-75');
        manualDendaInputField.focus();
    } else {
        manualDendaInput.classList.add('hidden');
        displayField.disabled = true;
        displayField.classList.add('opacity-75');
        manualDendaInputField.value = '';
    }
    updateDendaDisplay();
}

// Update denda display & hidden field
function updateDendaDisplay() {
    let dendaValue = 0;
    
    if (tipeManualRadio.checked && manualDendaInputField.value) {
        let inputValue = manualDendaInputField.value.replace(/\D/g, '') || 0;
        dendaValue = parseInt(inputValue);
    }
    
    hiddenField.value = dendaValue;
    displayField.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(dendaValue);
}

// Verify denda on form submit
document.querySelector('form')?.addEventListener('submit', function(e) {
    const tipeSelected = document.querySelector('input[name="tipe_denda"]:checked').value;
    
    if (tipeSelected === 'manual') {
        const dendaValue = parseInt(document.getElementById('denda').value || 0);
        if (dendaValue <= 0) {
            e.preventDefault();
            alert('⚠️ Silakan masukkan nominal denda yang valid!');
            manualDendaInputField.focus();
            return false;
        }
    }
});

// Initialize
toggleDendaInput();
</script>
@endpush

@endcomponent
