@extends('layouts.staff')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6 text-center">👩‍💼 Quản lý lịch hẹn (Nhân viên)</h1>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
    @endif

    {{-- Lịch hẹn đã duyệt --}}
    <h2 class="text-green-600 text-xl font-bold mb-2">✅ Lịch hẹn đã duyệt</h2>
    @include('staffs._appointments_table', ['appointments' => $confirmedAppointments])

    {{-- Lịch hẹn chờ duyệt --}}
    <h2 class="text-yellow-600 text-xl font-bold mb-2">⏳ Lịch hẹn chờ duyệt</h2>
    @include('staffs._appointments_table', ['appointments' => $pendingAppointments])

    {{-- Lịch hẹn đã hủy --}}
    <h2 class="text-red-600 text-xl font-bold mb-2">❌ Lịch hẹn đã hủy</h2>
    @include('staffs._appointments_table', ['appointments' => $cancelledAppointments])
</div>
@endsection
