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
            $table->string('company_logo')->nullable()->after('company_name'); // Tambahkan kolom untuk logo perusahaan
        });
    }
    
    public function down()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->dropColumn('company_logo');
        });
    }
    
};
