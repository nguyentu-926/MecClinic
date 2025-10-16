<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Events\AppointmentApproved;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function dashboard($id)
    {
        $user = Auth::user();

        // Kiểm tra quyền
        if ($user->id != $id || $user->role !== 'staff') {
            abort(403, 'Không có quyền truy cập');
        }

        // Lấy thông tin staff
        $staff = Staff::where('user_id', $id)->first();

        // Lấy dữ liệu hiển thị
        $appointments = Appointment::latest()->take(5)->get();

        return view('dashboard.staff', compact('user', 'staff', 'appointments'));
    }
     // Xem tất cả lịch chờ duyệt
    public function appointments()
    {
        $appointments = Appointment::with(['patient.user', 'doctor.user', 'doctor.specialization'])
            ->where('status', 'pending')
            ->with('doctor.user', 'doctor.specialization')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('staff.appointments.index', compact('appointments'));
    }

public function approveAppointment($id)
{
    $appointment = Appointment::findOrFail($id);

    // Nếu bác sĩ chưa phản hồi thì không được duyệt
    if (!$appointment->doctor_status) {
        return redirect()->back()->with('error', 'Bác sĩ chưa phản hồi, không thể duyệt.');
    }

    // Nếu bác sĩ đã phản hồi thì staff xác nhận (duyệt)
    if ($appointment->doctor_status === 'accepted') {
        $appointment->status = 'confirmed'; // Bệnh nhân thấy “Đã chấp nhận lịch ✅”
    } elseif ($appointment->doctor_status === 'cancelled') {
        $appointment->status = 'cancelled'; // Bệnh nhân thấy “Đã hủy ❌”
        if (!$appointment->cancel_reason) {
            $appointment->cancel_reason = 'Không có lý do';
        }
    }

    $appointment->save();

    return redirect()->back()->with('success', 'Đã duyệt phản hồi của bác sĩ thành công.');
}




public function approve($id)
{
    $appointment = Appointment::findOrFail($id);

    // Nếu bác sĩ chưa phản hồi
    if ($appointment->doctor_status === null) {
        return back()->with('error', 'Bác sĩ chưa phản hồi, không thể duyệt.');
    }

    // Chỉ xác nhận phản hồi của bác sĩ
    if ($appointment->doctor_status === 'accepted') {
        $appointment->status = 'confirmed';
    } elseif ($appointment->doctor_status === 'cancelled') {
        $appointment->status = 'cancelled';
    }

    $appointment->save();

    return back()->with('success', 'Duyệt lịch hẹn thành công.');
}




public function index()
{
    $appointments = Appointment::with(['patient.user', 'doctor.user'])
        ->orderByDesc('appointment_date')
        ->get(); 

    return view('staff.appointments', compact('appointments'));
}





    
}
