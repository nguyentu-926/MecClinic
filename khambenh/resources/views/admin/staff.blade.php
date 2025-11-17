@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto py-8 px-4 bg-white shadow-lg rounded-lg mt-8">
    
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
        <i class="fas fa-user-plus mr-2 text-blue-600"></i> Thêm Nhân viên mới
    </h2>

    {{-- Hiển thị thông báo lỗi/thành công nếu có --}}
    @if ($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-300">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.staff.store') }}" method="POST">
        @csrf
        
        {{-- Tên --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên:</label>
            <input type="text" name="name" id="name" 
                   class="border px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" 
                   value="{{ old('name') }}" required>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
            <input type="email" name="email" id="email" 
                   class="border px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" 
                   value="{{ old('email') }}" required>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mật khẩu (Quan trọng khi tạo tài khoản) --}}
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu:</label>
            <input type="password" name="password" id="password" 
                   class="border px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror" 
                   required>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Số điện thoại --}}
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại:</label>
            <input type="text" name="phone" id="phone" 
                   class="border px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror" 
                   value="{{ old('phone') }}">
            @error('phone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Vị trí (Chức vụ) --}}
        <div class="mb-4">
            <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Vị trí:</label>
            <select name="position" id="position" 
                    class="border px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('position') border-red-500 @enderror" required>
                <option value="">-- Chọn vị trí --</option>
                <option value="Reception" {{ old('position') == 'Reception' ? 'selected' : '' }}>Nhân viên Tiếp tân</option>
                <option value="Nurse" {{ old('position') == 'Nurse' ? 'selected' : '' }}>Y tá</option>
                <option value="Technician" {{ old('position') == 'Technician' ? 'selected' : '' }}>Kỹ thuật viên</option>
                {{-- Có thể thêm các vị trí khác --}}
            </select>
            @error('position')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Địa chỉ --}}
        <div class="mb-6">
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ:</label>
            <input type="text" name="address" id="address" 
                   class="border px-3 py-2 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror" 
                   value="{{ old('address') }}">
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nút Lưu --}}
        <button type="submit" 
                class="w-full bg-green-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 shadow-md">
            <i class="fas fa-save mr-2"></i> Lưu Nhân viên
        </button>
    </form>

</div>
@endsection