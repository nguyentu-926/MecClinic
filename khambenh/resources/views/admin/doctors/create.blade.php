@extends('layouts.admin')

@section('content')
<h2 class="text-2xl mb-4">Thêm Bác sĩ mới</h2>

<form action="{{ route('admin.doctors.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label>Tên:</label>
        <input type="text" name="name" class="border px-2 py-1 w-full" value="{{ old('name') }}">
    </div>
    <div class="mb-2">
        <label>Email:</label>
        <input type="email" name="email" class="border px-2 py-1 w-full" value="{{ old('email') }}">
    </div>
    <div class="mb-2">
        <label>Chuyên môn:</label>
        <input type="text" name="specialization" class="border px-2 py-1 w-full" value="{{ old('specialization') }}">
    </div>
    <div class="mb-2">
        <label>Phòng:</label>
        <input type="text" name="room" class="border px-2 py-1 w-full" value="{{ old('room') }}">
    </div>
    <div class="mb-2">
        <label>Kinh nghiệm (năm):</label>
        <input type="number" name="experience" class="border px-2 py-1 w-full" value="{{ old('experience') }}">
    </div>
    <div class="mb-2">
        <label>Lịch làm việc:</label>
        <input type="text" name="working_hours" class="border px-2 py-1 w-full" value="{{ old('working_hours') }}">
    </div>

    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded mt-2">Lưu</button>
</form>
@endsection
