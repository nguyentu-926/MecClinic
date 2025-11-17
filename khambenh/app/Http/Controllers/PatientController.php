<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;        
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\DatabaseNotification;

class PatientController extends Controller
{
    public function dashboard($id)
    {
        $user = Auth::user();

        // Kiểm tra quyền
        if ($user->id != $id || $user->role !== 'patient') {
            abort(403, 'Không có quyền truy cập');
        }

        // Lấy thông tin bệnh nhân
        $patient = Patient::where('user_id', $id)->first();

        // 🩺 Lấy danh sách lịch hẹn của bệnh nhân này
        $appointments = Appointment::where('patient_id', $patient->id)
            ->with('doctor.user')
            ->orderByDesc('appointment_date')
            ->get();

        return view('dashboard.patient', compact('user', 'patient', 'appointments'));
    }

    // Hiển thị hồ sơ cá nhân (view-only)
    public function show()
    {
        $patient = Patient::where('user_id', Auth::id())->firstOrFail();
        return view('patients.show', compact('patient'));
    }

    // Form chỉnh sửa hồ sơ cá nhân
   public function edit($id)
{
    $patient = Patient::findOrFail($id); // Lấy patient theo id
    return view('patients.edit', compact('patient'));
}


    // Cập nhật hồ sơ cá nhân
    public function update(Request $request)
    {
        $patient = Patient::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->name = $request->full_name;
        $user->save();

        $patient->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
        ]);

        return redirect()->route('patients.show')
                         ->with('success', 'Cập nhật hồ sơ cá nhân thành công!');
    }
    public function appointments($id)
{
    $patient = Auth::user()->patient;

    // Lấy lịch hẹn của bệnh nhân hiện tại
    $confirmedAppointments = \App\Models\Appointment::with(['doctor.user'])
        ->where('patient_id', $patient->id)
        ->where('status', 'confirmed')
        ->orderByDesc('appointment_date')
        ->get();

    $pendingAppointments = \App\Models\Appointment::with(['doctor.user'])
        ->where('patient_id', $patient->id)
        ->where('status', 'pending')
        ->orderByDesc('appointment_date')
        ->get();

    return view('patient.appointments', compact('confirmedAppointments', 'pendingAppointments'));
}

public function markAllAsRead()
{
    $user = Auth::user();
    $user->unreadNotifications->markAsRead();

    return back()->with('success', 'Đã đánh dấu tất cả thông báo là đã đọc.');
}

public function notifications(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $filter = $request->query('filter', 'all');

    $query = $user->notifications()->latest();

    if ($filter === 'unread') $query->whereNull('read_at');
    elseif ($filter === 'read') $query->whereNotNull('read_at');

    $notifications = $query->get()->map(function($notification) {
        
        // BƯỚC 1: Xử lý an toàn key 'data'
        // $notification->data là đối tượng/mảng được giải mã từ JSON.
        // Dùng isset() để kiểm tra và gán mảng rỗng nếu không có dữ liệu
        $notificationData = (array)($notification->data ?? []);

        // Dữ liệu cần thiết cho hiển thị (có thể thiếu)
        $appointmentDate = $notificationData['appointment_date'] ?? null;
        $appointmentTime = $notificationData['appointment_time'] ?? null;
        
        // Tạo đối tượng Carbon một cách an toàn
        $appointmentDateTime = null;
        $status = 'default';

        if ($appointmentDate && $appointmentTime) {
            $appointmentDateTime = \Carbon\Carbon::parse($appointmentDate . ' ' . $appointmentTime);
            
            // Xác định trạng thái
            if ($appointmentDateTime->isFuture()) $status = 'upcoming';
            elseif ($appointmentDateTime->isToday()) $status = 'today';
            else $status = 'past';
        }
        
        // BƯỚC 2: TRẢ LẠI MẢNG KẾT QUẢ
        return [
            'id' => $notification->id,
            // ĐƯA KEY 'DATA' VÀO MẢNG KẾT QUẢ ĐỂ VIEW CÓ THỂ TRUY CẬP record_id
            'data' => $notificationData, 
            
            'doctor_name' => $notificationData['doctor_name'] ?? 'Hệ thống',
            'appointment_date' => $appointmentDateTime ? $appointmentDateTime->format('d/m/Y') : '---',
            'appointment_time' => $appointmentDateTime ? $appointmentDateTime->format('H:i') : '---',
            'message' => $notificationData['message'] ?? 'Không có nội dung',
            'read_at' => $notification->read_at,
            'created_at' => $notification->created_at,
            'status' => $status,
        ];
    });

    return view('patients.notifications_list', compact('notifications', 'filter'));
}
public function showNotification($id)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();
    
    $notification = $user->notifications()->findOrFail($id);

    // Nếu chưa đọc, đánh dấu là đã đọc
    if (is_null($notification->read_at)) {
        $notification->markAsRead();
    }

    return view('patients.notification-detail', compact('notification'));
}
public function markAsRead($id)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $notification = $user->notifications()->where('id', $id)->first();

    if ($notification && is_null($notification->read_at)) {
        $notification->markAsRead();
    }

    return back()->with('success', 'Thông báo đã được đánh dấu là đã đọc.');
}

public function showPortalCards()
    {
        // Trả về file resources/views/dckh.blade.php
        return view('dckh'); 
    }

    // =========================================================================
    // 2. CÁC PHƯƠNG THỨC HIỂN THỊ TRANG CHI TIẾT
    // (Sử dụng tên view trực tiếp, không có thư mục con)
    // =========================================================================

    /**
     * Hiển thị Phiếu Khảo Sát
     * Route: patient.survey
     */
    public function showSurvey()
    {
        return view('survey'); // Trả về resources/views/survey.blade.php
    }

    /**
     * Hiển thị Hồ Sơ Sức Khỏe
     * Route: patient.medical_records
     */
    public function showMedicalRecords()
    {
        return view('medical_records'); // Trả về resources/views/medical_records.blade.php
    }

    /**
     * Hiển thị Danh Mục Dịch Vụ
     * Route: patient.services
     */
    public function showServices()
    {
        return view('services'); // Trả về resources/views/services.blade.php
    }
    
    /**
     * Hiển thị Hướng Dẫn Tra Cứu
     * Route: patient.guide
     */
    public function showGuide()
    {
        return view('guide'); // Trả về resources/views/guide.blade.php
    }

    /**
     * Hiển thị Danh Sách Bác Sĩ
     * Route: patient.doctors
     */
    public function showDoctors()
    {
        return view('doctors'); // Trả về resources/views/doctors.blade.php
    }

    /**
     * Hiển thị Thông Tin Liên Hệ
     * Route: patient.contact
     */
    public function showContact()
    {
        return view('contact'); // Trả về resources/views/contact.blade.php
    }
    public function showGuidee()
    {
        // Trả về view guidee.blade.php
        return view('guidee'); 
    }
    public function showServicesList()
    {
        // Trả về view guidee.blade.php
        return view('servicesList'); 
    }
    public function showgt()
    {
        // Trả về view guidee.blade.php
        return view('gt'); 
    }
    public function showck()
    {
        // Trả về view guidee.blade.php
        return view('ck'); 
    }
    public function showdvdb()
    {
        // Trả về view guidee.blade.php
        return view('dvdb'); 
    }
    public function showlh()
    {
        // Trả về view guidee.blade.php
        return view('lh'); 
    }
    
}


