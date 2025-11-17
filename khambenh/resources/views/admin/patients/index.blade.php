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
    .admin-title {
        font-size: 1.875rem; /* text-3xl */
        font-weight: 800;
        color: #1f2937; /* gray-800 */
        border-bottom: 3px solid var(--admin-primary);
        padding-bottom: 10px;
        margin-bottom: 25px;
    }

    /* Nút chính (Thêm bệnh nhân) */
    .admin-btn-primary {
        background-color: var(--admin-primary);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: background-color 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
    }
    .admin-btn-primary:hover {
        background-color: #b91c1c; /* Red 700 */
        box-shadow: 0 6px 15px rgba(220, 38, 38, 0.4);
    }
    
    /* Thanh Lọc & Sắp xếp */
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

    /* Nút Lọc */
    .filter-btn {
        background-color: var(--admin-accent);
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    .filter-btn:hover {
        background-color: #1d4ed8; /* Blue 700 */
    }

    /* Bảng */
    .admin-table {
        border-collapse: collapse;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        overflow: hidden; 
    }
    .admin-table th, .admin-table td {
        padding: 12px 16px;
        text-align: left;
    }
    .admin-table thead tr {
        background-color: #f3f4f6; /* gray-100 */
        color: #374151; /* gray-700 */
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
    }
    .admin-table tbody tr {
        border-bottom: 1px solid #e5e7eb; /* gray-200 */
        transition: background-color 0.15s;
    }
    .admin-table tbody tr:last-child {
        border-bottom: none;
    }
    .admin-table tbody tr:hover {
        background-color: var(--bg-hover-danger); 
    }
    /* Hành động */
    .action-link {
        color: var(--admin-accent);
        font-weight: 500;
        transition: color 0.15s;
    }
    .action-delete {
        color: var(--admin-primary);
        font-weight: 500;
        transition: color 0.15s;
    }
</style>

<h2 class="admin-title">
    <i class="fas fa-users-medical mr-2 text-admin-primary"></i> Danh Sách Bệnh Nhân
</h2>

{{-- Thanh chức năng: Thêm mới và Sắp xếp --}}
<div class="flex justify-between items-center mb-6">
    <a href="{{ route('admin.patients.create') }}" class="admin-btn-primary flex items-center space-x-2">
        <i class="fas fa-plus-circle"></i>
        <span>Thêm Bệnh Nhân Mới</span>
    </a>

    {{-- Form Sắp xếp MỚI --}}
    <form method="GET" class="flex space-x-3 items-center bg-white p-3 rounded-lg shadow-sm border border-gray-100">
        <label class="text-gray-600 font-medium text-sm">Sắp xếp:</label>
        
        {{-- Sắp xếp theo cột --}}
        <select name="sort" class="filter-select">
            <option value="id" {{ request('sort', 'id') == 'id' ? 'selected' : '' }}>Theo ID</option>
            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Theo Tên</option>
        </select>
        
        {{-- Thứ tự --}}
        <select name="order" class="filter-select">
            <option value="asc" {{ request('order', 'asc') == 'asc' ? 'selected' : '' }}>Tăng dần (A-Z/ID thấp)</option>
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Giảm dần (Z-A/ID cao)</option>
        </select>
        
        <button type="submit" class="filter-btn flex items-center space-x-1">
            <i class="fas fa-sort"></i>
            <span>Sắp xếp</span>
        </button>
    </form>
</div>

{{-- Bảng danh sách Bệnh nhân --}}
<table class="w-full admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            
            <th class="text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patients as $patient)
        <tr>
            <td class="text-sm font-mono text-gray-600">{{ $patient->id }}</td>
            
            {{-- Truy cập Tên từ bảng users qua mối quan hệ user --}}
            <td class="font-bold text-gray-800">{{ $patient->user->name ?? $patient->name ?? '-' }}</td>
            
            {{-- Truy cập Email từ bảng users qua mối quan hệ user --}}
            <td class="text-gray-600">{{ $patient->user->email ?? $patient->email ?? '-' }}</td>
            
            <td class="text-center space-x-3">
                <a href="{{ route('admin.patients.edit', $patient->id) }}" class="action-link hover:text-blue-700" title="Sửa thông tin">
                    <i class="fas fa-edit"></i>
                </a>
                
                <a href="{{ route('admin.patients.medicalRecords', $patient->id) }}" class="action-link text-green-600 hover:text-green-700" title="Xem Hồ sơ khám">
                    <i class="fas fa-file-medical"></i>
                </a>

                <a href="{{ route('admin.patients.appointments', $patient->id) }}" class="action-link text-purple-600 hover:text-purple-700" title="Xem Lịch hẹn">
                    <i class="fas fa-calendar-alt"></i>
                </a>

                <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" class="inline ml-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-delete hover:text-red-700" onclick="return confirm('Bạn có chắc chắn muốn xóa bệnh nhân {{ $patient->user->name ?? $patient->name }} không?')" title="Xóa bệnh nhân">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Phân trang --}}
<div class="mt-6 flex justify-end">
    {{ $patients->links() }}
</div>

@endsection