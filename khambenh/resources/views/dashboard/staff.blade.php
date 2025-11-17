@extends('layouts.staff')

@section('content')
<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO TRANG DANH SÁCH LỊCH HẸN (Staff) */
/* ------------------------------------------- */

/* Tiêu đề chính (Header) */
.tat-header {
    color: #004d99; /* Giữ màu xanh */
    border-bottom: 3px solid #ff9900;
    display: inline-block;
    padding-bottom: 5px;
    margin-bottom: 20px;
    font-size: 1.8rem;
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
.tat-nav-button.active-blue {
    background-color: #003366; 
    color: white;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
}

/* TIÊU ĐỀ RIÊNG TRONG TRANG TỔNG THỂ */
.tat-section-title {
    font-weight: 700;
    font-size: 1.5rem; /* Tương đương text-xl */
    margin-top: 2rem; 
    margin-bottom: 1rem; 
    padding-left: 0.75rem;
    border-left: 5px solid; /* Đường viền phân cách */
}

/* Thêm thanh cuộn ngang nếu bảng quá rộng */
.table-responsive {
    overflow-x: auto;
    width: 100%;
}
/* Đảm bảo thead dính khi cuộn dọc nếu bảng quá dài */
.table-responsive table thead th {
    position: sticky;
    top: 0; /* Dính vào đỉnh của khối cuộn */
    background-color: #f0f7ff; /* Giữ màu nền để không bị trong suốt */
    z-index: 10;
}

</style>

{{-- KHỐI NỘI DUNG CHÍNH (Đã bỏ tat-form-container-bg và tat-form-card) --}}
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    
    <header class="mb-8">
        <h1 class="tat-header text-3xl font-extrabold">👩‍💼 QUẢN LÝ LỊCH HẸN</h1>
    </header>

    {{-- Session Message --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300 shadow-md">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-300 shadow-md">{{ session('error') }}</div>
    @endif

    {{-- Thanh menu con (Điều hướng) --}}
    <div class="flex flex-wrap justify-start gap-4 mb-8">
        @php
            $currentRoute = Route::currentRouteName();
        @endphp
        
        {{-- Tổng thể --}}
        <a href="{{ route('staff.appointments.all') }}" 
           class="tat-nav-button {{ $currentRoute == 'staff.appointments.all' ? 'active-blue' : 'bg-gray-200 text-gray-700 hover:bg-blue-100 hover:text-blue-800' }}">
            Tổng thể
        </a>
        
        {{-- Đã duyệt --}}
        <a href="{{ route('staff.appointments.confirmed') }}" 
           class="tat-nav-button {{ $currentRoute == 'staff.appointments.confirmed' ? 'active-blue' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
            Đã duyệt
        </a>
        
        {{-- Chờ duyệt --}}
        <a href="{{ route('staff.appointments.pending') }}" 
           class="tat-nav-button {{ $currentRoute == 'staff.appointments.pending' ? 'active-blue' : 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' }}">
            Chờ duyệt
        </a>
        
        {{-- Đã hủy --}}
        <a href="{{ route('staff.appointments.cancelled') }}" 
           class="tat-nav-button {{ $currentRoute == 'staff.appointments.cancelled' ? 'active-blue' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
            Đã hủy
        </a>
    </div>

    {{-- Lịch hẹn đã duyệt --}}
    <h2 class="tat-section-title text-green-600 border-green-600">✅ Lịch hẹn đã duyệt</h2>
    <div class="table-responsive bg-white rounded-lg shadow-md p-4">
        @include('staffs._appointments_table', ['appointments' => $confirmedAppointments])
    </div>

    <hr class="my-8 border-gray-300">

    {{-- Lịch hẹn chờ duyệt --}}
    <h2 class="tat-section-title text-yellow-600 border-yellow-600">⏳ Lịch hẹn chờ duyệt</h2>
    <div class="table-responsive bg-white rounded-lg shadow-md p-4">
        @include('staffs._appointments_table', ['appointments' => $pendingAppointments])
    </div>

    <hr class="my-8 border-gray-300">

    {{-- Lịch hẹn đã hủy --}}
    <h2 class="tat-section-title text-red-600 border-red-600">❌ Lịch hẹn đã hủy</h2>
    <div class="table-responsive bg-white rounded-lg shadow-md p-4">
        @include('staffs._appointments_table', ['appointments' => $cancelledAppointments])
    </div>
    
</div>

@endsection