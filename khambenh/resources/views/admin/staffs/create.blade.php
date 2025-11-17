@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST (Form Create) */
    /* ------------------------------------------- */
    :root {
        --admin-primary: #10b981; /* Màu Emerald 600 - Màu nhấn chính */
        --admin-accent: #2563eb; /* Blue 600 */
        --text-color: #1f2937; /* gray-800 */
        --border-color: #e5e7eb; /* Gray 200 */
        --bg-field: #f9fafb; /* Nền field rất nhẹ */
        --error-red: #dc2626; /* Red 600 */
    }

    /* Tiêu đề trang */
    .admin-title-form {
        font-size: 2rem; 
        font-weight: 800; 
        color: var(--text-color); 
        margin-bottom: 25px;
        border-left: 5px solid var(--admin-primary); 
        padding-left: 10px;
    }

    /* Input và Select */
    .admin-input {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 15px;
        width: 100%;
        transition: all 0.2s ease;
        background-color: var(--bg-field); 
        color: var(--text-color);
        font-weight: 500;
    }
    .admin-input:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); 
        background-color: white;
        outline: none;
    }
    .admin-input.error {
        border-color: var(--error-red);
    }

    /* Label */
    .admin-label {
        font-weight: 600;
        color: #374151; /* Gray 700 */
        margin-bottom: 5px;
        display: block;
        font-size: 0.95rem;
    }

    /* Nút Lưu */
    .admin-btn-save {
        background-color: var(--admin-primary); 
        color: white;
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        transition: background-color 0.2s, transform 0.2s;
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }
    .admin-btn-save:hover {
        background-color: #059669; 
        transform: translateY(-1px);
    }
    
    .text-error {
        color: var(--error-red);
        font-size: 0.875rem; /* text-sm */
        margin-top: 4px;
        font-weight: 500;
    }
</style>

<div class="max-w-3xl mx-auto py-8 px-4 bg-white shadow-lg rounded-xl mt-8 border border-gray-100">
    
    <h2 class="admin-title-form">
        <i class="fas fa-user-plus mr-2 text-admin-primary"></i> Thêm Nhân viên mới
    </h2>
    
    <hr class="mb-6 border-gray-100">

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-700 border border-red-200 font-semibold">
            <i class="fas fa-exclamation-triangle mr-2"></i> Vui lòng kiểm tra lại các trường thông tin bị lỗi.
        </div>
    @endif

    {{-- Form sử dụng route admin.staffs.store --}}
    <form action="{{ route('admin.staffs.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Tên --}}
            <div>
                <label for="name" class="admin-label">Tên nhân viên:</label>
                <input type="text" name="name" id="name" 
                       class="admin-input @error('name') error @enderror" 
                       value="{{ old('name') }}" placeholder="Ví dụ: Nguyễn Văn A" required>
                @error('name')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Email --}}
            <div>
                <label for="email" class="admin-label">Email (Tài khoản đăng nhập):</label>
                <input type="email" name="email" id="email" 
                       class="admin-input @error('email') error @enderror" 
                       value="{{ old('email') }}" placeholder="user@clinic.com" required>
                @error('email')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Mật khẩu --}}
            <div>
                <label for="password" class="admin-label">Mật khẩu:</label>
                <input type="password" name="password" id="password" 
                       class="admin-input @error('password') error @enderror" 
                       required>
                @error('password')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Xác nhận Mật khẩu --}}
            <div>
                <label for="password_confirmation" class="admin-label">Xác nhận Mật khẩu:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="admin-input" 
                       required>
            </div>
            
            {{-- Số điện thoại --}}
            <div>
                <label for="phone" class="admin-label">Số điện thoại:</label>
                <input type="text" name="phone" id="phone" 
                       class="admin-input @error('phone') error @enderror" 
                       value="{{ old('phone') }}" placeholder="09xxxxxxxx">
                @error('phone')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Vị trí trống (Dùng để căn chỉnh lưới) --}}
            {{-- Trường này đã bị xóa --}}
        </div>
        
        {{-- Địa chỉ đã bị xóa --}}
        
        {{-- Nút Lưu --}}
        <div class="pt-4 flex justify-end">
            <button type="submit" 
                    class="admin-btn-save inline-flex items-center">
                <i class="fas fa-save mr-2"></i> LƯU NHÂN VIÊN
            </button>
        </div>
    </form>

</div>
@endsection