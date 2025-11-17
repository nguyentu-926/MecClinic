@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST (Form Edit - Improved) */
    /* ------------------------------------------- */
    :root {
        --admin-primary: #10b981; /* Màu Emerald 600 */
        --admin-accent: #2563eb; /* Blue 600 - Màu nhấn chính cho form Edit */
        --text-color: #1f2937; /* gray-800 */
        --border-color: #e5e7eb; /* Gray 200 */
        --bg-field: #f9fafb; /* Nền field rất nhẹ */
        --error-red: #dc2626; /* Red 600 */
        --shadow-elevation: 0 4px 10px rgba(0, 0, 0, 0.05); /* Shadow nhẹ nhàng */
    }

    .form-container {
        max-width: 900px; /* Tăng chiều rộng tổng thể */
        margin: 2rem auto;
        padding: 3rem 2.5rem; /* Tăng padding */
        background-color: #ffffff;
        box-shadow: var(--shadow-elevation);
        border-radius: 12px; /* Góc bo tròn hơn */
        border: 1px solid #f3f4f6; /* Border rất nhẹ */
    }

    /* Tiêu đề trang */
    .admin-title-form {
        font-size: 2.25rem; /* Lớn hơn */
        font-weight: 800; /* Dùng 800 (ExtraBold) thay vì 1200 */
        color: var(--text-color);
        margin-bottom: 25px;
        border-left: 6px solid var(--admin-accent); /* Dày hơn 1 chút */
        padding-left: 15px; /* Tăng khoảng cách padding */
    }
    
    /* Input và Select */
    .admin-input {
        border: 1px solid var(--border-color);
        border-radius: 6px; /* Bo góc nhỏ hơn, hiện đại hơn */
        padding: 12px 15px; /* Tăng chiều cao input */
        width: 100%;
        transition: all 0.3s ease;
        background-color: var(--bg-field);
        color: var(--text-color);
        font-weight: 500;
    }
    .admin-input:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2); /* Shadow đậm hơn khi focus */
        background-color: white;
        outline: none;
    }

    /* Label */
    .admin-label {
        font-weight: 700; /* Đậm hơn */
        color: #374151;
        margin-bottom: 8px; /* Tăng khoảng cách với input */
        display: block;
        font-size: 0.9rem;
        letter-spacing: 0.5px; /* Tăng khoảng cách chữ nhẹ */
    }
    
    /* Ghi chú phần chia section */
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-color);
        margin-top: 2rem;
        margin-bottom: 1.5rem;
        padding-bottom: 5px;
        border-bottom: 2px solid var(--border-color); /* Đường gạch chân rõ hơn */
    }

    /* Nút Cập nhật */
    .admin-btn-update {
        background-color: var(--admin-accent); 
        color: white;
        padding: 14px 35px; /* Nút lớn hơn */
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.05rem;
        transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4); /* Shadow nổi bật */
    }
    .admin-btn-update:hover {
        background-color: #1d4ed8;
        transform: translateY(-2px); /* Nổi lên nhiều hơn khi hover */
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.6);
    }
    
    .text-error {
        color: var(--error-red);
        font-size: 0.8rem; /* Nhỏ gọn hơn */
        margin-top: 4px;
        font-weight: 500;
    }
</style>

<div class="form-container">
    
    <h2 class="admin-title-form">
        <i class="fas fa-user-edit mr-3 text-admin-accent"></i> Cập nhật hồ sơ Nhân viên
    </h2>
    <span class="block text-gray-500 ml-4 mb-8">Sửa thông tin cho nhân viên: **{{ $staff->user->name }}**</span>
    
    <hr class="mb-6 border-gray-100">

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-700 border border-red-200 font-semibold">
            <i class="fas fa-exclamation-triangle mr-2"></i> Vui lòng kiểm tra lại các trường thông tin bị lỗi.
        </div>
    @endif

    <form action="{{ route('admin.staffs.update', $staff->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <h3 class="section-title">Thông tin Công việc & Tài khoản</h3>

        {{-- Phần thông tin tài khoản và cơ bản --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Tên --}}
            <div>
                <label for="name" class="admin-label">Tên nhân viên:</label>
                <input type="text" name="name" id="name" 
                       class="admin-input @error('name') error @enderror" 
                       value="{{ old('name', $staff->user->name) }}" required>
                @error('name')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Email (Readonly) --}}
            <div>
                <label for="email" class="admin-label">Email (Tài khoản đăng nhập):</label>
                <input type="email" name="email" id="email" 
                       class="admin-input bg-gray-100 cursor-not-allowed" 
                       value="{{ old('email', $staff->user->email) }}" readonly> 
                @error('email')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Số điện thoại --}}
            <div>
                <label for="phone" class="admin-label">Số điện thoại:</label>
                <input type="text" name="phone" id="phone" 
                       class="admin-input @error('phone') error @enderror" 
                       value="{{ old('phone', $staff->phone) }}" placeholder="09xxxxxxxx">
                @error('phone')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Vị trí (Chức vụ) --}}
            <div>
                <label for="position" class="admin-label">Vị trí / Chức danh:</label>
                <select name="position" id="position" 
                        class="admin-input @error('position') error @enderror" required>
                    @php $oldPosition = old('position', $staff->position); @endphp
                    <option value="">-- Chọn vị trí --</option>
                    <option value="Reception" {{ $oldPosition == 'Reception' ? 'selected' : '' }}>Nhân viên Tiếp tân</option>
                    <option value="Nurse" {{ $oldPosition == 'Nurse' ? 'selected' : '' }}>Y tá</option>
                    <option value="Technician" {{ $oldPosition == 'Technician' ? 'selected' : '' }}>Kỹ thuật viên</option>
                </select>
                @error('position')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <h3 class="section-title">Thông tin Hồ sơ cá nhân</h3>

        {{-- Phần thông tin cá nhân chi tiết --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Ngày sinh --}}
            <div>
                <label for="date_of_birth" class="admin-label">Ngày sinh:</label>
                <input type="date" name="date_of_birth" id="date_of_birth" 
                       class="admin-input @error('date_of_birth') error @enderror" 
                       value="{{ old('date_of_birth', $staff->date_of_birth) }}">
                @error('date_of_birth')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Giới tính --}}
            <div>
                <label for="gender" class="admin-label">Giới tính:</label>
                <select name="gender" id="gender" 
                        class="admin-input @error('gender') error @enderror">
                    @php $oldGender = old('gender', $staff->gender); @endphp
                    <option value="">-- Chọn --</option>
                    <option value="male" {{ $oldGender == 'male' ? 'selected' : '' }}>Nam</option>
                    <option value="female" {{ $oldGender == 'female' ? 'selected' : '' }}>Nữ</option>
                    <option value="other" {{ $oldGender == 'other' ? 'selected' : '' }}>Khác</option>
                </select>
                @error('gender')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Quê quán --}}
            <div>
                <label for="hometown" class="admin-label">Quê quán:</label>
                <input type="text" name="hometown" id="hometown" 
                       class="admin-input @error('hometown') error @enderror" 
                       value="{{ old('hometown', $staff->hometown) }}" placeholder="Ví dụ: Tỉnh A, Thành phố B">
                @error('hometown')
                    <p class="text-error">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Địa chỉ --}}
        <div class="pt-2">
            <label for="address" class="admin-label">Địa chỉ hiện tại:</label>
            <input type="text" name="address" id="address" 
                   class="admin-input @error('address') error @enderror" 
                   value="{{ old('address', $staff->address) }}" placeholder="Số nhà, đường, quận/huyện, tỉnh/thành phố">
            @error('address')
                <p class="text-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Ghi chú --}}
        <div class="pt-2">
            <label for="notes" class="admin-label">Ghi chú (Thông tin thêm):</label>
            <textarea name="notes" id="notes" rows="4" 
                      class="admin-input @error('notes') error @enderror" 
                      placeholder="Thông tin sức khỏe, sở thích, hoặc các ghi chú quan trọng khác...">{{ old('notes', $staff->notes) }}</textarea>
            @error('notes')
                <p class="text-error">{{ $message }}</p>
            @enderror
        </div>
        
        <h3 class="section-title">Ảnh đại diện</h3>

        {{-- Ảnh đại diện --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            
            <div>
                <label for="photo" class="admin-label">Tải lên Ảnh mới:</label>
                <input type="file" name="photo" id="photo" 
                       class="admin-input p-2 @error('photo') error @enderror" 
                       accept="image/*">
                @error('photo')
                    <p class="text-error">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-2">Chọn file ảnh (JPEG, PNG) không quá 2MB.</p>
            </div>
            
            {{-- Hiển thị ảnh cũ nếu có --}}
            <div class="md:text-right">
                @if($staff->photo)
                    <div class="inline-block text-center">
                        <span class="block text-sm text-gray-600 mb-2 font-semibold">Ảnh hiện tại:</span>
                        <img src="{{ asset('storage/' . $staff->photo) }}" alt="Ảnh đại diện nhân viên" class="w-28 h-28 object-cover rounded-full shadow-lg border-4 border-gray-100 mx-auto md:mx-0">
                    </div>
                @else
                    <div class="text-gray-500 italic">Chưa có ảnh đại diện nào được tải lên.</div>
                @endif
            </div>
        </div>

        <div class="pt-6 flex justify-end">
            <button type="submit" 
                    class="admin-btn-update inline-flex items-center">
                <i class="fas fa-sync-alt mr-2"></i> CẬP NHẬT HỒ SƠ
            </button>
        </div>
    </form>

</div>
@endsection