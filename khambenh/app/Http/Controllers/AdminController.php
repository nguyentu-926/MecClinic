<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;


class AdminController extends Controller
{
    public function dashboard($id)
    {
        // Lấy user theo id
        $user = User::findOrFail($id);

        // Kiểm tra user login có đúng id không
        if ($user->id !== Auth::id()) {
            abort(403, 'Bạn không có quyền truy cập dashboard admin.');
        }

        // Ví dụ: admin có thể xem tất cả lịch hẹn
        $appointments = Appointment::latest()->take(10)->get();

        // Ví dụ: admin có thể quản lý user
        $users = User::latest()->take(10)->get();

        return view('dashboard.admin', compact('user', 'appointments', 'users'));
    }
}
