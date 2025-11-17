<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\Staff;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;


class AdminController extends Controller
{
   public function dashboard($id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== Auth::id()) {
            abort(403);
        }
        return view('dashboard.admin', compact('user'));
    }
     // Hiển thị danh sách user
    public function usersIndex(Request $request)
    {
        $query = User::query();

        // Lọc theo role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Sắp xếp theo cột
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'asc');
        $query->orderBy($sort, $order);

        $users = $query->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // Form thêm user
    public function usersCreate()
    {
        return view('admin.users.create');
    }

    // Lưu user mới
    public function usersStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:patient,doctor,staff,admin',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Tài khoản user đã được tạo.');
    }

    // Form chỉnh sửa user
    public function usersEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật user
    public function usersUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:patient,doctor,staff,admin',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Tài khoản user đã được cập nhật.');
    }

    // Xóa user
    public function usersDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Tài khoản user đã bị xóa.');
    }
    // Danh sách bệnh nhân
    public function patientsIndex(Request $request)
    {
        $query = User::where('role', 'patient');

        // Lọc theo trạng thái hoạt động (active/inactive)
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sắp xếp
        if ($request->has('order') && $request->order != '') {
            $query->orderBy('name', $request->order); // sắp xếp theo tên
        } else {
            $query->latest();
        }

        $patients = $query->paginate(10);

        return view('admin.patients.index', compact('patients'));
    }

    // Thêm bệnh nhân
    public function patientsCreate()
    {
        return view('admin.patients.create');
    }

    public function patientsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient',
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'status' => 'active',
        ]);

        return redirect()->route('admin.patients.index')->with('success', 'Bệnh nhân đã được thêm thành công!');
    }

    // Sửa bệnh nhân
    public function patientsEdit(User $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function patientsUpdate(Request $request, User $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        $patient->update($request->only('name', 'phone', 'dob', 'gender', 'status'));

        return redirect()->route('admin.patients.index')->with('success', 'Bệnh nhân đã được cập nhật!');
    }

    // Xóa bệnh nhân
    public function patientsDestroy(User $patient)
    {
        $patient->delete();
        return redirect()->route('admin.patients.index')->with('success', 'Bệnh nhân đã bị xóa!');
    }

    public function patientsMedicalRecords($patientId)
{
    $patient = User::where('role', 'patient')->findOrFail($patientId);

    // Lấy tất cả hồ sơ khám của bệnh nhân
    $medicalRecords = MedicalRecord::where('patient_id', $patient->id)
                        ->latest()
                        ->paginate(10);

    return view('admin.patients.medical-records', compact('patient', 'medicalRecords'));

}
public function showMedicalRecord($recordId)
{
    $record = MedicalRecord::findOrFail($recordId);
    return view('admin.patients.medical-record-detail', compact('record'));
}


    // Xem lịch hẹn
   public function patientsAppointments($patientId, Request $request)
{
    $patient = User::where('role', 'patient')->findOrFail($patientId);

    $query = $patient->appointments(); // Relationship đã định nghĩa trong User.php

    // Lọc theo trạng thái
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Sắp xếp
    $order = $request->get('order', 'asc');
    $query->orderBy('appointment_date', $order);

    // Phân trang
    $appointments = $query->paginate(100)->withQueryString();

    return view('admin.patients.appointments', compact('patient', 'appointments'));
}

public function appointments(Request $request)
{
    $query = \App\Models\Appointment::with(['doctor.user', 'patient.user']);

    // Lọc theo trạng thái
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Lọc theo bác sĩ
    if ($request->filled('doctor_id')) {
        $query->where('doctor_id', $request->doctor_id);
    }

    // Lọc theo ngày hẹn
    if ($request->filled('date')) {
        $query->whereDate('appointment_date', $request->date);
    }

    $appointments = $query->paginate(10)->withQueryString();

    // Danh sách bác sĩ để lọc
    $doctors = \App\Models\Doctor::with('user')->get();

    return view('admin.appointments.index', compact('appointments', 'doctors'));
}
public function statistics()
{
    // 1️⃣ Thống kê lịch hẹn theo tháng
    $appointmentsByMonth = Appointment::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month');

    // 2️⃣ Thống kê theo trạng thái
    $appointmentStatus = Appointment::selectRaw('status, COUNT(*) as total')
        ->groupBy('status')
        ->pluck('total', 'status');

    // 3️⃣ Số lượng user theo role
    $userRoles = DB::table('users')
        ->selectRaw('role, COUNT(*) as total')
        ->groupBy('role')
        ->pluck('total', 'role');

    // 4️⃣ Lịch hẹn theo từng bác sĩ
    $appointmentsPerDoctor = Doctor::select(
            'doctors.id',
            DB::raw('users.name as doctor_name'),
            DB::raw('COUNT(appointments.id) as total')
        )
        ->leftJoin('users', 'users.id', '=', 'doctors.user_id')
        ->leftJoin('appointments', 'appointments.doctor_id', '=', 'doctors.id')
        ->groupBy('doctors.id', 'users.name')
        ->orderBy('total', 'DESC')
        ->get();

    // 5️⃣ Top 5 bác sĩ bận nhất
    $topDoctors = Doctor::select(
            'doctors.id',
            DB::raw('users.name as doctor_name'),
            DB::raw('COUNT(appointments.id) as total')
        )
        ->leftJoin('users', 'users.id', '=', 'doctors.user_id')
        ->leftJoin('appointments', 'appointments.doctor_id', '=', 'doctors.id')
        ->groupBy('doctors.id', 'users.name')
        ->orderBy('total', 'DESC')
        ->limit(5)
        ->get();

    return view('admin.statistics.index', compact(
        'appointmentsByMonth',
        'appointmentStatus',
        'userRoles',
        'appointmentsPerDoctor',
        'topDoctors'
    ));
}
public function store(Request $request)
    {
        // 1. Validate dữ liệu đầu vào
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Email phải duy nhất trong bảng users và là bắt buộc
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Yêu cầu xác nhận mật khẩu
            'phone' => ['nullable', 'string', 'max:20'],
            // Vị trí phải nằm trong danh sách cho phép (ví dụ)
            'position' => ['required', 'string', Rule::in(['Reception', 'Nurse', 'Technician'])],
            'address' => ['nullable', 'string', 'max:255'],
        ], [
            // Thông báo lỗi tiếng Việt
            'name.required' => 'Tên nhân viên là bắt buộc.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'position.required' => 'Vị trí/Chức vụ là bắt buộc.',
        ]);

        // 2. Tạo tài khoản User trước
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff', // Gán role mặc định là 'staff'
        ]);

        // 3. Tạo hồ sơ Staff liên kết với User vừa tạo
        Staff::create([
            'user_id' => $user->id, // Liên kết Staff với User
            'phone' => $request->phone,
            'position' => $request->position,
            'address' => $request->address,
            // Các trường khác như date_of_birth, gender, photo sẽ được cập nhật sau
        ]);

        // 4. Chuyển hướng về trang danh sách nhân viên với thông báo thành công
        return redirect()->route('admin.staff.index')
                         ->with('success', 'Đã thêm nhân viên ' . $user->name . ' thành công!');
    }

}