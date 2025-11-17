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

    font-family: 'Inter', sans-serif; /* Dùng font Inter hiện đại hơn */

    overflow: hidden; 

}



/* Bỏ mọi container mặc định từ layout */

body > div, .container, .card {

    background: transparent !important;

    box-shadow: none !important;

}



/* ------------------------------------------- */

/* KHỐI ĐĂNG NHẬP (.login-container) - Tinh tế hơn */

/* ------------------------------------------- */

.login-container {

    max-width: 420px; /* Nhỏ gọn hơn */

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

    margin-bottom: 5px;

    /* Hiệu ứng 3D nhẹ */

    filter: drop-shadow(0 0 10px rgba(77, 192, 181, 0.8));

}



/* Tiêu đề */

.login-container h2 {

    font-size: 2.5rem;

    font-weight: 800; 

    color: #ffffff; 

    margin-top: 0; 

    margin-bottom: 35px; 

}



/* ------------------------------------------- */

/* INPUT FIELDS CÓ ICON */

/* ------------------------------------------- */

/* NEW: Input Group Wrapper - Quan trọng để định vị icon */

.input-group-custom {

    position: relative;

    width: 100%;

    margin-bottom: 20px; /* Thêm margin dưới cho mỗi nhóm input */

}



.form-control {

    display: block;

    width: 100%;

    /* Tăng padding trái để chừa chỗ cho icon */

    padding: 18px 20px 18px 50px; 

    font-size: 1.1rem;

    border-radius: 10px;

    margin-top: 0; /* Đã chuyển margin lên .input-group-custom */

    

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



/* Icon cố định bên trái */

.input-icon {

    position: absolute;

    top: 50%;

    left: 15px; /* Vị trí icon */

    transform: translateY(-50%);

    width: 20px;

    height: 20px;

    color: #4dc0b5; /* Màu Teal/Cyan */

    z-index: 20;

}



/* Password Toggle Eye Icon (Bên phải) */

.password-toggle {

    position: absolute;

    top: 50%;

    right: 15px; /* Vị trí icon con mắt */

    transform: translateY(-50%);

    width: 22px;

    height: 22px;

    color: rgba(0, 0, 0, 0.5); /* Icon màu xám mờ */

    cursor: pointer;

    z-index: 20;

    background: transparent;

    border: none;

    padding: 0;

    transition: color 0.2s;

}



.password-toggle:hover {

    color: #4dc0b5; /* Teal on hover */

}





/* Nút đăng nhập - Màu Teal/Cyan hiện đại */

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

    margin-top: 20px; /* Giảm margin do input đã có margin */

    width: 100%;

    box-shadow: 0 8px 30px rgba(77, 192, 181, 0.7);

    transition: background-color 0.3s, box-shadow 0.3s, transform 0.2s;

}

.btn-login-tat:hover {

    background-color: #38a89d;

    box-shadow: 0 12px 35px rgba(77, 192, 181, 0.9);

    transform: translateY(-2px);

}



/* Links */

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



/* Thông báo lỗi Laravel */

.alert-danger-laravel {

    background-color: rgba(248, 215, 218, 0.95);

    border-color: #f5c6cb;

    color: #721c24;

    padding: 14px;

    margin-bottom: 25px;

    border: 1px solid transparent;

    border-radius: .5rem;

    text-align: left;

    width: 100%;

    box-shadow: 0 2px 5px rgba(0,0,0,0.1);

}



/* ------------------------------------------- */

/* NỀN ĐỘNG (FLOATING BACKGROUND) - Giữ nguyên */

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

    background: rgba(255, 255, 255, 0.25); /* Hơi mờ hơn */

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

/* ICON Y TẾ CỐ ĐỊNH Ở GÓC DƯỚI BÊN TRÁI (Medical Floaters) - Giữ nguyên */

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



{{-- KHỐI ĐĂNG NHẬP --}}

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

    <h2>Đăng nhập</h2>



    {{-- Hiển thị lỗi Laravel --}}

    @if ($errors->any())

        <div class="alert-danger-laravel">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    <form action="{{ url('/login') }}" method="POST" class="w-full">

        @csrf



        {{-- TRƯỜNG EMAIL CÓ ICON --}}

        <div class="input-group-custom">

            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                {{-- Icon Email --}}

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>

            </svg>

            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Địa chỉ Email" class="form-control">

        </div>



        {{-- TRƯỜNG MẬT KHẨU CÓ ICON VÀ NÚT TOGGLE --}}

        <div class="input-group-custom">

            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                {{-- Icon Lock --}}

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v3h8z"></path>

            </svg>

            <input type="password" id="password" name="password" required placeholder="Mật khẩu" class="form-control">

            

            {{-- Nút hiện/ẩn mật khẩu --}}

            <button type="button" id="password-toggle-btn" class="password-toggle" aria-label="Toggle password visibility">

                {{-- Eye open icon (Hiển thị mặc định) --}}

                <svg id="eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>

                </svg>

                {{-- Eye closed icon (Ẩn mặc định) --}}

                <svg id="eye-closed" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.258 0 2.446.33 3.518.802M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12l-2.458 7.057A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.258 0 2.446.33 3.518.802M10 12l.5.5m2-.5l-.5-.5"></path>

                </svg>

            </button>

        </div>



        <button type="submit" class="btn-login-tat">Đăng nhập</button>

    </form>



    <div class="links-section">

        <a href="{{ url('/forgot-password') }}">Quên mật khẩu?</a>

        <span class="mx-2">|</span>

        <a href="{{ url('/register') }}">Đăng ký</a>

    </div>

    

</div>



<script>

    document.addEventListener('DOMContentLoaded', function() {

        const passwordInput = document.getElementById('password');

        const toggleButton = document.getElementById('password-toggle-btn');

        const eyeOpen = document.getElementById('eye-open');

        const eyeClosed = document.getElementById('eye-closed');



        if (toggleButton && passwordInput) {

            // Khi nhấn nút toggle

            toggleButton.addEventListener('click', function() {

                // Đổi kiểu input giữa 'password' và 'text'

                const isPassword = passwordInput.getAttribute('type') === 'password';

                const newType = isPassword ? 'text' : 'password';

                passwordInput.setAttribute('type', newType);



                // Ẩn/hiện icon con mắt phù hợp

                if (isPassword) {

                    eyeOpen.style.display = 'none';

                    eyeClosed.style.display = 'block';

                } else {

                    eyeOpen.style.display = 'block';

                    eyeClosed.style.display = 'none';

                }

            });

        }

    });

</script>

@endsection

