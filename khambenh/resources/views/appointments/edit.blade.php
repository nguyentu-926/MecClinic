@extends('layouts.patient')

@section('content')
<style>
/* ------------------------------------------- */
/* TÁI SỬ DỤNG CSS TỪ GIAO DIỆN ĐẶT LỊCH */
/* ------------------------------------------- */
html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    width: 100%;
}

.tat-form-container-bg {
    position: relative;
    width: 100vw;            
    left: 50%;              
    right: 50%;
    margin-left: -50vw;     
    min-height: 100vh; /* Đảm bảo chiều cao bao phủ viewport */
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
    height: 100%; /* Bao phủ toàn bộ chiều cao của container */
    display: block;
    object-fit: cover;      
    position: absolute;
    top: 0; /* ĐÃ CHỈNH SỬA: Đảm bảo ảnh bắt đầu từ đỉnh container */
    left: 0;
    z-index: -1;
}

/* Khối Form (Card) */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 900px;
    width: 90%;
    margin: 0 auto;
    overflow: hidden;
    display: flex;
    flex-wrap: wrap; 
    position: relative;
    z-index: 1;
}

/* Cột trái */
.tat-info-panel {
    flex: 0 0 40%;
    padding: 30px;
    background-color: #f0f7ff; 
    border-right: 1px solid #e0e0e0;
}
@media (max-width: 768px) {
    .tat-info-panel {
        flex: 1 1 100%;
        border-right: none;
        border-bottom: 1px solid #e0e0e0;
    }
}

/* Cột phải */
.tat-input-panel {
    flex: 1;
    padding: 30px;
}

/* Thanh tiêu đề form */
.tat-form-header-bar {
    background-color: #004d99;
    color: white;
    text-align: center;
    padding: 15px 20px;
    margin: -30px; 
    margin-bottom: 30px; 
}

.tat-form-header-bar h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Form input */
.form-control, .form-select, textarea {
    display: block;
    width: 100%;
    border-radius: 6px;
    padding: 10px 12px;
    border: 1px solid #d9d9d9;
    margin-top: 4px;
    font-size: 1rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control:focus {
    border-color: #004d99;
    box-shadow: 0 0 0 3px rgba(0, 77, 153, 0.2);
    outline: none;
}

/* Nút Cập nhật (primary) */
.btn-primary-tat {
    background-color: #ff9900 !important;
    color: white !important;
    font-weight: 700;
    border-radius: 6px;
    border: none;
    padding: 10px 20px;
    text-transform: uppercase;
    box-shadow: 0 4px 10px rgba(255, 153, 0, 0.4);
    transition: background-color 0.2s;
}
.btn-primary-tat:hover {
    background-color: #e68a00 !important;
}

/* Nút Hủy (secondary) */
.btn-secondary-tat {
    background-color: #6c757d !important;
    color: white !important;
    font-weight: 700;
    border-radius: 6px;
    border: none;
    padding: 10px 20px;
    text-transform: uppercase;
    transition: background-color 0.2s;
}
.btn-secondary-tat:hover {
    background-color: #5a6268 !important;
}

/* Style cho thông tin cố định ở cột trái */
.info-item {
    padding: 10px 0;
    border-bottom: 1px dashed #c0d8f0;
}
.info-item:last-child {
    border-bottom: none;
}
.info-item label {
    display: block;
    font-weight: 600;
    color: #004d99;
    margin-bottom: 5px;
}
.info-item p {
    font-weight: 500;
    color: #333;
}

/* Style cho ảnh vui vui */
.fun-illustration {
    width: 100%; 
    max-width: 200px; 
    height: auto;
    display: block;
    margin: 15px auto 0 auto; 
    border-radius: 8px; 
    border: 3px solid #66bb6a; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); 
}

/* Thông báo lỗi */
.alert-error-tat {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: .25rem;
}
</style>

<div class="tat-form-container-bg">
    {{-- Ảnh nền: nen1.jpg (Đã chỉnh CSS để bao phủ form) --}}
    <img src="{{ asset('images/nen1.jpg') }}" alt="Nền" class="full-width-image">

    <div class="py-12 px-4" style="max-width: 1200px; margin: 0 auto;">
        <div class="tat-form-card">
            
            {{-- Cột Trái: Thông tin cố định (Chuyên khoa, Bác sĩ và Ảnh vui) --}}
            <div class="tat-info-panel">
                <h4 class="guide-title text-xl mb-6">Thông tin lịch hẹn cố định</h4>
                <div class="info-item">
                    <label>Chuyên khoa</label>
                    <p class="font-bold">{{ $appointment->doctor->specialization ?? 'Đang cập nhật' }}</p> 
                </div>
                <div class="info-item">
                    <label>Bác sĩ</label>
                    <p class="font-bold">{{ $appointment->doctor->user->name ?? 'Đang cập nhật' }}</p>
                    <p class="text-sm text-gray-600">Phòng khám: {{ $appointment->doctor->room ?? 'N/A' }}</p>
                    
                    {{-- KHỐI ẢNH MINH HỌA VUI VẺ ĐÃ ĐƯỢC THÊM VÀO DƯỚI PHÒNG KHÁM --}}
                    <div class="text-center mt-4">
                        <img src="{{ asset('images/nen4.png') }}" 
                             alt="Ảnh vui vẻ" 
                             class="fun-illustration"> 
                    </div>
                </div>
                
            </div>

            {{-- Cột Phải: Form Chỉnh sửa (Ngày, Giờ, Ghi chú) --}}
            <div class="tat-input-panel">
                <div class="tat-form-header-bar">
                    <h3 class="mb-0">SỬA LỊCH HẸN</h3>
                </div>

                @if(session('error'))
                    <div class="alert-error-tat">
                        {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        {{-- Ngày hẹn --}}
                        <div class="mb-3">
                            <label class="block mb-1 font-medium">Ngày hẹn</label>
                            <input type="date" name="appointment_date" 
                                class="form-control @error('appointment_date') border-red-500 @enderror" 
                                value="{{ old('appointment_date', $appointment->appointment_date) }}" 
                                required min="{{ date('Y-m-d') }}">
                            @error('appointment_date') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        {{-- Giờ hẹn --}}
                        <div class="mb-3">
                            <label class="block mb-1 font-medium">Giờ hẹn</label>
                            <input type="text" name="appointment_time" 
                                class="form-control @error('appointment_time') border-red-500 @enderror" 
                                value="{{ old('appointment_time', $appointment->appointment_time) }}" required>
                            @error('appointment_time') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                    </div>

                    {{-- Ghi chú --}}
                    <div class="mb-6 mt-3">
                        <label class="block mb-1 font-medium">Triệu chứng/ Lý do khám</label>
                        <textarea name="notes" 
                                class="form-control @error('notes') border-red-500 @enderror" 
                                rows="4">{{ old('notes', $appointment->notes) }}</textarea>
                        @error('notes') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <div class="flex gap-4 pt-4 border-t border-gray-200">
                        <button type="submit" class="btn-primary-tat flex-1">CẬP NHẬT LỊCH HẸN</button>
                        <a href="{{ route('patients.appointments', auth()->user()->patient->id) }}" class="btn-secondary-tat flex-1 text-center">HỦY BỎ</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection