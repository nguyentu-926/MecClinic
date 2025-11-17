@extends('layouts.patient')

@section('content')
<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO TRANG DANH SÁCH LỊCH HẸN */
/* ------------------------------------------- */

/* THAY ĐỔI: ĐẶT MÀU NỀN XANH NHẠT GIỐNG Y KHOA */
html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    width: 100%;
    /* MÀU NỀN MỚI: Xanh nhạt (Pale Blue/Medical Blue) */
    background-color: #F5F9FD; 
}

/* Tiêu đề chính */
.tat-header {
    color: #004d99; /* Màu xanh đậm chủ đạo */
    border-bottom: 3px solid #ff9900; /* Đường viền cam */
    display: inline-block;
    padding-bottom: 5px;
    margin-bottom: 20px;
}

/* Style cho các nút menu con */
.tat-nav-button {
    font-weight: 600;
    border-radius: 8px;
    padding: 10px 18px;
    transition: all 0.2s;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.tat-nav-button.blue {
    background-color: #004d99; /* Xanh đậm */
    color: white;
}
.tat-nav-button.blue:hover {
    background-color: #003366;
}

/* Style Bảng */
.tat-table-header {
    background-color: #e0e9f3; /* Nền xanh nhạt hơn cho header */
    color: #004d99; /* Chữ xanh đậm */
    font-weight: 700;
    text-transform: uppercase;
}
.tat-table-cell {
    border: 1px solid #c8d8e8; /* Viền màu xanh xám */
    padding: 12px 10px;
    vertical-align: middle;
    background-color: white; /* Đảm bảo nội dung bảng trắng */
}
.tat-table-row:nth-child(even) .tat-table-cell {
    background-color: #f5f5f5; /* Sọc ngựa nhẹ xám */
}

/* Style cho các nút Hành động (Action Buttons) */
.tat-action-button {
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
    transition: background-color 0.2s;
}

.tat-action-button.edit {
    background-color: #ff9900; /* Màu cam/vàng chủ đạo */
    color: white;
}
.tat-action-button.edit:hover {
    background-color: #e68a00;
}

.tat-action-button.cancel {
    background-color: #cc0000; /* Màu đỏ đậm */
    color: white;
}
.tat-action-button.cancel:hover {
    background-color: #990000;
}

/* Style Trạng thái */
.status-tag {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.85rem;
}
.status-pending {
    background-color: #ffecd1; /* Cam nhạt */
    color: #cc6600;
    border: 1px solid #ffcc66;
}
.status-confirmed {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
.status-cancelled {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
.status-doctor-pending {
    background-color: #e9f0f6; /* Xanh xám nhạt */
    color: #495057;
    border: 1px solid #d0d7de;
}
</style>

<h1 class="text-2xl font-bold tat-header">LỊCH HẸN CỦA TÔI</h1>

{{-- Thanh menu con: Tổng thể / Đã duyệt / Chờ duyệt / Đã hủy --}}
<div class="flex justify-start gap-4 mb-8">
    {{-- Tổng thể --}}
    <a href="{{ route('patients.appointments.all', Auth::id()) }}" 
       class="tat-nav-button blue">
        Tổng thể
    </a>

    {{-- Đã duyệt --}}
    <a href="{{ route('patients.appointments.confirmed', Auth::id()) }}" 
       class="tat-nav-button bg-green-600 text-white hover:bg-green-700">
        Đã duyệt
    </a>
    
    {{-- Chờ duyệt --}}
    <a href="{{ route('patients.appointments.pending', Auth::id()) }}" 
       class="tat-nav-button bg-yellow-400 text-gray-800 hover:bg-yellow-500">
        Chờ duyệt
    </a>
    
    {{-- Đã hủy --}}
    <a href="{{ route('patients.appointments.cancelled', Auth::id()) }}" 
       class="tat-nav-button bg-red-600 text-white hover:bg-red-700">
        Đã hủy
    </a>
</div>

{{-- Danh sách lịch hẹn --}}
@if($appointments->isEmpty())
    <div class="p-6 bg-white border-l-4 border-blue-500 text-gray-700 rounded-lg shadow-md">
        <p class="font-medium">Bạn chưa có lịch hẹn nào trong danh sách này.</p>
    </div>
@else
    <div class="overflow-x-auto shadow-xl rounded-lg">
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="tat-table-header tat-table-cell w-12">STT</th>
                    <th class="tat-table-header tat-table-cell w-28">Ngày hẹn</th>
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
                @php $i = 1; @endphp
                @foreach($appointments as $appointment)
                <tr class="tat-table-row">
                    <td class="tat-table-cell text-center">{{ $i++ }}</td>
                    <td class="tat-table-cell">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                    <td class="tat-table-cell">{{ $appointment->appointment_time }}</td>
                    <td class="tat-table-cell font-medium text-gray-800">{{ $appointment->doctor && $appointment->doctor->user ? $appointment->doctor->user->name : 'Không xác định' }}</td>
                    <td class="tat-table-cell">{{ $appointment->doctor ? $appointment->doctor->specialization : 'Chưa có' }}</td>
                    <td class="tat-table-cell text-center">{{ $appointment->room }}</td>

                    {{-- Trạng thái --}}
                    <td class="tat-table-cell">
                        @if($appointment->status === 'pending')
                            @if($appointment->doctor_status === null)
                                <span class="status-tag status-doctor-pending">Chờ Bác sĩ</span>
                            @elseif($appointment->doctor_status === 'accepted')
                                <span class="status-tag status-pending">Bác sĩ đã duyệt (Chờ NV)</span>
                            @elseif($appointment->doctor_status === 'cancelled')
                                <span class="status-tag status-cancelled">Bác sĩ đã hủy (Chờ NV)</span>
                            @endif
                        @elseif($appointment->status === 'confirmed')
                            <span class="status-tag status-confirmed">Đã chấp nhận ✅</span>
                        @elseif($appointment->status === 'cancelled')
                            <span class="status-tag status-cancelled">Đã hủy lịch ❌</span>
                        @endif
                    </td>

                    {{-- Ghi chú bệnh nhân --}}
                    <td class="tat-table-cell text-sm max-w-xs">{{ Str::limit($appointment->notes ?? '-', 50) }}</td>

                    {{-- Lý do hủy --}}
                    <td class="tat-table-cell text-sm max-w-xs">
                        {{ Str::limit($appointment->status === 'cancelled' && $appointment->cancel_reason ? $appointment->cancel_reason : '-', 50) }}
                    </td>

                    {{-- Hành động --}}
                    <td class="tat-table-cell flex flex-col sm:flex-row gap-2 justify-center">
                        @if($appointment->status === 'pending' && $appointment->doctor_status !== 'cancelled')
                            {{-- Nút Sửa (Màu cam chủ đạo) --}}
                            <a href="{{ route('appointments.edit', $appointment->id) }}" 
                               class="tat-action-button edit">
                                Sửa
                            </a>
                            
                            {{-- Form Hủy (Màu đỏ) --}}
                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" 
                                  onsubmit="return confirm('Bạn có chắc muốn hủy lịch hẹn này? Hành động này không thể hoàn tác.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="tat-action-button cancel">Hủy</button>
                            </form>
                        @else
                            <span class="text-gray-500 text-sm">Không thể sửa</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<script>

</script>
@endsection