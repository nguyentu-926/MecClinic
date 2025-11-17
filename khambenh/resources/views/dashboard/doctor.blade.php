@extends('layouts.doctor')

@section('content')
<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO CẤU TRÚC CARD KHÔNG NỀN */
/* ------------------------------------------- */

/* KHỐI CARD CHÍNH - Container lớn bao quanh nội dung */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); 
    border-radius: 12px;
    /* Dùng shadow xanh đậm */
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4); 
    max-width: 1500px; 
    width: 100%; 
    margin: 0px auto 0px auto; 
    overflow: hidden;
    position: relative;
    z-index: 10; 
}

/* Thanh Tiêu đề Card (Phần đầu card, đồng bộ màu xanh lá đậm) */
.tat-form-header-bar {
    background-color: #004d99; /* Xanh lá đậm của Doctor Layout */
    color: white;
    text-align: center;
    padding: 18px 20px;
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: 1px;
}

/* Tiêu đề phụ (tat-subheader) */
.tat-subheader {
    color: #ff9900;
    border-bottom: 2px solid #004d99; /* Dùng màu xanh lá đậm cho Doctor */
    display: inline-block;
    padding-bottom: 5px;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
}

/* Style cho các nút menu con (Navigation) */
.tat-nav-button {
    font-weight: 600;
    border-radius: 8px;
    padding: 10px 18px;
    transition: all 0.2s;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    white-space: nowrap;
}
/* Class cho nút Active (Màu Xanh Đậm y tế cho trang Tổng thể) */
.tat-nav-button.active-blue {
    background-color: #004d99; /* Xanh đậm y tế */
    color: white;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px); 
}

/* ------------------------------------------- */
/* CSS BẢNG */
/* ------------------------------------------- */

/* Thêm thanh cuộn ngang nếu bảng quá rộng */
.table-responsive {
    overflow-x: auto;
    width: 100%;
}
</style>

{{-- KHỐI CARD CHÍNH (Đã đồng bộ) --}}
<div class="tat-form-card">
    
    {{-- Tiêu đề Card đồng bộ --}}
    <div class="tat-form-header-bar">
        👨‍⚕️ TỔNG THỂ LỊCH HẸN 
    </div>

    <div class="p-8">
        {{-- Session Message (Giả định được xử lý trong Layout Doctor) --}}
        
        {{-- Thanh menu con (Điều hướng) --}}
        <div class="flex justify-start flex-wrap gap-4 mb-8">
            
            {{-- Tổng thể (Active page) --}}
            <a href="{{ route('doctors.appointments.all', Auth::id()) }}" 
               class="tat-nav-button active-blue">
                Tổng thể
            </a>
            
            {{-- Đã chấp nhận --}}
            <a href="{{ route('doctors.appointments.confirmed', Auth::id()) }}" 
               class="tat-nav-button bg-green-100 text-green-700 hover:bg-green-200">
                Đã chấp nhận
            </a>
            
            {{-- Chờ duyệt --}}
            <a href="{{ route('doctors.appointments.pending', Auth::id()) }}" 
               class="tat-nav-button bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                Chờ duyệt
            </a>
            
            {{-- Đã hủy --}}
            <a href="{{ route('doctors.appointments.cancelled', Auth::id()) }}" 
               class="tat-nav-button bg-red-100 text-red-700 hover:bg-red-200">
                Đã hủy
            </a>
        </div>

        <h2 class="text-center mx-auto tat-subheader">📋 Tất cả lịch hẹn</h2>

        {{-- Bảng lịch hẹn --}}
        <div class="table-responsive">
            @include('doctors.appointments._table', ['appointments' => $appointments])
        </div>
    </div>
</div>
@endsection