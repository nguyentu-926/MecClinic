@extends('layouts.auth')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Quên mật khẩu</h2>

    <form action="{{ url('/forgot-password') }}" method="POST" class="space-y-3">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email đăng ký"
               class="w-full border rounded p-2">
        <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded">Gửi link khôi phục</button>
    </form>

    <div class="mt-4 text-sm">
        <a href="{{ url('/login') }}" class="text-blue-600">Quay lại đăng nhập</a>
    </div>
@endsection
