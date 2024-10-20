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
        Schema::create('mentor_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mentor');
            $table->string('keahlian');
            $table->year('lulusan_tahun');
            $table->text('riwayat_pendidikan');
            $table->string('pekerjaan_saat_ini');
            $table->text('testimoni')->nullable();
            $table->string('kontak_alumni');
            $table->string('foto_alumni')->nullable();
            $table->boolean('is_approved')->default(false); // Status approval oleh admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_registrations');
    }
};
