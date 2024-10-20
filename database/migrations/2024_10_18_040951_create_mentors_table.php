<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mentor');
            $table->string('keahlian');
            $table->year('lulusan_tahun');
            $table->text('riwayat_pendidikan');
            $table->string('pekerjaan_saat_ini');
            $table->text('testimoni')->nullable();
            $table->string('kontak_alumni');
            $table->string('foto_alumni')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
}
