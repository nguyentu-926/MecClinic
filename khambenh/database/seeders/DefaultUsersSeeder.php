<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Staff;

class DefaultUsersSeeder extends Seeder
{
    public function run()
    {
        // Doctors
        $doctors = [
            ['name' => 'Dr. House',    'email' => 'doctor1@example.com'],
            ['name' => 'Dr. Strange',  'email' => 'doctor2@example.com'],
            ['name' => 'Dr. Who',      'email' => 'doctor3@example.com'],
        ];
        foreach ($doctors as $d) {
            $user = User::create([
                'name' => $d['name'],
                'email' => $d['email'],
                'password' => Hash::make('password123'),
                'role' => 'doctor',
            ]);
            // Tạo record bác sĩ (nếu bạn dùng bảng doctors)
            if (class_exists(Doctor::class)) {
                Doctor::create([
                    'user_id' => $user->id,
                    'degree' => 'BSCKI',
                    'title' => null,
                    'specialization' => 'Khoa da liễu',
                    'experience' => 5,
                    'working_hours' => '08:00-17:00',
                    'room' => '101',
                ]);
            }
        }

        // Staffs
        $staffs = [
            ['name' => 'Staff A', 'email' => 'staff1@example.com'],
            ['name' => 'Staff B', 'email' => 'staff2@example.com'],
            ['name' => 'Staff C', 'email' => 'staff3@example.com'],
        ];
        foreach ($staffs as $s) {
            $user = User::create([
                'name' => $s['name'],
                'email' => $s['email'],
                'password' => Hash::make('password123'),
                'role' => 'staff',
            ]);
            if (class_exists(Staff::class)) {
                Staff::create([
                    'user_id' => $user->id,
                    'phone' => null,
                    'position' => 'Reception',
                ]);
            }
        }

        // Admins
        $admins = [
            ['name' => 'Admin Boss', 'email' => 'admin1@example.com'],
        ];
        foreach ($admins as $a) {
            User::create([
                'name' => $a['name'],
                'email' => $a['email'],
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
        }

       
    }
}
