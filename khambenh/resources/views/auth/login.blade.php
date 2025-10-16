@extends('layouts.auth')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Đăng nhập</h2>

    <form action="{{ url('/login') }}" method="POST" class="space-y-3">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email"
               class="w-full border rounded p-2">
        <input type="password" name="password" required placeholder="Mật khẩu"
               class="w-full border rounded p-2">
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Đăng nhập</button>
    </form>

    <div class="mt-4 text-sm">
        <a href="{{ url('/forgot-password') }}" class="text-blue-600">Quên mật khẩu?</a>
        <span class="mx-2">|</span>
        <a href="{{ url('/register') }}" class="text-blue-600">Đăng ký (Bệnh nhân)</a>
    </div>
@endsection
