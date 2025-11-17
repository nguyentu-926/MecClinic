<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    // Dashboard bác sĩ
    public function dashboard($id)
    {
        $user = Auth::user();

        if($user->id != $id || $user->role !== 'doctor'){
            abort(403, 'Không có quyền truy cập');
        }

        $doctor = Doctor::with(['appointments.patient.user'])
                        ->where('user_id', $user->id)
                        ->first();

        $appointments = $doctor ? $doctor->appointments()->orderBy('appointment_date')->orderBy('appointment_time')->get() : collect();

        return view('dashboard.doctor', compact('doctor', 'appointments'));
    }

  public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:accepted,cancelled',
        'cancel_reason' => 'nullable|string|max:255',
    ]);

    $appointment = \App\Models\Appointment::findOrFail($id);

    // Chỉ lưu phản hồi của bác sĩ
    $appointment->doctor_status = $request->status;

    if ($request->status === 'cancelled') {
        $appointment->cancel_reason = $request->cancel_reason ?? 'Không có lý do';
    }

    // ⚠️ KHÔNG cập nhật $appointment->status (status chính thức do staff duyệt)
    $appointment->save();

    return redirect()->back()->with('success', 'Phản hồi của bác sĩ đã được lưu.');
}





    // Form tạo hồ sơ khám
    public function createMedicalRecord($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        if($appointment->doctor_id != Auth::user()->doctor->id){
            abort(403);
        }

        return view('medical_records.create', compact('appointment'));
    }
     // Xem form chỉnh sửa hồ sơ bác sĩ
    public function editProfile($id)
    {
        $user = Auth::user();
        if($user->id != $id || $user->role !== 'doctor'){
            abort(403);
        }

        $doctor = Doctor::where('user_id', $user->id)->firstOrFail();
        return view('doctors.edit', compact('doctor'));
    }
    
    // Lưu chỉnh sửa hồ sơ bác sĩ
    public function updateProfile(Request $request, $id)
    {
        $user = Auth::user();
        if($user->id != $id || $user->role !== 'doctor'){
            abort(403);
        }

        $request->validate([
            'degree' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'working_hours' => 'nullable|string|max:255',
            'room' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'hometown' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'notes' => 'nullable|string'
        ]);

        $doctor = Doctor::where('user_id', $user->id)->firstOrFail();

        $doctor->update($request->except('photo'));

        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('doctor_photos','public');
            $doctor->photo = $path;
            $doctor->save();
        }

        return redirect()->route('doctor.profile.edit', $user->id)
                         ->with('success','Cập nhật hồ sơ thành công!');
    }

    // Lưu hồ sơ khám
    public function storeMedicalRecord(Request $request, $appointmentId)
    {
        $request->validate([
            'diagnosis' => 'required|string',
            'prescription' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $appointment = Appointment::findOrFail($appointmentId);

        if($appointment->doctor_id != Auth::user()->doctor->id){
            abort(403);
        }

        $medicalRecord = new MedicalRecord();
        $medicalRecord->appointment_id = $appointment->id;
        $medicalRecord->doctor_id = $appointment->doctor_id;
        $medicalRecord->diagnosis = $request->diagnosis;
        $medicalRecord->prescription = $request->prescription;
        $medicalRecord->notes = $request->notes;
        $medicalRecord->save();

        $appointment->status = 'done';
        $appointment->save();

        return redirect()->route('dashboard.doctor', Auth::user()->id)
                         ->with('success','Thêm hồ sơ khám thành công!');
    }
    public function appointments($id)
{
    $doctor = Auth::user()->doctor;

    // Lấy các lịch hẹn theo bác sĩ đăng nhập
    $confirmedAppointments = \App\Models\Appointment::with(['patient.user'])
        ->where('doctor_id', $doctor->id)
        ->where('status', 'confirmed')
        ->orderByDesc('appointment_date')
        ->get();

    $pendingAppointments = \App\Models\Appointment::with(['patient.user'])
        ->where('doctor_id', $doctor->id)
        ->where('status', 'pending')
        ->orderByDesc('appointment_date')
        ->get();

    return view('doctor.appointments', compact('confirmedAppointments', 'pendingAppointments'));
}
// ✅ Tổng thể lịch hẹn của bác sĩ
public function doctorAllAppointments($id)
{
    $user = Auth::user();
    if ($user->id != $id) abort(403, 'Không có quyền truy cập.');

    $doctor = $user->doctor;

    $appointments = Appointment::with(['patient.user'])
        ->where('doctor_id', $doctor->id)
        ->orderBy('appointment_date', 'asc')
        ->get();

    return view('doctors.all_appointments', compact('appointments', 'doctor'));
}

// ✅ Lịch hẹn đã duyệt
public function doctorConfirmedAppointments($id)
{
    $user = Auth::user();
    if ($user->id != $id) abort(403, 'Không có quyền truy cập.');

    $doctor = $user->doctor;

    $confirmedAppointments = Appointment::with(['patient.user'])
        ->where('doctor_id', $doctor->id)
        ->where('status', 'confirmed')
        ->orderBy('appointment_date', 'asc')
        ->get();

    return view('doctors.confirmed_appointments', compact('confirmedAppointments', 'doctor'));
}

// ✅ Lịch hẹn chờ duyệt
public function doctorPendingAppointments($id)
{
    $user = Auth::user();
    if ($user->id != $id) abort(403, 'Không có quyền truy cập.');

    $doctor = $user->doctor;

    $pendingAppointments = Appointment::with(['patient.user'])
        ->where('doctor_id', $doctor->id)
        ->where('status', 'pending')
        ->orderBy('appointment_date', 'asc')
        ->get();

    return view('doctors.pending_appointments', compact('pendingAppointments', 'doctor'));
}

// ✅ Lịch hẹn đã hủy
public function doctorCancelledAppointments($id)
{
    $user = Auth::user();
    if ($user->id != $id) abort(403, 'Không có quyền truy cập.');

    $doctor = $user->doctor;

    $cancelledAppointments = Appointment::with(['patient.user'])
        ->where('doctor_id', $doctor->id)
        ->where('status', 'cancelled')
        ->orderBy('appointment_date', 'asc')
        ->get();

    return view('doctors.cancelled_appointments', compact('cancelledAppointments', 'doctor'));
}
 /**
     * 🩺 Danh sách các hồ sơ khám do bác sĩ phụ trách
     */
    public function medicalRecordsIndex()
    {
        $doctorId = Auth::user()->doctor->id;

        $records = MedicalRecord::with(['appointment.patient.user'])
            ->where('doctor_id', $doctorId)
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('doctors.medical_records.index', compact('records'));
    }

    /**
     * ✍️ Hiển thị form để bác sĩ điền / chỉnh sửa hồ sơ
     */
    public function editMedicalRecord($id)
    {
        $record = MedicalRecord::with(['appointment.patient.user'])->findOrFail($id);

        if ($record->doctor_id !== Auth::user()->doctor->id) {
            abort(403, 'Không có quyền chỉnh sửa hồ sơ này.');
        }

        return view('doctors.medical_records.edit', compact('record'));
    }

    /**
     * 💾 Cập nhật thông tin chuyên môn
     */
    public function updateMedicalRecord(Request $request, $id)
    {
        $record = MedicalRecord::findOrFail($id);

        if ($record->doctor_id !== Auth::user()->doctor->id) {
            abort(403, 'Không có quyền cập nhật hồ sơ này.');
        }

        $validated = $request->validate([
            'symptoms' => 'nullable|string',
            'diagnosis' => 'required|string',
            'prescription' => 'nullable|string',
            'treatment_plan' => 'nullable|string',
            'test_results' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $record->update(array_merge($validated, [
            'status' => 'completed',
        ]));

        // Cập nhật trạng thái lịch hẹn
        $record->appointment->update(['status' => 'done']);

        return redirect()->route('doctor.medicalRecords.index')
                         ->with('success', '✅ Hồ sơ khám đã được hoàn tất thành công!');
    }
   public function schedule(Request $request)
{
    $doctor = Auth::user()->doctor;
    if (!$doctor) {
        return redirect()->back()->with('error', 'Không tìm thấy thông tin bác sĩ.');
    }

    // 1. Xác định ngày được chọn (mặc định là hôm nay nếu không có ngày nào được chọn)
    $selectedDate = Carbon::parse($request->get('date', now()->toDateString()));

    // 2. Tính toán ngày Bắt đầu và Kết thúc của tuần chứa $selectedDate
    // Lịch tuần của bạn bắt đầu từ Thứ Hai (MONDAY)
    $startOfWeek = $selectedDate->copy()->startOfWeek(Carbon::MONDAY)->toDateString();
    $endOfWeek = $selectedDate->copy()->endOfWeek(Carbon::SUNDAY)->toDateString();

    // 3. LẤY TẤT CẢ LỊCH HẸN ĐÃ CONFIRMED TRONG PHẠM VI CẢ TUẦN
    $appointments = Appointment::where('doctor_id', $doctor->id)
        ->where('status', 'confirmed') // ✅ Chỉ lấy lịch đã xác nhận
        ->whereBetween('appointment_date', [$startOfWeek, $endOfWeek]) // 🎯 Lọc theo phạm vi TUẦN
        ->orderBy('appointment_date', 'asc')
        ->orderBy('appointment_time', 'asc')
        ->get();

    return view('doctors.schedule', [
        'appointments' => $appointments, // Dữ liệu lịch hẹn CỦA CẢ TUẦN
        'selectedDate' => $selectedDate->toDateString(), // Ngày được chọn (dùng cho PHẦN 3)
    ]);
}
// Hiển thị danh sách bác sĩ
    public function index()
    {
        $doctors = Doctor::with('user')->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    // Form thêm mới
    public function create()
    {
        return view('admin.doctors.create');
    }

    // Lưu bác sĩ mới
    public function store(Request $request)
    {
         /** @var \App\Models\User $user */
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'specialization' => 'required|string|max:255',
            'room' => 'required|string|max:50',
            'experience' => 'required|integer|min:0',
            'working_hours' => 'required|string|max:50',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'doctor',
            'password' => Hash::make('password123'), // default password
        ]);

        Doctor::create([
            'user_id' => $user->id,
            'specialization' => $request->specialization,
            'room' => $request->room,
            'experience' => $request->experience,
            'working_hours' => $request->working_hours,
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Bác sĩ đã được thêm thành công!');
    }

    // Form chỉnh sửa
    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    // Cập nhật bác sĩ
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$doctor->user_id,
            'specialization' => 'required|string|max:255',
            'room' => 'required|string|max:50',
            'experience' => 'required|integer|min:0',
            'working_hours' => 'required|string|max:50',
        ]);

        $doctor->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $doctor->update([
            'specialization' => $request->specialization,
            'room' => $request->room,
            'experience' => $request->experience,
            'working_hours' => $request->working_hours,
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Bác sĩ đã được cập nhật!');
    }

    // Xóa bác sĩ
    public function destroy(Doctor $doctor)
    {
        $doctor->user->delete(); // Xóa user cùng bác sĩ
        return redirect()->route('admin.doctors.index')->with('success', 'Bác sĩ đã bị xóa!');
    }

public function profileshow($id)
{
    // Lấy doctor kèm user để lấy tên
    $doctor = Doctor::with('user')->findOrFail($id);

    return view('doctors.show', compact('doctor'));
}


}
