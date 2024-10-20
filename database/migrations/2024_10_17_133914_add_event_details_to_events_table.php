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
        Schema::table('events', function (Blueprint $table) {
            $table->string('title');              // Judul acara
            $table->dateTime('waktu');            // Waktu acara
            $table->string('lokasi');             // Lokasi acara
            $table->text('deskripsi')->nullable(); // Deskripsi acara (bisa kosong)
            $table->string('gambar')->nullable(); // URL atau path gambar (opsional)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['title', 'waktu', 'lokasi', 'deskripsi', 'gambar']);
        });
    }
};
