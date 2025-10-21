@extends('layouts.staff')

@section('content')
<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO TRANG QUẢN LÝ LỊCH HẸN (Nhân viên) */
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
    font-size: 1.5rem; /* Điều chỉnh kích thước tiêu đề chính */
    font-weight: 700;
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

/* Các style màu cho trạng thái nút điều hướng */
.tat-nav-button.green {
    background-color: #1a995e; /* Xanh lá đậm hơn */
    color: white;
}
.tat-nav-button.green:hover {
    background-color: #12794a;
}
.tat-nav-button.yellow {
    background-color: #ff9900; /* Màu cam chủ đạo */
    color: white;
}
.tat-nav-button.yellow:hover {
    background-color: #e68a00;
}
.tat-nav-button.red {
    background-color: #cc0000; /* Màu đỏ đậm */
    color: white;
}
.tat-nav-button.red:hover {
    background-color: #990000;
}
</style>

<div class="container mx-auto p-6">
    {{-- Tiêu đề chính (Đã đồng bộ) --}}
    <h1 class="tat-header mx-auto mb-8">👩‍💼 QUẢN LÝ LỊCH HẸN (NHÂN VIÊN)</h1>

    {{-- Thanh menu con (Đã đồng bộ style) --}}
    <div class="flex justify-center mb-8 gap-4">
        
        {{-- Nút Tất cả (Sử dụng màu Xanh đậm chủ đạo cho nút mặc định) --}}
        <button onclick="showTable('all')" class="tat-nav-button blue" id="btn-all">Tổng thể</button>
        
        {{-- Nút Đã duyệt --}}
        <button onclick="showTable('confirmed')" class="tat-nav-button green" id="btn-confirmed">Đã duyệt</button>
        
        {{-- Nút Chờ duyệt --}}
        <button onclick="showTable('pending')" class="tat-nav-button yellow" id="btn-pending">Chờ duyệt</button>
        
        {{-- Nút Đã hủy --}}
        <button onclick="showTable('cancelled')" class="tat-nav-button red" id="btn-cancelled">Đã hủy</button>
    </div>

    {{-- Bảng tất cả lịch hẹn (Giả định component _appointments_table đã được đồng bộ) --}}
    <div id="table-all">
        @include('staffs._appointments_table', ['appointments' => $confirmedAppointments->merge($pendingAppointments)->merge($cancelledAppointments)])
    </div>

    {{-- Bảng theo trạng thái --}}
    <div id="table-confirmed" class="hidden">
        @include('staffs._appointments_table', ['appointments' => $confirmedAppointments])
    </div>

    <div id="table-pending" class="hidden">
        @include('staffs._appointments_table', ['appointments' => $pendingAppointments])
    </div>

    <div id="table-cancelled" class="hidden">
        @include('staffs._appointments_table', ['appointments' => $cancelledAppointments])
    </div>
</div>

<script>
// Logic JavaScript đã được tinh chỉnh để highlight nút đang hoạt động
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo trạng thái ban đầu
    showTable('all'); 
});

function showTable(status) {
    const tables = ['all', 'confirmed', 'pending', 'cancelled'];
    const buttons = {
        'all': document.getElementById('btn-all'),
        'confirmed': document.getElementById('btn-confirmed'),
        'pending': document.getElementById('btn-pending'),
        'cancelled': document.getElementById('btn-cancelled'),
    };

    tables.forEach(t => {
        // Ẩn tất cả các bảng
        document.getElementById('table-' + t).classList.add('hidden');
        
        // Loại bỏ class active (màu xanh đậm) khỏi tất cả các nút và khôi phục màu ban đầu
        if (buttons[t]) {
            buttons[t].classList.remove('bg-gray-400'); // Loại bỏ class active (nếu có)
            
            // Đảm bảo nút "Tất cả" luôn là màu xanh đậm nếu không active
            if (t === 'all') {
                buttons[t].classList.add('blue');
            } else if (t === 'confirmed') {
                 buttons[t].classList.add('green');
            } else if (t === 'pending') {
                 buttons[t].classList.add('yellow');
            } else if (t === 'cancelled') {
                 buttons[t].classList.add('red');
            }
        }
    });

    // Hiển thị bảng được chọn
    document.getElementById('table-' + status).classList.remove('hidden');

    // Highlight nút được chọn (làm nó tối hơn một chút, hoặc sử dụng màu xanh đậm nếu là "Tất cả")
    const activeBtn = buttons[status];
    if (activeBtn) {
         // Xóa hết màu nền cũ
        activeBtn.classList.remove('blue', 'green', 'yellow', 'red');
        
        // Thêm màu nền active (giả sử màu xanh đậm cho tất cả các nút khi active)
        activeBtn.classList.add('bg-gray-400', 'text-gray-800'); // Dùng màu xám để nổi bật trạng thái đã chọn
    }
}
</script>
@endsection