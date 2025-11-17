@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS RIÊNG CHO TRANG QUẢN LÝ USER */
    /* ------------------------------------------- */
    :root {
        --admin-primary: #dc2626; /* Red 600 */
        --admin-accent: #2563eb; /* Blue 600 */
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

    /* Nút chính (Thêm user) */
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
        overflow: hidden; /* Cần để góc bo tròn hoạt động */
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
        background-color: #fef2f2; /* Red 50 */
    }

    /* Phân trang */
    .pagination-links {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
    }
</style>

<h2 class="admin-title">Quản Lý Người Dùng Hệ Thống</h2>

<div class="flex justify-between items-center mb-6">
    <a href="{{ route('admin.users.create') }}" class="admin-btn-primary flex items-center space-x-2">
        <i class="fas fa-user-plus"></i>
        <span>Thêm Người Dùng Mới</span>
    </a>

    {{-- Form lọc & sắp xếp (Đã sắp xếp lại) --}}
    <form method="GET" class="flex space-x-3 items-center bg-white p-3 rounded-lg shadow-sm border border-gray-100">
        <label class="text-gray-600 font-medium text-sm">Bộ Lọc:</label>
        <select name="role" class="filter-select">
            <option value="">Vai trò</option>
            <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
            <option value="doctor" {{ request('role')=='doctor'?'selected':'' }}>Bác sĩ</option>
            <option value="staff" {{ request('role')=='staff'?'selected':'' }}>Nhân viên</option>
            <option value="patient" {{ request('role')=='patient'?'selected':'' }}>Bệnh nhân</option>
        </select>
        <select name="sort" class="filter-select">
            <option value="id" {{ request('sort')=='id'?'selected':'' }}>Sắp xếp theo ID</option>
            <option value="name" {{ request('sort')=='name'?'selected':'' }}>Sắp xếp theo Tên</option>
            <option value="email" {{ request('sort')=='email'?'selected':'' }}>Sắp xếp theo Email</option>
        </select>
        <select name="order" class="filter-select">
            <option value="asc" {{ request('order')=='asc'?'selected':'' }}>Tăng dần</option>
            <option value="desc" {{ request('order')=='desc'?'selected':'' }}>Giảm dần</option>
        </select>
        <button class="filter-btn">
            <i class="fas fa-filter mr-1"></i> Lọc
        </button>
    </form>
</div>

{{-- Bảng danh sách User --}}
<table class="w-full admin-table">
    <thead>
        <tr>
            <th class="border-b">ID</th>
            <th class="border-b">Tên</th>
            <th class="border-b">Email</th>
            <th class="border-b">Vai trò</th>
            <th class="border-b text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="{{ $user->role == 'admin' ? 'bg-red-50/70 font-semibold' : '' }}">
            <td class="text-sm font-mono text-gray-600">{{ $user->id }}</td>
            <td class="font-bold text-gray-800">{{ $user->name }}</td>
            <td class="text-gray-600">{{ $user->email }}</td>
            <td class="font-semibold">
                {{-- Dùng switch để tô màu Role --}}
                @switch($user->role)
                    @case('admin')
                        <span class="bg-red-200 text-red-800 px-2 py-0.5 rounded-full text-xs uppercase">Admin</span>
                        @break
                    @case('doctor')
                        <span class="bg-blue-200 text-blue-800 px-2 py-0.5 rounded-full text-xs uppercase">Bác sĩ</span>
                        @break
                    @case('staff')
                        <span class="bg-teal-200 text-teal-800 px-2 py-0.5 rounded-full text-xs uppercase">Nhân viên</span>
                        @break
                    @case('patient')
                        <span class="bg-gray-200 text-gray-800 px-2 py-0.5 rounded-full text-xs uppercase">Bệnh nhân</span>
                        @break
                    @default
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-0.5 rounded-full text-xs uppercase">Unknown</span>
                @endswitch
            </td>
            <td class="text-center space-x-3">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition duration-150">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition duration-150" onclick="return confirm('⚠️ Cảnh báo! Bạn có chắc chắn muốn xóa người dùng {{ $user->name }} (ID: {{ $user->id }}) này không?')">
                        <i class="fas fa-trash-alt"></i> Xóa
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Phân trang --}}
<div class="pagination-links">
    {{ $users->links() }}
</div>

@endsection