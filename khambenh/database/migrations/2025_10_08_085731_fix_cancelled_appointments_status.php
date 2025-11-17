<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ✅ Cập nhật dữ liệu sai logic: bác sĩ hủy mà status vẫn "confirmed"
        DB::table('appointments')
            ->where('status', 'confirmed')
            ->where('doctor_status', 'cancelled')
            ->update(['status' => 'cancelled']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 🔁 Nếu rollback, đổi lại "confirmed" (tùy chọn)
        DB::table('appointments')
            ->where('status', 'cancelled')
            ->where('doctor_status', 'cancelled')
            ->update(['status' => 'confirmed']);
    }
};
