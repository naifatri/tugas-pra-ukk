<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjaman', 'status_pembayaran_denda')) {
                $table->enum('status_pembayaran_denda', ['belum dibayar', 'lunas'])
                    ->default('lunas')
                    ->after('metode_pembayaran');
            }

            if (!Schema::hasColumn('peminjaman', 'tgl_pelunasan_denda')) {
                $table->timestamp('tgl_pelunasan_denda')->nullable()->after('status_pembayaran_denda');
            }
        });

        DB::table('peminjaman')
            ->where('denda', '>', 0)
            ->update([
                'status_pembayaran_denda' => 'belum dibayar',
                'tgl_pelunasan_denda' => null,
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            if (Schema::hasColumn('peminjaman', 'tgl_pelunasan_denda')) {
                $table->dropColumn('tgl_pelunasan_denda');
            }

            if (Schema::hasColumn('peminjaman', 'status_pembayaran_denda')) {
                $table->dropColumn('status_pembayaran_denda');
            }
        });
    }
};
