@extends('layouts.patient')

@section('content')
    <h1 class="text-2xl font-bold mb-3">Trang chủ bệnh nhân</h1>
    <p>Xin chào, {{ auth()->user()->name }}.</p>

    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="{{ route('patients.show') }}" class="p-4 border rounded hover:shadow">Hồ sơ cá nhân</a>
        <a href="{{ route('appointments.index') }}" class="p-4 border rounded hover:shadow">Lịch hẹn</a>

        <a href="{{ url('/medical-records') }}" class="p-4 border rounded hover:shadow">Kết quả khám</a>
        <a href="#" class="p-4 border rounded hover:shadow">Nhắc lịch (cấu hình)</a>
    </div>
@endsection
