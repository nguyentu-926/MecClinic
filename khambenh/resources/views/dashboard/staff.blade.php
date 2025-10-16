@extends('layouts.staff')

@section('content')
<h1 class="text-2xl font-bold mb-4">Danh sách lịch hẹn chờ duyệt</h1>

@if(session('success'))
    <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
        {{ session('error') }}
    </div>
@endif

@if($appointments->isEmpty())
    <p>Hiện tại không có lịch hẹn nào.</p>
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
                <th class="px-2 py-1 border">Bác sĩ</th>
                <th class="px-2 py-1 border">Phòng</th>
                <th class="px-2 py-1 border">Trạng thái Staff</th>
                <th class="px-2 py-1 border">Trạng thái Bác sĩ</th>
                <th class="px-2 py-1 border">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($appointments as $appointment)
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
                <td class="border px-2 py-1">{{ $appointment->doctor->user->name ?? '-' }}</td>
                <td class="border px-2 py-1">{{ $appointment->room }}</td>

                <td class="border px-2 py-1">
                    {{ $appointment->status === 'pending' ? 'Chưa duyệt' : 'Đã duyệt' }}
                </td>

                <td class="border px-2 py-1">
                    @if($appointment->doctor_status === 'accepted')
                        Chấp nhận
                    @elseif($appointment->doctor_status === 'cancelled')
                        Hủy
                    @else
                        Chưa phản hồi
                    @endif
                </td>

                <td class="border px-2 py-1">
                    @if($appointment->status === 'pending')
                        @if($appointment->doctor_status !== null)
                            <form action="{{ route('staff.appointments.approve', $appointment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">
                                    Duyệt
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500">Bác sĩ chưa phản hồi</span>
                        @endif
                    @else
                        <span class="text-green-600">Đã duyệt</span>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
