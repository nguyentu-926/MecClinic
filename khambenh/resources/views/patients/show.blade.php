@extends('layouts.patient')

@section('content')
<h2 class="text-2xl font-bold mb-4">Hồ sơ cá nhân</h2>

@if(session('success'))
    <div class="bg-green-200 p-2 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="bg-white p-4 rounded shadow max-w-md space-y-2">
    <p><strong>Họ và tên:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Số điện thoại:</strong> {{ $patient->phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $patient->address }}</p>
    <p><strong>Ngày sinh:</strong> {{ $patient->date_of_birth }}</p>
    <p><strong>Giới tính:</strong> 
        {{ $patient->gender == 'male' ? 'Nam' : ($patient->gender == 'female' ? 'Nữ' : 'Khác') }}
    </p>

    <a href="{{ route('patients.edit') }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
        Chỉnh sửa
    </a>
</div>
@endsection
