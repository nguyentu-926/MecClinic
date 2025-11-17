@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST (Đồng bộ với Admin layout) */
    /* ------------------------------------------- */
    :root {
        --admin-primary: #dc2626; /* Red 600 */
        --admin-accent: #2563eb; /* Blue 600 */
        --bg-hover-light: #f9fafb; /* Gray 50 */
    }

    /* Tiêu đề trang */
    .admin-title-appointment {
        font-size: 2rem; /* text-3xl */
        font-weight: 800;
        color: #1f2937; /* gray-800 */
        padding-bottom: 10px;
        margin-bottom: 25px;
        border-bottom: 3px solid var(--admin-primary);
    }
    
    /* Box chứa thông tin bệnh nhân */
    .patient-info-box {
        background-color: #eff6ff; /* Blue 50 */
        border: 1px solid #bfdbfe; /* Blue 200 */
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    /* Form Lọc & Sắp xếp */
    .filter-group {
        display: flex;
        align-items: center;
        gap: 12px;
        background-color: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
    }
    .filter-select {
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 8px 12px;
        background-color: white;
        transition: border-color 0.2s;
    }
    .filter-select:focus {
        border-color: var(--admin-accent);
        outline: none;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
    }
    .filter-btn {
        background-color: var(--admin-accent);
        color: white;
        padding: 8px 18px;
        border-radius: 6px;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    .filter-btn:hover {
        background-color: #1d4ed8; /* Blue 700 */
    }

    /* Bảng */
    .admin-table-appointment {
        border-collapse: collapse;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        overflow: hidden; 
        width: 100%;
    }
    .admin-table-appointment th, .admin-table-appointment td {
        padding: 14px 16px; 
        text-align: left;
        vertical-align: middle;
    }
    .admin-table-appointment thead tr {
        background-color: var(--admin-primary); /* Header màu đỏ primary */
        color: white;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
    }
    .admin-table-appointment tbody tr {
        border-bottom: 1px solid #e5e7eb; /* gray-200 */
        transition: background-color 0.15s;
    }
    .admin-table-appointment tbody tr:last-child {
        border-bottom: none;
    }
    .admin-table-appointment tbody tr:hover {
        background-color: var(--bg-hover-light); 
    }
    
    /* Hiển thị Trạng thái */
    .status-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .status-pending { background-color: #fef3c7; color: #d97706; } /* Yellow */
    .status-confirmed { background-color: #d1fae5; color: #059669; } /* Green */
    .status-done { background-color: #dbeafe; color: #2563eb; } /* Blue */
    .status-cancelled { background-color: #fee2e2; color: #dc2626; } /* Red */
    
    /* Quay lại */
    .back-link {
        color: var(--admin-accent);
        transition: color 0.15s;
        font-weight: 600;
    }
    .back-link:hover {
        color: #1d4ed8;
    }
</style>

<h2 class="admin-title-appointment">
    <i class="fas fa-calendar-alt mr-2 text-admin-primary"></i> Lịch Hẹn Của Bệnh Nhân
</h2>

{{-- Thông tin Bệnh nhân --}}
<div class="patient-info-box">
    <p class="text-xl font-bold text-gray-800">
        Bệnh nhân: <span class="text-admin-accent">{{ $patient->name }}</span>
    </p>
    <p class="text-sm text-gray-600 mt-1">
        ID Bệnh nhân: <span class="font-mono text-gray-700">{{ $patient->id }}</span>
    </p>
</div>

{{-- Form lọc (Đã thiết kế lại) --}}
<form method="GET" class="mb-6 filter-group">
    <span class="text-gray-600 font-medium">Bộ lọc:</span>
    
    <label class="text-sm font-medium text-gray-700">Trạng thái</label>
    <select name="status" class="filter-select">
        <option value="">Tất cả</option>
        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Đang chờ</option>
        <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Đã xác nhận</option>
        <option value="done" {{ request('status')=='done'?'selected':'' }}>Đã hoàn tất</option>
        <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Đã hủy</option>
    </select>

    <label class="text-sm font-medium text-gray-700 ml-4">Sắp xếp theo ngày</label>
    <select name="order" class="filter-select">
        <option value="asc" {{ request('order')=='asc'?'selected':'' }}>Tăng dần (Cũ nhất)</option>
        <option value="desc" {{ request('order')=='desc'?'selected':'' }}>Giảm dần (Mới nhất)</option>
    </select>

    <button type="submit" class="filter-btn flex items-center space-x-1">
        <i class="fas fa-filter"></i>
        <span>Lọc</span>
    </button>
</form>

{{-- Bảng danh sách Lịch hẹn --}}
<div class="overflow-x-auto">
    <table class="admin-table-appointment">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ngày hẹn</th>
                <th>Giờ hẹn</th>
                <th>Bác sĩ</th>
                <th>Phòng khám</th>
                <th class="text-center">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td class="text-sm font-mono text-gray-600">{{ $appointment->id }}</td>
                
                {{-- Ngày hẹn --}}
                <td class="font-medium text-gray-800">
                    <i class="far fa-calendar-alt mr-1 text-admin-primary"></i> 
                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}
                </td>
                
                {{-- Giờ hẹn --}}
                <td class="font-bold text-gray-800">
                    <i class="far fa-clock mr-1 text-gray-500"></i>
                    {{ $appointment->appointment_time ?? 'N/A' }}
                </td>
                
                {{-- Bác sĩ --}}
                <td class="text-gray-700">
                    <i class="fas fa-user-md mr-1 text-admin-primary"></i> 
                    {{ $appointment->doctor?->user->name ?? 'N/A' }}
                </td>
                
                {{-- Phòng khám --}}
                <td class="font-bold text-lg text-gray-800 text-center">
                    {{ $appointment->room ?? '-' }}
                </td>
                
                {{-- Trạng thái (Đã làm đẹp) --}}
                <td class="text-center">
                    @php
                        $status = strtolower($appointment->status);
                        switch($status) {
                            case 'pending':
                                $statusText = 'Đang chờ';
                                $statusClass = 'status-pending';
                                $statusIcon = 'fa-hourglass-half';
                                break;
                            case 'confirmed':
                                $statusText = 'Đã xác nhận';
                                $statusClass = 'status-confirmed';
                                $statusIcon = 'fa-check-circle';
                                break;
                            case 'done':
                                $statusText = 'Đã hoàn tất';
                                $statusClass = 'status-done';
                                $statusIcon = 'fa-clipboard-check';
                                break;
                            case 'cancelled':
                                $statusText = 'Đã hủy';
                                $statusClass = 'status-cancelled';
                                $statusIcon = 'fa-times-circle';
                                break;
                            default:
                                $statusText = ucfirst($status);
                                $statusClass = 'status-pending'; // Mặc định
                                $statusIcon = 'fa-info-circle';
                        }
                    @endphp
                    <span class="status-badge {{ $statusClass }}">
                        <i class="fas {{ $statusIcon }}"></i> {{ $statusText }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Phân trang --}}
<div class="mt-6 flex justify-end">
    {{ $appointments->links() }}
</div>

{{-- Nút quay lại --}}
<div class="mt-8">
    <a href="{{ route('admin.patients.index') }}" 
        class="back-link flex items-center space-x-2">
        <i class="fas fa-arrow-left"></i> 
        <span>Quay lại Danh sách Bệnh nhân</span>
    </a>
</div>

@endsection