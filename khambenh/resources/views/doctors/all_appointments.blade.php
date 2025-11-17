@extends('layouts.doctor')

@section('content')

<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO CẤU TRÚC CARD & TIÊU ĐỀ */
/* ------------------------------------------- */

/* KHỐI CARD CHÍNH - Container lớn bao quanh nội dung */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); 
    border-radius: 12px;
    /* Dùng shadow xanh lá đậm */
    box-shadow: 0 10px 40px rgba(21, 128, 61, 0.3); 
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

/* Tiêu đề phụ (tat-subheader): Đã chỉnh màu sắc đồng bộ với Doctor Layout */
.tat-subheader {
    color: #15803d; /* Xanh lá đậm */
    border-bottom: 2px solid #ff9900; /* Đường viền cam nổi bật */
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
    text-decoration: none; /* Đảm bảo không có gạch chân */
}
/* Class cho nút Active (Màu Xanh Đậm y tế đã được định nghĩa là blue) */
.tat-nav-button.active-style {
    background-color: #004d99; /* Xanh đậm y tế */
    color: white;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px); 
}
/* Class cho nút không Active (Sử dụng tông màu nhạt) */
.tat-nav-button.inactive-style {
    background-color: #f3f4f6; /* bg-gray-100 */
    color: #374151; /* text-gray-700 */
}
.tat-nav-button.inactive-style:hover {
    background-color: #e5e7eb; /* bg-gray-200 */
}
</style>

{{-- KHỐI CARD CHÍNH --}}
<div class="tat-form-card">
    
    {{-- Tiêu đề Card đồng bộ --}}
    <div class="tat-form-header-bar">
        👨‍⚕️ TỔNG THỂ LỊCH HẸN 
    </div>

    <div class="p-8">
        {{-- Thanh menu con (Điều hướng) --}}
        <div class="flex justify-start flex-wrap gap-4 mb-8">
            
            {{-- Helper để xác định liên kết đang active --}}
            @php
                $currentPath = Request::path();
                $allActive = Str::endsWith($currentPath, 'appointments');
                $confirmedActive = Str::endsWith($currentPath, 'confirmed');
                $pendingActive = Str::endsWith($currentPath, 'pending');
                $cancelledActive = Str::endsWith($currentPath, 'cancelled');
            @endphp
            
            {{-- 1. Tổng thể --}}
            <a href="{{ route('doctors.appointments.all', Auth::id()) }}" 
               class="tat-nav-button {{ $allActive ? 'active-style' : 'inactive-style' }}">
                Tổng thể
            </a>
            
            {{-- 2. Đã chấp nhận --}}
            <a href="{{ route('doctors.appointments.confirmed', Auth::id()) }}" 
               class="tat-nav-button {{ $confirmedActive ? 'active-style' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                Đã chấp nhận
            </a>
            
            {{-- 3. Chờ duyệt --}}
            <a href="{{ route('doctors.appointments.pending', Auth::id()) }}" 
               class="tat-nav-button {{ $pendingActive ? 'active-style' : 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' }}">
                Chờ duyệt
            </a>
            
            {{-- 4. Đã hủy --}}
            <a href="{{ route('doctors.appointments.cancelled', Auth::id()) }}" 
               class="tat-nav-button {{ $cancelledActive ? 'active-style' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                Đã hủy
            </a>
        </div>

        {{-- Tiêu đề phụ --}}
        <h2 class="text-center mx-auto tat-subheader">📋 Danh sách lịch hẹn</h2>

        {{-- Bảng lịch hẹn (Đảm bảo component _table đã được đồng bộ) --}}
        <div class="table-responsive">
            @include('doctors.appointments._table', ['appointments' => $appointments])
        </div>
    </div>
</div>
@endsection