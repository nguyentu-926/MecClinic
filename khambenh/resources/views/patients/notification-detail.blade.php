@extends('layouts.patient')

@section('content')
<style>
/* TÁI SỬ DỤNG CSS TỪ GIAO DIỆN HỒ SƠ CÁ NHÂN */

html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    width: 100%;
}

/* CONTAINER VÀ ẢNH NỀN */
.tat-form-container-bg {
    position: relative;
    width: 100vw; 
    left: 50%; 
    right: 50%;
    margin-left: -50vw; 
    min-height: 100vh;
    overflow: hidden; 
    
    padding-top: 50px; 
    padding-bottom: 50px; 
    box-sizing: border-box; 
    
    display: flex; 
    justify-content: center; 
    align-items: flex-start; 
}

.tat-form-container-bg img.full-width-image {
    width: 100%; 
    height: 100%;
    display: block;
    object-fit: cover; 
    position: absolute;
    top: -100px; 
    left: 0;
    z-index: -1;
}

/* KHỐI CARD CHÍNH */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); 
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 700px; /* Chiều rộng tối ưu cho chi tiết */
    width: 90%; 
    margin: 0 auto;
    overflow: hidden;
    position: relative;
    z-index: 1;
}

/* Thanh Tiêu đề chính */
.tat-form-header-bar {
    background-color: #004d99; 
    color: white;
    text-align: center;
    padding: 15px 20px;
    font-size: 1.5rem;
    font-weight: 700;
}

/* Dữ liệu Chi tiết (Sử dụng cho các trường thông tin) */
.profile-detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    background-color: #f0f7ff; /* Màu xanh nhạt đồng bộ */
    border-radius: 6px;
    border-left: 4px solid #004d99; /* Dải màu xanh đậm */
    margin-bottom: 10px;
}

.profile-detail-item strong {
    color: #004d99;
    font-weight: 600;
    flex-shrink: 0;
    margin-right: 20px;
}

.profile-detail-item span {
    color: #333;
    font-weight: 700;
    text-align: right;
    word-break: break-word; /* Đảm bảo nội dung dài không làm tràn */
}

/* Nút Thứ cấp (Quay lại) */
.btn-tat-secondary {
    background-color: #e0f2ff !important; /* Xanh nhạt */
    color: #004d99 !important; /* Xanh đậm */
    font-weight: 600;
    border-radius: 6px;
    border: none;
    padding: 12px 25px;
    transition: background-color 0.2s;
    font-size: 1rem;
    text-transform: uppercase;
    box-shadow: 0 4px 8px rgba(0, 77, 153, 0.1);
}
.btn-tat-secondary:hover {
    background-color: #cceeff !important;
}
</style>

<div class="tat-form-container-bg">
    <img src="{{ asset('images/nen1.jpg') }}" alt="Nền" class="full-width-image">

    <div class="tat-form-card">
        
        {{-- Tiêu đề Card đồng bộ --}}
        <div class="tat-form-header-bar">
            CHI TIẾT THÔNG BÁO
        </div>

        <div class="p-8">
            <div class="space-y-4">
                
                {{-- Thông tin chi tiết --}}
                <div class="profile-detail-item">
                    <strong>Bác sĩ:</strong>
                    <span>{{ $notification->data['doctor_name'] ?? 'Không rõ' }}</span>
                </div>
                
                <div class="profile-detail-item">
                    <strong>Ngày khám:</strong>
                    <span>
                        {{ isset($notification->data['appointment_date']) ? \Carbon\Carbon::parse($notification->data['appointment_date'])->format('d/m/Y') : '---' }}
                    </span>
                </div>

                <div class="profile-detail-item">
                    <strong>Giờ khám:</strong>
                    <span>{{ $notification->data['appointment_time'] ?? '---' }}</span>
                </div>
                
                {{-- Nội dung (Dùng khối riêng cho nội dung dài) --}}
                <div class="pt-4">
                    <h4 class="text-lg font-bold text-blue-700 mb-2 border-b border-gray-200 pb-2">NỘI DUNG THÔNG BÁO:</h4>
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 shadow-inner">
                        {{ $notification->data['message'] ?? 'Không có nội dung' }}
                    </div>
                </div>

                {{-- Nút Quay lại --}}
                <div class="pt-4 text-center">
                    <a href="{{ route('patients.notifications') }}" class="btn-tat-secondary">
                        ← Quay lại danh sách
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection