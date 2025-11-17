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
    .edit-patient-card {
        background-color: #ffffff;
        border-radius: 16px; 
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05); /* Shadow tinh tế */
        padding: 40px;
        border: 1px solid #fee2e2; /* Red 100 - Viền nhẹ */
        max-width: 800px; 
        margin: 0px auto;
    }
    
    /* Tiêu đề trang */
    .admin-title-edit {
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
        background-color: var(--admin-accent); /* Dùng màu Blue làm nút cập nhật */
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        transition: background-color 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
    }
    .submit-btn-lux:hover {
        background-color: #1d4ed8; /* Blue 700 */
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.4);
    }

    /* Lỗi validation */
    .error-message {
        font-size: 0.8rem;
        color: #ef4444; /* Red 500 */
        margin-top: 5px;
        font-weight: 500;
    }
</style>

<h2 class="admin-title-edit">
    <i class="fas fa-edit mr-2"></i> Chỉnh Sửa Thông Tin Bệnh Nhân
</h2>

<div class="edit-patient-card">
    <p class="text-sm text-gray-600 mb-6">
        ID Bệnh Nhân: <span class="font-mono font-bold text-red-600">{{ $patient->id }}</span>
    </p>
    
    <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <h3 class="text-lg font-bold text-gray-800 border-l-4 border-admin-primary pl-3">Thông Tin Cá Nhân và Liên Hệ</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- TÊN --}}
            <div>
                <label class="form-label-lux">Tên</label>
                <input type="text" name="name" class="form-input-lux" value="{{ old('name', $patient->name) }}" placeholder="Họ và tên bệnh nhân">
                @error('name') <p class="error-message">{{ $message }}</p> @enderror
            </div>
            
            {{-- EMAIL --}}
            <div>
                <label class="form-label-lux">Email</label>
                <input type="email" name="email" class="form-input-lux" value="{{ old('email', $patient->email) }}" placeholder="Địa chỉ email">
                @error('email') <p class="error-message">{{ $message }}</p> @enderror
            </div>
            
            {{-- SỐ ĐIỆN THOẠI --}}
            <div>
                <label class="form-label-lux">Số Điện Thoại</label>
                <input type="text" name="phone" class="form-input-lux" value="{{ old('phone', $patient->phone) }}" placeholder="Số điện thoại liên hệ">
                @error('phone') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            {{-- NGÀY SINH --}}
            <div>
                <label class="form-label-lux">Ngày Sinh</label>
                <input type="date" name="dob" class="form-input-lux" value="{{ old('dob', $patient->dob) }}">
                @error('dob') <p class="error-message">{{ $message }}</p> @enderror
            </div>
            
            {{-- GIỚI TÍNH --}}
            <div>
                <label class="form-label-lux">Giới Tính</label>
                <select name="gender" class="form-select-lux">
                    <option value="male" {{ old('gender', $patient->gender) === 'male' ? 'selected' : '' }}>Nam</option>
                    <option value="female" {{ old('gender', $patient->gender) === 'female' ? 'selected' : '' }}>Nữ</option>
                    <option value="other" {{ old('gender', $patient->gender) === 'other' ? 'selected' : '' }}>Khác</option>
                </select>
                @error('gender') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            {{-- ĐỊA CHỈ --}}
            <div class="md:col-span-2">
                <label class="form-label-lux">Địa chỉ</label>
                {{-- Giả sử trường 'address' tồn tại trong model $patient --}}
                <input type="text" name="address" class="form-input-lux" value="{{ old('address', $patient->address ?? '') }}" placeholder="Số nhà, đường, quận/huyện, tỉnh/thành phố">
                @error('address') <p class="error-message">{{ $message }}</p> @enderror
            </div>
        </div>
        
        {{-- NÚT CẬP NHẬT --}}
        <div class="pt-4 flex justify-end">
            <button type="submit" class="submit-btn-lux flex items-center space-x-2">
                <i class="fas fa-sync-alt"></i>
                <span>Cập Nhật Thông Tin</span>
            </button>
        </div>
    </form>
</div>

@endsection