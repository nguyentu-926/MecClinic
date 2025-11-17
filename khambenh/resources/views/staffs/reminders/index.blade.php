@extends('layouts.staff')

@section('content')
<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO CẤU TRÚC CARD KHÔNG NỀN */
/* ------------------------------------------- */

/* KHỐI CARD CHÍNH */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); 
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 1500px; 
    width: 100%; 
    margin: 0px auto 0px auto; 
    overflow: hidden;
    position: relative;
    z-index: 10; 
}

/* Thanh Tiêu đề Card */
.tat-form-header-bar {
    background-color: #004d99; 
    color: white;
    text-align: center;
    padding: 15px 20px;
    font-size: 1.5rem;
    font-weight: 700;
}

/* ------------------------------------------- */
/* CSS LỌC VÀ BẢNG */
/* ------------------------------------------- */

/* Nút Lọc (Filter Buttons) */
.btn-filter {
    font-weight: 600;
    border-radius: 6px;
    padding: 8px 15px;
    transition: all 0.2s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.btn-filter.active-filter {
    background-color: #ff9900; 
    color: white;
    box-shadow: 0 4px 8px rgba(255, 153, 0, 0.4);
}

/* Thêm thanh cuộn ngang nếu bảng quá rộng */
.table-responsive {
    overflow-x: auto;
    width: 100%;
}

/* KHỐI CUỘN DỌC MỚI: Thiết lập chiều cao và thanh cuộn dọc */
.table-scroll-container {
    max-height: 550px; 
    overflow-y: auto; 
    border: 1px solid #e5e7eb; 
    border-radius: 8px;
    margin-top: 20px; 
}

/* Header Bảng */
.tat-table-head {
    background-color: #004d99; 
    color: white;
}

/* Đảm bảo tiêu đề dính khi cuộn dọc */
.table-scroll-container table thead th {
    position: sticky;
    top: 0; 
    background-color: #004d99; 
    z-index: 11; 
}

/* Nút Gửi Nhắc Lịch (Active) */
.btn-tat-active {
    background-color: #10b981; 
    color: white;
    font-weight: 600;
    border-radius: 6px;
    padding: 6px 12px;
    transition: background-color 0.2s;
    font-size: 0.875rem;
    box-shadow: 0 2px 4px rgba(16, 185, 129, 0.4);
    white-space: nowrap; 
}
.btn-tat-active:hover {
    background-color: #059669;
}

/* Nút Đã Gửi (Reminded) */
.btn-tat-reminded {
    background-color: #6b7280; 
    color: white;
    font-weight: 600;
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 0.875rem;
    cursor: pointer; 
    white-space: nowrap;
}
.btn-tat-reminded:hover {
    background-color: #4b5563;
}
</style>

@php
    // Lấy trạng thái lọc từ URL. 
    $filter = request()->input('filter', null); 
    
    // Lấy tên route hiện tại để xây dựng URL lọc
    $currentRouteName = Route::currentRouteName();
@endphp

{{-- KHỐI CARD CHÍNH --}}
<div class="tat-form-card">
    
    {{-- Tiêu đề Card đồng bộ --}}
    <div class="tat-form-header-bar">
        🔔 NHẮC LỊCH HẸN CHO BỆNH NHÂN
    </div>

    <div class="p-8">
        {{-- Thông báo --}}
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300 shadow-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Thanh Lọc (Filter Bar) --}}
        <div class="flex justify-start space-x-4 mb-4">
            
            {{-- Tất cả --}}
            {{-- Dùng Route::currentRouteName() để đảm bảo route không bị lỗi --}}
            <a href="{{ route($currentRouteName, ['filter' => null]) }}" 
               class="btn-filter {{ $filter === null ? 'active-filter' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Tất cả
            </a>
            
            {{-- Chưa nhắc lịch --}}
            <a href="{{ route($currentRouteName, ['filter' => 'pending']) }}" 
               class="btn-filter {{ $filter === 'pending' ? 'active-filter' : 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' }}">
                Chưa nhắc lịch
            </a>
            
            {{-- Đã nhắc lịch --}}
            <a href="{{ route($currentRouteName, ['filter' => 'reminded']) }}" 
               class="btn-filter {{ $filter === 'reminded' ? 'active-filter' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                Đã nhắc lịch
            </a>
        </div>

        @if($appointments->isEmpty())
            <p class="text-gray-600 italic text-center py-4">Không có lịch hẹn nào được xác nhận cần gửi nhắc.</p>
        @else
            {{-- KHỐI CUỘN DỌC chứa Bảng danh sách --}}
            <div class="table-scroll-container">
                <div class="table-responsive">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs uppercase tat-table-head">
                            <tr class="text-center">
                                <th class="p-3 w-10">#</th>
                                <th class="p-3">Bệnh nhân</th>
                                <th class="p-3">Bác sĩ</th>
                                <th class="p-3">Ngày khám</th>
                                <th class="p-3">Giờ khám</th>
                                <th class="p-3 w-40">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $index => $appt)
                                @php
                                    $isReminded = $appt->reminded ?? false; 
                                    $buttonText = $isReminded ? 'Đã gửi nhắc lịch (Gửi lại)' : 'Gửi nhắc lịch';
                                    $buttonClasses = $isReminded 
                                        ? 'btn-tat-reminded'
                                        : 'btn-tat-active';
                                    
                                    // Logic lọc hiển thị
                                    $display = true;
                                    if ($filter === 'reminded' && !$isReminded) {
                                        $display = false;
                                    } elseif ($filter === 'pending' && $isReminded) {
                                        $display = false;
                                    }
                                @endphp
                                
                                @if($display)
                                    <tr class="border-b hover:bg-gray-50 text-center align-middle">
                                        {{-- Sử dụng $loop->iteration để số thứ tự không bị nhảy khi lọc --}}
                                        <td class="p-3 font-medium text-gray-900">{{ $loop->iteration }}</td>
                                        <td class="p-3 font-semibold text-left">{{ $appt->patient->user->name ?? 'Không rõ' }}</td>
                                        <td class="p-3 text-left">{{ $appt->doctor->user->name ?? 'Không rõ' }}</td>
                                        <td class="p-3 font-bold text-blue-700">{{ date('d/m/Y', strtotime($appt->appointment_date)) }}</td>
                                        <td class="p-3 font-bold text-orange-600">{{ $appt->appointment_time }}</td>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            {{-- FORM GỬI NHẮC LỊCH --}}
                                            <form action="{{ route('staff.reminders.send', $appt->id) }}" method="POST" 
                                                onsubmit="return handleReminderSend(this);" 
                                                data-reminded="{{ $isReminded ? 'true' : 'false' }}">
                                                @csrf
                                                <button type="submit" class="w-full {{ $buttonClasses }}">
                                                    {{ $buttonText }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Đặt JavaScript ở cuối file Blade --}}
<script>
    /**
     * Xử lý xác nhận và thay đổi trạng thái nút khi gửi nhắc lịch.
     * @param {HTMLFormElement} form - form gửi nhắc lịch
     */
    function handleReminderSend(form) {
        const button = form.querySelector('button[type="submit"]');
        const isReminded = form.getAttribute('data-reminded') === 'true';
        let confirmationMessage = '';

        // Nếu đã gửi, hiển thị thông báo xác nhận gửi lại
        if (isReminded) {
            confirmationMessage = 'Bệnh nhân này đã được gửi nhắc lịch.\nChắc chắn muốn gửi lại lần nữa?';
        } else {
            confirmationMessage = 'Gửi nhắc lịch cho bệnh nhân này?';
        }

        // Xác nhận từ người dùng
        const confirmed = confirm(confirmationMessage);
        if (!confirmed) {
            return false; // Hủy gửi
        }

        // Nếu người dùng xác nhận → đổi trạng thái nút tạm thời (trước khi reload)
        button.textContent = 'Đang gửi...';
        button.disabled = true;

        // Tạm thời đổi style sang trạng thái 'Đã gửi'
        button.classList.remove('btn-tat-active', 'bg-blue-600', 'hover:bg-blue-700');
        button.classList.add('bg-gray-500', 'cursor-not-allowed');

        // Cập nhật trạng thái trong DOM (để lần sau click sẽ có confirm gửi lại)
        form.setAttribute('data-reminded', 'true');

        // Cho phép submit form
        return true;
    }
</script>

@endsection