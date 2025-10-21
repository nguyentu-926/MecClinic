{{-- resources/views/staffs/_appointments_table.blade.php --}}
<table class="table-auto w-full border-collapse border border-gray-300 mb-6">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-2 py-1 border">STT</th>
            <th class="px-2 py-1 border">Bệnh nhân</th>
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
        @forelse($appointments as $appointment)
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
                @if($appointment->status === 'confirmed') Đã duyệt
                @elseif($appointment->status === 'pending') Chờ duyệt
                @elseif($appointment->status === 'cancelled') Đã hủy
                @else - @endif
            </td>

            <td class="border px-2 py-1">
                @if($appointment->doctor_status === 'accepted') Chấp nhận
                @elseif($appointment->doctor_status === 'cancelled') Hủy
                @elseif($appointment->doctor_status === null) Chưa phản hồi
                @else - @endif
            </td>

            <td class="border px-2 py-1">
                @if($appointment->status === 'pending' && $appointment->doctor_status !== null)
                    <form action="{{ route('staff.appointments.approve', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            Duyệt
                        </button>
                    </form>
                @elseif($appointment->status === 'confirmed')
                    <span class="text-green-600">Đã duyệt</span>
                @elseif($appointment->status === 'cancelled')
                    <span class="text-red-600">Đã hủy</span>
                @else
                    <span class="text-gray-500">Chờ phản hồi</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="13" class="text-center text-gray-500">Không có lịch hẹn</td>
        </tr>
        @endforelse
    </tbody>
</table>
