<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Auth | Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
        {{-- Flash (success / error) --}}
        @if(session('success'))
            <div id="flash-success" 
                 class="mb-3 px-3 py-2 rounded text-sm bg-green-500 text-white text-center shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div id="flash-error" 
                 class="mb-3 px-3 py-2 rounded text-sm bg-red-500 text-white text-center shadow">
                {{ session('error') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-3 px-3 py-2 rounded text-sm bg-red-100 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        // 3 giây tự ẩn flash
        setTimeout(() => {
            const s = document.getElementById('flash-success');
            const e = document.getElementById('flash-error');
            if (s) s.style.display = 'none';
            if (e) e.style.display = 'none';
        }, 600);
    </script>
</body>
</html>
