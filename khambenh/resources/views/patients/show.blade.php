@extends('layouts.patient')

@section('content')
<style>
/* TÁI SỬ DỤNG CSS TỪ GIAO DIỆN ĐẶT LỊCH (Đồng bộ ảnh nền và card) */

html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    width: 100%;
}

/* CONTAINER VÀ ẢNH NỀN (Giữ nguyên style full-width và dịch chuyển) */
.tat-form-container-bg {
    position: relative;
    width: 100vw;            
    left: 50%;              
    right: 50%;
    margin-left: -50vw;     
    min-height: 100vh;
    overflow: hidden; 
    
    padding-top: 50px; /* Đảm bảo nội dung form có khoảng cách với đỉnh */
    padding-bottom: 50px; 
    box-sizing: border-box; 
    
    display: flex; 
    justify-content: center; /* Căn giữa nội dung theo chiều ngang */
    align-items: flex-start; /* Nội dung bắt đầu từ trên */
}

.tat-form-container-bg img.full-width-image {
    width: 100%;             
    height: 100%;
    display: block;
    object-fit: cover;      
    position: absolute;
    top: -100px; /* Dịch ảnh nền lên trên */
    left: 0;
    z-index: -1;
}

/* KHỐI CARD CHÍNH (Đồng bộ với khối form đặt lịch) */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); /* Trắng hơi trong suốt */
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 900px; /* Giới hạn chiều rộng cho card hồ sơ */
    width: 90%; /* Chiếm 90% chiều rộng container */
    margin: 0 auto;
    overflow: hidden;
    position: relative;
    z-index: 1;
}

/* STYLE CÁC THÀNH PHẦN NỘI DUNG */

/* Thanh Tiêu đề chính */
.tat-form-header-bar {
    background-color: #004d99; /* Màu xanh đậm đồng bộ */
    color: white;
    text-align: center;
    padding: 15px 20px;
    margin-bottom: 20px;
    font-size: 1.5rem;
    font-weight: 700;
}

/* Dữ liệu Hồ sơ chi tiết */
.profile-detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    background-color: #f0f7ff; /* Màu xanh nhạt đồng bộ */
    border-radius: 6px;
    border-left: 4px solid #004d99; /* Dải màu xanh đậm */
}

.profile-detail-item strong {
    color: #004d99;
    font-weight: 600;
}

.profile-detail-item span {
    color: #333;
    font-weight: 700;
}

/* Nút Chỉnh Sửa (Màu cam/vàng đồng bộ) */
.btn-tat-edit {
    background-color: #ff9900 !important;
    color: white !important;
    font-weight: 700;
    border-radius: 6px;
    border: none;
    padding: 12px 20px;
    text-transform: uppercase;
    width: 100%;
    margin-top: 20px;
    box-shadow: 0 4px 10px rgba(255, 153, 0, 0.4);
    transition: background-color 0.2s;
}
.btn-tat-edit:hover {
    background-color: #e68a00 !important;
}

/* Thông báo thành công */
.alert-success-tat {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: .25rem;
}
</style>

<div class="tat-form-container-bg">
    <img src="{{ asset('images/nen1.jpg') }}" alt="Nền" class="full-width-image">

    <div class="tat-form-card">
        
        {{-- Tiêu đề Card --}}
        <div class="tat-form-header-bar">
            HỒ SƠ CÁ NHÂN
        </div>

        <div class="p-8">
            @if(session('success'))
                <div class="alert-success-tat">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                
                {{-- Ảnh đại diện và Tên (Tương tự cột trái) --}}
                <div class="flex items-center space-x-4 pb-4 border-b border-gray-200 mb-6">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                    </div>
                </div>

                {{-- Thông tin chi tiết (Tương tự cột phải) --}}
                <div class="space-y-3">
                    <div class="profile-detail-item">
                        <strong>Số điện thoại:</strong>
                        <span>{{ $patient->phone }}</span>
                    </div>
                    
                    <div class="profile-detail-item">
                        <strong>Địa chỉ:</strong>
                        <span>{{ $patient->address }}</span>
                    </div>

                    <div class="profile-detail-item">
                        <strong>Ngày sinh:</strong>
                        <span>{{ $patient->date_of_birth }}</span>
                    </div>

                    <div class="profile-detail-item">
                        <strong>Giới tính:</strong>
                        <span>
                            {{ $patient->gender == 'male' ? 'Nam' : ($patient->gender == 'female' ? 'Nữ' : 'Khác') }}
                        </span>
                    </div>
                </div>

                {{-- Nút Chỉnh sửa --}}
                <a href="{{ route('patients.edit', $patient->id) }}" class="btn-tat-edit">
                    Chỉnh sửa hồ sơ
                </a>
            </div>
        </div>
    </div>
</div>
@endsection