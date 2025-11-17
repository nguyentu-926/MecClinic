@extends('layouts.staff')

@section('content')
<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO CẤU TRÚC CARD KHÔNG NỀN */
/* ------------------------------------------- */

/* KHỐI CARD CHÍNH - Container lớn bao quanh nội dung */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); 
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 1600px; 
    width: 100%; 
    margin: 30px auto 50px auto; 
    overflow: hidden;
    position: relative;
    z-index: 10; 
}

/* Thanh Tiêu đề Card (Phần đầu card, đồng bộ màu xanh đậm) */
.tat-form-header-bar {
    background-color: #004d99; 
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
    border-bottom: 2px solid #004d99;
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
/* Class cho nút Active (Màu Vàng cho trạng thái Chờ duyệt) */
.tat-nav-button.active-yellow {
    background-color: #eab308; /* Màu vàng đậm */
    color: white;
    box-shadow: 0 6px 8px rgba(234, 179, 8, 0.4);
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
        ⏳ QUẢN LÝ LỊCH HẸN CHỜ DUYỆT
    </div>

    <div class="p-8">
        {{-- Session Message --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300 shadow-md">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-300 shadow-md">
                {{ session('error') }}
            </div>
        @endif

        {{-- Thanh menu con (Điều hướng) --}}
        <div class="flex justify-start flex-wrap gap-4 mb-8">
            
            {{-- Tổng thể --}}
            <a href="{{ route('staff.appointments.all') }}" 
               class="tat-nav-button bg-gray-200 text-gray-700 hover:bg-gray-300">
                Tổng thể
            </a>
            
            {{-- Đã duyệt --}}
            <a href="{{ route('staff.appointments.confirmed') }}" 
               class="tat-nav-button bg-green-100 text-green-700 hover:bg-green-200">
                Đã duyệt
            </a>
            
            {{-- Chờ duyệt (Active page) --}}
            <a href="{{ route('staff.appointments.pending') }}" 
               class="tat-nav-button active-yellow">
                Chờ duyệt
            </a>
            
            {{-- Đã hủy --}}
            <a href="{{ route('staff.appointments.cancelled') }}" 
               class="tat-nav-button bg-red-100 text-red-700 hover:bg-red-200">
                Đã hủy
            </a>
        </div>

        <h2 class="text-center mx-auto tat-subheader">Lịch hẹn Chờ Duyệt</h2>

        {{-- Bảng chỉ hiển thị lịch hẹn chờ duyệt --}}
        <div class="table-responsive">
            @include('staffs._appointments_table', ['appointments' => $pendingAppointments])
        </div>

    </div>
</div>
@endsection