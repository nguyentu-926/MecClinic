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
}
/* Tiêu đề phụ (Dùng cho trạng thái cụ thể) */
.tat-subheader {
    color: #ff9900; /* Màu cam chủ đạo */
    border-bottom: 2px solid #004d99; /* Đường viền xanh đậm */
    display: inline-block;
    padding-bottom: 5px;
    font-size: 1.5rem;
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

/* Các style bảng (tat-table-header, tat-table-cell, status-tag, v.v.) 
   được giả định đã được định nghĩa và áp dụng trong component _table */
</style>

<div class="container mx-auto py-6">
    {{-- Thanh menu con (Đã đồng bộ style) --}}
    <div class="flex justify-start gap-4 mb-8">
        
        {{-- Tổng thể --}}
        <a href="{{ route('doctors.appointments.all', Auth::id()) }}" 
           class="tat-nav-button blue">
           Tổng thể
        </a>
        
        {{-- Đã chấp nhận --}}
        <a href="{{ route('doctors.appointments.confirmed', Auth::id()) }}" 
           class="tat-nav-button bg-green-600 text-white hover:bg-green-700">
           Đã chấp nhận
        </a>
        
        {{-- Chờ duyệt (Nút này nên được highlight nếu đây là trang đang active) --}}
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

    {{-- Tiêu đề chính (Đã đồng bộ và làm nổi bật trạng thái Chờ duyệt) --}}
    <h2 class="text-center mb-6 tat-subheader mx-auto">⏳ LỊCH HẸN CHỜ DUYỆT</h2>

    {{-- Bảng lịch hẹn (Cần đảm bảo file _table sử dụng các class đồng bộ) --}}
    @include('doctors.appointments._table', ['appointments' => $pendingAppointments])
</div>
@endsection