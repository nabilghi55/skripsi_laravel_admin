<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToMentorRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mentor_registrations', function (Blueprint $table) {
            $table->string('email')->nullable(); // Menambahkan kolom email
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mentor_registrations', function (Blueprint $table) {
            $table->dropColumn('email'); // Menghapus kolom email jika rollback
        });
    }
}
