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
    \App\Models\Appointment::where('status', 'confirmed')
        ->where('doctor_status', 'cancelled')
        ->update(['status' => 'cancelled']);
}

public function down()
{
    // rollback: tuỳ chọn, ví dụ đổi lại confirmed nếu muốn
}


};
