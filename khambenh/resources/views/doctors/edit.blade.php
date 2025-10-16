@extends('layouts.doctor')

@section('content')
<h1 class="text-2xl font-bold mb-4">Chỉnh sửa hồ sơ của tôi</h1>

@if(session('success'))
<div class="mb-4 p-3 rounded bg-green-100 text-green-800">
    {{ session('success') }}
</div>
@endif

{{-- Hiển thị tên bác sĩ --}}
<h2 class="text-xl font-semibold mb-2">
    Hồ sơ của: {{ $doctor->user->name ?? 'Không xác định' }}
</h2>

<form action="{{ route('doctor.profile.update', $doctor->user_id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
    @csrf
    @method('PUT')
    
    <div>
        <label>Học vị (degree)</label>
        <input type="text" name="degree" value="{{ old('degree',$doctor->degree) }}" class="border px-2 py-1 w-full">
    </div>
    <div>
        <label>Học hàm (title)</label>
        <input type="text" name="title" value="{{ old('title',$doctor->title) }}" class="border px-2 py-1 w-full">
    </div>
    <div>
        <label>Chuyên môn</label>
        <input type="text" name="specialization" value="{{ old('specialization',$doctor->specialization) }}" class="border px-2 py-1 w-full">
    </div>
    <div>
        <label>Kinh nghiệm (năm)</label>
        <input type="number" name="experience" value="{{ old('experience',$doctor->experience) }}" class="border px-2 py-1 w-full">
    </div>
    <div>
        <label>Giờ làm việc</label>
        <input type="text" name="working_hours" value="{{ old('working_hours',$doctor->working_hours) }}" class="border px-2 py-1 w-full">
    </div>
    <div>
        <label>Phòng</label>
        <input type="text" name="room" value="{{ old('room',$doctor->room) }}" class="border px-2 py-1 w-full">
    </div>
    <div>
        <label>Địa chỉ</label>
        <input type="text" name="address" value="{{ old('address',$doctor->address) }}" class="border px-2 py-1 w-full">
    </div>
    <div>
        <label>Quê quán</label>
        <input type="text" name="hometown" value="{{ old('hometown',$doctor->hometown) }}" class="border px-2 py-1 w-full">
    </div>
    <div>
        <label>Ảnh đại diện</label>
        <input type="file" name="photo" class="border px-2 py-1 w-full">
        @if($doctor->photo)
            <img src="{{ asset('storage/'.$doctor->photo) }}" class="w-24 h-24 mt-2">
        @endif
    </div>
    <div>
        <label>Ghi chú</label>
        <textarea name="notes" class="border px-2 py-1 w-full">{{ old('notes',$doctor->notes) }}</textarea>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
</form>
@endsection
