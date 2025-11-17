@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST (Đồng bộ với Admin layout) */
    /* ------------------------------------------- */
    :root {
        --admin-primary: #dc2626; /* Red 600 */
        --admin-accent: #2563eb; /* Blue 600 */
    }

    /* Khối card chính */
    .create-card-lux {
        background-color: #ffffff;
        border-radius: 16px; 
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05); /* Shadow tinh tế */
        padding: 30px;
        border: 1px solid #fee2e2; /* Red 100 - Viền nhẹ */
        max-width: 600px; /* Giới hạn chiều rộng cho form */
        margin: 0px auto;
    }
    
    /* Tiêu đề trang */
    .admin-title-create {
        font-size: 2rem; /* text-3xl */
        font-weight: 800;
        color: var(--admin-primary);
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 3px solid var(--admin-accent);
    }
    
    /* Label */
    .form-label-lux {
        font-weight: 700;
        color: #1f2937; /* gray-800 */
        margin-bottom: 5px;
        display: block;
        font-size: 0.9rem;
    }

    /* Input field */
    .form-input-lux, .form-select-lux {
        border: 1px solid #d1d5db; /* gray-300 */
        border-radius: 8px;
        padding: 10px 14px;
        width: 100%;
        transition: all 0.2s ease;
        background-color: #f9fafb; /* gray-50 */
    }
    .form-input-lux:focus, .form-select-lux:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15); 
        background-color: white;
        outline: none;
    }

    /* Nút Submit */
    .submit-btn-lux {
        background-color: var(--admin-primary); /* Dùng màu Red làm nút tạo mới */
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        transition: background-color 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
    }
    .submit-btn-lux:hover {
        background-color: #b91c1c; /* Red 700 */
        box-shadow: 0 6px 15px rgba(220, 38, 38, 0.4);
    }

    /* Lỗi validation */
    .error-message {
        font-size: 0.8rem;
        color: #ef4444; /* Red 500 */
        margin-top: 5px;
        font-weight: 500;
    }
</style>

<h2 class="admin-title-create">
    <i class="fas fa-user-plus mr-2"></i> Thêm Người Dùng Mới
</h2>

<div class="create-card-lux">
    <p class="text-sm text-gray-600 mb-6">
        Tạo tài khoản mới cho bệnh nhân, bác sĩ, nhân viên hoặc quản trị viên.
    </p>
    
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
        @csrf
        
        {{-- TÊN --}}
        <div>
            <label class="form-label-lux">Tên:</label>
            <input type="text" name="name" class="form-input-lux" value="{{ old('name') }}" placeholder="Nhập tên người dùng">
            @error('name') <p class="error-message">{{ $message }}</p> @enderror
        </div>
        
        {{-- EMAIL --}}
        <div>
            <label class="form-label-lux">Email:</label>
            <input type="email" name="email" class="form-input-lux" value="{{ old('email') }}" placeholder="Nhập địa chỉ email">
            @error('email') <p class="error-message">{{ $message }}</p> @enderror
        </div>
        
        {{-- ROLE --}}
        <div>
            <label class="form-label-lux">Role:</label>
            <select name="role" class="form-select-lux">
                <option value="patient" {{ old('role') === 'patient' ? 'selected' : '' }}>Patient (Bệnh nhân)</option>
                <option value="doctor" {{ old('role') === 'doctor' ? 'selected' : '' }}>Doctor (Bác sĩ)</option>
                <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff (Nhân viên)</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (Quản trị viên)</option>
            </select>
            @error('role') <p class="error-message">{{ $message }}</p> @enderror
        </div>
        
        <hr class="border-t border-gray-200">
        
        {{-- MẬT KHẨU --}}
        <div>
            <label class="form-label-lux">Mật khẩu:</label>
            <input type="password" name="password" class="form-input-lux" placeholder="••••••••">
            @error('password') <p class="error-message">{{ $message }}</p> @enderror
        </div>
        
        {{-- NHẬP LẠI MẬT KHẨU --}}
        <div>
            <label class="form-label-lux">Nhập lại mật khẩu:</label>
            <input type="password" name="password_confirmation" class="form-input-lux" placeholder="••••••••">
        </div>
        
        {{-- NÚT TẠO USER --}}
        <div class="pt-4 flex justify-end">
            <button type="submit" class="submit-btn-lux flex items-center space-x-2">
                <i class="fas fa-user-plus"></i>
                <span>Tạo User</span>
            </button>
        </div>
    </form>
</div>

@endsection