@extends('layouts.patient')

@section('content')
<style>
/* ------------------------------------------- */
/* TÁI SỬ DỤNG CSS ĐỒNG BỘ VÀ TỐI ƯU HÓA */
/* ------------------------------------------- */

html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    width: 100%;
}

/* CONTAINER */
.tat-form-container-bg {
    position: relative;
    width: 100vw;            
    left: 50%;              
    right: 50%;
    margin-left: -50vw;     
    /* Đảm bảo nó bao phủ ít nhất 100vh VÀ MỞ RỘNG theo nội dung */
    min-height: 100vh; 
    overflow: hidden; 
    
    padding-top: 50px; 
    padding-bottom: 50px; 
    box-sizing: border-box; 
    
    display: flex; 
    justify-content: center; 
    align-items: flex-start; 
}

/* ******** PHỤC HỒI CSS CHO THẺ ẢNH NỀN ******* */
.tat-form-container-bg img.full-width-image {
    width: 100%;             
    height: 100%; /* Đảm bảo chiều cao bao phủ form */
    display: block;
    object-fit: cover;      
    position: absolute;
    top: 0; /* ĐÃ CHỈNH SỬA: Đảm bảo ảnh bắt đầu từ đỉnh container */
    left: 0;
    z-index: -1; /* Đặt dưới form card */
}

/* KHỐI CARD CHÍNH (FORM) */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 600px; 
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

/* INPUT VÀ SELECT */
.form-control-tat {
    display: block;
    width: 100%;
    border-radius: 6px;
    padding: 10px 12px;
    border: 1px solid #d9d9d9;
    margin-top: 4px;
    font-size: 1rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control-tat:focus {
    border-color: #004d99;
    box-shadow: 0 0 0 3px rgba(0, 77, 153, 0.2);
    outline: none;
}

/* Nút Cập Nhật (Màu cam/vàng đồng bộ) */
.btn-tat-submit {
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
.btn-tat-submit:hover {
    background-color: #e68a00 !important;
}

/* Thông báo lỗi */
.text-red-500 {
    color: #cc0000;
    font-size: 0.875rem;
    margin-top: 4px;
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
    
    {{-- ĐÃ KHÔI PHỤC THẺ IMG ĐỂ LÀM ẢNH NỀN --}}
    <img src="{{ asset('images/nen1.jpg') }}" alt="Nền" class="full-width-image">

    <div class="tat-form-card">
        
        {{-- Tiêu đề Card --}}
        <div class="tat-form-header-bar">
            CHỈNH SỬA HỒ SƠ CÁ NHÂN
        </div>

        <div class="p-8">
            @if(session('success'))
                <div class="alert-success-tat">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('patients.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Họ và tên --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Họ và tên</label>
                    <input type="text" name="full_name" 
                            value="{{ old('full_name', Auth::user()->name) }}" 
                            class="form-control-tat">
                    @error('full_name') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Số điện thoại --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Số điện thoại</label>
                    <input type="text" name="phone" 
                            value="{{ old('phone', $patient->phone) }}" 
                            class="form-control-tat">
                    @error('phone') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Địa chỉ --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Địa chỉ</label>
                    <input type="text" name="address" 
                            value="{{ old('address', $patient->address) }}" 
                            class="form-control-tat">
                    @error('address') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Ngày sinh --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Ngày sinh</label>
                    <input type="date" name="date_of_birth" 
                            value="{{ old('date_of_birth', $patient->date_of_birth) }}" 
                            class="form-control-tat">
                    @error('date_of_birth') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Giới tính --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Giới tính</label>
                    <select name="gender" class="form-control-tat">
                        <option value="">Chọn giới tính</option>
                        <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                        <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                        <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>Khác</option>
                    </select>
                    @error('gender') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-tat-submit">
                    CẬP NHẬT HỒ SƠ
                </button>
            </form>
        </div>
    </div>
</div>
@endsection