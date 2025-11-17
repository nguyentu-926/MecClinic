@extends('layouts.staff')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Chỉnh sửa phòng bác sĩ: {{ $doctor->user->name }}</h1>

    <form action="{{ route('staffs.rooms.update', $doctor) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Phòng:</label>
        <input type="text" name="room" value="{{ old('room', $doctor->room) }}" class="border p-2 w-full mb-4">

        @error('room')
            <div class="text-red-600 mb-2">{{ $message }}</div>
        @enderror

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Cập nhật
        </button>
        <a href="{{ route('staffs.rooms') }}" class="ml-2 px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
            Hủy
        </a>
    </form>
</div>
@endsection
