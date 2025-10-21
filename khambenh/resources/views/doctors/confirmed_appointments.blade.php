@extends('layouts.doctor')

@section('content')
<div class="container mx-auto py-6">
    <div class="flex justify-center gap-3 mb-6">
        <a href="{{ route('doctors.appointments.all', Auth::id()) }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Tổng thể</a>
        <a href="{{ route('doctors.appointments.confirmed', Auth::id()) }}" 
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Đã chấp nhận</a>
        <a href="{{ route('doctors.appointments.pending', Auth::id()) }}" 
           class="px-4 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500 transition">Chờ duyệt</a>
        <a href="{{ route('doctors.appointments.cancelled', Auth::id()) }}" 
           class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Đã hủy</a>
    </div>

    <h2 class="text-center mb-4 text-green-600 text-xl font-bold">✅ Lịch hẹn đã chấp nhận</h2>

    @include('doctors.appointments._table', ['appointments' => $confirmAppointments])

</div>
@endsection
