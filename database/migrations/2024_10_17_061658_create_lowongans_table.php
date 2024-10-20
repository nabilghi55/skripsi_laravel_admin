<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowongansTable extends Migration
{
    public function up()
    {
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('salary')->nullable(); // Gaji bisa nullable
            $table->string('minimal_pendidikan');
            $table->text('persyaratan');
            $table->string('link_url');
            $table->enum('tipe_kerja', ['wfo', 'wfh', 'hybrid']); // Jenis pekerjaan
            $table->string('lokasi');
            $table->timestamp('diupload_kapan')->useCurrent(); // Waktu upload
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lowongans');
    }
}
