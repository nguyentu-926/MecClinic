<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;

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
    Route::get('/dashboard/patient/{id}', [PatientController::class, 'dashboard'])->name('dashboard.patient');
    Route::get('/profile', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/profile/edit', [PatientController::class, 'edit'])->name('patients.edit');
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
    // Cập nhật trạng thái lịch hẹn (confirm / done / cancel)

    Route::put('/doctor/appointment/{id}/update-status', [DoctorController::class, 'updateStatus'])->name('doctor.appointment.updateStatus');


    // Tạo hồ sơ khám mới cho lịch hẹn
    Route::get('/doctor/appointments/{id}/medical-record/create', [DoctorController::class, 'createMedicalRecord'])
         ->name('doctor.medicalRecord.create');

    Route::post('/doctor/appointments/{id}/medical-record', [DoctorController::class, 'storeMedicalRecord'])
         ->name('doctor.medicalRecord.store');
    // ============ LỊCH HẸN CỦA BÁC SĨ ============
    Route::get('/doctor/{id}/appointments/all', [AppointmentController::class, 'doctorAllAppointments'])->name('doctors.appointments.all');
    Route::get('/doctor/{id}/appointments/confirmed', [AppointmentController::class, 'doctorConfirmedAppointments'])->name('doctors.appointments.confirmed');
    Route::get('/doctor/{id}/appointments/pending', [AppointmentController::class, 'doctorPendingAppointments'])->name('doctors.appointments.pending');
    Route::get('/doctor/{id}/appointments/cancelled', [AppointmentController::class, 'doctorCancelledAppointments'])->name('doctors.appointments.cancelled');

    // =======================
    // STAFF
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






});
