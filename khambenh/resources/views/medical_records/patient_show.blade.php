@extends('layouts.patient')

@section('content')
<style>
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    overflow-x: hidden;
}

.tat-form-container-bg {
    position: relative;
    width: 100vw;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    min-height: 100vh; /* chiều cao tối thiểu = màn hình */
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 50px 0;
    box-sizing: border-box;
    overflow: hidden;
}

.tat-form-container-bg img.full-width-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}

/* ======================== CARD ======================== */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); /* Trắng hơi trong suốt */
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 900px;
    width: 90%;
    display: flex;
    flex-direction: column;
    min-height: calc(100vh - 100px); /* vừa chiều cao màn hình */
    position: relative;
    z-index: 1;
    overflow: hidden;
}

/* ======================== HEADER CARD ======================== */
.tat-form-header-bar {
    background-color: #004d99; /* xanh đậm */
    color: white;
    text-align: center;
    padding: 15px 20px;
    font-size: 1.5rem;
    font-weight: 700;
}

/* ======================== NỘI DUNG ======================== */
.tat-form-card .card-content {
    padding: 20px 30px;
    overflow-y: auto; /* scroll khi nội dung dài */
    flex: 1; /* chiếm chiều cao còn lại */
}

/* ======================== BLOCK NỘI DUNG ======================== */
.profile-detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    background-color: #f0f7ff; /* xanh nhạt */
    border-radius: 6px;
    border-left: 4px solid #004d99; /* dải màu xanh đậm */
    margin-bottom: 8px;
}

.profile-detail-item strong {
    color: #004d99;
    font-weight: 600;
}

.profile-detail-item span {
    color: #333;
    font-weight: 700;
}

.content-detail-block {
    padding: 16px;
    background-color: #f9faff;
    border: 1px solid #cce0ff;
    border-radius: 8px;
    color: #333;
    margin-bottom: 15px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
    white-space: pre-line; /* giữ xuống dòng */
}

/* ======================== NÚT QUAY LẠI ======================== */
.btn-tat-edit {
    background-color: #ff9900;
    color: white;
    font-weight: 700;
    border-radius: 6px;
    border: none;
    padding: 12px 20px;
    text-transform: uppercase;
    width: 50%;
    max-width: 300px;
    margin: 0 auto;
    display: block;
    text-align: center;
    box-shadow: 0 4px 10px rgba(255, 153, 0, 0.4);
    transition: background-color 0.2s;
}

.btn-tat-edit:hover {
    background-color: #e68a00;
}

/* Responsive */
@media (max-width: 768px) {
    .tat-form-card {
        width: 95%;
    }
    .tat-form-card .card-content {
        padding: 15px 20px;
    }
}
</style>

<div class="tat-form-container-bg">
    <img src="{{ asset('images/nen1.jpg') }}" alt="Nền" class="full-width-image">

    <div class="tat-form-card">
        {{-- HEADER --}}
        <div class="tat-form-header-bar">
            KẾT QUẢ KHÁM CHI TIẾT
        </div>

        {{-- NỘI DUNG --}}
        <div class="card-content">

            {{-- Thông tin chung --}}
            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-3">Thông tin bác sĩ & cuộc khám</h3>
                <div class="profile-detail-item">
                    <strong>Bác sĩ:</strong>
                    <span>{{ $record->doctor->user->name ?? 'Không rõ' }}</span>
                </div>
                <div class="profile-detail-item">
                    <strong>Ngày khám:</strong>
                    <span>{{ date('d/m/Y', strtotime($record->appointment->appointment_date ?? $record->created_at)) }}</span>
                </div>
                <div class="profile-detail-item">
                    <strong>Giờ khám:</strong>
                    <span>{{ $record->appointment->appointment_time ?? '-' }}</span>
                </div>
                <div class="profile-detail-item">
                    <strong>Phòng khám:</strong>
                    <span>{{ $record->appointment->room ?? '-' }}</span>
                </div>
            </div>

            {{-- Nội dung khám chi tiết --}}
            <div>
                <h4 class="text-lg font-bold text-blue-700 mb-2">CHUẨN ĐOÁN</h4>
                <div class="content-detail-block">{{ $record->diagnosis ?? 'Chưa có thông tin' }}</div>

                <h4 class="text-lg font-bold text-blue-700 mb-2">KẾ HOẠCH ĐIỀU TRỊ</h4>
                <div class="content-detail-block">{{ $record->treatment_plan ?? 'Chưa có thông tin' }}</div>

                <h4 class="text-lg font-bold text-blue-700 mb-2">KẾT QUẢ XÉT NGHIỆM</h4>
                <div class="content-detail-block">{{ $record->test_results ?? 'Chưa có thông tin' }}</div>

                <h4 class="text-lg font-bold text-blue-700 mb-2">ĐƠN THUỐC</h4>
                <div class="content-detail-block">{{ $record->prescription ?? 'Không có' }}</div>

                <h4 class="text-lg font-bold text-blue-700 mb-2">GHI CHÚ THÊM</h4>
                <div class="content-detail-block">{{ $record->notes ?? 'Không có' }}</div>
            </div>

            {{-- Nút Quay lại --}}
            <div class="text-center mt-8">
                <a href="{{ route('patient.medical-records.index') }}" class="btn-tat-edit">
                    ← Quay lại danh sách hồ sơ
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
