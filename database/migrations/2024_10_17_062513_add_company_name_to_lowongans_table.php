<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->string('company_name')->after('title'); // Tambahkan kolom nama perusahaan setelah title
        });
    }
    
    public function down()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->dropColumn('company_name');
        });
    }
    
};
