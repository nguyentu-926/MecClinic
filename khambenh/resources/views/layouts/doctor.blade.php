<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Doctor | Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        .sidebar {

            /* Chiều cao = 100vh - Chiều cao header (64px) */

            height: calc(100vh - 64px); 

            top: 64px;

        }

        /* Đảm bảo hiệu ứng fade out cho flash message */

        #flash-success {

            transition: opacity 0.5s ease-out;

        }

    </style>

</head>

<body class="bg-gray-100 min-h-screen"> 



    {{-- KHỐI HEADER TRÊN CÙNG (Cố định, màu Xanh Lá cho Bác Sĩ) --}}

    <header class="bg-blue-800 text-white shadow-lg sticky top-0 z-20 h-16">

        <div class="max-w-full mx-auto flex items-center justify-between p-4 px-6">

            <div class="flex items-center space-x-4">

                <span class="text-3xl font-extrabold text-yellow-300">👨‍⚕️</span>

                <a href="{{ route('dashboard.doctor', ['id' => Auth::id()]) }}" 

                   class="text-xl font-semibold tracking-wide">

                    DOCTOR PANEL

                </a>

            </div>

            

            {{-- Nút Đăng xuất ở góc phải --}}

            <form action="{{ route('logout') }}" method="POST" class="inline">

                @csrf

                <button type="submit" class="bg-red-600 hover:bg-red-700 transition duration-200 text-white px-4 py-1.5 rounded-lg font-medium shadow-md">

                    Đăng xuất

                </button>

            </form>

        </div>

    </header>



    {{-- KHỐI CHÍNH: SIDEBAR + NỘI DUNG --}}

    <div class="flex">



        {{-- SIDEBAR (Thanh điều hướng bên, cố định) --}}

        <aside class="w-64 bg-white shadow-xl p-4 sticky sidebar z-10">

            <div class="space-y-2 pt-4">

                

                {{-- Helper để xác định liên kết đang active --}}

                @php

                    $currentPath = Request::path();

                    $baseClass = 'flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-600 transition duration-150';

                    $activeClass = 'flex items-center space-x-3 p-3 rounded-lg bg-green-100 text-green-800 font-bold transition duration-150';

                @endphp



                {{-- LỊCH KHÁM --}}

                <a href="{{ route('dashboard.doctor', ['id' => Auth::id()]) }}"  

                   class="{{ Str::startsWith($currentPath, 'appointments') ? $activeClass : $baseClass }}">

                    <span class="text-xl">📅</span>

                    <span>Lịch khám</span>

                </a>
                {{-- HỒ SƠ KHÁM --}}

                <a href="{{ url('/medical-records') }}" 

                   class="{{ Str::startsWith($currentPath, 'medical-records') ? $activeClass : $baseClass }}">

                    <span class="text-xl">📄</span>

                    <span>Hồ sơ khám</span>

                </a>

                

                {{-- LỊCH LÀM VIỆC --}}

                <a href="{{ url('/doctor/schedule') }}" 

                   class="{{ Str::startsWith($currentPath, 'doctor/schedule') ? $activeClass : $baseClass }}">

                    <span class="text-xl">⏱️</span>

                    <span>Lịch làm việc</span>

                </a>



                {{-- BÁO CÁO --}}

                <a href="{{ url('/doctor/reports') }}" 

                   class="{{ Str::startsWith($currentPath, 'doctor/reports') ? $activeClass : $baseClass }}">

                    <span class="text-xl">📊</span>

                    <span>Báo cáo</span>

                </a>



                {{-- HỒ SƠ CÁ NHÂN --}}

                <a href="{{ route('doctor.profile.show', Auth::id()) }}"

                   class="{{ Str::startsWith($currentPath, '/profile') ? $activeClass : $baseClass }}">

                    <span class="text-xl">⚙️</span>

                    <span>Hồ sơ cá nhân</span>

                </a>

            </div>

            

            {{-- Thông tin thêm/Footer Sidebar --}}

            <div class="absolute bottom-4 left-4 text-sm text-gray-500">

                <p>&copy; 2025 Clinic System</p>

            </div>

        </aside>



        {{-- MAIN CONTENT --}}

        <main class="flex-1 p-6">

            {{-- Flash Message --}}

            @if(session('success'))

                <div id="flash-success" class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 font-medium shadow-md border-l-4 border-green-500">

                    {{ session('success') }}

                </div>

            @endif



            @yield('content')

        </main>

    </div> {{-- Kết thúc div.flex --}}



    {{-- Script --}}

    <script>

        // Tự động ẩn flash message sau 3 giây

        setTimeout(() => { 

            const s = document.getElementById('flash-success'); 

            if(s) s.style.opacity = 0;

            setTimeout(() => { if(s) s.remove(); }, 500); // Đợi opacity transition kết thúc

        }, 3000);

    </script>

</body>

</html>