<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Doctor | Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-green-100 border-b">
    <div class="max-w-5xl mx-auto flex items-center justify-between p-4">
        <div class="flex items-center space-x-4">
            <span class="text-2xl">👨‍⚕️</span>
            <a href="{{ route('dashboard.doctor', ['id' => Auth::id()]) }}" 
               class="font-semibold text-lg">
               Doctor Panel
            </a>
        </div>
        <nav class="space-x-4">
            <a href="{{ route('doctor.profile.edit', Auth::id()) }}" class="text-green-800">
                Hồ sơ cá nhân
            </a>
            <a href="{{ url('/appointments') }}" class="text-green-800">Lịch khám</a>
            <a href="{{ url('/patients') }}" class="text-green-800">Bệnh nhân</a>
            <a href="{{ url('/medical-records') }}" class="text-green-800">Hồ sơ khám</a>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">
                    Đăng xuất
                </button>
            </form>
        </nav>
    </div>
</header>


    <main class="max-w-5xl mx-auto p-6">
        @if(session('success'))
            <div id="flash-success" class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        setTimeout(() => { 
            const s = document.getElementById('flash-success'); 
            if (s) s.remove(); 
        }, 3000);
    </script>
</body>
</html>
