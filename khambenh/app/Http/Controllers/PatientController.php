<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

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
    public function edit()
    {
        $patient = Patient::where('user_id', Auth::id())->firstOrFail();
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
}
