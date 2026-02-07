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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id')->nullable(); # Nullable incase user is deleted or system action
            # Note: ERD shows user_id, so we link it. If user is deleted, we might want to keep the log or set null.
            # Let's set null on delete to preserve the log entry itself.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->string('aksi');
            $table->string('modul');
            $table->text('detail_teks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
