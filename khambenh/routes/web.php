<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RoomController;


// Trang chủ
Route::get('/', function () {
    return view('welcome');
});

// =======================
// 🧍 AUTHENTICATION
// =======================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::middleware(['auth'])->group(function () {

    // =======================
    // PATIENT
    // =======================
   

    // =======================
    // DOCTOR
    // =======================
    // Dashboard bác sĩ
   
    Route::get('/dashboard/doctor/{id}', [DoctorController::class,'dashboard'])->name('dashboard.doctor');
    // Xem chi tiết 1 lịch hẹn
    Route::get('/doctor/appointments/{id}', [DoctorController::class, 'showAppointment'])
         ->name('doctor.appointment.show');
     // Bác sĩ xem lịch hẹn
Route::get('/doctor/{id}/appointments', [DoctorController::class, 'appointments'])
    ->name('doctor.appointments');
    // Xem/Chỉnh sửa hồ sơ cá nhân bác sĩ
    Route::get('/doctor/profile/{id}', [DoctorController::class, 'editProfile'])
         ->name('doctor.profile.edit');
    Route::put('/doctor/profile/{id}', [DoctorController::class, 'updateProfile'])
         ->name('doctor.profile.update');
    Route::get('/profile/{id}', [DoctorController::class, 'profileshow'])->name('doctor.profile.show');

    // Cập nhật trạng thái lịch hẹn (confirm / done / cancel)

    Route::put('/doctor/appointment/{id}/update-status', [DoctorController::class, 'updateStatus'])->name('doctor.appointment.updateStatus');


   
    // ============ LỊCH HẸN CỦA BÁC SĨ ============
    Route::get('/doctor/{id}/appointments/all', [AppointmentController::class, 'doctorAllAppointments'])->name('doctors.appointments.all');
    Route::get('/doctor/{id}/appointments/confirmed', [AppointmentController::class, 'doctorConfirmedAppointments'])->name('doctors.appointments.confirmed');
    Route::get('/doctor/{id}/appointments/pending', [AppointmentController::class, 'doctorPendingAppointments'])->name('doctors.appointments.pending');
    Route::get('/doctor/{id}/appointments/cancelled', [AppointmentController::class, 'doctorCancelledAppointments'])->name('doctors.appointments.cancelled');

    // =======================
    // STAFF
    Route::get('/profile', [StaffController::class, 'show'])->name('staff.profile.show');
Route::get('/profile/edit', [StaffController::class, 'edit'])->name('staff.profile.edit');
Route::put('/profile', [StaffController::class, 'update'])->name('staff.profile.update');

Route::get('/', [StaffController::class, 'allAppointments'])
     ->name('staff.appointments.all');
    // =======================
    Route::get('/dashboard/staff/{id}', [StaffController::class, 'dashboard'])->name('dashboard.staff');
    // Danh sách lịch hẹn cho staff
    
    // Nhân viên xem toàn bộ lịch hẹn
    
Route::get('/staff/appointments', [StaffController::class, 'appointments'])
    ->name('staff.appointments');
    Route::get('staff/appointments', [AppointmentController::class,'staffIndex'])->name('staff.appointments.index');

    // Duyệt lịch hẹn (Ajax PUT)
     // Nút xác nhận phản hồi bác sĩ
    Route::put('/appointments/{id}/approve', [StaffController::class, 'approve']) ->name('staff.appointments.approve');
    // =======================
    // ADMIN
    // =======================
    Route::get('/dashboard/admin/{id}', [AdminController::class, 'dashboard'])->name('dashboard.admin');

    // =======================
    // APPOINTMENTS
    // =======================
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/patients/{id}/appointments', [AppointmentController::class, 'index'])->name('patients.appointments');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    // AJAX
    Route::get('/appointments/doctors', [AppointmentController::class, 'getDoctorsBySpecialization'])->name('appointments.doctors');
    Route::get('/appointments/available-times', [AppointmentController::class, 'getAvailableTimes'])->name('appointments.availableTimes');




// 1. ROUTE TỔNG THỂ (Sử dụng cho nút "Tổng thể")
    Route::get('/', [StaffController::class, 'allAppointments'])
         ->name('staff.appointments.all');

    // 2. ROUTE ĐÃ DUYỆT (Lỗi hiện tại: staff.appointments.confirmed)
    Route::get('/confirmed', [StaffController::class, 'confirmedAppointments'])
         ->name('staff.appointments.confirmed');

    // 3. ROUTE CHỜ DUYỆT
    Route::get('/pending', [StaffController::class, 'pendingAppointments'])
         ->name('staff.appointments.pending');

    // 4. ROUTE ĐÃ HỦY
    Route::get('/cancelled', [StaffController::class, 'cancelledAppointments'])
         ->name('staff.appointments.cancelled');

    // 5. HÀNH ĐỘNG DUYỆT LỊCH HẸN
    Route::put('/{appointment}/approve', [StaffController::class, 'approve'])
         ->name('staff.appointments.approve');


    // 📋 Trang danh sách lịch hẹn đã duyệt
    Route::get('/medical-records/list', [StaffController::class, 'medicalRecordsList'])
        ->name('staff.medical_records.list');
    Route::post('/staff/medical-records/create/{appointmentId}', [StaffController::class, 'createMedicalRecord'])
    ->name('staff.createMedicalRecord');

    // 🩺 Hành động tạo hồ sơ khám mới
    Route::post('/medical-records/create/{appointmentId}', [StaffController::class, 'createMedicalRecord'])
        ->name('staff.medical_records.create');


    // Danh sách hồ sơ khám mà bác sĩ cần xử lý
    Route::get('/medical-records', [DoctorController::class, 'medicalRecordsIndex'])->name('doctor.medicalRecords.index');

    // Form bác sĩ điền kết quả khám
    Route::get('/medical-records/{id}/edit', [DoctorController::class, 'editMedicalRecord'])->name('doctor.medicalRecords.edit');

    // Xử lý lưu lại thông tin khám
    Route::post('/medical-records/{id}/update', [DoctorController::class, 'updateMedicalRecord'])->name('doctor.medicalRecords.update');




    // 📅 Lịch khám của bác sĩ
    Route::get('/doctor/schedule', [App\Http\Controllers\DoctorController::class, 'schedule'])
    ->name('doctor.schedule');

    Route::get('/doctor/api/appointments', [DoctorController::class, 'apiAppointments'])
        ->name('doctor.api.appointments');

     // ✅ Bệnh nhân xem danh sách hồ sơ của mình
    Route::get('/patient/medical-records', [MedicalRecordController::class, 'viewForPatient'])
        ->name('patient.medical-records.index');

    // ✅ Bệnh nhân xem chi tiết 1 hồ sơ khám
    Route::get('/patient/medical-records/{id}', [MedicalRecordController::class, 'showForPatient'])
        ->name('patient.medical-records.show');
     // Trang danh sách các lịch đã duyệt
    Route::get('/staff/reminders', [StaffController::class, 'reminderList'])->name('staff.reminders');

    // Gửi nhắc lịch cho 1 lịch cụ thể
    Route::post('/staff/reminders/{id}/send', [StaffController::class, 'sendReminder'])->name('staff.reminders.send');

    
    
Route::post('/patients/notifications/read-all', [PatientController::class, 'markAllAsRead'])->name('patients.notifications.readAll');
Route::get('/patients/notifications/{id}', [PatientController::class, 'showNotification'])
    ->name('patients.notifications.show');

// Hiển thị tất cả thông báo
Route::get('/patients/notifications', [PatientController::class, 'notifications'])->name('patients.notifications')->middleware('auth');;

// Đánh dấu tất cả là đã đọc
Route::post('/patients/notifications/read-all', [PatientController::class, 'markAllAsRead'])->name('patients.notifications.readAll');

// Đánh dấu 1 thông báo là đã đọc (cần có)
Route::post('/patients/notifications/{id}/read', [PatientController::class, 'markAsRead'])
    ->name('patients.notifications.markAsRead');


     Route::get('/staffs/rooms', [\App\Http\Controllers\StaffController::class, 'rooms'])->name('staffs.rooms');
     Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

    Route::get('/staffs/rooms/{doctor}/edit', [\App\Http\Controllers\StaffController::class, 'editRoom'])->name('staffs.rooms.edit');
    Route::put('/staffs/rooms/{doctor}', [\App\Http\Controllers\StaffController::class, 'updateRoom'])->name('staffs.rooms.update');



    // Dashboard admin
    Route::get('/dashboard/{id}', [AdminController::class, 'dashboard'])->name('dashboard.admin');

    // Quản lý user
    Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    Route::get('/users/create', [AdminController::class, 'usersCreate'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'usersStore'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'usersEdit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'usersUpdate'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'usersDestroy'])->name('admin.users.destroy');
     // Danh sách bệnh nhân
    Route::get('/admin/patients', [AdminController::class, 'patientsIndex'])->name('admin.patients.index');

    // Thêm mới bệnh nhân
    Route::get('/admin/patients/create', [AdminController::class, 'patientsCreate'])->name('admin.patients.create');
    Route::post('/admin/patients', [AdminController::class, 'patientsStore'])->name('admin.patients.store');

    // Sửa bệnh nhân
    Route::get('/admin/patients/{patient}/edit', [AdminController::class, 'patientsEdit'])->name('admin.patients.edit');
    Route::put('/admin/patients/{patient}', [AdminController::class, 'patientsUpdate'])->name('admin.patients.update');

    // Xóa bệnh nhân
    Route::delete('/admin/patients/{patient}', [AdminController::class, 'patientsDestroy'])->name('admin.patients.destroy');

    // Xem hồ sơ khám của bệnh nhân
    Route::get('patients/{patient}/medical-records', [AdminController::class, 'patientsMedicalRecords'])
        ->name('admin.patients.medicalRecords');
    Route::get('patients/medical-records/{record}', [AdminController::class, 'showMedicalRecord'])
    ->name('admin.patients.medicalRecords.show');


    // Xem lịch hẹn của bệnh nhân
    Route::get('/admin/patients/{patient}/appointments', [AdminController::class, 'patientsAppointments'])->name('admin.patients.appointments');
 

     Route::get('/admin/doctors', [DoctorController::class, 'index'])->name('admin.doctors.index');
    Route::get('/admin/doctors/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
    Route::post('/admin/doctors', [DoctorController::class, 'store'])->name('admin.doctors.store');
    Route::get('/admin/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('admin.doctors.edit');
    Route::put('/admin/doctors/{doctor}', [DoctorController::class, 'update'])->name('admin.doctors.update');
    Route::delete('/admin/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');
    // Danh sách Nhân viên
Route::get('/admin/staffs', [StaffController::class, 'adminIndex'])->name('admin.staffs.index');

// Hiển thị form Thêm mới
Route::get('/admin/staffs/create', [StaffController::class, 'adminCreate'])->name('admin.staffs.create');

// Xử lý lưu Nhân viên mới
Route::post('/admin/staffs', [StaffController::class, 'adminStore'])->name('admin.staffs.store');

// Hiển thị form Sửa (sử dụng Route Model Binding)
Route::get('/admin/staffs/{staff}/edit', [StaffController::class, 'adminEdit'])->name('admin.staffs.edit');

// Xử lý Cập nhật
Route::put('/admin/staffs/{staff}', [StaffController::class, 'adminUpdate'])->name('admin.staffs.update');

// Xử lý Xóa
Route::delete('/admin/staffs/{staff}', [StaffController::class, 'adminDestroy'])->name('admin.staffs.destroy');

// (Tùy chọn) Xem chi tiết
// Route::get('/admin/staffs/{staff}', [AdminStaffController::class, 'show'])->name('admin.staffs.show');
    Route::get('/admin/appointments', [\App\Http\Controllers\AdminController::class, 'appointments'])
        ->name('admin.appointments.index');

    Route::get('/admin/statistics', [AdminController::class, 'statistics'])
    ->name('admin.statistics.index');


   Route::get('/dckh', [PatientController::class, 'showPortalCards'])->name('dckh.portal'); 

// 2. CÁC TRANG NỘI DUNG CHI TIẾT
// Trỏ đến các file view trực tiếp (survey.blade.php, medical_records.blade.php, ...)
Route::get('/dckh/survey', [PatientController::class, 'showSurvey'])->name('dckh.survey'); 
Route::get('/dckh/records', [PatientController::class, 'showMedicalRecords'])->name('dckh.medical_records');
Route::get('/dckh/services', [PatientController::class, 'showServices'])->name('dckh.services'); 
Route::get('/dckh/guide', [PatientController::class, 'showGuide'])->name('dckh.guide');
Route::get('/dckh/doctors', [PatientController::class, 'showDoctors'])->name('dckh.doctors');
Route::get('/dckh/contact', [PatientController::class, 'showContact'])->name('dckh.contact');

Route::get('/huong-dan-kham-benh', [PatientController::class, 'showGuidee'])->name('patient.guidee'); 
Route::get('/danh-sach-dich-vu', [PatientController::class, 'showServicesList'])->name('services.list');
Route::get('/gioi-thieu', [PatientController::class, 'showgt'])->name('patient.gt');
Route::get('/chuyen-khoa', [PatientController::class, 'showck'])->name('patient.ck');
Route::get('/dich-vu-dac-biet', [PatientController::class, 'showdvdb'])->name('patient.dvdb');

Route::put('/doctors/{doctor}/room', [StaffController::class, 'updateRoomAssignment'])->name('staff.updateRoom');

// Route hiển thị trang (Giải quyết lỗi 'Undefined variable $availableRooms')
    Route::get('/rooms', [StaffController::class, 'showRoomAssignment'])->name('rooms.index'); 

    // Route cập nhật phòng (Giải quyết lỗi 'Route [staff.updateRoom] not defined')
    Route::put('/doctors/{doctor}/room', [StaffController::class, 'updateRoomAssignment'])->name('staff.updateRoom');
    Route::get('/lien-he', [PatientController::class, 'showlh'])->name('patient.lh');

 Route::get('/dashboard/patient/{id}', [PatientController::class, 'dashboard'])->name('dashboard.patient');
    Route::get('/patients/{id}', [PatientController::class, 'show'])->name('patients.show');

    Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');

    Route::put('/profile', [PatientController::class, 'update'])->name('patients.update');
    // Bệnh nhân xem lịch hẹn
Route::get('/patient/{id}/appointments', [PatientController::class, 'appointments'])
    ->name('patient.appointments');
// 📋 Tổng thể lịch hẹn
Route::get('/patient/{id}/appointments/all', [AppointmentController::class, 'patientAllAppointments'])
    ->name('patients.appointments.all');
// Lịch đã duyệt
Route::get('/patient/{id}/appointments/confirmed', [AppointmentController::class, 'patientConfirmedAppointments'])
    ->name('patients.appointments.confirmed');

// Lịch chờ duyệt
Route::get('/patient/{id}/appointments/pending', [AppointmentController::class, 'patientPendingAppointments'])
    ->name('patients.appointments.pending');

// Lịch đã hủy
Route::get('/patient/{id}/appointments/cancelled', [AppointmentController::class, 'patientCancelledAppointments'])
    ->name('patients.appointments.cancelled');
});



