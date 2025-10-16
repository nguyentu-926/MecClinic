<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

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
}
