<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjaman', 'notifikasi_pengembalian_kanal')) {
                $table->string('notifikasi_pengembalian_kanal', 20)
                    ->nullable()
                    ->after('tgl_pelunasan_denda');
            }
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            if (Schema::hasColumn('peminjaman', 'notifikasi_pengembalian_kanal')) {
                $table->dropColumn('notifikasi_pengembalian_kanal');
            }
        });
    }
};
