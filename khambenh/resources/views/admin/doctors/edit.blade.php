@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST V2 */
    /* ------------------------------------------- */
    :root {
        --admin-primary: #dc2626; /* Red 600 */
        --admin-accent: #2563eb; /* Blue 600 */
        --shadow-subtle: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .admin-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1f2937;
        padding-bottom: 10px;
        margin-bottom: 30px;
        border-bottom: 3px solid var(--admin-accent);
    }

    .form-container {
        max-width: 48rem; /* max-w-2xl (Form hẹp hơn) */
        margin: 0 auto;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: var(--shadow-subtle);
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.35rem;
        font-weight: 600;
        color: #374151; /* gray-700 */
        font-size: 0.95rem;
    }

    .form-input, .form-select, .form-textarea {
        border: 1px solid #e5e7eb; /* gray-200, mỏng và nhẹ hơn */
        padding: 10px 14px;
        width: 100%;
        border-radius: 8px; /* Góc bo tròn hơn */
        transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        background-color: #f9fafb; /* gray-50 cho input nền nhẹ */
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: var(--admin-accent);
        outline: none;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        background-color: white; /* Nền trắng khi focus */
    }
    
    /* Input bị khóa (Readonly) */
    .form-input:read-only {
        background-color: #f3f4f6; /* gray-100 */
        color: #6b7280; /* gray-500 */
        cursor: not-allowed;
        border: 1px dashed #d1d5db; /* Đường viền nét đứt nhẹ */
        box-shadow: none;
    }
    .form-input:read-only:focus {
        box-shadow: none;
        border: 1px dashed #d1d5db;
    }

    .btn-submit {
        background-color: var(--admin-primary);
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 700;
        letter-spacing: 0.05em;
        transition: background-color 0.2s, transform 0.1s;
        box-shadow: 0 5px 15px rgba(220, 38, 38, 0.35);
    }
    .btn-submit:hover {
        background-color: #b91c1c;
        transform: translateY(-1px);
    }

    .back-link {
        color: var(--admin-accent);
        transition: color 0.2s;
        font-weight: 500;
    }
    .back-link:hover {
        color: #1d4ed8;
    }
</style>

<h2 class="admin-title">
    <i class="fas fa-edit mr-2 text-admin-accent"></i> Chỉnh Sửa Thông Tin Bác Sĩ: <span class="text-admin-primary">{{ $doctor->user->name }}</span>
</h2>

<form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" class="form-container bg-white">
    @csrf
    @method('PUT')

    {{-- Phần 1: Thông tin Tài khoản (2 cột) --}}
    <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">1. Tài khoản & Cơ bản</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="form-group">
            <label for="name" class="form-label">Tên:</label>
            <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $doctor->user->name) }}">
            @error('name') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-input" value="{{ old('email', $doctor->user->email) }}">
            @error('email') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
        </div>
    </div>
    
    {{-- Phần 2: Thông tin Chuyên môn & Làm việc (2 cột) --}}
    <h3 class="text-xl font-bold mt-6 mb-4 text-gray-800 border-b pb-2">2. Chuyên môn & Công việc</h3>
    
    {{-- Hàng 1: Bằng cấp, Chức danh, Chuyên môn --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Bằng cấp --}}
        <div class="form-group">
            <label for="degree" class="form-label">Bằng cấp:</label>
            <input type="text" name="degree" id="degree" class="form-input" value="{{ old('degree', $doctor->degree) }}">
            @error('degree') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- Chức danh --}}
        <div class="form-group">
            <label for="title" class="form-label">Chức danh:</label>
            <input type="text" name="title" id="title" class="form-input" value="{{ old('title', $doctor->title) }}">
            @error('title') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- Chuyên môn (KHÔNG ĐƯỢC SỬA) --}}
        <div class="form-group">
            <label for="specialization" class="form-label flex justify-between items-center">
                <span>Chuyên môn:</span> 
                <span class="text-xs text-admin-primary font-normal"><i class="fas fa-lock mr-1"></i> Không được sửa</span>
            </label>
            <input type="text" name="specialization" id="specialization" class="form-input" value="{{ old('specialization', $doctor->specialization) }}" readonly>
            @error('specialization') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
        </div>
    </div>
    
    {{-- Hàng 2: Kinh nghiệm, Phòng, Lịch làm việc --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="form-group">
            <label for="experience" class="form-label">Kinh nghiệm (năm):</label>
            <input type="number" name="experience" id="experience" class="form-input" value="{{ old('experience', $doctor->experience) }}">
            @error('experience') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
        </div>
        
        {{-- Phòng (KHÔNG ĐƯỢC SỬA) --}}
        <div class="form-group">
            <label for="room" class="form-label flex justify-between items-center">
                <span>Phòng:</span>
                <span class="text-xs text-admin-primary font-normal"><i class="fas fa-lock mr-1"></i> Không được sửa</span>
            </label>
            <input type="text" name="room" id="room" class="form-input" value="{{ old('room', $doctor->room) }}" readonly>
            @error('room') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- Lịch làm việc (KHÔNG ĐƯỢC SỬA) --}}
        <div class="form-group">
            <label for="working_hours" class="form-label flex justify-between items-center">
                <span>Lịch làm việc:</span>
                <span class="text-xs text-admin-primary font-normal"><i class="fas fa-lock mr-1"></i> Không được sửa</span>
            </label>
            <input type="text" name="working_hours" id="working_hours" class="form-input" value="{{ old('working_hours', $doctor->working_hours) }}" readonly>
            @error('working_hours') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Phần 3: Thông tin Cá nhân (2 cột) --}}
    <h3 class="text-xl font-bold mt-6 mb-4 text-gray-800 border-b pb-2">3. Thông tin Cá nhân</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="grid grid-cols-2 gap-6">
            {{-- Giới tính --}}
            <div class="form-group">
                <label for="gender" class="form-label">Giới tính:</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="">-- Chọn --</option>
                    <option value="Nam" {{ old('gender', $doctor->gender) == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ old('gender', $doctor->gender) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    <option value="Khác" {{ old('gender', $doctor->gender) == 'Khác' ? 'selected' : '' }}>Khác</option>
                </select>
                @error('gender') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            
            {{-- Ngày sinh --}}
            <div class="form-group">
                <label for="date_of_birth" class="form-label">Ngày sinh:</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-input" value="{{ old('date_of_birth', $doctor->date_of_birth) }}">
                @error('date_of_birth') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
        </div>
        
        {{-- SĐT --}}
        <div class="form-group">
            <label for="phone" class="form-label">Số điện thoại:</label>
            <input type="text" name="phone" id="phone" class="form-input" value="{{ old('phone', $doctor->phone) }}">
            @error('phone') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

    </div>
    
    {{-- Địa chỉ (Toàn bộ chiều rộng) --}}
    <div class="form-group mt-3">
        <label for="address" class="form-label">Địa chỉ:</label>
        <textarea name="address" id="address" class="form-textarea h-24">{{ old('address', $doctor->address) }}</textarea>
        @error('address') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
    </div>

    {{-- Nút hành động --}}
    <div class="mt-8 flex justify-end items-center border-t pt-6">
        <a href="{{ route('admin.doctors.index') }}" class="back-link flex items-center space-x-2 mr-6">
            <i class="fas fa-arrow-left"></i> 
            <span>Quay lại danh sách</span>
        </a>
        <button type="submit" class="btn-submit flex items-center space-x-2">
            <i class="fas fa-save"></i>
            <span>Cập nhật Thông tin</span>
        </button>
    </div>
</form>
@endsection