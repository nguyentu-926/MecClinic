<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // liên kết với users
            
            $table->string('specialization');       // chuyên khoa
            $table->string('degree')->nullable();   // học vị
            $table->string('title')->nullable();    // học hàm
            $table->integer('experience')->nullable();   // số năm kinh nghiệm
            $table->string('working_hours')->nullable(); // giờ làm việc
            $table->string('room')->nullable();     // phòng khám
            
            // Thông tin cá nhân
            $table->date('date_of_birth')->nullable();   // ngày sinh
            $table->string('address')->nullable();       // quê quán
            $table->string('phone')->nullable();         // số điện thoại
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // giới tính
            $table->string('photo')->nullable();         // ảnh đại diện
            
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
