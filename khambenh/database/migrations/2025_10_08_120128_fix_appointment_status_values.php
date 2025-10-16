<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Appointment;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Chuyển tất cả các status sai sang status hợp lệ
        // Nếu bác sĩ hủy nhưng status đang là giá trị khác => chuyển sang 'cancelled'
        Appointment::where('doctor_status', 'cancelled')
            ->whereNotIn('status', ['pending','confirmed','cancelled'])
            ->update(['status' => 'cancelled']);

        // Nếu bác sĩ chấp nhận nhưng status sai => chuyển sang 'confirmed'
        Appointment::where('doctor_status', 'accepted')
            ->whereNotIn('status', ['pending','confirmed','cancelled'])
            ->update(['status' => 'confirmed']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Không làm gì khi rollback
    }
};
