<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenteeRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('mentee_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentee_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mentor_id')->constrained('mentors')->onDelete('cascade');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mentee_requests');
    }
}
