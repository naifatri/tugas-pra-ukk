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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pinjam');
            $table->date('tgl_harus_kembali');
            $table->date('tgl_kembali_real')->nullable();
            $table->enum('status_pinjam', ['menunggu', 'disetujui', 'ditolak', 'kembali', 'telat'])->default('menunggu');
            
            // Foreign Key ke tabel users (Peminjam)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign Key ke tabel users (Petugas) - nullable karena awal pengajuan belum ada petugas yang acc
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('set null');

            $table->decimal('denda', 10, 2)->default(0);
            $table->text('keterangan_denda')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
