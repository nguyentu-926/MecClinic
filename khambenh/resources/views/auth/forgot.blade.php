@extends('layouts.auth')

@section('content')
<style>
/* ------------------------------------------- */
/* NỀN VÀ CĂN CHỈNH TỔNG THỂ */
/* ------------------------------------------- */
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    min-height: 100vh;
    /* Giữ hình nền ảnh để đảm bảo độ tương phản */
    background-image: url("{{ asset('images/nen5.jpg') }}");
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Inter', sans-serif; /* Dùng font Inter hiện đại */
    overflow: hidden; 
}

/* Bỏ mọi container mặc định từ layout */
body > div, .container, .card {
    background: transparent !important;
    box-shadow: none !important;
}

/* ------------------------------------------- */
/* KHỐI CHÍNH (.login-container) - Tinh tế và Tối giản */
/* ------------------------------------------- */
.login-container {
    max-width: 420px; /* Đồng bộ với form Đăng nhập */
    width: 90%;
    padding: 50px 40px; 
    
    /* Hiệu ứng Glassmorphism Tinh tế */
    background-color: rgba(255, 255, 255, 0.1); /* Rất trong suốt */
    backdrop-filter: blur(20px); /* Blur mạnh mẽ */
    border: 1px solid rgba(255, 255, 255, 0.4); /* Viền sáng hơn */
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
    border-radius: 18px;
    
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 10; 
}

/* Logo/Icon Area */
.logo-area svg {
    color: #4dc0b5; /* Màu Cyan/Teal cho icon chính */
    width: 70px;
    height: 70px;
    margin-bottom: 1px;
    filter: drop-shadow(0 0 10px rgba(77, 192, 181, 0.8));
}

/* Tiêu đề - ĐÃ BỎ HIỆU ỨNG BÓNG MỜ */
.login-container h2 {
    font-size:30px;
    font-weight: 800; 
    color: #ffffff; 
    margin-top: 0; 
    margin-bottom: 10px; 
    /* Tiêu đề sắc nét, không có bóng (theo yêu cầu) */
}

/* Paragraph Text (Thông báo hướng dẫn) */
.login-container p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.05rem;
    font-weight: 500;
    margin-bottom: 30px;
    line-height: 1.5;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
}


/* INPUT FIELDS */
.form-control {
    display: block;
    width: 100%;
    padding: 18px 20px; /* Padding lớn hơn cho cảm giác cao cấp */
    margin-top: 20px;
    font-size: 1.1rem;
    border-radius: 10px;
    
    /* Input sáng, rõ ràng */
    background-color: rgba(255, 255, 255, 0.98); 
    border: 1px solid rgba(0, 0, 0, 0.1); 
    color: #333; 
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #4dc0b5; /* Màu Teal */
    box-shadow: 0 0 0 4px rgba(77, 192, 181, 0.4);
    background-color: #fff;
    outline: none;
}

/* Nút Submit - Dùng style của nút Đăng nhập (Teal) */
.btn-login-tat {
    background-color: #4dc0b5; /* Màu Teal */
    color: #0d2a28; /* Chữ màu xanh đậm tương phản */
    font-weight: 700;
    border-radius: 10px;
    border: none;
    padding: 16px 25px;
    text-transform: uppercase;
    font-size: 1.2rem;
    letter-spacing: 1.5px;
    margin-top: 40px;
    width: 100%;
    box-shadow: 0 8px 30px rgba(77, 192, 181, 0.7);
    transition: background-color 0.3s, box-shadow 0.3s, transform 0.2s;
}
.btn-login-tat:hover {
    background-color: #38a89d;
    box-shadow: 0 12px 35px rgba(77, 192, 181, 0.9);
    transform: translateY(-2px);
}

/* Links (Quay lại đăng nhập) */
.links-section {
    margin-top: 40px;
    font-size: 1rem;
    text-decoration:none;
    color: rgba(255, 255, 255, 0.8); 
    text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
}
.links-section a {
    color: #ffffff; /* Link màu trắng sáng */
    font-weight: 600;
    text-decoration:none;
    transition: color 0.3s;
}
.links-section a:hover {
    color: #4dc0b5; /* Hover màu Teal */
}
.links-section span {
    color: rgba(255, 255, 255, 0.7);
    font-weight: 400;
}

/* Thông báo lỗi & thành công Laravel */
.alert-danger-laravel, .alert-success-laravel {
    padding: 14px;
    margin-bottom: 25px;
    border: 1px solid transparent;
    border-radius: .5rem;
    text-align: left;
    width: 100%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.alert-danger-laravel {
    background-color: rgba(248, 215, 218, 0.95);
    border-color: #f5c6cb;
    color: #721c24;
}

.alert-success-laravel {
    background-color: rgba(209, 248, 218, 0.95); 
    border-color: #c3e6cb;
    color: #155724;
}

/* ------------------------------------------- */
/* NỀN ĐỘNG (FLOATING BACKGROUND) - Đã đồng bộ từ Login */
/* ------------------------------------------- */
.area{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1; 
}

.circles{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    list-style: none;
}

.circles li{
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.25); 
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.3); 
    animation: animate 25s linear infinite;
    bottom: -150px;
    border-radius: 50%;
}

/* Tùy chỉnh màu sắc và hình dạng cho bubbles */
.circles li:nth-child(1){ left: 25%; width: 80px; height: 80px; animation-delay: 0s; background: rgba(77, 192, 181, 0.3); } /* Màu Teal */
.circles li:nth-child(2){ left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; border-radius: 10px; background: rgba(0, 123, 255, 0.3); } /* Màu Xanh dương */
.circles li:nth-child(3){ left: 70%; width: 20px; height: 20px; animation-delay: 4s; animation-duration: 20s; }
.circles li:nth-child(4){ left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; border-radius: 30%; }
.circles li:nth-child(5){ left: 65%; width: 20px; height: 20px; animation-delay: 0s; background: rgba(77, 192, 181, 0.3); } /* Màu Teal */
.circles li:nth-child(6){ left: 75%; width: 110px; height: 110px; animation-delay: 3s; animation-duration: 30s; }
.circles li:nth-child(7){ left: 35%; width: 150px; height: 150px; animation-delay: 7s; background: rgba(0, 123, 255, 0.3); } /* Màu Xanh dương */
.circles li:nth-child(8){ left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; border-radius: 10px; }
.circles li:nth-child(9){ left: 20%; width: 15px; height: 15px; animation-delay: 6s; animation-duration: 35s; }
.circles li:nth-child(10){ left: 85%; width: 150px; height: 150px; animation-delay: 11s; animation-duration: 22s; background: rgba(77, 192, 181, 0.3); } /* Màu Teal */

/* Định nghĩa animation cho bubbles */
@keyframes animate {
    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100%{
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }
}

/* ------------------------------------------- */
/* ICON Y TẾ CỐ ĐỊNH Ở GÓC DƯỚI BÊN TRÁI (Medical Floaters) - Đã đồng bộ từ Login */
/* ------------------------------------------- */
.medical-floaters {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    list-style: none;
    pointer-events: none;
}

.medical-floaters li {
    position: absolute;
    display: block;
    color: rgba(255, 255, 255, 0.8); 
    filter: drop-shadow(0 0 8px rgba(0, 123, 255, 0.5)); 
    animation: icon-pulse 4s infinite alternate;
    top: initial; 
    bottom: 5%;  
    
    width: 60px; /* Nhỏ gọn hơn */
    height: 60px;
    opacity: 0.8;
}

@keyframes icon-pulse {
    0% { filter: drop-shadow(0 0 6px rgba(0, 123, 255, 0.8)); transform: scale(1); }
    100% { filter: drop-shadow(0 0 12px rgba(77, 192, 181, 0.8)); transform: scale(1.05); }
}

@keyframes horizontal-shake {
    0% { transform: translateX(0) rotate(-3deg); }
    50% { transform: translateX(3px) rotate(3deg); }
    100% { transform: translateX(0) rotate(-3deg); }
}

.medical-floaters li:nth-child(1) { left: 5%; animation-delay: 0s; }
.medical-floaters li:nth-child(2) { left: 15%; animation-delay: 1s; }
.medical-floaters li:nth-child(3) { left: 25%; animation-delay: 2s; }
.medical-floaters li:nth-child(4) { 
    left: 35%; 
    animation: horizontal-shake 8s ease-in-out infinite alternate, icon-pulse 4s infinite alternate; 
    animation-delay: 0.5s; 
}
</style>

{{-- NỀN ĐỘNG CÁC HÌNH TRÒN VÀ ICON Y TẾ --}}
<div class="area" >
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    {{-- KHU VỰC 4 ICON Y TẾ CỐ ĐỊNH Ở GÓC DƯỚI BÊN TRÁI --}}
    <ul class="medical-floaters">
        {{-- Icon 1: Stethoscope (Ống nghe) --}}
        <li>
            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C7.58 2 4 5.58 4 10v10h2v-5h3v5h2v-5h2v5h2v-5h3v5h2V10c0-4.42-3.58-8-8-8zm0 10c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
            </svg>
        </li>
        {{-- Icon 2: Heartbeat/EKG (Nhịp tim) --}}
        <li>
            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 12h-2c0-1.38-.83-2.5-2-3v3h-2v-3h-2v3h-2v-3H8v3H6v-3c-1.17.5-2 1.62-2 3v8h2v-3h2v3h2v-3h2v3h2v-3h2v3h2V12zm-8-7a5 5 0 00-5 5h10a5 5 0 00-5-5z"/>
            </svg>
        </li>
        {{-- Icon 3: Vial (Lọ thuốc/Mẫu xét nghiệm) --}}
        <li>
            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 8h-2v-2c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8 6h8v2H8V6zm10 14H6V10h12v10zm-4-4h-4v-4h4v4z"/>
            </svg>
        </li>
        {{-- Icon 4: Hospital Building (Tòa nhà Bệnh viện) - CỐ ĐỊNH, LẮC NGANG --}}
        <li>
            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 9h-4V3H9v6H5v12h14V9zm-5 4h-4v-4h4v4zM7 9h2V7h4v2h2v10H7V9z"/>
            </svg>
        </li>
    </ul>
</div >

{{-- KHỐI QUÊN MẬT KHẨU --}}
<div class="login-container">
    
    {{-- LOGO/ICON --}}
    <div class="logo-area">
        {{-- Sử dụng biểu tượng tim (Heart) + dấu cộng (Plus) đơn giản, mạnh mẽ --}}
        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            {{-- Hình trái tim lớn --}}
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            {{-- Dấu cộng/y tế (Health Cross) --}}
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8"></path>
        </svg>
    </div>
    <h2>Quên mật khẩu</h2>
    
    <p>Vui lòng nhập địa chỉ email đã đăng ký của bạn. Chúng tôi sẽ gửi một liên kết khôi phục mật khẩu qua email này.</p>

    {{-- Hiển thị thông báo (Thành công hoặc Lỗi) --}}
    @if (session('status'))
        <div class="alert-success-laravel">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-danger-laravel">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/forgot-password') }}" method="POST" class="w-full">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Địa chỉ Email"
                class="form-control">
        <button type="submit" class="btn-login-tat">Gửi link khôi phục</button>
    </form>

    <div class="links-section">
        <a href="{{ url('/login') }}">← Quay lại đăng nhập</a>
    </div>
</div>
@endsection
