<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Patient Dashboard | Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Header trên --}}
    <header class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between p-4">
        {{-- Logo --}}
        <div class="flex items-center space-x-2">
    <a href="{{ route('dashboard.patient', Auth::user()->id) }}">
        <img src="{{ asset('images/Ảnh chụp màn hình 2025-09-17 131053.png') }}"
             alt="Clinic Logo"
             class="w-44 object-contain hover:opacity-80 transition">
    </a>
</div>


        {{-- Tìm kiếm --}}
        <div class="relative w-96 mx-5"> <!-- tăng w-60 → w-96 để dài hơn -->
    <input type="text" placeholder="Tìm kiếm"
           class="w-full border border-gray-300 rounded-full px-10 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-200">
    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#6bb9ee] text-lg">
        🔍
    </span>
</div>


        {{-- Menu chính --}}
        <div class="flex items-center space-x-6 text-black font-medium">
            <a href="{{ route('dckh.portal') }}" class="flex items-center gap-1 cursor-pointer hover:text-[#6bb9ee] transition">
    👤 Dành cho khách hàng
</a>
            <a href="{{ route('appointments.create') }}" class="flex items-center gap-1 hover:text-[#6bb9ee] transition">
    📅 Đặt lịch khám
</a>

        </div>

        {{-- Liên hệ --}}
        <div class="flex flex-col items-center text-black ml-6">
            <div class="flex items-center text-base mb-1">
                <svg class="h-5 w-5 mr-1 text-[#6bb9ee]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z"/>
                </svg>
                Hà Nội
            </div>
            <div class="text-sm font-bold">
                <a href="tel:02471066858" class="hover:text-[#6bb9ee] transition">024 7106 6858</a> - 
                <a href="tel:02438723872" class="hover:text-[#6bb9ee] transition">024 3872 3872</a>
            </div>
        </div>

       {{-- Language / Login / Logout --}}
<div class="flex items-center space-x-2 ml-6">
    {{-- Biểu tượng thông báo --}}
<a href="{{ route('patients.notifications') }}"
   class="relative group hover:scale-110 transition-transform mr-2">
    <svg xmlns="http://www.w3.org/2000/svg" 
         fill="none" viewBox="0 0 24 24" stroke-width="1.8" 
         stroke="currentColor" 
         class="w-7 h-7 text-[#6bb9ee] group-hover:text-blue-400 transition-colors">
        <path stroke-linecap="round" stroke-linejoin="round" 
              d="M14.25 18.75a1.5 1.5 0 01-3 0m9-6a7.5 7.5 0 00-15 0v2.25l-1.5 1.5v.75h19.5v-.75l-1.5-1.5V12.75z" />
    </svg>

    {{-- Dấu chấm đỏ khi có thông báo mới --}}
    @if(Auth::user()->unreadNotifications->count() > 0)
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center">
            {{ Auth::user()->unreadNotifications->count() }}
        </span>
    @endif
</a>
    @auth
        {{-- Avatar hình tròn --}}
        <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1119.88 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

        <span class="text-gray-400">|</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-500 hover:underline font-medium">Đăng xuất</button>
        </form>
    @else
        <a href="{{ route('register') }}" class="text-[#6bb9ee] hover:underline font-medium">Đăng ký</a>
        <span class="text-gray-400">|</span>
        <a href="{{ route('login') }}" class="text-[#6bb9ee] hover:underline font-medium">Đăng nhập</a>
    @endauth
</div>

</header>


   {{-- Thanh menu màu xanh đậm --}}
<nav class="bg-blue-900 text-white">
    <div class="container mx-auto flex justify-center space-x-12 p-3">
        <a href="{{ route('patient.gt') }}" class="uppercase font-semibold text-lg hover:text-[#6bb9ee] transition">Giới thiệu</a>
        <a href="{{ route('patient.ck') }}"  class="uppercase font-semibold text-lg hover:text-[#6bb9ee] transition">Chuyên khoa</a>
        <a href="#chuyengia" class="uppercase font-semibold text-lg hover:text-[#6bb9ee] transition">Chuyên gia – bác sĩ</a>
        <a href="{{ route('patient.dvdb') }}" class="uppercase font-semibold text-lg hover:text-[#6bb9ee] transition">Dịch vụ đặc biệt</a>
        <a href="{{ route('appointments.index') }}" class="uppercase font-semibold text-lg hover:text-[#6bb9ee] transition">Lịch hẹn</a>
        <a href="{{ route('patient.medical-records.index') }}" 
   class="uppercase font-semibold text-lg hover:text-[#6bb9ee] transition">
   Kết quả khám
</a>

        <a href="{{ route('patients.show', auth()->user()->id) }}"
   class="uppercase font-semibold text-lg hover:text-[#6bb9ee] transition">
   Hồ sơ cá nhân
</a>
        <a href="{{ route('patient.lh') }}" class="uppercase font-semibold text-lg hover:text-[#6bb9ee] transition">Liên hệ</a>
    </div>
</nav>



    {{-- Nội dung chính --}}
    <main class="flex-1 w-full p-0 m-0">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white shadow p-4 text-center text-gray-600">
        &copy; {{ date('Y') }} MyClinic. All rights reserved.
    </footer>
@yield('scripts')

</body>
</html>


