@extends('layouts.patient')

@section('content')
<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO TRANG DANH SÁCH LỊCH HẸN */
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

/* Style Bảng */
.tat-table-header {
    background-color: #e0e9f3; /* Nền xanh nhạt hơn cho header */
    color: #004d99; /* Chữ xanh đậm */
    font-weight: 700;
    text-transform: uppercase;
}
.tat-table-cell {
    border: 1px solid #c8d8e8; /* Viền màu xanh xám */
    padding: 12px 10px;
    vertical-align: middle;
    background-color: white; /* Đảm bảo nội dung bảng trắng */
}
.tat-table-row:nth-child(even) .tat-table-cell {
    background-color: #f5f5f5; /* Sọc ngựa nhẹ xám */
}

/* Style cho các nút Hành động (Action Buttons) */
.tat-action-button {
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
    transition: background-color 0.2s;
}

.tat-action-button.edit {
    background-color: #ff9900; /* Màu cam/vàng chủ đạo */
    color: white;
}
.tat-action-button.edit:hover {
    background-color: #e68a00;
}

.tat-action-button.cancel {
    background-color: #cc0000; /* Màu đỏ đậm */
    color: white;
}
.tat-action-button.cancel:hover {
    background-color: #990000;
}

/* Style Trạng thái */
.status-tag {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.85rem;
}
.status-pending {
    background-color: #ffecd1; /* Cam nhạt */
    color: #cc6600;
    border: 1px solid #ffcc66;
}
.status-confirmed {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
.status-cancelled {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
.status-doctor-pending {
    background-color: #e9f0f6; /* Xanh xám nhạt */
    color: #495057;
    border: 1px solid #d0d7de;
}
</style>

<h1 class="text-2xl font-bold tat-header">LỊCH HẸN CỦA TÔI</h1>

{{-- Thanh menu con: Tổng thể / Đã duyệt / Chờ duyệt / Đã hủy --}}
<div class="flex justify-start gap-4 mb-8">
    {{-- Tổng thể --}}
    <a href="{{ route('patients.appointments.all', Auth::id()) }}" 
       class="tat-nav-button blue">
        Tổng thể
    </a>

    {{-- Đã duyệt --}}
    <a href="{{ route('patients.appointments.confirmed', Auth::id()) }}" 
       class="tat-nav-button bg-green-600 text-white hover:bg-green-700">
        Đã duyệt
    </a>
    
    {{-- Chờ duyệt --}}
    <a href="{{ route('patients.appointments.pending', Auth::id()) }}" 
       class="tat-nav-button bg-yellow-400 text-gray-800 hover:bg-yellow-500">
        Chờ duyệt
    </a>
    
    {{-- Đã hủy --}}
    <a href="{{ route('patients.appointments.cancelled', Auth::id()) }}" 
       class="tat-nav-button bg-red-600 text-white hover:bg-red-700">
        Đã hủy
    </a>
</div>

    <h2 class="text-center text-xl font-semibold mb-4 text-blue-700">📋 TỔNG THỂ LỊCH HẸN</h2>

    @include('patients.partials.appointment_table', ['appointments' => $appointments])
</div>
@endsection
