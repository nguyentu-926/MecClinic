<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Staff | Clinic</title>
    {{-- Đổi CDN Tailwind để hỗ trợ cấu hình tùy chỉnh tốt hơn --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Thiết lập chiều cao cho sidebar */
        .sidebar {
            height: calc(100vh - 64px); /* 100% viewport height trừ đi chiều cao header (64px = p-4 * 2) */
            top: 64px;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen"> {{-- Nền hơi xám --}}

    {{-- KHỐI HEADER TRÊN CÙNG (Cố định, màu xanh y tế) --}}
    <header class="bg-blue-800 text-white shadow-lg sticky top-0 z-20 h-16">
        <div class="max-w-full mx-auto flex items-center justify-between p-4 px-6">
            <div class="flex items-center space-x-4">
                <span class="text-3xl font-extrabold text-yellow-300">🏥</span>
                <a href="{{ route('staff.appointments.all') }}" class="text-xl font-semibold tracking-wide">
                    STAFF DASHBOARD
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
                
                {{-- LIÊN KẾT: HỒ SƠ CÁ NHÂN (MỚI) --}}
                @php
                    // Lấy tên route hiện tại để xác định liên kết đang active
                    $currentRouteName = Route::currentRouteName();
                    $isProfileActive = $currentRouteName == 'staff.profile';
                @endphp
    

                {{-- LIÊN KẾT: QUẢN LÝ LỊCH HẸN --}}
                <a href="{{ route('staff.appointments.all') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-150 
                   {{ Str::startsWith($currentRouteName, 'staff.appointments') ? 'bg-blue-100 text-blue-800 font-bold' : '' }}">
                    <span class="text-xl">📅</span>
                    <span>Quản lý lịch hẹn</span>
                </a>

                {{-- LIÊN KẾT: TẠO HỒ SƠ KHÁM --}}
                <a href="{{ route('staff.medical_records.list') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-150 
                   {{ $currentRouteName == 'staff.medical_records.list' ? 'bg-blue-100 text-blue-800 font-bold' : '' }}">
                    <span class="text-xl">🩺</span>
                    <span>Tạo hồ sơ khám</span>
                </a>
                
                {{-- LIÊN KẾT: NHẮC LỊCH HẸN --}}
                <a href="{{ route('staff.reminders') }}"
                   class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-150
                   {{ $currentRouteName == 'staff.reminders' ? 'bg-blue-100 text-blue-800 font-bold' : '' }}">
                    <span class="text-xl">📩</span>
                    <span>Nhắc lịch hẹn</span>
                </a>

                {{-- LIÊN KẾT: QUẢN LÝ PHÒNG --}}
                <a href="{{ route('rooms.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-150
                   {{ $currentRouteName == 'rooms.index' ? 'bg-blue-100 text-blue-800 font-bold' : '' }}">
                    <span class="text-xl">🚪</span>
                    <span>Quản lý phòng</span>
                </a>
                <a href="{{ route('staff.profile.show') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-150 {{ $isProfileActive ? 'bg-blue-100 text-blue-800 font-bold' : '' }}">
                    <span class="text-xl">👤</span>
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
            if(s) {
                s.style.transition = 'opacity 0.5s ease-in-out';
                s.style.opacity = 0;
                setTimeout(() => { s.remove(); }, 500); // Đợi opacity transition kết thúc
            }
        }, 3000);
    </script>
</body>
</html>