@extends('layouts.patient')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Sửa lịch hẹn</h2>

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium">Ngày hẹn</label>
            <input type="text" class="border p-2 w-full bg-gray-100" value="{{ $appointment->appointment_date }}" disabled>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Giờ hẹn</label>
            <input type="text" name="appointment_time" class="border p-2 w-full" value="{{ old('appointment_time', $appointment->appointment_time) }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Ghi chú</label>
            <textarea name="notes" class="border p-2 w-full" rows="3">{{ old('notes', $appointment->notes) }}</textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
            <a href="{{ route('patients.appointments', auth()->user()->patient->id) }}" class="bg-gray-300 px-4 py-2 rounded">Hủy</a>
        </div>
    </form>
</div>
@endsection
