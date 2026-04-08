# 🔄 BEFORE & AFTER CODE COMPARISON - PENGEMBALIAN DENDA

---

## 1. FORM INPUT DENDA DESIGN

### ❌ BEFORE
```blade
<!-- kembali.blade.php - SEBELUM -->
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
```

**Masalah:**
- Hanya satu input denda (simple)
- Tidak ada cara membedakan otomatis vs manual
- Tidak ada validasi
- Input description tidak jelas

### ✅ AFTER
```blade
<!-- kembali.blade.php - SESUDAH -->
<div class="px-6 py-6 border-t border-gray-200 bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Tipe Denda --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                Tipe Denda <span class="text-red-500">*</span>
            </label>
            <div class="space-y-2">
                <!-- Opsi 1: Otomatis -->
                <label class="flex items-center p-3 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer hover:bg-white dark:hover:bg-gray-800 transition">
                    <input type="radio" name="tipe_denda" id="tipe_auto" value="auto" checked 
                           class="w-4 h-4 text-green-600" onchange="toggleDendaInput()">
                    <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Otomatis (Keterlambatan)
                    </span>
                </label>
                
                <!-- Opsi 2: Manual -->
                <label class="flex items-center p-3 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer hover:bg-white dark:hover:bg-gray-800 transition">
                    <input type="radio" name="tipe_denda" id="tipe_manual" value="manual" 
                           class="w-4 h-4 text-orange-600" onchange="toggleDendaInput()">
                    <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Manual (Kerusakan/Lainnya)
                    </span>
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
```

**Keuntungan:**
- ✅ UI lebih jelas & informatif
- ✅ Radio button untuk memilih tipe
- ✅ Manual input hanya visible jika dipilih
- ✅ Format input dengan contoh
- ✅ Info panel penjelasan

---

## 2. JAVASCRIPT EVENT HANDLING

### ❌ BEFORE
```javascript
// SEBELUM - Event listener simple
const display = document.getElementById('denda_display');
const hidden  = document.getElementById('denda');

display.addEventListener('input', function(e){
    let number = e.target.value.replace(/\D/g,'') || 0;
    
    hidden.value = number;
    
    display.value = 'Rp ' +
        new Intl.NumberFormat('id-ID').format(number);
});
```

**Masalah:**
- Hanya 1 event listener (input event)
- Hidden field tidak ter-update jika field value tidak berubah
- Tidak ada validation
- Tidak ada form submit check
- Tidak responsive terhadap radio button change

### ✅ AFTER
```javascript
// SESUDAH - Robust event handling
const displayField = document.getElementById('denda_display');
const hiddenField = document.getElementById('denda');
const manualDendaInput = document.getElementById('manual_denda_input');
const manualDendaInputField = document.getElementById('manual_denda_input_field');
const tipeAutoRadio = document.getElementById('tipe_auto');
const tipeManualRadio = document.getElementById('tipe_manual');

// 1. Toggle manual input visibility
function toggleDendaInput() {
    if (tipeManualRadio.checked) {
        // Tampilkan manual input
        manualDendaInput.classList.remove('hidden');
        displayField.disabled = false;
        displayField.classList.remove('opacity-75');
        manualDendaInputField.focus();  // ← Auto focus
    } else {
        // Sembunyikan manual input
        manualDendaInput.classList.add('hidden');
        displayField.disabled = true;
        displayField.classList.add('opacity-75');
        manualDendaInputField.value = '';  // ← Clear value
    }
    updateDendaDisplay();  // ← Update immediately
}

// 2. Update display & hidden field
function updateDendaDisplay() {
    let dendaValue = 0;
    
    if (tipeManualRadio.checked && manualDendaInputField.value) {
        let inputValue = manualDendaInputField.value
            .replace(/\D/g, '') || 0;  // ← Remove non-digits
        dendaValue = parseInt(inputValue);
    }
    
    hiddenField.value = dendaValue;  // ← Sync to hidden
    displayField.value = 'Rp ' + 
        new Intl.NumberFormat('id-ID').format(dendaValue);
}

// 3. Form submission validation
document.querySelector('form')?.addEventListener('submit', function(e) {
    const tipeSelected = document.querySelector(
        'input[name="tipe_denda"]:checked'
    ).value;
    
    if (tipeSelected === 'manual') {
        const dendaValue = parseInt(
            document.getElementById('denda').value || 0
        );
        if (dendaValue <= 0) {
            e.preventDefault();  // ← Block submission
            alert('⚠️ Silakan masukkan nominal denda yang valid!');
            manualDendaInputField.focus();
            return false;
        }
    }
});

// 4. Initialize on page load
toggleDendaInput();
```

**Keuntungan:**
- ✅ Multiple functions dengan tanggung jawab jelas
- ✅ Toggle visibility conditional
- ✅ Event validation sebelum submit
- ✅ Better UX (auto focus, clear)
- ✅ Robust input parsing

---

## 3. CONTROLLER METHOD - prosesPengembalian()

### ❌ BEFORE
```php
public function prosesPengembalian(Request $request, $id)
{
    $request->validate([
        'tgl_kembali_real' => 'required|date',
        'kondisi_kembali' => 'required|array',
        'kondisi_kembali.*' => 'required|in:baik,rusak ringan,rusak berat,hilang',
        'deskripsi_kondisi_kembali' => 'nullable|array',
    ]);

    // ... get peminjaman ...

    $peminjaman->tgl_kembali_real = $request->tgl_kembali_real;
    $peminjaman->petugas_id = auth()->id();

    // ❌ MASALAH: Denda dihitung OTOMATIS, form input di-IGNORE!
    $denda = 0;
    if ($tgl_kembali->gt($tgl_seharusnya)) {
        $days = $tgl_kembali->diffInDays($tgl_seharusnya);
        $denda = $days * 1000;
        $peminjaman->keterangan_denda = "Terlambat $days hari";
    }

    // ❌ Form denda input sama sekali tidak di-baca!
    $peminjaman->denda = $denda;
    $peminjaman->status_pinjam = 'kembali';
    $peminjaman->save();

    // ... update detail & stock ...
    
    return redirect()->route('petugas.aktif')
        ->with('success', 'Pengembalian berhasil diproses. Denda: Rp ' . number_format($denda));
}
```

**Masalah:**
- Form input denda tidak di-validasi
- Denda selalu dihitung otomatis (keterlambatan)
- Manual denda input di-ignore
- Keterangan denda tidak informatif (always hardcoded)
- Tidak ada error handling yang detail

### ✅ AFTER
```php
public function prosesPengembalian(Request $request, $id)
{
    // ✅ IMPROVED: Validasi termasuk tipe_denda
    $request->validate([
        'tgl_kembali_real' => 'required|date',
        'kondisi_kembali' => 'required|array',
        'kondisi_kembali.*' => 'required|in:baik,rusak ringan,rusak berat,hilang',
        'deskripsi_kondisi_kembali' => 'nullable|array',
        'tipe_denda' => 'required|in:auto,manual',  // ← New validation
        'denda' => 'nullable|numeric|min:0',  // ← New validation
    ]);

    $peminjaman = \App\Models\Peminjaman::with('detail_peminjaman.alat')
        ->findOrFail($id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
        $peminjaman->tgl_kembali_real = $request->tgl_kembali_real;
        $peminjaman->petugas_id = auth()->id();

        // ✅ IMPROVED: Calculate atau use manual denda
        $tgl_seharusnya = \Carbon\Carbon::parse($peminjaman->tgl_harus_kembali);
        $tgl_kembali = \Carbon\Carbon::parse($request->tgl_kembali_real);

        $denda = 0;
        $keterangan_denda = null;

        if ($request->tipe_denda === 'auto') {
            // ✅ Auto calculation
            if ($tgl_kembali->gt($tgl_seharusnya)) {
                $days = $tgl_kembali->diffInDays($tgl_seharusnya);
                $denda = $days * 1000;
                $keterangan_denda = "Terlambat $days hari @ Rp 1.000/hari";
            } else {
                $keterangan_denda = "Tepat waktu, tanpa denda";
            }
        } elseif ($request->tipe_denda === 'manual' && $request->denda > 0) {
            // ✅ Manual input accepted
            $denda = $request->denda;
            $keterangan_denda = "Denda manual (kerusakan/penggantian barang)";
        }

        $peminjaman->denda = $denda;
        $peminjaman->keterangan_denda = $keterangan_denda;  // ← Now dynamic!
        $peminjaman->status_pinjam = 'kembali';
        $peminjaman->save();

        // ... update detail & stock ...
        
        // ✅ Better logging
        \App\Models\LogAktivitas::storeLog(
            'Proses Pengembalian', 
            'Peminjaman', 
            'Memproses pengembalian (ID: ' . $id . '). Denda: Rp ' . number_format($denda) . 
            '. Tipe: ' . $request->tipe_denda . '. Petugas: ' . auth()->user()->nama_lengkap
        );

        \Illuminate\Support\Facades\DB::commit();

        return redirect()->route('petugas.aktif')
            ->with('success', 'Pengembalian berhasil diproses. Denda: Rp ' . number_format($denda));
            
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\DB::rollBack();
        \Log::error('Error processing pengembalian: ' . $e->getMessage());
        return redirect()->back()
            ->withErrors(['error' => 'Gagal memproses pengembalian: ' . $e->getMessage()])
            ->withInput();
    }
}
```

**Keuntungan:**
- ✅ Form input denda di-accept & di-validasi
- ✅ Tipe denda (auto/manual) ter-proses
- ✅ Keterangan denda dynamic & informatif
- ✅ Better logging untuk audit
- ✅ Error handling yang lengkap
- ✅ Transaction handling robust

---

## 4. RIWAYAT VIEW - LIPE Status Denda Column

### ❌ BEFORE
```blade
<!-- SEBELUM - Status denda column -->
<td class="px-6 py-4 whitespace-nowrap text-right">
    @if($p->denda > 0)
        <div class="inline-flex flex-col items-end">
            <span class="text-sm font-bold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 px-3 py-1.5 rounded-xl border border-red-100 dark:border-red-800 shadow-sm">
                Rp {{ number_format($p->denda, 0, ',', '.') }}
            </span>
            <!-- ❌ MASALAH: Hardcoded "Terlambat" -->
            <span class="text-[10px] text-red-500 font-medium mt-1 uppercase tracking-wider">
                Terlambat
            </span>
        </div>
    @else
        <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 px-3 py-1.5 rounded-xl border border-emerald-100 dark:border-emerald-800 shadow-sm inline-flex items-center">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Lunas
        </span>
    @endif
</td>
```

**Masalah:**
- Hardcoded "Terlambat" untuk semua denda > 0
- Tidak menunjukkan detail kenapa ada denda
- Tidak fleksibel (bisa manual denda untuk kerusakan)
- Keterangan_denda tidak ditampilkan

### ✅ AFTER
```blade
<!-- SESUDAH - Status denda column dengan keterangan -->
<td class="px-6 py-4 whitespace-nowrap text-right">
    @if($p->denda > 0)
        <div class="inline-flex flex-col items-end">
            <!-- ✅ Nominal denda tetap sama -->
            <span class="text-sm font-bold text-white bg-red-600 dark:bg-red-700 px-3 py-1.5 rounded-xl border border-red-700 dark:border-red-800 shadow-md">
                Rp {{ number_format($p->denda, 0, ',', '.') }}
            </span>
            <!-- ✅ DYNAMIC: Tampil keterangan_denda dari database -->
            <span class="text-[10px] text-red-600 dark:text-red-400 font-semibold mt-1.5 uppercase tracking-wider">
                {{ $p->keterangan_denda ?? 'Ada Denda' }}
            </span>
        </div>
    @else
        <span class="text-sm font-bold text-white bg-emerald-600 dark:bg-emerald-700 px-3 py-1.5 rounded-xl border border-emerald-700 dark:border-emerald-800 shadow-md inline-flex items-center">
            <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            Lunas
        </span>
    @endif
</td>
```

**Keuntungan:**
- ✅ Keterangan dynamic dari database
- ✅ Fleksibel untuk berbagai tipe denda
- ✅ Informasi lebih lengkap & transparan
- ✅ Better styling (white text, darker background)

---

## 📊 COMPARISON TABLE

| Aspek | BEFORE | AFTER |
|-------|--------|-------|
| **Form Design** | Simple 1 input | Radio buttons + conditional input |
| **Validation** | Basic (date, kondisi) | + tipe_denda + denda numeric |
| **JavaScript** | 1 event listener | Multiple functions + form validation |
| **Controller** | Denda otomatis saja | Auto OR manual denda |
| **Keterangan** | Hardcoded | Dynamic dari DB |
| **Logging** | Minimal | Detailed dengan tipe denda |
| **Riwayat Display** | Static "Terlambat" | Dynamic keterangan |
| **UX** | Confusing | Clear & guided |
| **Error Handling** | Basic | Try-catch lengkap + logging |

---

## 🔑 KEY IMPROVEMENTS

1. **Separation of Concerns**
   - Form lebih jelas & interactive
   - Validation yang comprehensive
   - Controller logic yang fleksibel

2. **User Experience**
   - Radio button jelas (auto vs manual)
   - Input validation sebelum submit
   - Feedback yang informatif

3. **Data Integrity**
   - Keterangan_denda tersimpan dengan baik
   - Audit trail yang lengkap
   - No data loss

4. **Maintainability**
   - Code lebih modular
   - Error handling lebih robust
   - Easier to debug

