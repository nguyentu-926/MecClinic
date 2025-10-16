<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin | Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-red-100 border-b">
        <div class="max-w-6xl mx-auto flex items-center justify-between p-4">
            <div class="flex items-center space-x-4">
                <span class="text-2xl">🛠️</span>
                <a href="{{ route('dashboard.admin', ['id' => Auth::id()]) }}">Admin Dashboard</a>
            </div>
            <nav class="space-x-4">
                <a href="{{ url('/admin/users') }}" class="text-red-800">Quản lý user</a>
                <a href="{{ url('/admin/statistics') }}" class="text-red-800">Thống kê</a>
                <a href="{{ url('/admin/logs') }}" class="text-red-800">Logs</a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-gray-800 text-white px-3 py-1 rounded">Đăng xuất</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="max-w-6xl mx-auto p-6">
        @if(session('success'))
            <div id="flash-success" class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        setTimeout(() => { const s=document.getElementById('flash-success'); if(s) s.remove(); }, 3000);
    </script>
</body>
</html>
