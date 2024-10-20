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
        Schema::disableForeignKeyConstraints();

        Schema::create('mentoring_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentee_id')->references('id')->on('mentee');
            $table->foreignId('mentor_id')->references('id')->on('mentor');
            $table->enum('status', ["pending", "approved", "rejected"]);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentoring_requests');
    }
};
