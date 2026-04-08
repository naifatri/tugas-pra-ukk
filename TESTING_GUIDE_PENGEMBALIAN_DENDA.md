# 🧪 TESTING GUIDE - PENGEMBALIAN BARANG DENGAN DENDA

**Status:** Ready for Testing  
**Tanggal:** 2 April 2026

---

## 📋 TESTING SCENARIOS

### **SCENARIO 1: Pengembalian Tepat Waktu (Tanpa Denda)**

**Setup:**
- Peminjaman tgl pinjam: 1 April 2026
- Jatuh tempo: 5 April 2026
- Pengembalian: 5 April 2026 (tepat waktu)
- Kondisi: Baik

**Steps:**
1. Login sebagai Petugas
2. Buka "Petugas Dashboard" → "Peminjaman Aktif"
3. Klik button "Kembali" untuk peminjaman tersebut
4. Form Pengembalian muncul
5. Lihat field denda → radio "Otomatis (Keterlambatan)" sudah selected
6. Verify: Display denda = "Rp 0" (disabled input)
7. Isi tgl kembali: `5 April 2026`
8. Pilih kondisi alat: "Baik"
9. Klik "Konfirmasi Pengembalian"

**Expected Result:**
- ✅ Alert: "Pengembalian berhasil diproses. Denda: Rp 0"
- ✅ Redirect ke "Peminjaman Aktif"
- ✅ Record berpindah ke "Riwayat Pengembalian"
- ✅ Status denda: "Lunas"
- ✅ Database: `denda = 0, keterangan_denda = "Tepat waktu, tanpa denda"`

---

### **SCENARIO 2: Pengembalian Terlambat (Auto Denda)**

**Setup:**
- Peminjaman tgl pinjam: 1 April 2026
- Jatuh tempo: 5 April 2026
- Pengembalian: 8 April 2026 (3 hari lama)
- Kondisi: Baik

**Steps:**
1. Login sebagai Petugas
2. Buka "Peminjaman Aktif"
3. Klik "Kembali"
4. Form Pengembalian muncul
5. Radio "Otomatis (Keterlambatan)" sudah selected
6. Isi tgl kembali: `8 April 2026`
7. Pilih kondisi alat: "Baik"
8. Klik "Konfirmasi Pengembalian"

**Expected Result:**
- ✅ Alert: "Pengembalian berhasil diproses. Denda: Rp 3.000"
- ✅ Database: `denda = 3000, keterangan_denda = "Terlambat 3 hari @ Rp 1.000/hari"`
- ✅ Riwayat: Tampil "Rp 3.000 - Terlambat 3 hari @ Rp 1.000/hari"

---

### **SCENARIO 3: Pengembalian dengan Kerusakan (Manual Denda)**

**Setup:**
- Peminjaman (tepat waktu)
- Kondisi: Rusak Berat
- User ingin masukkan denda 250.000 untuk ganti barang

**Steps:**
1. Login sebagai Petugas
2. Buka "Peminjaman Aktif"
3. Klik "Kembali"
4. Form Pengembalian muncul
5. **Ubah pilihan radio ke "Manual (Kerusakan/Lainnya)"**
6. Verify: Field input denda menjadi visible (tidak hidden lagi)
7. Input denda: `250000` (ketik tanpa Rp)
8. Verify: Display field berubah menjadi "Rp 250.000"
9. Pilih kondisi alat: "Rusak Berat"
10. Isi deskripsi: "LCD pecah, tidak bisa diperbaiki"
11. Klik "Konfirmasi Pengembalian"

**Expected Result:**
- ✅ Alert: "Pengembalian berhasil diproses. Denda: Rp 250.000"
- ✅ Database: `denda = 250000, keterangan_denda = "Denda manual (kerusakan/penggantian barang)"`
- ✅ Riwayat: Tampil "Rp 250.000 - Denda manual (kerusakan/penggantian barang)"

---

### **SCENARIO 4: Form Validation - Manual Denda Kosong**

**Setup:**
- User pilih "Manual (Kerusakan)" tapi kosongkan input

**Steps:**
1. Login sebagai Petugas
2. Buka form pengembalian
3. Pilih radio "Manual (Kerusakan/Lainnya)"
4. Biarkan field input denda kosong
5. Isi kondisi alat
6. Klik "Konfirmasi Pengembalian"

**Expected Result:**
- ✅ Alert appear: "⚠️ Silakan masukkan nominal denda yang valid!"
- ✅ Form tidak ter-submit
- ✅ Input field di-focus: `#manual_denda_input_field`

---

### **SCENARIO 5: Form Validation - Input Format**

**Setup:**
- User input denda dengan format yang tidak standard

**Steps:**
1. Pilih "Manual (Kerusakan)"
2. Ketik berbagai format dalam input:
   - `100.000` (dengan dot)
   - `100,000` (dengan comma)
   - `Rp 100000` (dengan Rp prefix)
   - `abc 100 def` (dengan text)
3. Observe: JavaScript hanya ambil digit

**Expected Result:**
- ✅ Display field otomatis "clean" format
- ✅ Semua non-digit dihapus
- ✅ Hasil: "Rp 100.000" (clean & formatted)
- ✅ Hidden field value: `100000`

---

### **SCENARIO 6: Riwayat Pengembalian - Lihat Denda & Keterangan**

**Setup:**
- Sudah ada beberapa pengembalian dengan berbagai denda

**Steps:**
1. Login sebagai Petugas
2. Buka "Riwayat Pengembalian"
3. Lihat table baris terakhir (kolom Status Denda)

**Expected Result:**
- ✅ Lihat beberapa status:
  - "Lunas" (untuk denda = 0) - hijau background
  - "Rp 3.000" + "Terlambat 3 hari..." - merah background
  - "Rp 250.000" + "Denda manual..." - merah background
- ✅ Warna berbeda: hijau (lunas) vs merah (ada denda)
- ✅ Keterangan jelas & informatif

---

### **SCENARIO 7: Database Verification**

**Verify via SQL:**
```sql
-- 1. Check denda values
SELECT id, user_id, denda, keterangan_denda, status_pinjam 
FROM peminjaman 
WHERE status_pinjam = 'kembali' 
ORDER BY id DESC 
LIMIT 10;

-- 2. Check total denda
SELECT SUM(denda) as total_denda 
FROM peminjaman 
WHERE status_pinjam = 'kembali';

-- 3. Specific record
SELECT * FROM peminjaman WHERE id = 5;
```

**Expected Result:**
- ✅ denda = numeric (0, 3000, 250000, etc.)
- ✅ keterangan_denda = descriptive text
- ✅ Semua record terisi dengan baik
- ✅ Total denda = sum of all denda values

---

### **SCENARIO 8: Log Aktivitas Verification**

**Steps:**
1. Buka table `log_aktivitas`
2. Filter `aksi = 'Proses Pengembalian'`
3. Cek `detail_teks`: berisi info denda & tipe

**Expected Result:**
- ✅ `detail_teks` contoh:
  - "Memproses pengembalian (ID: 5). Denda: Rp 3000. Tipe: auto. Petugas: Bambang"
  - "Memproses pengembalian (ID: 6). Denda: Rp 250000. Tipe: manual. Petugas: Siti"

---

### **SCENARIO 9: Edge Cases - Terlambat + Kerusakan**

**Scenario:**
- Pengembalian 5 hari terlambat
- Barang rusak berat
- User ingin custom denda 500.000 (lebih dari auto denda 5.000)

**Steps:**
1. Pilih "Manual (Kerusakan)"
2. Input 500.000
3. Pilih kondisi "Rusak Berat"
4. Submit

**Expected Result:**
- ✅ Denda = 500.000 (bukan 5.000 auto)
- ✅ Keterangan = "Denda manual (kerusakan/penggantian barang)"
- ✅ Fleksibilitas: petugas bisa set denda sesuai kebutuhan

---

### **SCENARIO 10: UI/UX - Form Responsiveness**

**Device Testing:**
1. Desktop (1920px)
2. Tablet (768px)
3. Mobile (375px)

**Steps:**
1. Buka form pengembalian di berbagai ukuran
2. Verify layout responsivity
3. Check radio button visibility
4. Check input field readability

**Expected Result:**
- ✅ Semua element responsive
- ✅ Form readable di semua ukuran
- ✅ Tidak ada overlapping elements
- ✅ Touch-friendly untuk mobile

---

## ✅ REGRESSION TESTING

**Poin yang harus tetap berfungsi:**

- [ ] Peminjaman approval (verifikasi peminjaman)
- [ ] Stock management (increment/decrement)
- [ ] Kondisi alat tracking
- [ ] User & Petugas relationship
- [ ] Laporan data
- [ ] Export functionality
- [ ] Search & filter
- [ ] Pagination di riwayat

---

## 🐛 BUG REPORTING TEMPLATE

Jika menemukan bug saat testing:

```
**Bug Title:** [Short description]

**Scenario:** [Which scenario from above]

**Steps to Reproduce:**
1. ...
2. ...
3. ...

**Expected Result:**
...

**Actual Result:**
...

**Screenshot/Video:** [Attach if possible]

**Browser/Device:** Chrome 123 / Desktop / Windows 11
```

---

## 📊 TEST RESULTS CHECKLIST

Untuk tracking hasil testing:

- [ ] SCENARIO 1: ✅ Pass / ❌ Fail
- [ ] SCENARIO 2: ✅ Pass / ❌ Fail
- [ ] SCENARIO 3: ✅ Pass / ❌ Fail
- [ ] SCENARIO 4: ✅ Pass / ❌ Fail
- [ ] SCENARIO 5: ✅ Pass / ❌ Fail
- [ ] SCENARIO 6: ✅ Pass / ❌ Fail
- [ ] SCENARIO 7: ✅ Pass / ❌ Fail
- [ ] SCENARIO 8: ✅ Pass / ❌ Fail
- [ ] SCENARIO 9: ✅ Pass / ❌ Fail
- [ ] SCENARIO 10: ✅ Pass / ❌ Fail

**Overall Status:** 🟢 Ready for Production / 🟡 Needs Fix / 🔴 Critical Issue

---

## 🚀 DEPLOYMENT READINESS

- [ ] Semua test scenarios PASS
- [ ] No regression issues
- [ ] Database verified
- [ ] Error logging working
- [ ] Documentation complete
- [ ] Performance acceptable (< 500ms per request)

**Ready to Deploy:** ✅ YES / ❌ NO

