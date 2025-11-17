{{-- resources/views/staffs/_appointments_table.blade.php --}}

<style>
/* Đảm bảo style cho header bảng được định nghĩa trong file CSS chính hoặc các file blade ngoài */
.tat-table-head {
    background-color: #004d99; /* Xanh đậm */
    color: white;
}
/* Style nút hành động cho các trang quản lý */
.btn-tat-action {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    transition: background-color 0.2s;
    white-space: nowrap;
}
.btn-tat-approve {
    background-color: #10b981; /* Xanh lá cây */
    color: white;
}
.btn-tat-approve:hover {
    background-color: #059669;
}

/* Căn giữa ô trong bảng */
.table-data-center {
    text-align: center;
}
</style>

<table class="w-full text-sm text-left text-gray-700 border-collapse">
    <thead class="text-xs uppercase tat-table-head">
        <tr class="text-center">
            <th class="p-3 border">STT</th>
            <th class="p-3 border">Bệnh nhân</th>
            <th class="p-3 border">Ngày sinh</th>
            <th class="p-3 border">Giới tính</th>
            <th class="p-3 border">Quê quán</th>
            <th class="p-3 border">SĐT</th>
            <th class="p-3 border">Ngày khám</th>
            <th class="p-3 border">Giờ khám</th>
            <th class="p-3 border">Bác sĩ</th>
            <th class="p-3 border">Phòng</th>
            <th class="p-3 border">Trạng thái Staff</th>
            <th class="p-3 border">Trạng thái Bác sĩ</th>
            <th class="p-3 border w-32">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @forelse($appointments as $appointment)
        <tr class="border-b hover:bg-gray-50 align-middle">
            <td class="border p-3 table-data-center font-medium">{{ $i++ }}</td>
            <td class="border p-3 font-semibold whitespace-nowrap">{{ $appointment->patient->user->name ?? '-' }}</td>
            <td class="border p-3 table-data-center">{{ date('d/m/Y', strtotime($appointment->patient->date_of_birth)) ?? '-' }}</td>
            <td class="border p-3 table-data-center">
                @switch($appointment->patient->gender)
                    @case('male') Nam @break
                    @case('female') Nữ @break
                    @case('other') Khác @break
                    @default - 
                @endswitch
            </td>
            <td class="border p-3">{{ $appointment->patient->address ?? '-' }}</td>
            <td class="border p-3 table-data-center">{{ $appointment->patient->phone ?? '-' }}</td>
            <td class="border p-3 table-data-center font-bold text-blue-700">{{ date('d/m/Y', strtotime($appointment->appointment_date)) }}</td>
            <td class="border p-3 table-data-center font-bold text-orange-600">{{ $appointment->appointment_time }}</td>
            <td class="border p-3">{{ $appointment->doctor->user->name ?? '-' }}</td>
            <td class="border p-3 table-data-center">{{ $appointment->room }}</td>

            {{-- Trạng thái Staff --}}
            <td class="border p-3 table-data-center">
                @if($appointment->status === 'confirmed') 
                    <span class="font-bold text-green-600">Đã duyệt</span>
                @elseif($appointment->status === 'pending') 
                    <span class="font-semibold text-yellow-600">Chờ duyệt</span>
                @elseif($appointment->status === 'cancelled') 
                    <span class="font-bold text-red-600">Đã hủy</span>
                @else 
                    - 
                @endif
            </td>

            {{-- Trạng thái Bác sĩ --}}
            <td class="border p-3 table-data-center">
                @if($appointment->doctor_status === 'accepted') 
                    <span class="text-green-500">Chấp nhận</span>
                @elseif($appointment->doctor_status === 'cancelled') 
                    <span class="text-red-500">Hủy</span>
                @elseif($appointment->doctor_status === null) 
                    <span class="text-gray-500">Chưa phản hồi</span>
                @else 
                    - 
                @endif
            </td>

            {{-- Hành động --}}
            <td class="border p-3 table-data-center">
                @if($appointment->status === 'pending' && $appointment->doctor_status !== null && $appointment->doctor_status !== 'cancelled')
                    {{-- Chỉ hiện nút Duyệt nếu Staff Pending VÀ Bác sĩ đã phản hồi (Accepted) --}}
                    <form action="{{ route('staff.appointments.approve', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                                class="btn-tat-action btn-tat-approve">
                            Duyệt
                        </button>
                    </form>
                @elseif($appointment->status === 'confirmed')
                    <span class="text-green-600 font-semibold">Đã duyệt</span>
                @elseif($appointment->status === 'cancelled')
                    <span class="text-red-600 font-semibold">Đã hủy</span>
                @else
                    <span class="text-gray-500 italic">Đợi phản hồi BS</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="13" class="text-center p-4 text-lg font-semibold text-gray-500 bg-gray-50">
                <p class="py-2">Không có lịch hẹn nào thỏa mãn điều kiện.</p>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>