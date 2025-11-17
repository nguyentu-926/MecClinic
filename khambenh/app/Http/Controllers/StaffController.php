<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentReminderMail;
use App\Notifications\AppointmentReminderNotification;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Hiển thị Dashboard chính của Staff
     */
    public function dashboard($id)
    {
        $user = Auth::user();

        if ($user->id != $id || $user->role !== 'staff') {
            abort(403, 'Không có quyền truy cập');
        }

        $staff = Staff::where('user_id', $id)->first();
        
        // Dùng tên biến rõ ràng cho Dashboard
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


    /**
     * Hiển thị trang Tổng thể Lịch hẹn (ALL)
     */
    public function allAppointments()
    {
        $appointments = Appointment::with(['patient.user', 'doctor.user'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        // View: resources/views/staffs/appointments/all.blade.php
        return view('staffs.appointments.all', compact('appointments'));
    }


    /**
     * Hiển thị danh sách các lịch hẹn đã duyệt (Confirmed)
     */
    public function confirmedAppointments()
    {
        // 1. Tên biến phải là $confirmedAppointments
        $confirmedAppointments = Appointment::with(['doctor.user', 'patient.user'])
            ->where('status', 'confirmed')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        // 2. Truyền biến $confirmedAppointments vào View
        return view('staffs.confirmed_appointments', compact('confirmedAppointments'));
    }

    /**
     * Hiển thị danh sách các lịch hẹn chờ duyệt (Pending)
     */
    public function pendingAppointments()
    {
        // 1. Tên biến phải là $pendingAppointments
        $pendingAppointments = Appointment::with(['doctor.user', 'patient.user'])
            ->where('status', 'pending')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        // 2. Truyền biến $pendingAppointments vào View
        return view('staffs.pending_appointments', compact('pendingAppointments'));
    }

    /**
     * Hiển thị danh sách các lịch hẹn đã hủy (Cancelled)
     */
    public function cancelledAppointments()
    {
        // 1. Tên biến phải là $cancelledAppointments
        $cancelledAppointments = Appointment::with(['doctor.user', 'patient.user'])
            ->where('status', 'cancelled')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        // 2. Truyền biến $cancelledAppointments vào View
        return view('staffs.cancelled_appointments', compact('cancelledAppointments'));
    }

    /**
     * Hành động: Staff duyệt phản hồi của Bác sĩ (chuyển trạng thái cuối cùng)
     */
    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->status !== 'pending') {
             return back()->with('error', 'Lịch hẹn này đã được xử lý. Không thể duyệt lại.');
        }

        if ($appointment->doctor_status === null) {
            return back()->with('error', 'Bác sĩ chưa phản hồi, không thể duyệt.');
        }

        if ($appointment->doctor_status === 'accepted') {
            $appointment->status = 'confirmed';
        } elseif ($appointment->doctor_status === 'cancelled') {
            $appointment->status = 'cancelled';
        }

        $appointment->save();

        return back()->with('success', 'Duyệt phản hồi của bác sĩ thành công.');
    }
    public function medicalRecordsList()
    {
        // Lấy tất cả lịch hẹn đã được xác nhận (confirmed), kèm theo các quan hệ cần thiết
        // MedicalRecord quan hệ 1-1 với Appointment, dùng để kiểm tra hồ sơ đã tạo chưa
        $confirmedAppointments = Appointment::with(['doctor.user', 'patient.user', 'medicalRecord']) 
            ->where('status', 'confirmed')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        return view('staffs.medical_records_list', compact('confirmedAppointments'));
    }


    /**
     * Hành động: Nhân viên tạo hồ sơ khám bệnh ban đầu (Medical Record) 
     * Sao chép triệu chứng ban đầu và thiết lập status là 'initiated'.
     */
    public function createMedicalRecord($appointmentId)
{
    $appointment = Appointment::with(['patient', 'doctor', 'medicalRecord'])->findOrFail($appointmentId);

    // 1. Kiểm tra trạng thái lịch hẹn
    if ($appointment->status !== 'confirmed') {
        return back()->with('error', 'Chỉ có thể tạo hồ sơ khám cho lịch hẹn Đã Duyệt (Confirmed).');
    }

    // 2. Kiểm tra hồ sơ đã tồn tại chưa
    if ($appointment->medicalRecord) {
        return back()->with('error', 'Hồ sơ khám bệnh đã được tạo cho lịch hẹn này.');
    }

    // Lấy ID của Staff đang đăng nhập
    $staffUserId = Auth::id();
    
    try {
        // ✅ Tạo bản ghi Medical Record mới
        \App\Models\MedicalRecord::create([
            'appointment_id' => $appointment->id,
            'doctor_id'      => $appointment->doctor_id,
            'patient_id'     => $appointment->patient_id,
            'symptoms'       => $appointment->symptoms, 
            'created_by'     => $staffUserId, 
            'status'         => 'draft', // ✅ khớp enum trong migration
        ]);
    } catch (\Exception $e) {
        return back()->with('error', 'Lỗi khi tạo hồ sơ khám bệnh: ' . $e->getMessage());
    }

    return back()->with('success', 'Đã tạo hồ sơ khám bệnh ban đầu thành công.');
}
// 📋 Hiển thị danh sách các lịch đã được duyệt
public function reminderList()
{
    $today = Carbon::today()->toDateString();

    $appointments = \App\Models\Appointment::with(['patient.user', 'doctor.user'])
        ->where('status', 'confirmed') // chỉ lấy lịch đã duyệt
        ->orderByRaw("ABS(DATEDIFF(appointment_date, ?)) ASC", [$today]) // ngày gần nhất với hôm nay lên đầu
        ->orderBy('appointment_time', 'asc') // cùng ngày sắp theo giờ
        ->get();

    return view('staffs.reminders.index', compact('appointments'));
}


  // ✉️ Gửi nhắc lịch cho 1 lịch cụ thể
public function sendReminder($id)
{
    // 1. Lấy dữ liệu
    $appointment = Appointment::with(['patient.user', 'doctor.user'])->findOrFail($id);

    // Chỉ gửi khi lịch đã được duyệt
    if ($appointment->status !== 'confirmed') {
        return back()->with('error', '❌ Chỉ có thể gửi nhắc lịch cho các lịch đã được duyệt.');
    }

    // 2. Gửi mail nhắc lịch
    Mail::to($appointment->patient->user->email)
        ->send(new \App\Mail\AppointmentReminderMail($appointment));

    // =========================================================
    // 🔑 BƯỚC THÊM MỚI: Gửi thông báo hệ thống (Database Notification)
    // =========================================================
    try {
        // Đảm bảo đối tượng User có trait Notifiable
        $patientUser = $appointment->patient->user; 
        
        $patientUser->notify(new \App\Notifications\AppointmentReminderNotification($appointment));
        
    } catch (\Exception $e) {
        // Ghi lại lỗi nếu quá trình lưu thông báo thất bại (ví dụ: bảng notifications chưa có)
        // \Log::error('Lỗi khi lưu thông báo: ' . $e->getMessage()); 
        // Vẫn tiếp tục xử lý các phần còn lại
    }

    // 3. Đánh dấu là đã gửi nhắc lịch (Sử dụng cột 'reminded_at' hoặc 'reminded' đã migration)
    // LƯU Ý: Nếu bạn dùng cột 'reminded_at', hãy đổi 'reminded' thành 'reminded_at = now()'
    $appointment->reminded = true; // Sử dụng cột 'reminded_at' như đã thống nhất
    $appointment->save();

    // 4. Gửi thông báo flash để view hiển thị
    return back()->with('success', '✅ Đã gửi nhắc lịch cho bệnh nhân ' . $appointment->patient->user->name);
}

public function rooms()
{
    $doctors = \App\Models\Doctor::with('user')->get();
    return view('staffs.rooms.index', compact('doctors'));
}

public function editRoom(\App\Models\Doctor $doctor)
{
    return view('staffs.rooms.edit', compact('doctor'));
}

public function updateRoom(Request $request, \App\Models\Doctor $doctor)
{
    $request->validate([
        'room' => 'required|string|max:50',
    ]);

    $doctor->room = $request->room;
    $doctor->save();

    return redirect()->route('staffs.rooms')
                     ->with('success', 'Cập nhật phòng bác sĩ thành công!');
}
public function showRoomAssignment()
    {
        // Lấy danh sách bác sĩ cùng thông tin User (để lấy tên)
        $doctors = Doctor::with('user')->get();

        // Định nghĩa danh sách các phòng khả dụng (Hơn 60 phòng, chỉ số)
        $availableRooms = [
            '101', '102', '103', '104', '105', '106', '107', '108', '109', '110', 
            '201', '202', '203', '204', '205', '206', '207', '208', '209', '210', 
            '301', '302', '303', '304', '305', '306', '307', '308', '309', '310', 
            '401', '402', '403', '404', '405', '406', '407', '408', '409', '410', 
            '501', '502', '503', '504', '505', '506', '507', '508', '509', '510', 
            '601', '602', '603', '604', '605', '606', '607', '608', '609', '610',
        ];

        // Trả về view và truyền hai biến cần thiết
        return view('staffs.rooms.index', compact('doctors', 'availableRooms'));
    }
    
    // Phương thức xử lý cập nhật phòng (Xử lý form PUT)
    public function updateRoomAssignment(Request $request, Doctor $doctor)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'room' => 'required|string|max:10', // Đảm bảo room là chuỗi và không quá 10 ký tự
        ]);

        // Cập nhật trường 'room' cho đối tượng Doctor
        $doctor->update([
            'room' => $request->input('room'),
        ]);

        // Quay lại trang trước với thông báo thành công
        return redirect()->back()->with('success', 
            'Đã cập nhật phòng **' . $request->input('room') . '** cho bác sĩ **' . ($doctor->user->name ?? 'N/A') . '** thành công.'
        );
        
    }
    public function show()
{
    $staff = Staff::where('user_id', Auth::id())->first();
    return view('staffs.profile.show', compact('staff'));
}

public function edit()
{
    $staff = Staff::where('user_id', Auth::id())->first();
    return view('staffs.profile.edit', compact('staff'));
}

public function update(Request $request)
    {
        // Lấy User và Staff đang đăng nhập
        $user = Auth::user();
        $staff = $user->staff; // Quan hệ hasOne giữa User và Staff

        // 1. VALIDATION
        $request->validate([
            // Bắt buộc cập nhật User.name
            'name' => ['required', 'string', 'max:255'], 
            
            // Các trường của Staff
            'phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'address' => ['nullable', 'string', 'max:255'],
            'hometown' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            
            // Ảnh đại diện
            'photo' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png,webp'], 
        ]);
/** @var \App\Models\User $user */
        // 2. CẬP NHẬT USER (Tên)
        $user->update([
            'name' => $request->name,
            // KHÔNG cập nhật email và password ở đây (cần route/form riêng)
        ]);

        // 3. XỬ LÝ VÀ CẬP NHẬT ẢNH ĐẠI DIỆN
        if ($request->hasFile('photo')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
            // Lưu ảnh mới vào thư mục 'staff_photos' trong storage
            $path = $request->file('photo')->store('staff_photos', 'public');
        } else {
            $path = $staff->photo; // Giữ nguyên ảnh cũ
        }
        
        // 4. CẬP NHẬT STAFF (Các trường hồ sơ)
        $staff->update([
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'hometown' => $request->hometown,
            'notes' => $request->notes,
            'photo' => $path, // Lưu đường dẫn ảnh
        ]);

        return back()->with('success', 'Hồ sơ cá nhân đã được cập nhật thành công!');
    }
public function adminIndex()
    {
        // Lấy danh sách Staff, eager loading User, và phân trang
        $staffs = Staff::with('user')->paginate(10); 
        
        return view('admin.staffs.index', compact('staffs'));
    }

    // ---------------------------------------------------------------------

    /**
     * Hiển thị form để thêm nhân viên mới (CREATE).
     * Route: GET /admin/staffs/create -> [AdminStaffController::class, 'adminCreate']
     */
    public function adminCreate()
    {
        return view('admin.staffs.create');
    }

    // ---------------------------------------------------------------------

    /**
     * Lưu trữ nhân viên mới vào cơ sở dữ liệu (STORE).
     * Route: POST /admin/staffs -> [AdminStaffController::class, 'adminStore']
     */
    public function adminStore(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        // 2. Tạo tài khoản User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff', 
        ]);

        // 3. Tạo hồ sơ Staff
        Staff::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.staffs.index')
                         ->with('success', 'Đã thêm nhân viên ' . $user->name . ' thành công!');
    }

    // ---------------------------------------------------------------------

    /**
     * Hiển thị form để sửa nhân viên (EDIT).
     * Route: GET /admin/staffs/{staff}/edit -> [AdminStaffController::class, 'adminEdit']
     */
    public function adminEdit(Staff $staff)
    {
        return view('admin.staffs.edit', compact('staff'));
    }

    // ---------------------------------------------------------------------

    /**
     * Cập nhật thông tin nhân viên vào cơ sở dữ liệu (UPDATE).
     * Route: PUT/PATCH /admin/staffs/{staff} -> [AdminStaffController::class, 'adminUpdate']
     */
   public function adminUpdate(Request $request, Staff $staff)
{
    // 1. Validate dữ liệu - Bổ sung các trường mới và quy tắc cho ảnh
    $request->validate([
        'name'          => ['required', 'string', 'max:255'],
        'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($staff->user_id)],
        
        'phone'         => ['nullable', 'string', 'max:20'],
        'date_of_birth' => ['nullable', 'date'],
        'gender'        => ['nullable', 'string', Rule::in(['male', 'female', 'other'])],
        'address'       => ['nullable', 'string', 'max:255'],
        'hometown'      => ['nullable', 'string', 'max:255'],
        'notes'         => ['nullable', 'string'],
        'photo'         => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Max 2MB
    ]);

    // 2. Cập nhật User (Thông tin tài khoản)
    $staff->user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // 3. Xử lý Ảnh đại diện (PHOTO)
    $path = $staff->photo; // Mặc định giữ đường dẫn ảnh cũ

    if ($request->hasFile('photo')) {
        // Xóa ảnh cũ nếu tồn tại
        if ($staff->photo) {
            Storage::disk('public')->delete($staff->photo);
        }
        
        // Lưu ảnh mới vào thư mục 'staff_photos'
        $path = $request->file('photo')->store('staff_photos', 'public');
    }

    // 4. Cập nhật Staff (Thông tin hồ sơ cá nhân)
    $staff->update([
        'phone'         => $request->phone,
        'date_of_birth' => $request->date_of_birth,
        'gender'        => $request->gender,
        'address'       => $request->address,
        'hometown'      => $request->hometown,
        'notes'         => $request->notes,
        'photo'         => $path, // Lưu đường dẫn ảnh đã được xử lý (ảnh mới hoặc ảnh cũ)
    ]);

    return redirect()->route('admin.staffs.index')
                     ->with('success', 'Thông tin nhân viên ' . $staff->user->name . ' đã được cập nhật.');
}

    public function adminDestroy(Staff $staff)
    {
        $userName = $staff->user->name;
        $userId = $staff->user_id;

        // Xóa hồ sơ Staff
        $staff->delete();

        // Xóa tài khoản User liên quan
        User::find($userId)->delete();

        return redirect()->route('admin.staffs.index')
                         ->with('success', 'Nhân viên ' . $userName . ' và tài khoản liên quan đã bị xóa.');
    }

}
