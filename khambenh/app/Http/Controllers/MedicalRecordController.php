<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    // 📋 Staff tạo hồ sơ khám trống
    public function create($appointment_id)
    {
        $appointment = Appointment::with(['patient.user', 'doctor.user'])->findOrFail($appointment_id);
        return view('medical_records.create', compact('appointment'));
    }

    // 💾 Staff lưu hồ sơ trống
    public function store(Request $request, $appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);

        // Tạo hồ sơ trống
        $record = MedicalRecord::create([
            'appointment_id' => $appointment->id,
            'doctor_id' => $appointment->doctor_id,
            'patient_id' => $appointment->patient_id,
            'created_by' => Auth::id(),
            'status' => 'draft', // Chưa hoàn tất
        ]);

        return redirect()->route('dashboard.doctor', $appointment->doctor_id)
                         ->with('success', '🩺 Hồ sơ khám đã được khởi tạo, vui lòng chuyển cho bác sĩ hoàn thiện!');
    }

    // 👨‍⚕️ Bác sĩ xem form nhập kết quả khám
    public function editByDoctor($id)
    {
        $record = MedicalRecord::with(['appointment.patient.user'])->findOrFail($id);
        return view('medical_records.edit_by_doctor', compact('record'));
    }

    // 💾 Bác sĩ điền và lưu kết quả
    public function updateByDoctor(Request $request, $id)
    {
        $record = MedicalRecord::findOrFail($id);

        $validated = $request->validate([
            'symptoms' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'prescription' => 'nullable|string',
            'treatment_plan' => 'nullable|string',
            'test_results' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $record->update(array_merge($validated, ['status' => 'completed']));

        // Đổi trạng thái lịch hẹn thành "done"
        $record->appointment->update(['status' => 'done']);

        return redirect()->route('medical_records.index')
                         ->with('success', '✅ Hồ sơ khám đã được bác sĩ hoàn thiện thành công!');
    }
    // 🧍‍♂️ Bệnh nhân xem danh sách hồ sơ của mình
public function viewForPatient()
{
    $records = \App\Models\MedicalRecord::with(['doctor.user', 'appointment'])
        ->where('patient_id', Auth::user()->patient->id
)
        ->where('status', 'completed')
        ->latest()
        ->get();

    return view('medical_records.patient_index', compact('records'));
}

// 🧾 Bệnh nhân xem chi tiết 1 hồ sơ
public function showForPatient($id)
{
    $record = \App\Models\MedicalRecord::with(['doctor.user', 'appointment'])
        ->where('id', $id)
        ->where('patient_id', Auth::user()->patient->id
)
        ->where('status', 'completed')
        ->firstOrFail();

    return view('medical_records.patient_show', compact('record'));
}

}
