@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST - APPOINTMENTS */
    /* ------------------------------------------- */
    :root {
        --admin-accent: #2563eb; /* Blue 600 */
        --admin-primary: #1e40af; /* Blue 800 for buttons/actions */
        --shadow-elevation: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 20px;
        border-left: 5px solid var(--admin-accent);
        padding-left: 1rem;
    }

    /* Filter Card Styling */
    .filter-card {
        background-color: white;
        padding: 24px;
        border-radius: 12px;
        box-shadow: var(--shadow-elevation);
        margin-bottom: 30px;
    }

    .filter-group label {
        font-weight: 600;
        color: #4b5563; /* gray-600 */
        margin-bottom: 4px;
        display: block;
    }

    .filter-input, .filter-select {
        border: 1px solid #d1d5db;
        padding: 8px 12px;
        border-radius: 6px;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
        min-width: 150px;
    }
    .filter-input:focus, .filter-select:focus {
        border-color: var(--admin-accent);
        outline: none;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
    }
    
    .filter-button {
        background-color: var(--admin-primary);
        color: white;
        padding: 9px 20px;
        border-radius: 6px;
        font-weight: 600;
        transition: background-color 0.2s;
        box-shadow: 0 4px 8px rgba(30, 64, 175, 0.2);
        height: fit-content;
    }
    .filter-button:hover {
        background-color: #1f3a8a;
    }

    /* Table Styling */
    .data-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        background-color: white;
        border-radius: 12px;
        overflow: hidden; /* Quan trọng để giữ border radius */
        box-shadow: var(--shadow-elevation);
    }

    .data-table th, .data-table td {
        padding: 14px 20px;
        text-align: left;

    }
    
    .data-table thead th {
        background-color: #2563eb;
        color: white;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .data-table tbody tr {
        border-top: 1px solid #e5e7eb;
        transition: background-color 0.2s;
    }
    .data-table tbody tr:hover {
        background-color: #f9fafb;
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: capitalize;
    }
    .status-pending {
        background-color: #fef3c7; /* Amber 100 */
        color: #b45309; /* Amber 700 */
    }
    .status-confirmed {
        background-color: #d1fae5; /* Green 100 */
        color: #065f46; /* Green 700 */
    }
    .status-cancelled {
        background-color: #fee2e2; /* Red 100 */
        color: #991b1b; /* Red 700 */
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }
</style>

<h2 class="page-title">
    <i class="fas fa-calendar-alt mr-2"></i> Quản lý Lịch hẹn
</h2>

<div class="filter-card">
    <form method="GET" class="flex gap-6 items-end flex-wrap">

        <div class="filter-group">
            <label>Trạng thái</label>
            <select name="status" class="filter-select">
                <option value="">Tất cả</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Đang chờ</option>
                <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Đã xác nhận</option>
                <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Đã hủy</option>
            </select>
        </div>

        <div class="filter-group">
            <label>Bác sĩ</label>
            <select name="doctor_id" class="filter-select">
                <option value="">Tất cả</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->user->name }} ({{ $doctor->specialization }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label>Ngày hẹn</label>
            <input type="date" name="date" value="{{ request('date') }}" class="filter-input">
        </div>

        <button class="filter-button flex items-center space-x-2">
            <i class="fas fa-filter"></i>
            <span>Lọc Dữ liệu</span>
        </button>
    </form>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Bệnh nhân</th>
            <th>Bác sĩ</th>
            <th>Ngày</th>
            <th>Giờ</th>
            <th>Trạng thái</th>
            {{-- <th>Hành động</th> --}}
        </tr>
    </thead>
    <tbody>
        @forelse($appointments as $app)
        <tr>
            <td>{{ $app->id }}</td>
            <td>{{ $app->patient->user->name }}</td>
            <td>{{ $app->doctor->user->name }}</td>
            <td>{{ \Carbon\Carbon::parse($app->appointment_date)->format('d/m/Y') }}</td>
            <td>{{ $app->appointment_time }}</td>
            <td>
                @if($app->status == 'pending')
                    <span class="status-badge status-pending">Đang chờ</span>
                @elseif($app->status == 'confirmed')
                    <span class="status-badge status-confirmed">Đã xác nhận</span>
                @else
                    <span class="status-badge status-cancelled">Đã hủy</span>
                @endif
            </td>
            {{-- <td>
                <a href="{{ route('admin.appointments.edit', $app->id) }}" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-edit"></i>
                </a>
            </td> --}}
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center py-5 text-gray-500 font-medium">
                <i class="fas fa-info-circle mr-2"></i> Không tìm thấy lịch hẹn nào theo tiêu chí lọc.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="pagination-container">
    {{ $appointments->links() }}
</div>
@endsection