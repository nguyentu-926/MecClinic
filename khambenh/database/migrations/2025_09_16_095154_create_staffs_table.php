<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // liên kết với users
            $table->string('phone')->nullable();
            $table->string('position')->nullable(); // vị trí công việc: lễ tân, điều phối...

            // Thông tin thêm
            $table->date('date_of_birth')->nullable(); // ngày sinh
            $table->string('address')->nullable();     // địa chỉ
            $table->string('hometown')->nullable();    // quê quán
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // giới tính
            $table->string('photo')->nullable();       // ảnh đại diện (lưu path)
            $table->text('notes')->nullable();         // ghi chú thêm

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
        Schema::dropIfExists('staffs');
    }
};
