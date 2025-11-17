@extends('layouts.patient')

@section('content')
<style>
/* TÁI SỬ DỤNG CSS TỪ GIAO DIỆN HỒ SƠ CÁ NHÂN */

html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    width: 100%;
}

/* CONTAINER VÀ ẢNH NỀN: Cập nhật để nền tự kéo dài theo nội dung */
.tat-form-container-bg {
    position: relative;
    width: 100vw; 
    left: 50%; 
    right: 50%;
    margin-left: -50vw; 
    min-height: 100vh; /* Giữ ít nhất bằng 1 màn hình */
    overflow: hidden; 
    
    padding-top: 50px; 
    padding-bottom: 80px; /* Tăng padding dưới để tạo khoảng trống */
    box-sizing: border-box; 
    
    display: flex; 
    justify-content: center; 
    align-items: flex-start; /* Giữ flex-start để nội dung bắt đầu từ trên */
}

/* Đảm bảo ảnh nền bao phủ toàn bộ chiều cao của container */
.tat-form-container-bg img.full-width-image {
    width: 100%; 
    height: 100%; /* Đảm bảo chiều cao 100% của container cha */
    display: block;
    object-fit: cover; 
    position: absolute;
    top: -50px; 
    left: 0;
    z-index: -1;
}

/* KHỐI CARD CHÍNH */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); 
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 800px; 
    width: 100%; 
    margin: 0 auto;
    overflow: hidden; 
    position: relative;
    z-index: 1;
}

/* Thanh Tiêu đề chính */
.tat-form-header-bar {
    background-color: #004d99; 
    color: white;
    text-align: center;
    padding: 15px 20px;
    font-size: 1.5rem;
    font-weight: 700;
}

/* KHỐI MỚI: TẠO THANH CUỘN CHO DANH SÁCH THÔNG BÁO */
.notification-scroll-area {
    /* Đã giữ nguyên max-height để danh sách cuộn bên trong card */
    max-height: 500px; 
    overflow-y: auto; 
    padding-right: 15px; 
}


/* Nút Chính (Đánh dấu đã đọc) */
.btn-tat-primary {
    background-color: #ff9900 !important; 
    color: white !important;
    font-weight: 600;
    border-radius: 6px;
    border: none;
    padding: 8px 15px;
    transition: background-color 0.2s;
    font-size: 0.9rem;
}
.btn-tat-primary:hover {
    background-color: #e68a00 !important;
}

/* Nút Thứ cấp (Xem chi tiết) */
.btn-tat-secondary {
    background-color: #e0f2ff !important; 
    color: #004d99 !important; 
    font-weight: 600;
    border-radius: 6px;
    border: none;
    padding: 8px 15px;
    transition: background-color 0.2s;
    font-size: 0.9rem;
}
.btn-tat-secondary:hover {
    background-color: #cceeff !important;
}

/* Thẻ Thông báo chưa đọc */
.notification-unread {
    border-left: 5px solid #004d99; 
    background-color: #f0f7ff; 
    box-shadow: 0 4px 10px rgba(0, 77, 153, 0.1);
}
/* Thẻ Thông báo đã đọc */
.notification-read {
    border-left: 5px solid #ccc;
    background-color: #ffffff;
    opacity: 0.8;
}
</style>

<div class="tat-form-container-bg">
    <img src="{{ asset('images/nen1.jpg') }}" alt="Nền" class="full-width-image">

    <div class="tat-form-card">
        
        {{-- Tiêu đề Card đồng bộ --}}
        <div class="tat-form-header-bar">
            🔔 THÔNG BÁO CỦA BẠN
        </div>

        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-xl font-semibold text-gray-800">Danh sách Thông báo</h1>

                <form action="{{ route('patients.notifications.readAll') }}" method="POST">
                    @csrf
                    <button class="btn-tat-primary">
                        Đánh dấu tất cả là đã đọc
                    </button>
                </form>
            </div>

            @if ($notifications->isEmpty())
                <div class="p-6 bg-blue-50 border-l-4 border-blue-500 text-blue-700 rounded shadow-md text-center">
                    <p class="font-bold">Tuyệt vời!</p>
                    <p>Hiện tại không có thông báo mới nào dành cho bạn.</p>
                </div>
            @else
                {{-- KHỐI CUỘN MỚI --}}
                <div class="notification-scroll-area">
                    @foreach ($notifications as $notification)
                        @php
                            $isRead = !is_null($notification['read_at']);
                            $status = $notification['status'] ?? 'default';
                            
                            $bgClass = $isRead ? 'notification-read' : 'notification-unread';
                            
                            switch($status) {
                                case 'upcoming':
                                    $icon = '✅'; 
                                    break;
                                case 'today':
                                    $icon = '🕒'; 
                                    break;
                                case 'new_result':
                                    $icon = '📃'; 
                                    break;
                                default:
                                    $icon = 'ℹ️'; 
                            }
                        @endphp

                        <div class="p-4 mb-4 rounded shadow-md transition duration-200 {{ $bgClass }} hover:shadow-lg">
                            <div class="flex justify-between items-start">
                                
                                {{-- Nội dung thông báo --}}
                                <div class="flex gap-3 flex-grow">
                                    <div class="text-3xl flex-shrink-0">{{ $icon }}</div>
                                    <div>
                                        <p class="font-bold text-lg text-gray-800 leading-snug">{{ $notification['doctor_name'] ?? 'Hệ thống' }}</p>
                                        <p class="text-blue-700 font-medium mt-1">
                                            {{ $notification['appointment_date'] ?? '---' }} lúc {{ $notification['appointment_time'] ?? '---' }}
                                        </p>
                                        <p class="text-gray-600 text-sm mt-1">{{ $notification['message'] }}</p>
                                    </div>
                                </div>

                                {{-- Thời gian và trạng thái --}}
                                <div class="text-right flex-shrink-0">
                                    <p class="text-xs text-gray-500">{{ $notification['created_at']->diffForHumans() }}</p>
                                    @if(!$isRead)
                                        <span class="mt-1 inline-block text-xs font-semibold bg-red-500 text-white px-2 py-1 rounded-full">Chưa đọc</span>
                                    @endif
                                </div>
                            </div>

                           {{-- Nút hành động --}}
                        <div class="mt-4 flex gap-3 border-t border-gray-200 pt-3">
                            {{-- 1. Kiểm tra xem key 'record_id' có được map vào mảng 'data' hay không. --}}
                            {{-- Do bạn đã gặp lỗi, ta phải truy cập vào dữ liệu gốc từ Notification Model --}}
                            
                            {{-- Tuy nhiên, nếu bạn đã map, phải truy cập như MẢNG: $notification['record_id'] --}}
                            {{-- Hoặc nếu bạn đã map cả key 'data' (Chưa rõ) --}}

                            {{-- **GIẢI PHÁP AN TOÀN NHẤT: TRUY CẬP DỮ LIỆU ĐÃ MAP** --}}

                            @php
                                // Thử lấy 'record_id' từ cấp độ data nếu nó tồn tại
                                // Sử dụng array_key_exists để tránh lỗi nếu 'data' không tồn tại
                                $recordId = $notification['data']['record_id'] 
                                            ?? ($notification['record_id'] ?? null); 
                            @endphp

                            @if ($recordId)
                                <a href="{{ route('patient.medical-records.show', $recordId) }}"
                                   class="btn-tat-secondary">
                                    Xem chi tiết
                                </a>
                            @endif

                            @if(!$isRead)
                            <form action="{{ route('patients.notifications.markAsRead', $notification['id']) }}" method="POST">
                                @csrf
                                <button class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm font-semibold">
                                    Đánh dấu đã đọc
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- KẾT THÚC KHỐI CUỘN MỚI --}}

        @endif

    </div>
</div>
@endsection