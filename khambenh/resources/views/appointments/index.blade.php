@extends('layouts.patient')

@section('content')
<h1 class="text-2xl font-bold mb-3">Lịch hẹn của tôi</h1>

@if($appointments->isEmpty())
    <p>Bạn chưa có lịch hẹn nào.</p>
@else
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-3 py-2">STT</th>
                <th class="border border-gray-300 px-3 py-2">Ngày hẹn</th>
                <th class="border border-gray-300 px-3 py-2">Giờ</th>
                <th class="border border-gray-300 px-3 py-2">Bác sĩ</th>
                <th class="border border-gray-300 px-3 py-2">Khoa</th>
                <th class="border border-gray-300 px-3 py-2">Phòng</th>
                <th class="border border-gray-300 px-3 py-2">Trạng thái</th>
                <th class="border border-gray-300 px-3 py-2">Ghi chú</th> {{-- ghi chú bệnh nhân --}}
                <th class="border border-gray-300 px-3 py-2">Lý do hủy</th>
                <th class="border border-gray-300 px-3 py-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($appointments as $appointment)
            <tr>
                <td class="border border-gray-300 px-3 py-2">{{ $i++ }}</td>
                <td class="border border-gray-300 px-3 py-2">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                <td class="border border-gray-300 px-3 py-2">{{ $appointment->appointment_time }}</td>
                <td class="border border-gray-300 px-3 py-2">{{ $appointment->doctor && $appointment->doctor->user ? $appointment->doctor->user->name : 'Không xác định' }}</td>
                <td class="border border-gray-300 px-3 py-2">{{ $appointment->doctor ? $appointment->doctor->specialization : 'Chưa có' }}</td>
                <td class="border border-gray-300 px-3 py-2">{{ $appointment->room }}</td>

                {{-- Trạng thái --}}
                <td class="border px-2 py-1">
    @if($appointment->status === 'pending')
        @if($appointment->doctor_status === null)
            <span class="text-gray-600">Đang chờ phản hồi bác sĩ</span>
        @elseif($appointment->doctor_status === 'accepted')
            <span class="text-yellow-600">Bác sĩ đã chấp nhận, chờ nhân viên duyệt</span>
        @elseif($appointment->doctor_status === 'cancelled')
            <span class="text-red-600">Bác sĩ đã hủy, chờ nhân viên duyệt</span>
        @endif
    @elseif($appointment->status === 'confirmed')
        <span class="text-green-600 font-semibold">Đã chấp nhận ✅</span>
    @elseif($appointment->status === 'cancelled')
        <span class="text-red-600 font-semibold">Đã hủy lịch ❌</span>
    @endif
</td>


                {{-- Ghi chú bệnh nhân --}}
                <td class="border border-gray-300 px-3 py-2">{{ $appointment->notes ?? '-' }}</td>

                {{-- Lý do hủy --}}
                <td class="border border-gray-300 px-3 py-2">
                    @if($appointment->status === 'cancelled' && $appointment->cancel_reason)
                        {{ $appointment->cancel_reason }}
                    @else
                        -
                    @endif
                </td>

                {{-- Hành động --}}
                <td class="border border-gray-300 px-3 py-2 flex gap-2">
                    @if($appointment->status === 'pending' && $appointment->doctor_status !== 'cancelled')
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="px-2 py-1 bg-blue-500 text-white rounded">Sửa</a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" 
                              onsubmit="return confirm('Bạn có chắc muốn hủy lịch này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Hủy</button>
                        </form>
                    @else
                        <span class="text-gray-500">Không thể chỉnh sửa</span>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
@endif

<script>
function showNoteModal(note) {
    if(note) {
        alert(note);
    } else {
        alert('Không có thông tin.');
    }
}
</script>

@endsection
