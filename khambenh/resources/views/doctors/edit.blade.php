@extends('layouts.doctor')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST */
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
    
    /* Input field */
    .tat-input-lux {
        border: 1px solid #d1d5db; /* gray-300 */
        border-radius: 8px;
        padding: 12px 16px;
        width: 100%;
        transition: all 0.2s ease;
        background-color: var(--bg-field); 
    }
    .tat-input-lux:focus {
        border-color: var(--primary-deep);
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1); 
        background-color: white;
        outline: none;
    }
    /* Style cho trường bị khóa (disabled) */
    .tat-input-lux:disabled {
        background-color: #eef2ff; /* Blue 50 */
        color: #4b5563; /* gray-600 */
        cursor: not-allowed;
        font-weight: 600;
        border-color: #c7d2fe;
    }

    .tat-textarea-lux {
        min-height: 120px;
        resize: vertical;
    }

    /* Label */
    .tat-label-lux {
        font-weight: 700;
        color: #1f2937; /* gray-800 */
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
    }

    /* Nút Submit */
    .tat-submit-btn-lux {
        background-color: var(--primary-deep);
        color: white;
        padding: 14px 30px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        transition: background-color 0.2s, transform 0.2s;
        box-shadow: 0 8px 20px rgba(30, 58, 138, 0.3);
    }
    .tat-submit-btn-lux:hover {
        background-color: #1e40af; /* Blue 700 */
        transform: translateY(-1px);
        box-shadow: 0 10px 25px rgba(30, 58, 138, 0.4);
    }

    /* Phân tách nhóm */
    .section-divider-lux {
        margin-top: 25px;
        margin-bottom: 25px;
        border-top: 1px dashed #d1d5db;
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
    .avatar-upload-label {
        color: var(--primary-deep);
        font-weight: 600;
        cursor: pointer;
        display: block;
        margin-top: 10px;
    }
</style>

<div class="profile-card-lux">

    <h1 class="profile-title-lux">
        Hồ Sơ Cá Nhân
    </h1>
    <span class="profile-subtitle-lux">
        Cập nhật thông tin cơ bản và chuyên môn.
    </span>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-800 border border-green-200 font-semibold shadow-sm">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center mb-8 pb-4 border-b border-gray-100">
        <div class="mr-6">
            @if($doctor->photo)
                 <img src="{{ asset('storage/'.$doctor->photo) }}" alt="Ảnh đại diện Bác sĩ" class="avatar-img-lux">
            @else
                 <div class="avatar-img-lux bg-gray-200 flex items-center justify-center text-gray-500 text-xl">
                    <i class="fas fa-user-circle"></i>
                 </div>
            @endif
        </div>
        <div>
            <p class="text-2xl font-bold text-primary-deep">{{ $doctor->user->name ?? 'Không xác định' }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $doctor->title ?? 'Bác sĩ' }} | {{ $doctor->specialization ?? 'Chuyên môn chưa có' }}</p>
        </div>
    </div>

    <form action="{{ route('doctor.profile.update', $doctor->user_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        {{-- PHẦN 1: THÔNG TIN CHUYÊN MÔN (Học vị, Kinh nghiệm) --}}
        <h2 class="text-xl font-bold text-gray-800 border-l-4 border-accent-teal pl-3 pt-4">Thông Tin Học Thuật & Chuyên Môn</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- Học vị --}}
            <div>
                <label class="tat-label-lux">Học vị (Degree)</label>
                <input type="text" name="degree" value="{{ old('degree', $doctor->degree) }}" class="tat-input-lux" placeholder="Ví dụ: ThS, TS">
            </div>
            
            {{-- Học hàm/Chức danh --}}
            <div>
                <label class="tat-label-lux">Học hàm / Chức danh (Title)</label>
                <input type="text" name="title" value="{{ old('title', $doctor->title) }}" class="tat-input-lux" placeholder="Ví dụ: Bác sĩ, Chuyên khoa I">
            </div>

            {{-- Kinh nghiệm --}}
            <div>
                <label class="tat-label-lux">Kinh nghiệm (Năm)</label>
                <input type="number" name="experience" value="{{ old('experience', $doctor->experience) }}" class="tat-input-lux" min="0" placeholder="Số năm kinh nghiệm">
            </div>

             {{-- Chuyên môn (KHÔNG ĐƯỢC PHÉP SỬA) --}}
            <div class="md:col-span-3">
                <label class="tat-label-lux text-red-600">Chuyên môn (KHÔNG ĐƯỢC SỬA)</label>
                <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization) }}" class="tat-input-lux" required disabled>
                <p class="text-xs text-red-500 mt-1">Vui lòng liên hệ quản trị viên để thay đổi chuyên môn.</p>
            </div>
        </div>
        
        <hr class="section-divider-lux">

        {{-- PHẦN 2: THÔNG TIN LÀM VIỆC & LIÊN HỆ --}}
        <h2 class="text-xl font-bold text-gray-800 border-l-4 border-accent-teal pl-3 pt-4">Địa Chỉ & Lịch Làm Việc</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Giờ làm việc (KHÔNG ĐƯỢC PHÉP SỬA) --}}
            <div>
                <label class="tat-label-lux text-red-600">Giờ làm việc (KHÔNG ĐƯỢC SỬA)</label>
                <input type="text" name="working_hours" value="{{ old('working_hours', $doctor->working_hours) }}" class="tat-input-lux" disabled>
            </div>
            
            {{-- Phòng (KHÔNG ĐƯỢC PHÉP SỬA) --}}
            <div>
                <label class="tat-label-lux text-red-600">Phòng (KHÔNG ĐƯỢC SỬA)</label>
                <input type="text" name="room" value="{{ old('room', $doctor->room) }}" class="tat-input-lux" disabled>
            </div>
            
            {{-- Địa chỉ --}}
            <div class="md:col-span-2">
                <label class="tat-label-lux">Địa chỉ làm việc</label>
                <input type="text" name="address" value="{{ old('address', $doctor->address) }}" class="tat-input-lux" placeholder="Địa chỉ phòng khám/bệnh viện hiện tại">
            </div>
            
            {{-- Quê quán --}}
            <div>
                <label class="tat-label-lux">Quê quán</label>
                <input type="text" name="hometown" value="{{ old('hometown', $doctor->hometown) }}" class="tat-input-lux" placeholder="Tỉnh/Thành phố quê hương">
            </div>
        </div>

        <hr class="section-divider-lux">

        {{-- PHẦN 3: GHI CHÚ & ẢNH ĐẠI DIỆN --}}
        <h2 class="text-xl font-bold text-gray-800 border-l-4 border-accent-teal pl-3 pt-4">Ghi Chú & Tải Ảnh</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
            
            {{-- Ghi chú/Giới thiệu --}}
            <div>
                <label class="tat-label-lux">Ghi chú & Giới thiệu bản thân</label>
                <textarea name="notes" class="tat-input-lux tat-textarea-lux" placeholder="Viết vài dòng giới thiệu về bản thân hoặc lĩnh vực chuyên sâu.">{{ old('notes', $doctor->notes) }}</textarea>
            </div>
            
            {{-- Ảnh đại diện --}}
            <div class="flex flex-col">
                <label class="tat-label-lux">Tải lên Ảnh đại diện mới</label>
                <input type="file" name="photo" class="tat-input-lux bg-white border-dashed border-2 p-2">
            </div>
        </div>

        {{-- Nút Cập nhật --}}
        <div class="pt-6 flex justify-center md:justify-end">
            <button type="submit" class="tat-submit-btn-lux">
                <i class="fas fa-save mr-2"></i> LƯU & CẬP NHẬT
            </button>
        </div>
    </form>
</div>
@endsection