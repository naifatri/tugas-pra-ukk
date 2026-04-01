<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            // Pertama: Ubah enum untuk support nilai baru (kondisi_awal)
            $table->enum('kondisi_awal', ['baik', 'rusak', 'rusak ringan', 'rusak berat'])->default('baik')->change();

            // Ubah enum untuk support nilai baru (kondisi_kembali)
            $table->enum('kondisi_kembali', ['baik', 'rusak', 'rusak ringan', 'rusak berat', 'hilang'])->nullable()->change();
        });

        // Update nilai yang tidak sesuai enum baru
        DB::table('detail_peminjaman')->where('kondisi_awal', 'rusak')->update(['kondisi_awal' => 'rusak ringan']);
        DB::table('detail_peminjaman')->where('kondisi_kembali', 'rusak')->update(['kondisi_kembali' => 'rusak ringan']);

        Schema::table('detail_peminjaman', function (Blueprint $table) {
            // Final: Hapus nilai lama yang sudah tidak digunakan
            $table->enum('kondisi_awal', ['baik', 'rusak ringan', 'rusak berat'])->default('baik')->change();
            $table->enum('kondisi_kembali', ['baik', 'rusak ringan', 'rusak berat', 'hilang'])->nullable()->change();

            // Tambah field untuk deskripsi kondisi saat pengembalian
            $table->text('deskripsi_kondisi_kembali')->nullable()->after('kondisi_kembali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->enum('kondisi_awal', ['baik', 'rusak'])->default('baik')->change();
            $table->enum('kondisi_kembali', ['baik', 'rusak', 'hilang'])->nullable()->change();
            $table->dropColumn('deskripsi_kondisi_kembali');
        });

        // Revert data back
        DB::table('detail_peminjaman')->where('kondisi_awal', 'rusak ringan')->update(['kondisi_awal' => 'rusak']);
        DB::table('detail_peminjaman')->where('kondisi_awal', 'rusak berat')->update(['kondisi_awal' => 'rusak']);
        DB::table('detail_peminjaman')->where('kondisi_kembali', 'rusak ringan')->update(['kondisi_kembali' => 'rusak']);
        DB::table('detail_peminjaman')->where('kondisi_kembali', 'rusak berat')->update(['kondisi_kembali' => 'rusak']);
    }
};
