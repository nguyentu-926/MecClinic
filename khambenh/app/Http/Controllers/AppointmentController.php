<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Events\AppointmentApproved;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppointmentReminderNotification;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    // Form tạo lịch
    public function create()
    {
        $specializations = [
            'Khoa ngoại nhi',
            'Khoa xương khớp',
            'Khoa ngoại thần kinh - cột sống',
            'Khoa tiêu hóa gan - mật - tụy',
            'Khoa miễn dịch lâm sàng',
            'Khoa nội tiết - Đái tháo đường',
            'Khoa da liễu',
            'Khoa hô hấp',
            'Khoa ung bướu',
            'Khoa răng hàm mặt'
        ];

        return view('appointments.create', compact('specializations'));
    }

    // Lưu lịch
   public function store(Request $request)
{
    $patient = Auth::user()->patient;

    // Kiểm tra hồ sơ bệnh nhân
    if (!$patient->phone || !$patient->address || !$patient->gender) {
        return redirect()->route('patients.edit', $patient->id)
                         ->with('warning', 'Vui lòng cập nhật đầy đủ hồ sơ trước khi đặt lịch khám!');
    }

    // Xác thực dữ liệu
    $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required|string', // ví dụ: "13:00-14:00"
        'health_issue' => 'required|string|max:500',
    ]);

    // Tách chuỗi giờ thành 2 phần
    [$start, $end] = explode('-', $request->appointment_time);

    // Kiểm tra trùng lịch
    $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->exists();

if($exists){
    return back()->with('warning', 'Khung giờ này đã có người đặt, vui lòng chọn ngày/giờ khác')->withInput();
}

    $doctor = Doctor::findOrFail($request->doctor_id);

    // Lưu lịch hẹn
   Appointment::create([
    'patient_id' => $patient->id,
    'doctor_id' => $request->doctor_id,
    'appointment_date' => $request->appointment_date,
    'appointment_time' => $request->appointment_time, // vẫn là "09:30-10:30"
    'room' => $doctor->room,
    'status' => 'pending',
    'notes' => $request->health_issue,
]);

    // Quay về trang dashboard bệnh nhân
    return redirect()->route('dashboard.patient', Auth::id())->with('success', 'Đặt lịch thành công!');
}


    // AJAX: lấy bác sĩ theo chuyên khoa
    public function getDoctorsBySpecialization(Request $request)
    {
        $doctors = Doctor::where('specialization', $request->specialization)
                        ->with('user')
                        ->get(['id', 'user_id', 'room']);

        return response()->json($doctors);
    }

    // AJAX: lấy khung giờ khả dụng (cho bác sĩ + ngày)
    public function getAvailableTimes(Request $request)
    {
        $doctor = Doctor::findOrFail($request->doctor_id);
        $date = $request->appointment_date;

        // Khung giờ cố định trong ngày
        $appointmentSlots = [
            '08:00-09:00',
            '09:30-10:30',
            '13:00-14:00',
            '14:30-15:30',
            '15:30-16:30'
        ];

        // Lấy các giờ đã bị đặt
        $booked = Appointment::where('doctor_id', $doctor->id)
                    ->with('doctor.user', 'doctor.specialization')
                    ->where('appointment_date', $date)
                    ->pluck('appointment_time')
                    ->toArray();

        // Trả lại khung giờ chưa bị đặt
        $available = array_values(array_diff($appointmentSlots, $booked));

        return response()->json($available);
    }
   public function index()
{
    $patient = Auth::user()->patient;

    // Lấy tất cả lịch hẹn của bệnh nhân, sắp xếp theo ngày
    $appointments = Appointment::where('patient_id', $patient->id)
                    ->where('patient_id', $patient->id)
                    ->with('doctor.user')   
                    ->orderBy('appointment_date', 'asc')
                    ->orderBy('appointment_time', 'asc')
                    ->get();

    return view('appointments.index', compact('appointments'));
}
// Hiển thị form sửa
public function edit($id)
{
    $appointment = Appointment::findOrFail($id);

    // Chỉ cho sửa khi trạng thái pending
    if ($appointment->status !== 'pending') {
        return redirect()->back()->with('error', 'Không thể chỉnh sửa lịch đã xác nhận.');
    }

    return view('appointments.edit', compact('appointment'));
}

// Cập nhật lịch
public function update(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);

    if ($appointment->status !== 'pending') {
        return redirect()->back()->with('error', 'Không thể chỉnh sửa lịch đã xác nhận.');
    }

    $request->validate([
        'appointment_time' => 'required|string',
        'notes' => 'nullable|string',
    ]);

    $appointment->appointment_time = $request->appointment_time;
    $appointment->notes = $request->notes;
    $appointment->save();

    return redirect()->route('patients.appointments', Auth::user()->patient)
                     ->with('success', 'Cập nhật thành công.');
}

// Hủy lịch
public function cancel($id)
{
    $appointment = Appointment::findOrFail($id);

    // Chỉ hủy khi đang pending
    if($appointment->status !== 'pending') {
        return redirect()->back()->with('error', 'Không thể hủy lịch đã xác nhận.');
    }

    $appointment->status = 'cancelled';
    $appointment->save();

    return redirect()->back()->with('success', 'Hủy thành công lịch hẹn.');
}
public function destroy($id)
{
    $appointment = Appointment::findOrFail($id);

    if ($appointment->status !== 'pending') {
        return redirect()->back()->with('error', 'Lịch hẹn đã xác nhận, không thể hủy.');
    }

    $appointment->delete();

    return redirect()->back()->with('success', 'Lịch hẹn đã được hủy thành công.');
}


// Danh sách lịch hẹn cho staff (chờ duyệt)
    public function staffIndex()
    {
        $appointments = Appointment::with(['patient.user','doctor.user'])
            ->where('status','pending')
            ->get();

        return view('staff.appointments.index', compact('appointments'));
    }

    // Duyệt lịch hẹn
    public function approve($id)
{
    $appointment = Appointment::findOrFail($id);

    if($appointment->status !== 'pending'){
        return redirect()->back()->with('error','Lịch hẹn đã được xử lý');
    }

    $appointment->status = 'confirmed';
    $appointment->save();

    // Redirect về lại trang trước (trang danh sách) với flash success
    return redirect()->back()->with('success','Duyệt lịch hẹn thành công');
}
public function patientConfirmedAppointments($id)
{
    // Lấy user hiện tại
    $user = Auth::user();

    // Kiểm tra: chỉ cho xem lịch của chính mình
    if ($user->id != $id) {
        abort(403, 'Bạn không có quyền truy cập trang này.');
    }

    $patient = $user->patient;

    // Lấy các lịch hẹn đã duyệt của bệnh nhân
    $confirmedAppointments = Appointment::with(['doctor.user'])
        ->where('patient_id', $patient->id)
        ->where('status', 'confirmed')
         ->orderBy('appointment_date', 'asc')
        ->get();

    return view('patients.confirmed_appointments', compact('confirmedAppointments', 'patient'));
}
// 🕓 Lịch hẹn đang chờ duyệt
public function patientPendingAppointments($id)
{
    $user = Auth::user();
    if ($user->id != $id) abort(403, 'Không có quyền truy cập.');

    $patient = $user->patient;

    $pendingAppointments = Appointment::with(['doctor.user'])
        ->where('patient_id', $patient->id)
        ->where('status', 'pending')
        ->orderBy('appointment_date', 'asc')
        ->get();

    return view('patients.pending_appointments', compact('pendingAppointments', 'patient'));
}

// ❌ Lịch hẹn đã hủy
public function patientCancelledAppointments($id)
{
    $user = Auth::user();
    if ($user->id != $id) abort(403, 'Không có quyền truy cập.');

    $patient = $user->patient;

    $cancelledAppointments = Appointment::with(['doctor.user'])
        ->where('patient_id', $patient->id)
        ->where('status', 'cancelled')
        ->orderBy('appointment_date', 'asc')
        ->get();

    return view('patients.cancelled_appointments', compact('cancelledAppointments', 'patient'));
}
// 📋 Tổng thể tất cả lịch hẹn của bệnh nhân (lọc theo id đăng nhập)
public function patientAllAppointments($id)
{
    $user = Auth::user();
    if ($user->id != $id) {
        abort(403, 'Không có quyền truy cập.');
    }

    $patient = $user->patient;

    // Lấy tất cả lịch hẹn của bệnh nhân, sắp theo ngày gần nhất
    $appointments = Appointment::with(['doctor.user'])
        ->where('patient_id', $patient->id)
        ->orderBy('appointment_date', 'asc')
        ->get();

    return view('patients.all_appointments', compact('appointments', 'patient'));
}

// Tổng thể lịch hẹn của bác sĩ
public function doctorAllAppointments($id)
{
    $doctor = \App\Models\Doctor::where('user_id', $id)->firstOrFail();
    $appointments = \App\Models\Appointment::with('patient.user')
                    ->where('doctor_id', $doctor->id)
                    ->orderBy('appointment_date', 'asc')
                    ->get();

    return view('doctors.all_appointments', compact('appointments', 'doctor'));
}

// Đã duyệt
public function doctorConfirmedAppointments($id)
{
    $doctor = Doctor::where('user_id', $id)->first();

    // Lấy các lịch hẹn đã xác nhận
    $confirmAppointments = Appointment::where('doctor_id', $doctor->id)
                                      ->where('status', 'confirmed')
                                      ->orderBy('appointment_date', 'asc')
                                      ->get();

    // Truyền biến đúng tên cho view
    return view('doctors.confirmed_appointments', compact('doctor', 'confirmAppointments'));
}


// Chờ duyệt
public function doctorPendingAppointments($id)
{
    $doctor = Doctor::where('user_id', $id)->first();

    // Lấy các lịch hẹn đang chờ duyệt
    $pendingAppointments = Appointment::where('doctor_id', $doctor->id)
                                      ->where('status', 'pending')
                                      ->orderBy('appointment_date', 'asc')
                                      ->get();

    // Truyền biến cho view
    return view('doctors.pending_appointments', compact('doctor', 'pendingAppointments'));
}


// Đã hủy
public function doctorCancelledAppointments($id)
{
    $doctor = Doctor::where('user_id', $id)->first();

    // Lấy các lịch hẹn đã hủy
    $cancelledAppointments = Appointment::where('doctor_id', $doctor->id)
                                        ->where('status', 'cancelled')
                                        ->orderBy('appointment_date', 'asc')
                                        ->get();

    // Truyền biến cho view
    return view('doctors.cancelled_appointments', compact('doctor', 'cancelledAppointments'));
}

public function sendReminderByStaff($id)
{
    $appointment = \App\Models\Appointment::with(['patient.user', 'doctor.user'])->findOrFail($id);

    // Gửi thông báo (web notification)
    Notification::send($appointment->patient->user, new AppointmentReminderNotification($appointment));

    // Nếu có email, có thể gửi thêm email
    if ($appointment->patient->user->email) {
        Mail::to($appointment->patient->user->email)->send(
            new \App\Mail\AppointmentReminderMail($appointment)
        );
    }

    return back()->with('success', 'Đã gửi nhắc lịch đến bệnh nhân!');
}


}
