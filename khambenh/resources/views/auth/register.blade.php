@extends('layouts.auth')
@section('content')
<style>
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    min-height: 100vh;
    background-image: url("{{ asset('images/nen5.jpg') }}");
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Inter', sans-serif;
    overflow: hidden; 
}
body > div, .container, .card {
    background: transparent !important;
    box-shadow: none !important;
}



/* ------------------------------------------- */

/* KHỐI CHÍNH (.login-container) */

/* ------------------------------------------- */

.login-container {

    max-width: 700px; /* ĐÃ SỬA: Tăng chiều rộng tối đa của khung chính */

    width: 100%;

    padding: 10px 40px; 

    

    /* Hiệu ứng Glassmorphism Tinh tế */

    background-color: rgba(255, 255, 255, 0.1);

    backdrop-filter: blur(20px);

    border: 1px solid rgba(255, 255, 255, 0.4);

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

    color: #4dc0b5;

    width: 70px;

    height: 70px;

    margin-bottom: 0px;

    filter: drop-shadow(0 0 10px rgba(77, 192, 181, 0.8));

}



/* Tiêu đề */

.login-container h2 {

    font-size: 2.5rem;

    font-weight: 800; 

    color: #ffffff; 

    margin-top: 0; 

    margin-bottom: 5px;

}



/* ------------------------------------------- */

/* INPUT FIELDS VỚI ICON (INPUT GROUP) */

/* ------------------------------------------- */

.input-group-tat {

    display: flex;

    align-items: center;

    width: 100%;

    margin-top: 15px; /* Khoảng cách giữa các nhóm input */

    background-color: rgba(255, 255, 255, 0.98); 

    border-radius: 10px;

    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);

    transition: all 0.3s;

    border: 1px solid rgba(0, 0, 0, 0.1); 

    position: relative; /* <-- Đã thêm: Giúp định vị nút toggle */

}



/* Hiệu ứng focus áp dụng cho toàn bộ wrapper */

.input-group-tat:focus-within {

    border-color: #4dc0b5; /* Màu Teal đồng bộ */

    box-shadow: 0 0 0 4px rgba(77, 192, 181, 0.4);

    background-color: #fff;

}



/* Icon style (Left side) */

.input-group-tat .icon {

    padding: 0 15px;

    color: #4dc0b5; /* Màu Teal nổi bật */

    flex-shrink: 0;

    width: 50px;

    height: 45px;

}



/* Input thực tế bên trong group */

.form-control-with-icon {

    display: block;

    width: 100%;

    /* Tùy chỉnh padding: Bỏ padding trái */

    padding: 16px 20px 16px 0; 

    font-size: 1.1rem;

    

    /* Bỏ border, box-shadow, margin mặc định */

    border: none;

    background-color: transparent;

    box-shadow: none;

    margin: 0;

    color: #333; 

    /* Chỉ bo góc bên phải để khớp với wrapper */

    border-radius: 0 10px 10px 0; 

    transition: all 0.3s;

}



.form-control-with-icon::placeholder {

    color: #777;

}



.form-control-with-icon:focus {

    /* Vô hiệu hóa focus mặc định vì wrapper đã xử lý */

    border-color: transparent;

    box-shadow: none;

    outline: none;

}



/* --- PHẦN MỚI: MẮT VÀ ĐIỀU CHỈNH INPUT MẬT KHẨU --- */

/* Nút toggle cho mật khẩu (Con mắt) */

.password-toggle {

    /* Dùng absolute để đặt chồng lên input */

    position: absolute;

    right: 0;

    top: 0;

    height: 100%;

    /* Thêm padding phải để căn giữa icon */

    padding-right: 15px; 

    

    /* Về cơ bản là một nút bấm vô hình */

    background: transparent;

    border: none;

    cursor: pointer;

    z-index: 20; 

    

    /* Căn giữa icon theo chiều dọc */

    display: flex;

    align-items: center;

}



.password-toggle .eye-icon {

    width: 24px;

    height: 24px;

    color: #4dc0b5; /* Màu Teal đồng bộ */

    transition: color 0.3s;

}



.password-toggle:hover .eye-icon {

    color: #38a89d; /* Màu Teal đậm hơn khi hover */

}



/* Điều chỉnh padding cho input mật khẩu để chừa chỗ cho nút toggle */

.form-control-with-icon.password-input-padding {

    padding-right: 50px; /* Thêm padding đủ rộng cho nút mắt */

}





/* ------------------------------------------- */

/* NÚT SUBMIT ĐĂNG KÝ (Teal) */

/* ------------------------------------------- */

.btn-register-tat {

    background-color: #4dc0b5; 

    color: #0d2a28;

    font-weight: 700;

    border-radius: 10px;

    border: none;

    padding: 16px 25px;

    text-transform: uppercase;

    font-size: 1.2rem; 

    letter-spacing: 1.5px;

    margin-top: 30px;

    width: 100%;

    box-shadow: 0 8px 30px rgba(77, 192, 181, 0.7);

    transition: background-color 0.3s, box-shadow 0.3s, transform 0.2s;

}

.btn-register-tat:hover {

    background-color: #38a89d;

    box-shadow: 0 12px 35px rgba(77, 192, 181, 0.9);

    transform: translateY(-2px);

}



/* ------------------------------------------- */

/* LINKS & ALERTS */

/* ------------------------------------------- */

.links-section {

    margin-top: 30px; 

    font-size: 1.05rem; 

    text-decoration:none;

    color: rgba(255, 255, 255, 0.8); 

    text-shadow: 1px 1px 3px rgba(0,0,0,0.8);

    width: 100%;

}

.links-section a {

    color: #ffffff;

    font-weight: 600;

    text-decoration:none;

    transition: color 0.3s;

}

.links-section a:hover {

    color: #4dc0b5;

    text-decoration:none;

}



.alert-danger-laravel {

    background-color: rgba(248, 215, 218, 0.95);

    border-color: #f5c6cb;

    color: #721c24;

    padding: 14px;

    margin-bottom: 20px;

    border: 1px solid transparent;

    border-radius: .5rem;

    text-align: left;

    width: 100%;

    box-shadow: 0 2px 5px rgba(0,0,0,0.1);

}



/* ------------------------------------------- */

/* NỀN ĐỘNG (FLOATING BACKGROUND) */

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



.circles li:nth-child(1){ left: 25%; width: 80px; height: 80px; animation-delay: 0s; background: rgba(77, 192, 181, 0.3); }

.circles li:nth-child(2){ left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; border-radius: 10px; background: rgba(0, 123, 255, 0.3); }

.circles li:nth-child(3){ left: 70%; width: 20px; height: 20px; animation-delay: 4s; animation-duration: 20s; }

.circles li:nth-child(4){ left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; border-radius: 30%; }

.circles li:nth-child(5){ left: 65%; width: 20px; height: 20px; animation-delay: 0s; background: rgba(77, 192, 181, 0.3); }

.circles li:nth-child(6){ left: 75%; width: 110px; height: 110px; animation-delay: 3s; animation-duration: 30s; }

.circles li:nth-child(7){ left: 35%; width: 150px; height: 150px; animation-delay: 7s; background: rgba(0, 123, 255, 0.3); }

.circles li:nth-child(8){ left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; border-radius: 10px; }

.circles li:nth-child(9){ left: 20%; width: 15px; height: 15px; animation-delay: 6s; animation-duration: 35s; }

.circles li:nth-child(10){ left: 85%; width: 150px; height: 150px; animation-delay: 11s; animation-duration: 22s; background: rgba(77, 192, 181, 0.3); }



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



/* ICON Y TẾ CỐ ĐỊNH */

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

    width: 60px;

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



/* 4 ICON BÊN DƯỚI BÊN TRÁI */

.medical-floaters li:nth-child(1) { left: 5%; bottom: 5%; top: initial; animation-delay: 0s; }

.medical-floaters li:nth-child(2) { left: 15%; bottom: 5%; top: initial; animation-delay: 1s; }

.medical-floaters li:nth-child(3) { left: 25%; bottom: 5%; top: initial; animation-delay: 2s; }

.medical-floaters li:nth-child(4) { 

    left: 35%; bottom: 5%; top: initial;

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



    <ul class="medical-floaters">

        {{-- 4 ICON GỐC - GÓC DƯỚI BÊN TRÁI --}}

        <li>{{-- Stethoscope --}}

            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C7.58 2 4 5.58 4 10v10h2v-5h3v5h2v-5h2v5h2v-5h3v5h2V10c0-4.42-3.58-8-8-8zm0 10c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>

        </li>

        <li>{{-- Heartbeat/EKG --}}

            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20 12h-2c0-1.38-.83-2.5-2-3v3h-2v-3h-2v3h-2v-3H8v3H6v-3c-1.17.5-2 1.62-2 3v8h2v-3h2v3h2v-3h2v3h2v-3h2v3h2V12zm-8-7a5 5 0 00-5 5h10a5 5 0 00-5-5z"/></svg>

        </li>

        <li>{{-- Vial --}}

            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M18 8h-2v-2c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8 6h8v2H8V6zm10 14H6V10h12v10zm-4-4h-4v-4h4v4z"/></svg>

        </li>

        <li>{{-- Hospital Building --}}

            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19 9h-4V3H9v6H5v12h14V9zm-5 4h-4v-4h4v4zM7 9h2V7h4v2h2v10H7V9z"/></svg>

        </li>

        <li>{{-- Microscope --}}

            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M15 16h-2V8h2V5h-2V3h-2v2H9V3H7v2H5v3h2v8H5v2h14v-2h-4zm-4 0h-2V8h2v8z"/></svg>

        </li>

        <li>{{-- Pill Bottle --}}

            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20 6h-2V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 4h4v2h-4V4zm10 16H4V8h16v12zM9 13H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/></svg>

        </li>

        <li>{{-- First Aid Cross --}}

            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M18 4H6C4.9 4 4 4.9 4 6v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM15 13h-2v2h-2v-2H9v-2h2V9h2v2h2v2z"/></svg>

        </li>

    </ul>

</div >



{{-- KHỐI ĐĂNG KÝ --}}

<div class="login-container">

    

    {{-- LOGO/ICON --}}

    <div class="logo-area">

        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8"></path>

        </svg>

    </div>

    <h2>Đăng ký</h2>



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



    <form action="{{ url('/register') }}" method="POST" class="w-full">

        @csrf



        {{-- Input: Họ và tên (User Icon) --}}

        <div class="input-group-tat">

            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>

            </svg>

            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Họ và tên"

                class="form-control-with-icon">

        </div>



        {{-- Input: Email (Mail Icon) --}}

        <div class="input-group-tat">

            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>

            </svg>

            <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email"

                class="form-control-with-icon">

        </div>



        {{-- Input: Mật khẩu (Lock Icon & Eye Toggle) --}}

        <div class="input-group-tat">

            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-4a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v3h8z"></path>

            </svg>

            <input type="password" name="password" required placeholder="Mật khẩu (tối thiểu 8 ký tự)"

                class="form-control-with-icon password-input-padding" id="password-field">



            <button type="button" class="password-toggle" id="toggle-password-field">

                {{-- ICON MẮT (Trạng thái ban đầu: Hidden) --}}

                <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>

                    <circle cx="12" cy="12" r="3"></circle>

                </svg>

            </button>

        </div>



        {{-- Input: Nhập lại mật khẩu (Lock Icon & Eye Toggle) --}}

        <div class="input-group-tat">

            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-4a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v3h8z"></path>

            </svg>

            <input type="password" name="password_confirmation" required placeholder="Nhập lại mật khẩu"

                class="form-control-with-icon password-input-padding" id="password-confirm-field">



            <button type="button" class="password-toggle" id="toggle-password-confirm-field">

                {{-- ICON MẮT (Trạng thái ban đầu: Hidden) --}}

                <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>

                    <circle cx="12" cy="12" r="3"></circle>

                </svg>

            </button>

        </div>



        {{-- Input: Số điện thoại (Phone Icon) --}}

        <div class="input-group-tat">

            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>

            </svg>

            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại (Tùy chọn)"

                class="form-control-with-icon">

        </div>



        {{-- Input: Địa chỉ (Map Pin Icon) --}}

        <div class="input-group-tat">

            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path>

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>

            </svg>

            <input type="text" name="address" value="{{ old('address') }}" placeholder="Địa chỉ (Tùy chọn)"

                class="form-control-with-icon">

        </div>





        <button type="submit" class="btn-register-tat">Đăng ký</button>

    </form>



    <div class="links-section">

        <a href="{{ url('/login') }}">Đã có tài khoản? Đăng nhập</a>

        

    </div>

</div>



{{-- SCRIPT ĐỂ XỬ LÝ NÚT HIỆN/ẨN MẬT KHẨU --}}

<script>

    function setupPasswordToggle(fieldId, toggleId) {

        const passwordInput = document.getElementById(fieldId);

        const toggleButton = document.getElementById(toggleId);

        

        if (!passwordInput || !toggleButton) return;



        // SVG cho Mắt mở (Hiển thị mật khẩu)

        const openEyeSVG = `

            <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>

                <circle cx="12" cy="12" r="3"></circle>

            </svg>`;



        // SVG cho Mắt bị gạch (Ẩn mật khẩu)

        const closedEyeSVG = `

            <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                <path d="M9.88 9.88a3 3 0 104.24 4.24M10.73 5.08A10.43 10.43 0 0112 4c7 0 11 8 11 8a13.94 13.94 0 01-6.59 4.39M2 12s4-8 11-8c.4 0 .8.04 1.2.11M4.24 14.83A10.41 10.41 0 013 12c0-4 4-8 11-8M1 1l22 22"></path>

            </svg>`;

        

        toggleButton.addEventListener('click', () => {

            const isPassword = passwordInput.type === 'password';

            

            // 1. Chuyển đổi loại input: password <-> text

            passwordInput.type = isPassword ? 'text' : 'password';



            // 2. Chuyển đổi icon

            toggleButton.innerHTML = isPassword ? closedEyeSVG : openEyeSVG;



            // 3. Đặt focus lại vào trường mật khẩu

            passwordInput.focus();

        });

    }



    // Thiết lập cho cả hai trường mật khẩu khi DOM được tải

    document.addEventListener('DOMContentLoaded', () => {

        setupPasswordToggle('password-field', 'toggle-password-field');

        setupPasswordToggle('password-confirm-field', 'toggle-password-confirm-field');

    });

</script>



@endsection

