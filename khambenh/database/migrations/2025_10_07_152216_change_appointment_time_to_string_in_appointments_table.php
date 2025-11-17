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
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('appointment_time')->change(); // chuyển sang VARCHAR
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->time('appointment_time')->change(); // quay về TIME nếu rollback
        });
    }
};
