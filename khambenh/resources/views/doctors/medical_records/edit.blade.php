@extends('layouts.doctor')

@section('content')

<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO CẤU TRÚC CARD & TIÊU ĐỀ */
/* ------------------------------------------- */

/* KHỐI CARD CHÍNH - Container lớn bao quanh nội dung */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); 
    border-radius: 12px;
    /* Dùng shadow xanh lá đậm */
    box-shadow: 0 10px 40px rgba(21, 128, 61, 0.3); 
    max-width: 1500px; /* Giảm max-width để form gọn hơn */
    width: 100%; 
    margin: 0px auto 0px auto; 
    overflow: hidden;
    position: relative;
    z-index: 10; 
}

/* Thanh Tiêu đề Card (Phần đầu card, đồng bộ màu xanh lá đậm) */
.tat-form-header-bar {
    background-color: #004d99; /* Xanh lá đậm của Doctor Layout */
    color: white;
    text-align: center;
    padding: 18px 20px;
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: 1px;
}

/* Tiêu đề phụ (tat-subheader): Dùng cho các section trong card */
.tat-subheader {
    color: #004d99; /* Xanh đậm y tế */
    border-bottom: 2px solid #ff9900; /* Đường viền cam nổi bật */
    display: inline-block;
    padding-bottom: 5px;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    padding-left: 10px; 
}

/* Style cho các cặp label/input */
.form-label {
    font-weight: 600;
    color: #047857; /* Màu xanh lá cây đậm */
    margin-bottom: 8px;
    display: block;
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid #d1d5db; /* border-gray-300 */
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
    transition: border-color 0.2s, box-shadow 0.2s;
    resize: vertical;
}
.form-control:focus {
    border-color: #004d99;
    box-shadow: 0 0 0 3px rgba(0, 77, 153, 0.2);
    outline: none;
}

/* THÔNG TIN BỆNH NHÂN ĐẦU HỒ SƠ */
.patient-info-box {
    background-color: #f0fdf4; /* Xanh lá nhạt */
    border: 1px solid #dcfce7;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
}
.patient-info-item strong {
    color: #047857; /* Xanh lá đậm */
    margin-right: 5px;
}
.patient-info-item {
    font-size: 0.95rem;
    color: #15803d;
}

/* NÚT LƯU */
.tat-submit-button {
    background-color: #15803d; /* Xanh lá đậm */
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 1.1rem;
    width: 100%;
    transition: background-color 0.2s, transform 0.2s;
}
.tat-submit-button:hover {
    background-color: #0e7456;
    transform: translateY(-1px);
}
</style>

@php
    // Giả định $record->appointment->patient tồn tại
    $patient = $record->appointment->patient;
@endphp

{{-- KHỐI CARD CHÍNH --}}
<div class="tat-form-card">
    
    {{-- Tiêu đề Card đồng bộ --}}
    <div class="tat-form-header-bar">
        ✍️ ĐIỀN/SỬA HỒ SƠ KHÁM BỆNH
    </div>

    <div class="p-8">
        
        {{-- THÔNG TIN BỆNH NHÂN (Đã bổ sung các trường thiếu) --}}
        <div class="patient-info-box grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="patient-info-item">
                <strong>👤 Bệnh nhân:</strong> {{ $patient->user->name ?? 'N/A' }}
            </div>
            <div class="patient-info-item">
                <strong>📅 Ngày khám:</strong> {{ \Carbon\Carbon::parse($record->appointment->appointment_date)->format('d/m/Y') }}
            </div>
            <div class="patient-info-item">
                <strong>🕰️ Giờ khám:</strong> {{ \Carbon\Carbon::parse($record->appointment->appointment_time)->format('H:i') }}
            </div>
            <div class="patient-info-item">
                <strong>🚻 Giới tính:</strong> 
                @switch($patient->gender ?? '—')
                    @case('male') Nam @break
                    @case('female') Nữ @break
                    @default —
                @endswitch
            </div>
            <div class="patient-info-item">
                <strong>📞 Số điện thoại:</strong> {{ $patient->phone ?? '—' }}
            </div>
            <div class="patient-info-item md:col-span-1">
                <strong>🏠 Quê quán:</strong> {{ $patient->address ?? '—' }}
            </div>
        </div>
        
        <h3 class="tat-subheader">📝 Thông tin chuyên môn</h3>

        <form action="{{ route('doctor.medicalRecords.update', $record->id) }}" method="POST">
            @csrf
            {{-- Giả định bạn đang sử dụng PUT/PATCH cho update --}}
            @method('PUT') 

            {{-- 1. Triệu chứng/Lý do khám --}}
            <div class="mb-5">
                <label for="chief_complaint" class="form-label">1. Lý do khám chính/Tóm tắt triệu chứng</label>
                {{-- Đã đổi tên trường từ `symptoms` sang `chief_complaint` để chuyên môn hơn --}}
                <textarea name="chief_complaint" id="chief_complaint" class="form-control" rows="3" placeholder="Ví dụ: Bệnh nhân đau đầu dữ dội 3 ngày, sốt nhẹ, không nôn.">{{ old('chief_complaint', $record->chief_complaint ?? $record->symptoms) }}</textarea>
                @error('chief_complaint')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- 2. Chuẩn đoán --}}
            <div class="mb-5">
                <label for="diagnosis" class="form-label">2. Chẩn đoán chính (Tên bệnh hoặc Mã ICD nếu có)</label>
                <textarea name="diagnosis" id="diagnosis" class="form-control" rows="2" required placeholder="Ví dụ: Cúm mùa (J11), Viêm họng cấp.">{{ old('diagnosis', $record->diagnosis) }}</textarea>
                @error('diagnosis')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- 3. Đơn thuốc & Kế hoạch điều trị (Có thể tách thành section riêng) --}}
            <h3 class="tat-subheader mt-8">💊 Đơn thuốc & Điều trị</h3>
            <div class="mb-5">
                <label for="prescription" class="form-label">3. Đơn thuốc (Danh sách thuốc, liều lượng)</label>
                <textarea name="prescription" id="prescription" class="form-control" rows="3" placeholder="Ví dụ: Paracetamol 500mg (1 viên x 2 lần/ngày, sau ăn).">{{ old('prescription', $record->prescription) }}</textarea>
                @error('prescription')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-5">
                <label for="treatment_plan" class="form-label">4. Kế hoạch điều trị & Hướng dẫn</label>
                <textarea name="treatment_plan" id="treatment_plan" class="form-control" rows="3" placeholder="Ví dụ: Nghỉ ngơi tại nhà, tái khám sau 3 ngày nếu không giảm.">{{ old('treatment_plan', $record->treatment_plan) }}</textarea>
                @error('treatment_plan')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- 4. Kết quả xét nghiệm và Ghi chú --}}
            <h3 class="tat-subheader mt-8">🔬 Kết quả & Ghi chú</h3>
            <div class="mb-5">
                <label for="test_results" class="form-label">5. Kết quả xét nghiệm / Chẩn đoán hình ảnh (Nếu có)</label>
                <textarea name="test_results" id="test_results" class="form-control" rows="3" placeholder="Ví dụ: Kết quả X-quang phổi: không có bất thường cấp tính.">{{ old('test_results', $record->test_results) }}</textarea>
                @error('test_results')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-5">
                <label for="notes" class="form-label">6. Ghi chú thêm / Dặn dò đặc biệt</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Ghi chú về tiền sử bệnh, dị ứng, hoặc bất kỳ thông tin liên quan.">{{ old('notes', $record->notes) }}</textarea>
                @error('notes')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            {{-- Nút Submit --}}
            <button type="submit" class="tat-submit-button">
                💾 Cập nhật & Hoàn tất Hồ Sơ Khám Bệnh
            </button>
        </form>
    </div>
</div>
@endsection