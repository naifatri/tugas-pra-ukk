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
        Schema::create('alat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->string('kode_alat')->unique();
            $table->integer('stok');
            $table->enum('kondisi', ['baik', 'rusak', 'hilang']); // Assuming enum values
            $table->string('lokasi_penyimpanan');
            $table->string('foto_alat')->nullable();
            $table->text('deskripsi')->nullable();
            
            // Foreign Key ke tabel kategori
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
