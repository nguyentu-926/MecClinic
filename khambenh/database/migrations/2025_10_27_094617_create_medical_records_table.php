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

            // 🔗 Liên kết với bảng appointments
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');

            // 🔗 Liên kết với bảng doctors
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');

            // 🔗 Liên kết với bảng patients
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            // 🩺 Thông tin hồ sơ khám
            $table->text('symptoms')->nullable()->comment('Triệu chứng của bệnh nhân');
            $table->text('diagnosis')->nullable()->comment('Chuẩn đoán của bác sĩ');
            $table->text('prescription')->nullable()->comment('Đơn thuốc');
            $table->text('treatment_plan')->nullable()->comment('Kế hoạch điều trị');
            $table->text('test_results')->nullable()->comment('Kết quả xét nghiệm (nếu có)');
            $table->text('notes')->nullable()->comment('Ghi chú thêm');

            // 👩‍💼 Người tạo hồ sơ (staff hoặc doctor)
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            // 🧾 Trạng thái hồ sơ
            $table->enum('status', ['draft', 'completed'])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
