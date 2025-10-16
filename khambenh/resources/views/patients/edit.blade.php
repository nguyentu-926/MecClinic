@extends('layouts.patient')

@section('content')
<h2 class="text-2xl font-bold mb-4">Hồ sơ cá nhân</h2>

@if(session('success'))
    <div class="bg-green-200 p-2 rounded mb-4">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('patients.update') }}" class="space-y-4">
    @csrf
    @method('PUT')

    {{-- Họ và tên --}}
    <div>
        <label class="block font-medium">Họ và tên</label>
        <input type="text" name="full_name" 
               value="{{ old('full_name', Auth::user()->name) }}" 
               class="w-full border px-3 py-2 rounded">
        @error('full_name') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Số điện thoại --}}
    <div>
        <label class="block font-medium">Số điện thoại</label>
        <input type="text" name="phone" 
               value="{{ old('phone', $patient->phone) }}" 
               class="w-full border px-3 py-2 rounded">
        @error('phone') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Địa chỉ --}}
    <div>
        <label class="block font-medium">Địa chỉ</label>
        <input type="text" name="address" 
               value="{{ old('address', $patient->address) }}" 
               class="w-full border px-3 py-2 rounded">
        @error('address') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Ngày sinh --}}
    <div>
        <label class="block font-medium">Ngày sinh</label>
        <input type="date" name="date_of_birth" 
               value="{{ old('date_of_birth', $patient->date_of_birth) }}" 
               class="w-full border px-3 py-2 rounded">
        @error('date_of_birth') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Giới tính --}}
    <div>
        <label class="block font-medium">Giới tính</label>
        <select name="gender" class="w-full border px-3 py-2 rounded">
            <option value="">Chọn giới tính</option>
            <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Nam</option>
            <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
            <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>Khác</option>
        </select>
        @error('gender') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
        Cập nhật
    </button>
</form>
@endsection
