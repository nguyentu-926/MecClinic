@extends('layouts.doctor')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST (Tái sử dụng từ trang edit) */
    /* ------------------------------------------- */
    :root {
        --primary-deep: #1e3a8a; /* Blue 800 - Navy/Deep Blue */
        --accent-teal: #0d9488; /* Teal 600 - Màu nhấn */
        --border-light: #e0e7ff; /* Blue 100 - Viền nhẹ */
        --bg-field: #f9faff; /* Rất nhạt, gần trắng */
    }

    /* Khối card chính */
    .profile-card-lux {
        background-color: #ffffff;
        border-radius: 16px; 
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Shadow tinh tế */
        padding: 40px 50px;
        border: 1px solid var(--border-light);
        max-width: 900px;
        margin: 0px auto;
    }

    /* Tiêu đề chính */
    .profile-title-lux {
        font-size: 2.25rem; /* text-4xl */
        font-weight: 900;
        color: var(--primary-deep);
        margin-bottom: 5px;
        letter-spacing: 1px;
    }
    .profile-subtitle-lux {
        color: #6b7280; /* gray-500 */
        font-size: 1rem;
        font-weight: 500;
        padding-bottom: 20px;
        border-bottom: 3px solid var(--accent-teal);
        display: block;
        margin-bottom: 30px;
    }
    
    /* Ảnh đại diện */
    .avatar-img-lux {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid var(--border-light);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Khu vực hiển thị thông tin */
    .info-label-lux {
        font-weight: 700;
        color: #1f2937; /* gray-800 */
        font-size: 0.95rem;
        margin-bottom: 4px;
        display: block;
    }
    .info-value-lux {
        background-color: var(--bg-field); 
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 12px 16px;
        color: #1f2937;
        font-weight: 600;
        min-height: 44px; /* Đảm bảo chiều cao đồng nhất với input */
        display: flex;
        align-items: center;
    }
    .info-value-notes-lux {
        min-height: 120px;
        white-space: pre-wrap; /* Giữ định dạng xuống dòng trong textarea */
    }
    
    /* Phân tách nhóm */
    .section-divider-lux {
        margin-top: 25px;
        margin-bottom: 25px;
        border-top: 1px dashed #d1d5db;
    }

    /* Nút Chỉnh sửa */
    .tat-edit-btn-lux {
        background-color: var(--accent-teal);
        color: white;
        padding: 14px 30px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        transition: background-color 0.2s, transform 0.2s;
        box-shadow: 0 8px 20px rgba(13, 148, 136, 0.3);
    }
    .tat-edit-btn-lux:hover {
        background-color: #0f766e; /* Teal 700 */
        transform: translateY(-1px);
        box-shadow: 0 10px 25px rgba(13, 148, 136, 0.4);
    }
</style>

{{-- Logic xử lý dữ liệu để hiển thị --}}
@php
    $photoUrl = $doctor->photo 
                ? asset('storage/'.$doctor->photo) 
                : asset('images/default-avatar.png');

    $displayGender = match (strtolower($doctor->gender ?? '')) {
        'male' => 'Nam',
        'female' => 'Nữ',
        default => 'Chưa cập nhật',
    };
    $displayDob = $doctor->date_of_birth ? date('d/m/Y', strtotime($doctor->date_of_birth)) : 'Chưa cập nhật';
@endphp

<div class="profile-card-lux">

    <h1 class="profile-title-lux">
        🩺 Hồ Sơ Cá Nhân Bác Sĩ
    </h1>
    <span class="profile-subtitle-lux">
        Thông tin chi tiết và chuyên môn làm việc.
    </span>

    {{-- THÔNG TIN TÓM TẮT (ẢNH & TÊN) --}}
    <div class="flex items-center mb-8 pb-4 border-b border-gray-100">
        <div class="mr-6">
            @if($doctor->photo)
                 <img src="{{ $photoUrl }}" alt="Ảnh đại diện Bác sĩ" class="avatar-img-lux">
            @else
                 <div class="avatar-img-lux bg-gray-200 flex items-center justify-center text-gray-500 text-3xl">
                    <i class="fas fa-user-md"></i>
                 </div>
            @endif
        </div>
        <div>
            <p class="text-3xl font-extrabold text-primary-deep">{{ $doctor->user->name ?? 'Không xác định' }}</p>
            <p class="text-md text-gray-500 mt-1 font-semibold">{{ $doctor->degree ?? '' }} {{ $doctor->title ?? 'Bác sĩ' }}</p>
            <p class="text-lg font-bold text-accent-teal">{{ $doctor->specialization ?? 'Chuyên môn chưa có' }}</p>
        </div>
    </div>

    {{-- PHẦN 1: THÔNG TIN CHUYÊN MÔN --}}
    <h2 class="text-xl font-bold text-gray-800 border-l-4 border-accent-teal pl-3 pt-4 mb-4">Thông Tin Học Thuật & Chuyên Môn</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Học vị (Degree) --}}
        <div>
            <label class="info-label-lux">Học vị (Degree)</label>
            <div class="info-value-lux">{{ $doctor->degree ?? 'N/A' }}</div>
        </div>
        
        {{-- Học hàm/Chức danh (Title) --}}
        <div>
            <label class="info-label-lux">Học hàm / Chức danh (Title)</label>
            <div class="info-value-lux">{{ $doctor->title ?? 'N/A' }}</div>
        </div>

        {{-- Kinh nghiệm --}}
        <div>
            <label class="info-label-lux">Kinh nghiệm (Năm)</label>
            <div class="info-value-lux">{{ $doctor->experience ?? '0' }} năm</div>
        </div>
        
        {{-- Ngày sinh --}}
        <div>
            <label class="info-label-lux">Ngày sinh</label>
            <div class="info-value-lux">{{ $displayDob }}</div>
        </div>

        {{-- Giới tính --}}
        <div>
            <label class="info-label-lux">Giới tính</label>
            <div class="info-value-lux">{{ $displayGender }}</div>
        </div>

        {{-- Số điện thoại --}}
        <div>
            <label class="info-label-lux">Số điện thoại</label>
            <div class="info-value-lux">{{ $doctor->phone ?? 'Chưa cập nhật' }}</div>
        </div>
    </div>
    
    <hr class="section-divider-lux">

    {{-- PHẦN 2: THÔNG TIN LÀM VIỆC & LIÊN HỆ --}}
    <h2 class="text-xl font-bold text-gray-800 border-l-4 border-accent-teal pl-3 pt-4 mb-4">Địa Chỉ & Lịch Làm Việc</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Giờ làm việc --}}
        <div>
            <label class="info-label-lux">Giờ làm việc</label>
            <div class="info-value-lux bg-blue-50 border-blue-200 font-bold text-blue-800">{{ $doctor->working_hours ?? 'Chưa cập nhật' }}</div>
        </div>
        
        {{-- Phòng --}}
        <div>
            <label class="info-label-lux">Phòng làm việc</label>
            <div class="info-value-lux bg-blue-50 border-blue-200 font-bold text-blue-800">{{ $doctor->room ?? 'Chưa cập nhật' }}</div>
        </div>
        
        {{-- Địa chỉ --}}
        <div class="md:col-span-2">
            <label class="info-label-lux">Địa chỉ làm việc</label>
            <div class="info-value-lux">{{ $doctor->address ?? 'Chưa cập nhật' }}</div>
        </div>
        
        {{-- Quê quán --}}
        <div>
            <label class="info-label-lux">Quê quán</label>
            <div class="info-value-lux">{{ $doctor->hometown ?? 'Chưa cập nhật' }}</div>
        </div>

    </div>

    <hr class="section-divider-lux">

    {{-- PHẦN 3: GHI CHÚ & GIỚI THIỆU --}}
    <h2 class="text-xl font-bold text-gray-800 border-l-4 border-accent-teal pl-3 pt-4 mb-4">Ghi Chú & Giới Thiệu Bản Thân</h2>
    <div class="mb-6">
        <div class="info-value-lux info-value-notes-lux">
            {{ $doctor->notes ?? 'Bác sĩ chưa thêm ghi chú hoặc giới thiệu bản thân.' }}
        </div>
    </div>

    {{-- Nút Chỉnh sửa --}}
    <div class="pt-6 flex justify-center md:justify-end">
        <a href="{{ route('doctor.profile.edit', Auth::id()) }}" class="tat-edit-btn-lux">
            <i class="fas fa-edit mr-2"></i> CHỈNH SỬA HỒ SƠ
        </a>
    </div>
</div>
@endsection