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

    if ($user->id != $id || $user->role !== 'staff') {
        abort(403, 'Không có quyền truy cập');
    }

    $staff = Staff::where('user_id', $id)->first();

    $confirmedAppointments = Appointment::with(['patient.user', 'doctor.user'])
        ->where('status', 'confirmed')
        ->orderBy('appointment_date', 'desc')
        ->take(50)
        ->get();

    $pendingAppointments = Appointment::with(['patient.user', 'doctor.user'])
        ->where('status', 'pending')
        ->orderBy('appointment_date', 'desc')
        ->take(50)
        ->get();

    $cancelledAppointments = Appointment::with(['patient.user', 'doctor.user'])
        ->where('status', 'cancelled')
        ->orderBy('appointment_date', 'desc')
        ->take(50)
        ->get();

    return view('dashboard.staff', compact(
        'user',
        'staff',
        'confirmedAppointments',
        'pendingAppointments',
        'cancelledAppointments'
    ));
}

     // Xem tất cả lịch chờ duyệt
   public function appointments()
{
    // Nhân viên được xem toàn bộ (hoặc lọc tùy mục đích)
    $confirmedAppointments = \App\Models\Appointment::with(['doctor.user', 'patient.user'])
        ->where('status', 'confirmed')
        ->orderByDesc('appointment_date')
        ->get();

    $pendingAppointments = \App\Models\Appointment::with(['doctor.user', 'patient.user'])
        ->where('status', 'pending')
        ->orderByDesc('appointment_date')
        ->get();

    return view('staff.appointments', compact('confirmedAppointments', 'pendingAppointments'));
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
