@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST (Đồng bộ với Admin layout) */
    /* ------------------------------------------- */
    :root {
        --admin-primary: #dc2626; /* Red 600 */
        --admin-accent: #2563eb; /* Blue 600 */
        --bg-hover-danger: #fef2f2; /* Red 50 */
    }

    /* Tiêu đề trang */
    .admin-title-record {
        font-size: 2rem; /* text-3xl */
        font-weight: 800;
        color: #1f2937; /* gray-800 */
        padding-bottom: 10px;
        margin-bottom: 25px;
        border-bottom: 3px solid var(--admin-primary);
    }
    
    /* Box chứa thông tin bệnh nhân */
    .patient-info-box {
        background-color: #fef3f3; /* Red 50 */
        border: 1px solid #fecaca; /* Red 200 */
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    /* Bảng */
    .admin-table-record {
        border-collapse: collapse;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        overflow: hidden; 
        width: 100%; /* Đảm bảo full width */
    }
    .admin-table-record th, .admin-table-record td {
        padding: 14px 16px; 
        text-align: left;
        vertical-align: middle;
    }
    .admin-table-record thead tr {
        background-color: var(--admin-accent); /* Header màu xanh Blue */
        color: white;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
    }
    .admin-table-record tbody tr {
        border-bottom: 1px solid #e5e7eb; /* gray-200 */
        transition: background-color 0.15s;
    }
    .admin-table-record tbody tr:last-child {
        border-bottom: none;
    }
    .admin-table-record tbody tr:hover {
        background-color: #f9f9f9; 
    }
    
    /* Trạng thái */
    .status-completed {
        background-color: #d1fae5; /* Green 100 */
        color: #059669; /* Green 600 */
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .status-pending {
        background-color: #fef3c7; /* Yellow 100 */
        color: #d97706; /* Yellow 700 */
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    /* Nút Chi tiết (giả định sẽ có) */
    .btn-detail {
        color: var(--admin-primary);
        font-weight: 600;
        transition: opacity 0.2s;
    }
    .btn-detail:hover {
        opacity: 0.8;
    }
</style>

<h2 class="admin-title-record">
    <i class="fas fa-notes-medical mr-2 text-admin-primary"></i> Hồ Sơ Khám Bệnh
</h2>

{{-- Thông tin Bệnh nhân --}}
<div class="patient-info-box">
    <p class="text-xl font-bold text-gray-800">
        Bệnh nhân: <span class="text-admin-primary">{{ $patient->name }}</span>
    </p>
    <p class="text-sm text-gray-600 mt-1">
        Email: <span class="font-mono text-gray-700">{{ $patient->email ?? $patient->user->email ?? '-' }}</span>
    </p>
</div>

{{-- Bảng danh sách Hồ sơ khám --}}
<div class="overflow-x-auto">
    <table class="admin-table-record">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ngày khám</th>
                <th>Bác sĩ</th>
                <th>Phòng khám</th> {{-- CỘT MỚI: ROOM --}}
                <th>Triệu chứng</th>
                <th>Chuẩn đoán</th>
                <th class="text-center">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicalRecords as $record)
            <tr>
                <td class="text-sm font-mono text-gray-600">{{ $record->id }}</td>
                
                {{-- Ngày khám --}}
                <td class="font-medium text-gray-700">
                    @if($record->appointment?->appointment_date)
                        <i class="fas fa-calendar-day mr-1 text-admin-accent"></i>
                        {{ \Carbon\Carbon::parse($record->appointment->appointment_date)->format('d/m/Y') }}
                    @else
                        N/A
                    @endif
                </td>
                
                {{-- Bác sĩ --}}
                <td class="text-admin-accent font-semibold">
                    <i class="fas fa-user-md mr-1"></i> {{ $record->doctor?->user->name ?? 'N/A' }}
                </td>
                
                {{-- Số phòng (MỚI) --}}
                <td class="font-bold text-lg text-gray-800 text-center">
                    {{ $record->appointment?->room ?? '-' }} 
                    {{-- Giả định tên trường là room_number trong appointment model, nếu là 'room' thì sửa lại --}}
                </td>

                {{-- Triệu chứng (Giới hạn ký tự) --}}
                <td class="text-gray-600">{{ Str::limit($record->symptoms, 40) }}</td>
                
                {{-- Chuẩn đoán (Giới hạn ký tự) --}}
                <td class="text-gray-600">{{ Str::limit($record->diagnosis, 40) }}</td>
                
                {{-- Trạng thái --}}
                <td class="text-center">
                    @php
                        $status = strtolower($record->status);
                        $statusText = $status === 'completed' ? 'Đã Hoàn Thành' : 'Đang Xử Lý';
                        $statusClass = $status === 'completed' ? 'status-completed' : 'status-pending';
                        $statusIcon = $status === 'completed' ? 'fa-check-circle' : 'fa-hourglass-half';
                    @endphp
                    <span class="{{ $statusClass }}">
                        <i class="fas {{ $statusIcon }} mr-1"></i> {{ $statusText }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Phân trang --}}
<div class="mt-6 flex justify-end">
    {{ $medicalRecords->links() }}
</div>

{{-- Nút quay lại --}}
<div class="mt-8">
    <a href="{{ route('admin.patients.index') }}" 
        class="text-gray-600 hover:text-gray-900 transition duration-150 flex items-center space-x-2 font-medium">
        <i class="fas fa-arrow-left"></i> 
        <span>Quay lại Danh sách Bệnh nhân</span>
    </a>
</div>

@endsection