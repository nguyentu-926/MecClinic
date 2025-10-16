@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
  <h1>Xin chào  {{ $user->name }}</h1>


  <h2 class="text-xl font-semibold mt-6">📋 Lịch hẹn gần đây</h2>
  <table class="w-full border mt-2">
      <tr class="bg-gray-100">
          <th class="p-2 border">Bệnh nhân</th>
          <th class="p-2 border">Bác sĩ</th>
          <th class="p-2 border">Thời gian</th>
          <th class="p-2 border">Trạng thái</th>
      </tr>
      @foreach($appointments as $appt)
      <tr>
          <td class="p-2 border">{{ $appt->patient->user->name ?? 'N/A' }}</td>
          <td class="p-2 border">{{ $appt->doctor->user->name ?? 'N/A' }}</td>
          <td class="p-2 border">{{ $appt->appointment_date }} {{ $appt->appointment_time }}</td>
          <td class="p-2 border">{{ $appt->status }}</td>
      </tr>
      @endforeach
  </table>

  <h2 class="text-xl font-semibold mt-6">👥 Người dùng mới</h2>
  <ul class="list-disc ml-6">
      @foreach($users as $u)
          <li>{{ $u->name }} - {{ $u->email }}</li>
      @endforeach
  </ul>
@endsection
