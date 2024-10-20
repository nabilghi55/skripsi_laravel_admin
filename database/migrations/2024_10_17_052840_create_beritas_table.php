<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('title');  // Judul berita
            $table->string('uploaded_by');  // Pengunggah
            $table->string('image');  // Path gambar
            $table->text('content');  // Konten berita
            $table->string('slug')->unique();  // Slug unik untuk URL-friendly
            $table->timestamps();  // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beritas');
    }
}
