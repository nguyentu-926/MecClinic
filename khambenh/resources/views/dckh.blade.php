@extends('layouts.patient')

@section('title', 'Dịch Vụ & Hỗ Trợ Dành Cho Khách Hàng')

@section('styles')
<style>
    /* Định nghĩa Bo Góc Lớn */
    :root {
        --card-radius: 1.25rem; /* Giá trị bo góc 1.25rem (khoảng 20px) */
    }

    /* 1. CSS Cho Thẻ Ảnh */
    .card-img-container {
        overflow: hidden; 
        height: 180px; 
        /* Áp dụng bo góc TRÊN của thẻ cha */
        border-radius: var(--card-radius) var(--card-radius) 0 0; 
        transform: scale(1.0);
        transition: transform 0.4s ease-in-out; 
    }

    .card-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease-in-out;
        
    }

    /* 2. CSS Cho Toàn Bộ Thẻ Link (Đảm bảo bo góc toàn bộ thẻ) */
    .card-link {
        /* Áp dụng bo góc TOÀN BỘ thẻ */
        border-radius: var(--card-radius); 
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        overflow: hidden; /* Quan trọng để nội dung (ảnh) bên trong không tràn ra ngoài bo góc */
        transform: translateY(0);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); 
    }
    
    /* Hiệu ứng khi di chuột (hover) */
    .card-link:hover {
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.22); 
        transform: translateY(-8px);
    }
    .card-link:hover .card-img-container img {
        transform: scale(1.05);
    }


    /* 3. Tinh Chỉnh Khoảng Cách và Nội Dung Text (Đảm bảo căn giữa tuyệt đối) */
    .card-text-content {
        height: 70px; 
        /* Căn giữa theo chiều dọc */
        display: flex;
        align-items: center; 
        /* Căn giữa theo chiều ngang */
        justify-content: center; 
        text-align: center; /* Đảm bảo văn bản đa dòng cũng căn giữa */
        padding: 0.5rem 1.5rem; 
    }

    .card-text-content p {
        /* Đã xóa margin để không phá vỡ căn giữa dọc */
        margin: 0; 
        font-size: 1rem; 
        line-height: 1.3;
        font-weight: 500; 
        color: #4a5568;
        text-align: center;
    }

    /* 4. Style cho phần overlay (Thẻ 4) */
    .card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 16px;
        background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0) 100%);
        color: white;
        text-align: left;
        padding-bottom: 25px;
        line-height: 1.2;
        /* Bo góc dưới của overlay để khớp với thẻ cha */
        border-radius: 0 0 var(--card-radius) var(--card-radius);
    }
    .card-overlay p {
        font-size: 1.3rem;
        font-weight: 800; 
        margin-bottom: 5px;
        color: white; 
    }
    .card-overlay small {
        font-weight: 500;
        opacity: 0.9;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8 bg-gray-100">
    <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Dành Cho Khách Hàng</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        {{-- Thẻ 1: Phiếu khảo sát --}}
        <a href="{{ route('dckh.survey') ?? '#' }}" class="card-link block bg-white duration-300 rounded-2xl">
            <div>
                <div class="card-img-container ">
                    <img src="{{ asset('images/c1.png') }}" alt="Phiếu Khảo Sát" loading="lazy" class="ll rounded-t-2xl">
                </div>
                <div class="card-text-content ">
                    <p>Danh mục dịch vụ kỹ thuật Bệnh viện Đa khoa TAT</p>
                </div>
            </div>
        </a>

        {{-- Thẻ 2: Tra cứu kết quả - Hồ sơ sức khỏe --}}
        <a href="{{ route('dckh.medical_records') ?? '#' }}" class="card-link block bg-white duration-300 rounded-2xl">
            <div>
                <div class="card-img-container">
                    <img src="{{ asset('images/c2.png') }}" alt="Hồ Sơ Sức Khỏe" loading="lazy" class="ll rounded-t-2xl">
                </div>
                <div class="card-text-content">
                    <p>HƯỚNG DẪN KHÁM BỆNH</p>
                </div>
            </div>
        </a>

        {{-- Thẻ 3: Danh mục dịch vụ --}}
        <a href="{{ route('appointments.create') }}" class="card-link block bg-white duration-300 rounded-2xl">
            <div>
                <div class="card-img-container">
                    <img src="{{ asset('images/c4.png') }}" alt="Danh Mục Dịch Vụ" loading="lazy" class="ll rounded-t-2xl">
                </div>
                <div class="card-text-content">
                    <p>Đăng ký khám bệnh</p>
                </div>
            </div>
        </a>

        {{-- Thẻ 4: Hướng dẫn tra cứu kết quả khám bệnh (Dùng Overlay) --}}
        <a href="{{ route('dckh.guide') ?? '#' }}" class="card-link block bg-white duration-300  rounded-2xl" >
            <div>
                <div class="card-img-container">
                    <img src="{{ asset('images/c3.png') }}" alt="Hướng Dẫn Tra Cứu" loading="lazy" class="ll rounded-t-2xl">
                </div>
                <div class="card-text-content">
                    <p>Quy trình khám và điều trị ngoại trú
</p>
                </div>
            </div>
        </a>

        {{-- Thẻ 5: Danh sách Bác sĩ / Đặt lịch --}}
        <a href="{{ route('dckh.doctors') ?? '#' }}" class="card-link block bg-white duration-300 rounded-2xl">
            <div>
                <div class="card-img-container">
                    <img src="{{ asset('images/c5.png') }}" alt="Đặt Lịch Hẹn" loading="lazy" class="ll rounded-t-2xl">
                </div>
                <div class="card-text-content">
                    <p>Hướng dẫn khách hàng điều trị nội trú</p>
                </div>
            </div>
        </a>

        {{-- Thẻ 6: Thông tin liên hệ / Hỗ trợ --}}
        <a href="{{ route('dckh.contact') ?? '#' }}" class="card-link block bg-white duration-300 rounded-2xl">
            <div>
                <div class="card-img-container">
                    <img src="{{ asset('images/c6.png') }}" alt="Thông Tin Liên Hệ" loading="lazy" class="ll rounded-t-2xl">
                </div>
                <div class="card-text-content">
                    <p>Thủ tục nhập viện và xuất viện</p>
                </div>
            </div>
        </a>

    </div>
</div>
{{-- PHẦN ĐỐI TÁC BẢO HIỂM --}}
<div class="container mx-auto px-4 pt-0 pb-8 max-w-6xl">
    <h2 class="text-3xl font-bold text-blue-800 mb-6 text-center">
        ĐỐI TÁC BẢO HIỂM
    </h2>
    {{-- Sử dụng grid-cols-2 trên mobile, grid-cols-3 trên sm, và grid-cols-5 trên lg để căn 5 logo --}}
    <div class="grid grid-cols-3 sm:grid-cols-5 gap-4 items-center justify-items-center">
        
        {{-- Logo 1: MIC --}}
        <div class="p-2">
            <img src="{{ asset('images/b1.png') }}" alt="Logo MIC" class="h-16 w-auto object-contain mx-auto">
        </div>
        
        {{-- Logo 2: AIA --}}
        <div class="p-2">
            <img src="{{ asset('images/b2.png') }}" alt="Logo AIA" class="h-16 w-auto object-contain mx-auto">
        </div>

        {{-- Logo 3: VietinBank Insurance --}}
        <div class="p-2">
            <img src="{{ asset('images/b3.png') }}" alt="Logo VietinBank Insurance" class="h-16 w-auto object-contain mx-auto">
        </div>
        
        {{-- Logo 4: PJICO --}}
        <div class="p-2">
            <img src="{{ asset('images/b4.png') }}" alt="Logo PJICO" class="h-16 w-auto object-contain mx-auto">
        </div>
        
        {{-- Logo 5: Insmart --}}
        <div class="p-2">
            <img src="{{ asset('images/b5.png') }}" alt="Logo Insmart" class="h-16 w-auto object-contain mx-auto">
        </div>
    </div>
</div>
{{-- END PHẦN ĐỐI TÁC BẢO HIỂM --}}
@endsection