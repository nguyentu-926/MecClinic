<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id'); // liên kết với patients
            $table->unsignedBigInteger('doctor_id');  // liên kết với doctors
            $table->date('appointment_date');        // ngày khám
            $table->time('appointment_time');        // giờ khám
            $table->string('room')->nullable();       // phòng khám nếu muốn chỉ định
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'done'])->default('pending');
            $table->text('notes')->nullable();       // ghi chú từ staff/bác sĩ
            $table->text('cancel_reason')->nullable(); // lý do hủy
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
