<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id'); // liên kết với appointment
            $table->unsignedBigInteger('doctor_id');      // bác sĩ thực hiện khám
            $table->text('diagnosis')->nullable();        // chẩn đoán
            $table->text('prescription')->nullable();     // đơn thuốc
            $table->text('notes')->nullable();            // ghi chú thêm
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
