@extends('layouts.doctor')

@section('content')
<h1 class="text-2xl font-bold mb-4">Lịch hẹn của tôi</h1>

@if(session('success'))
    <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
@endif

@if($appointments->isEmpty())
    <p>Chưa có lịch hẹn nào.</p>
@else
<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-2 py-1 border">STT</th>
            <th class="px-2 py-1 border">Tên bệnh nhân</th>
            <th class="px-2 py-1 border">Ngày sinh</th>
            <th class="px-2 py-1 border">Giới tính</th>
            <th class="px-2 py-1 border">Quê quán</th>
            <th class="px-2 py-1 border">SĐT</th>
            <th class="px-2 py-1 border">Ngày</th>
            <th class="px-2 py-1 border">Giờ</th>
            <th class="px-2 py-1 border">Phòng</th>
            <th class="px-2 py-1 border">Trạng thái</th>
            <th class="px-2 py-1 border">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($appointments as $appointment)
        @php
            $doctorStatus = $appointment->doctor_status ?? 'pending';
        @endphp
        <tr>
            <td class="border px-2 py-1">{{ $i++ }}</td>
            <td class="border px-2 py-1">{{ $appointment->patient->user->name ?? '-' }}</td>
            <td class="border px-2 py-1">{{ $appointment->patient->date_of_birth ?? '-' }}</td>
            <td class="border px-2 py-1">
                @switch($appointment->patient->gender)
                    @case('male') Nam @break
                    @case('female') Nữ @break
                    @case('other') Khác @break
                    @default - 
                @endswitch
            </td>
            <td class="border px-2 py-1">{{ $appointment->patient->address ?? '-' }}</td>
            <td class="border px-2 py-1">{{ $appointment->patient->phone ?? '-' }}</td>
            <td class="border px-2 py-1">{{ $appointment->appointment_date }}</td>
            <td class="border px-2 py-1">{{ $appointment->appointment_time }}</td>
            <td class="border px-2 py-1">{{ $appointment->room }}</td>

            {{-- Trạng thái --}}
            <td class="border px-2 py-1">
                @switch($doctorStatus)
                    @case('pending') Chưa duyệt @break
                    @case('accepted') Chấp nhận @break
                    @case('cancelled') Hủy @break
                    @default Chưa duyệt
                @endswitch
            </td>

            {{-- Hành động --}}
           <td class="border px-2 py-1 space-x-1">
    @if($doctorStatus === 'pending')
        {{-- Chấp nhận --}}
        <form method="POST" action="{{ route('doctor.appointment.updateStatus', $appointment->id) }}" class="inline">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="accepted">
            <button class="bg-green-500 text-white px-2 py-1 rounded">Chấp nhận</button>
        </form>

        {{-- Hủy với nhập lý do --}}
        <form method="POST" action="{{ route('doctor.appointment.updateStatus', $appointment->id) }}" class="inline cancel-form">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="cancelled">
            <input type="hidden" name="cancel_reason" class="cancel-reason">
            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hủy</button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.cancel-form').forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        let reason = prompt('Nhập lý do hủy lịch hẹn:');
                        if(reason !== null) { // nếu bấm Cancel, form ko gửi
                            form.querySelector('.cancel-reason').value = reason;
                            if(confirm('Bạn có chắc muốn hủy lịch này?')) {
                                form.submit();
                            }
                        }
                    });
                });
            });
        </script>
    @else
        <span>Đã phản hồi</span>
    @endif
</td>

        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
