<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin | Clinic</title>
    {{-- Đổi CDN Tailwind để hỗ trợ cấu hình tùy chỉnh tốt hơn --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Thêm thư viện icon fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        /* Thiết lập chiều cao cho sidebar */
        .sidebar {
            /* 100% viewport height trừ đi chiều cao header (64px) */
            height: calc(100vh - 64px); 
            top: 64px;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen"> 

    {{-- KHỐI HEADER TRÊN CÙNG (Cố định, màu đỏ/đen Admin) --}}
    <header class="bg-gray-800 text-white shadow-xl sticky top-0 z-20 h-16">
        <div class="max-w-full mx-auto flex items-center justify-between p-4 px-6">
            <div class="flex items-center space-x-4">
                <span class="text-3xl font-extrabold text-red-500">🛠️</span>
                <a href="{{ route('dashboard.admin', ['id' => Auth::id()]) }}" class="text-xl font-semibold tracking-wide text-red-100 hover:text-white">
                    ADMIN DASHBOARD
                </a>
            </div>
            
            {{-- Nút Đăng xuất ở góc phải --}}
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 transition duration-200 text-white px-4 py-1.5 rounded-lg font-medium shadow-md">
                    <i class="fas fa-sign-out-alt mr-1"></i> Đăng xuất
                </button>
            </form>
        </div>
    </header>

    {{-- KHỐI CHÍNH: SIDEBAR + NỘI DUNG --}}
    <div class="flex">

        {{-- SIDEBAR (Thanh điều hướng bên, cố định) --}}
        <aside class="w-64 bg-white shadow-xl p-4 sticky sidebar z-10">
            <div class="space-y-1 pt-4">
                
                {{-- Dashboard link --}}
                <a href="{{ route('dashboard.admin', ['id' => Auth::id()]) }}" 
                    class="flex items-center space-x-3 p-3 rounded-lg bg-gray-100 text-gray-800 font-bold transition duration-150 border-l-4 border-red-600">
                    <span class="text-xl text-red-600"><i class="fas fa-tachometer-alt"></i></span>
                    <span>Dashboard</span>
                </a>
                
                {{-- LIÊN KẾT: QUẢN LÝ USER --}}
                <a href="{{ route('admin.users.index') }}" 
                    class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                    <span class="text-xl"><i class="fas fa-users"></i></span>
                    <span>Quản lý User</span>
                </a>

                {{-- LIÊN KẾT: DANH SÁCH BỆNH NHÂN --}}
                <a href="{{ route('admin.patients.index') }}" 
                    class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                    <span class="text-xl"><i class="fas fa-bed"></i></span>
                    <span>Danh sách Bệnh nhân</span>
                </a>
                
                {{-- LIÊN KẾT: DANH SÁCH BÁC SĨ --}}
                <a href="{{ url('/admin/doctors') }}" 
                    class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                    <span class="text-xl"><i class="fas fa-user-md"></i></span>
                    <span>Danh sách Bác sĩ</span>
                </a>

                {{-- LIÊN KẾT: QUẢN LÝ STAFF --}}
                <a href="{{ route('admin.staffs.index') }}" 
                    class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                    <span class="text-xl"><i class="fas fa-user-tie"></i></span>
                    <span>Quản lý Staff</span>

                <hr class="my-2 border-gray-200">
                <a href="{{ url('/admin/appointments') }}" 
                    class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                    <span class="text-xl"><i class="fas fa-calendar-check"></i></span>
                    <span>Quản lý Lịch hẹn</span>
                </a>

                {{-- LIÊN KẾT: THỐNG KÊ --}}
                <a href="{{ url('/admin/statistics') }}" 
                    class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                    <span class="text-xl"><i class="fas fa-chart-line"></i></span>
                    <span>Thống kê / Báo cáo</span>
                </a>
                
                {{-- LIÊN KẾT: LOGS --}}
                <a href="{{ url('/admin/logs') }}" 
                    class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                    <span class="text-xl"><i class="fas fa-history"></i></span>
                    <span>Logs Hệ thống</span>
                </a>

            </div>
            
            {{-- Thông tin thêm/Footer Sidebar --}}
            <div class="absolute bottom-4 left-4 text-sm text-gray-500">
                <p>&copy; 2025 Admin Control</p>
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