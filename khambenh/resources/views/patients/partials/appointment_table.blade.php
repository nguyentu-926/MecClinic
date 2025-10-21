{{-- Bảng lịch hẹn dùng chung (Đã đồng bộ) --}}
@if($appointments->isEmpty())
    {{-- Đồng bộ thông báo khi không có lịch hẹn --}}
    <div class="p-6 bg-white border-l-4 border-blue-500 text-gray-700 rounded-lg shadow-md">
        <p class="font-medium text-center">Không có lịch hẹn nào.</p>
    </div>
@else
<div class="overflow-x-auto shadow-xl rounded-lg">
    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="tat-table-header tat-table-cell w-12">STT</th>
                <th class="tat-table-header tat-table-cell w-28">Ngày</th>
                <th class="tat-table-header tat-table-cell w-20">Giờ</th>
                <th class="tat-table-header tat-table-cell">Bác sĩ</th>
                <th class="tat-table-header tat-table-cell w-28">Khoa</th>
                <th class="tat-table-header tat-table-cell w-20">Phòng</th>
                <th class="tat-table-header tat-table-cell w-36">Trạng thái</th>
                <th class="tat-table-header tat-table-cell">Triệu chứng/Lý do khám</th>
                <th class="tat-table-header tat-table-cell">Lý do hủy</th>
                <th class="tat-table-header tat-table-cell w-36">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $index => $appointment)
            <tr class="tat-table-row">
                <td class="tat-table-cell text-center">{{ $index + 1 }}</td>
                <td class="tat-table-cell">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                <td class="tat-table-cell">{{ $appointment->appointment_time }}</td>
                <td class="tat-table-cell font-medium text-gray-800">{{ $appointment->doctor->user->name ?? 'Không xác định' }}</td>
                <td class="tat-table-cell">{{ $appointment->doctor->specialization ?? '—' }}</td>
                <td class="tat-table-cell text-center">{{ $appointment->room }}</td>

                {{-- Trạng thái (Đã đồng bộ với status-tag) --}}
                <td class="tat-table-cell">
                    @if($appointment->status === 'pending')
                        {{-- Sử dụng class pending đã được tạo style màu cam nhạt --}}
                        <span class="status-tag status-pending">Chờ duyệt</span>
                    @elseif($appointment->status === 'confirmed')
                        <span class="status-tag status-confirmed">Đã duyệt ✅</span>
                    @elseif($appointment->status === 'cancelled')
                        <span class="status-tag status-cancelled">Đã hủy ❌</span>
                    @endif
                </td>

                <td class="tat-table-cell text-sm max-w-xs">{{ Str::limit($appointment->notes ?? '—', 50) }}</td>
                <td class="tat-table-cell text-sm max-w-xs">{{ Str::limit($appointment->cancel_reason ?? '—', 50) }}</td>

                {{-- Hành động (Đã đồng bộ với action buttons) --}}
                <td class="tat-table-cell flex flex-col sm:flex-row gap-2 justify-center">
                    @if($appointment->status === 'pending')
                        {{-- Nút Sửa (Màu cam chủ đạo) --}}
                        <a href="{{ route('appointments.edit', $appointment->id) }}" 
                           class="tat-action-button edit">
                            Sửa
                        </a>
                        
                        {{-- Form Hủy (Màu đỏ) --}}
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Bạn có chắc muốn hủy lịch hẹn này? Hành động này không thể hoàn tác.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="tat-action-button cancel">Hủy</button>
                        </form>
                    @else
                        <span class="text-gray-500 text-sm">—</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif