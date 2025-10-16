@extends('layouts.auth')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Đăng ký (Bệnh nhân)</h2>

    <form action="{{ url('/register') }}" method="POST" class="space-y-3">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Họ và tên"
               class="w-full border rounded p-2">
        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email"
               class="w-full border rounded p-2">
        <input type="password" name="password" required placeholder="Mật khẩu (min 6 ký tự)"
               class="w-full border rounded p-2">
        <input type="password" name="password_confirmation" required placeholder="Nhập lại mật khẩu"
               class="w-full border rounded p-2">
        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại"
               class="w-full border rounded p-2">
        <input type="text" name="address" value="{{ old('address') }}" placeholder="Địa chỉ"
               class="w-full border rounded p-2">

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded">Đăng ký</button>
    </form>

    <div class="mt-4 text-sm">
        <a href="{{ url('/login') }}" class="text-blue-600">Đã có tài khoản? Đăng nhập</a>
    </div>
@endsection
