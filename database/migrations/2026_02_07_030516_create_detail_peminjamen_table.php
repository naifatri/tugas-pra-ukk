<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel peminjaman
            $table->unsignedBigInteger('peminjaman_id');
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->onDelete('cascade');
            
            // Foreign Key ke tabel alat
            $table->unsignedBigInteger('alat_id');
            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('cascade');
            
            $table->integer('jumlah');
            $table->integer('jumlah_kembali')->nullable();
            $table->enum('kondisi_awal', ['baik', 'rusak']);
            $table->enum('kondisi_kembali', ['baik', 'rusak', 'hilang'])->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_peminjamen');
    }
};
