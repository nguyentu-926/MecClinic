@extends('layouts.doctor')

@section('content')
<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO TRANG DANH SÁCH LỊCH HẸN (Bác Sĩ) */
/* ------------------------------------------- */

/* THAY ĐỔI: ĐẶT MÀU NỀN XANH NHẠT GIỐNG Y KHOA */
html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    width: 100%;
    /* MÀU NỀN MỚI: Xanh nhạt (Pale Blue/Medical Blue) */
    background-color: #F5F9FD; 
}

/* Tiêu đề chính */
.tat-header {
    color: #004d99; /* Màu xanh đậm chủ đạo */
    border-bottom: 3px solid #ff9900; /* Đường viền cam */
    display: inline-block;
    padding-bottom: 5px;
    margin-bottom: 20px;
    font-size: 1.5rem; /* Điều chỉnh kích thước tiêu đề chính */
    font-weight: 700;
}

/* Style cho các nút menu con */
.tat-nav-button {
    font-weight: 600;
    border-radius: 8px;
    padding: 10px 18px;
    transition: all 0.2s;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.tat-nav-button.blue {
    background-color: #004d99; /* Xanh đậm */
    color: white;
}
.tat-nav-button.blue:hover {
    background-color: #003366;
}

/* Lưu ý: Cần đảm bảo component bảng (_table) sử dụng các class tat-table-header, tat-table-cell, status-tag, v.v. đã định nghĩa trước. */
</style>

<div class="container mx-auto py-6">
    {{-- Thanh menu con (Đã đồng bộ style) --}}
    <div class="flex justify-start gap-4 mb-8">
        
        {{-- Tổng thể (Nút này nên được highlight nếu đây là trang đang active) --}}
        <a href="{{ route('doctors.appointments.all', Auth::id()) }}" 
           class="tat-nav-button blue">
           Tổng thể
        </a>
        
        {{-- Đã chấp nhận --}}
        <a href="{{ route('doctors.appointments.confirmed', Auth::id()) }}" 
           class="tat-nav-button bg-green-600 text-white hover:bg-green-700">
           Đã chấp nhận
        </a>
        
        {{-- Chờ duyệt --}}
        <a href="{{ route('doctors.appointments.pending', Auth::id()) }}" 
           class="tat-nav-button bg-yellow-400 text-gray-800 hover:bg-yellow-500">
           Chờ duyệt
        </a>
        
        {{-- Đã hủy --}}
        <a href="{{ route('doctors.appointments.cancelled', Auth::id()) }}" 
           class="tat-nav-button bg-red-600 text-white hover:bg-red-700">
           Đã hủy
        </a>
    </div>

    {{-- Tiêu đề chính (Đã đồng bộ) --}}
    {{-- Điều chỉnh để class tat-header được áp dụng đúng --}}
    <h2 class="text-center tat-header mx-auto">📋 TẤT CẢ LỊCH HẸN CỦA TÔI</h2>

    @include('doctors.appointments._table', ['appointments' => $appointments])
</div>
@endsection