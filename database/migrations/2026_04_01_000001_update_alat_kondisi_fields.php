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
        Schema::table('alat', function (Blueprint $table) {
            // Pertama: Ubah enum untuk support nilai baru
            $table->enum('kondisi', ['baik', 'rusak', 'hilang', 'rusak ringan', 'rusak berat'])->default('baik')->change();
        });

        // Kemudian ubah setiap value kondisi yang tidak sesuai enum baru
        // 'hilang' -> 'rusak berat', 'rusak' -> 'rusak ringan'
        DB::table('alat')->where('kondisi', 'hilang')->update(['kondisi' => 'rusak berat']);
        DB::table('alat')->where('kondisi', 'rusak')->update(['kondisi' => 'rusak ringan']);

        Schema::table('alat', function (Blueprint $table) {
            // Final: Hapus nilai lama yang sudah tidak digunakan, dan tambah field baru
            $table->enum('kondisi', ['baik', 'rusak ringan', 'rusak berat'])->default('baik')->change();
            // Tambah field deskripsi kondisi
            $table->text('deskripsi_kondisi')->nullable()->after('kondisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->enum('kondisi', ['baik', 'rusak', 'hilang'])->default('baik')->change();
            $table->dropColumn('deskripsi_kondisi');
        });

        // Revert data back
        DB::table('alat')->where('kondisi', 'rusak berat')->update(['kondisi' => 'hilang']);
        DB::table('alat')->where('kondisi', 'rusak ringan')->update(['kondisi' => 'rusak']);
    }
};
