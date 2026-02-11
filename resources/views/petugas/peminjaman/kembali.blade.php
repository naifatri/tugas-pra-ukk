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

    <form action="{{ route('petugas.kembali.store', $peminjaman->id) }}"
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

            {{-- Table --}}
            <div class="px-6 pb-6 overflow-x-auto">

                <p class="text-sm font-semibold text-gray-600 mb-3">
                    Daftar Alat Dipinjam
                </p>

                <table class="w-full text-sm border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-gray-500 text-left">
                            <th>Nama Alat</th>
                            <th class="text-center">Jumlah</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($peminjaman->detail_peminjaman as $detail)
                        <tr class="bg-gray-50 rounded-lg">
                            <td class="px-4 py-3 font-medium">
                                {{ $detail->alat->nama_alat }}
                            </td>
                            <td class="px-4 py-3 text-center font-semibold">
                                {{ $detail->jumlah }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
