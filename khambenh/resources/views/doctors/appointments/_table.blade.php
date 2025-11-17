@if($appointments->isEmpty())
    {{-- Đồng bộ hóa thông báo không có lịch hẹn (Đã đổi border thành xanh lá) --}}
    <div class="p-6 bg-white border-l-4 border-green-500 text-gray-700 rounded-lg shadow-md text-center">
        <p class="font-medium">Không có lịch hẹn nào.</p>
    </div>
@else

<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO BẢNG & TRẠNG THÁI (DOCTOR) */
/* ------------------------------------------- */

/* HEADER BẢNG */
.tat-table-header {
    background-color:  #004d99; /* Xanh lá đậm cho Doctor */
    color: white;
    padding: 12px 8px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.75rem; /* text-xs */
    text-align: center;
    white-space: nowrap;
}

/* CELL BẢNG */
.tat-table-cell {
    padding: 10px 8px;
    border-right: 1px solid #e5e7eb; /* border-gray-200 */
    border-bottom: 1px solid #e5e7eb;
    font-size: 0.875rem; /* text-sm */
    vertical-align: middle;
}
.tat-table-cell:last-child {
    border-right: none;
}

/* ROW BẢNG (Sọc ngựa và Hover) */
.tat-table-row:nth-child(even) {
    background-color: #f9fafb; /* bg-gray-50 */
}
.tat-table-row:hover {
    background-color: #f3f4f6; /* bg-gray-100 */
}

/* TAG TRẠNG THÁI */
.status-tag {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 9999px; /* rounded-full */
    font-size: 0.75rem; /* text-xs */
    font-weight: 700;
    line-height: 1;
}
/* Màu sắc cụ thể */
.status-pending, .status-doctor-pending {
    background-color: #fef3c7; /* bg-yellow-100 */
    color: #b45309; /* text-yellow-800 */
}
.status-confirmed {
    background-color: #d1fae5; /* bg-green-100 */
    color: #065f46; /* text-green-800 */
}
.status-cancelled {
    background-color: #fee2e2; /* bg-red-100 */
    color: #991b1b; /* text-red-800 */
}


/* NÚT HÀNH ĐỘNG */
.tat-action-button {
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 0.75rem; /* text-xs */
    font-weight: 600;
    transition: background-color 0.2s;
    margin: 2px;
}
.tat-action-button.cancel {
    background-color: #ef4444; /* red-500 */
    color: white;
}
.tat-action-button.cancel:hover {
    background-color: #dc2626; /* red-600 */
}
</style>

{{-- Bọc bảng trong div để áp dụng shadow và border-radius --}}
<div class="overflow-x-auto shadow-xl rounded-lg">
    {{-- Loại bỏ border-collapse và border-gray-300 cũ --}}
    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                {{-- Áp dụng tat-table-header và tat-table-cell --}}
                <th class="tat-table-header tat-table-cell w-10">STT</th>
                <th class="tat-table-header tat-table-cell">Tên bệnh nhân</th>
                <th class="tat-table-header tat-table-cell w-24">Ngày sinh</th>
                <th class="tat-table-header tat-table-cell w-16">Giới tính</th>
                <th class="tat-table-header tat-table-cell w-36">Quê quán</th>
                <th class="tat-table-header tat-table-cell w-28">SĐT</th>
                <th class="tat-table-header tat-table-cell w-20">Ngày</th>
                <th class="tat-table-header tat-table-cell w-16">Giờ</th>
                <th class="tat-table-header tat-table-cell w-16">Phòng</th>
                <th class="tat-table-header tat-table-cell w-36">Trạng thái</th>
                <th class="tat-table-header tat-table-cell w-48">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($appointments as $appointment)
                {{-- Áp dụng tat-table-row để kích hoạt sọc ngựa --}}
                <tr class="tat-table-row text-center">
                    {{-- Áp dụng tat-table-cell cho tất cả các ô --}}
                    <td class="tat-table-cell">{{ $i++ }}</td>
                    <td class="tat-table-cell text-left font-medium">{{ $appointment->patient->user->name ?? '-' }}</td>
                    <td class="tat-table-cell">{{ \Carbon\Carbon::parse($appointment->patient->date_of_birth ?? '1970-01-01')->format('d/m/Y') }}</td>
                    <td class="tat-table-cell">
                        @switch($appointment->patient->gender ?? '—')
                            @case('male') Nam @break
                            @case('female') Nữ @break
                            @case('other') Khác @break
                            @default —
                        @endswitch
                    </td>
                    <td class="tat-table-cell text-sm">{{ Str::limit($appointment->patient->address ?? '-', 40) }}</td>
                    <td class="tat-table-cell">{{ $appointment->patient->phone ?? '-' }}</td>
                    <td class="tat-table-cell font-semibold text-blue-700">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                    <td class="tat-table-cell font-semibold text-orange-600">{{ $appointment->appointment_time }}</td>
                    <td class="tat-table-cell">{{ $appointment->room }}</td>
                    
                    {{-- Trạng thái Bác sĩ --}}
                    <td class="tat-table-cell">
                        @php $doctorStatus = $appointment->doctor_status ?? 'pending'; @endphp
                        @switch($doctorStatus)
                            {{-- Sử dụng status-tag đồng bộ --}}
                            @case('pending') 
                                <span class="status-tag status-pending">Chờ duyệt</span> 
                                @break
                            @case('accepted') 
                                <span class="status-tag status-confirmed">Chấp nhận ✅</span> 
                                @break
                            @case('cancelled') 
                                <span class="status-tag status-cancelled">Đã hủy ❌</span> 
                                @break
                            @default 
                                <span class="status-tag status-doctor-pending">Chưa duyệt</span>
                        @endswitch
                    </td>

                    {{-- Hành động --}}
                    <td class="tat-table-cell space-x-1">
                        @if($doctorStatus === 'pending')
                            {{-- Nút Chấp nhận: Áp dụng tat-action-button + màu xanh lá đồng bộ --}}
                            <form method="POST" action="{{ route('doctor.appointment.updateStatus', $appointment->id) }}" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="accepted">
                                <button class="tat-action-button bg-green-600 hover:bg-green-700 text-white">Chấp nhận</button>
                            </form>

                            {{-- Nút Hủy: Áp dụng tat-action-button + class cancel đồng bộ --}}
                            <form method="POST" action="{{ route('doctor.appointment.updateStatus', $appointment->id) }}" class="inline cancel-form">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="cancelled">
                                <input type="hidden" name="cancel_reason" class="cancel-reason">
                                <button type="submit" class="tat-action-button cancel">Hủy</button>
                            </form>
                        @else
                            <span class="text-gray-500 text-sm">Đã phản hồi</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{-- Script nhập lý do hủy (giữ nguyên để chức năng hoạt động) --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cancel-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let reason = prompt('Nhập lý do hủy lịch hẹn:');
            if (reason !== null && reason.trim() !== '') {
                // Thêm confirmation thứ 2 để đảm bảo
                if (confirm('Bạn có chắc muốn hủy lịch này? Lý do: ' + reason)) {
                    form.querySelector('.cancel-reason').value = reason;
                    form.submit();
                }
            } else if (reason !== null) {
                // Nếu người dùng nhấn OK nhưng không nhập lý do
                alert('Vui lòng nhập lý do hủy lịch hẹn.');
            }
        });
    });
});
</script>