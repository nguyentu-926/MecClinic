@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST (Staff Index) */
    /* ------------------------------------------- */
    :root {
        --admin-primary: #10b981; /* Màu Emerald 600 - Màu nhấn cho Staff */
        --admin-accent: #2563eb; /* Blue 600 - Dùng làm màu nền header bảng */
        --bg-hover-light: #ecfdf5; /* Emerald 50 */
        --text-color: #1f2937; /* gray-800 */
    }

    /* Tiêu đề trang */
    .admin-title {
        font-size: 2rem; font-weight: 800; color: var(--text-color); padding-bottom: 10px; margin-bottom: 25px;
        border-bottom: 3px solid var(--admin-primary);
    }

    /* Nút chính (Thêm nhân viên) */
    .admin-btn-primary {
        background-color: var(--admin-primary); color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600;
        transition: background-color 0.2s, box-shadow 0.2s; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
    }
    .admin-btn-primary:hover { background-color: #059669; box-shadow: 0 6px 15px rgba(16, 185, 129, 0.4); }
    
    /* Bảng */
    .admin-table-staff { border-collapse: collapse; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border-radius: 10px; overflow: hidden; width: 100%; }
    .admin-table-staff th, .admin-table-staff td { padding: 14px 16px; text-align: left; vertical-align: middle; }
    .admin-table-staff thead tr { background-color: var(--admin-accent); color: white; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; }
    .admin-table-staff tbody tr { border-bottom: 1px solid #e5e7eb; transition: background-color 0.15s; }
    .admin-table-staff tbody tr:last-child { border-bottom: none; }
    .admin-table-staff tbody tr:hover { background-color: var(--bg-hover-light); }
    
    /* Hành động & Tag */
    .action-link { color: var(--admin-accent); font-weight: 500; transition: color 0.15s; }
    .action-delete { color: #dc2626; font-weight: 500; transition: color 0.15s; }
    .position-tag { display: inline-block; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; color: var(--admin-primary); background-color: var(--bg-hover-light); border: 1px solid var(--admin-primary); }
</style>

<h2 class="admin-title">
    <i class="fas fa-users-cog mr-2 text-admin-primary"></i> Danh Sách Nhân Viên
</h2>

{{-- Nút Thêm Mới --}}
<a href="{{ route('admin.staffs.create') }}" class="admin-btn-primary flex items-center space-x-2 mb-6 w-fit">
    <i class="fas fa-user-plus"></i>
    <span>Thêm Nhân Viên Mới</span>
</a>

{{-- Thông báo --}}
@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded-lg font-semibold">
        {{ session('success') }}
    </div>
@endif

{{-- Bảng danh sách Nhân viên --}}
<div class="overflow-x-auto">
    <table class="admin-table-staff">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>SĐT</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Địa chỉ</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffs as $staff)
            <tr>
                <td class="text-sm font-mono text-gray-600">{{ $staff->id }}</td>
                
                {{-- Tên --}}
                <td class="font-bold text-gray-800 whitespace-nowrap">
                    <i class="fas fa-user-tag mr-1 text-admin-accent"></i>
                    {{ $staff->user->name }}
                </td>
                
                {{-- Email --}}
                <td class="text-gray-600 whitespace-nowrap">
                    <i class="fas fa-envelope mr-1 text-gray-500"></i>
                    {{ $staff->user->email }}
                </td>
                
                {{-- Vị trí --}}
                <td>
    @php
        // Giả sử Staff model có quan hệ với User model thông qua $staff->user
        $roleValue = $staff->user->role ?? 'Khác'; 
        
        $roleText = match ($roleValue) {
            'staff' => 'Nhân viên',
            'admin' => 'Quản trị viên', // Có thể bao gồm các role khác nếu cần
            default => 'Không xác định',
        };
        
        // Định nghĩa màu sắc cho tag dựa trên role
        $tagClass = match ($roleValue) {
            'staff' => 'bg-green-100 text-green-700 border-green-300',
            'admin' => 'bg-red-100 text-red-700 border-red-300',
            default => 'bg-gray-100 text-gray-700 border-gray-300',
        };
    @endphp
    
    {{-- Hiển thị Role thay vì Position --}}
    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $tagClass }}">
        {{ $roleText }}
    </span>
</td>
                
                {{-- SĐT --}}
                <td class="text-gray-700 whitespace-nowrap">
                    <i class="fas fa-phone mr-1 text-gray-500"></i>
                    {{ $staff->phone ?? '-' }}
                </td>
                
                {{-- Giới tính --}}
                <td class="text-gray-700">
                    {{ match ($staff->gender) { 'male' => 'Nam', 'female' => 'Nữ', default => '-', } }}
                </td>
                
                {{-- Ngày sinh --}}
                <td class="text-gray-700 whitespace-nowrap">
                    {{ $staff->date_of_birth ? date('d/m/Y', strtotime($staff->date_of_birth)) : '-' }}
                </td>
                
                {{-- Địa chỉ (Giới hạn hiển thị) --}}
                <td class="text-gray-600">
                    {{ Str::limit($staff->address, 20) }}
                </td>

                {{-- Hành động --}}
                <td class="text-center space-x-3 whitespace-nowrap">
                    {{-- Sửa --}}
                    <a href="{{ route('admin.staffs.edit', $staff->id) }}" class="action-link hover:text-blue-700" title="Sửa thông tin">
                        <i class="fas fa-edit"></i> Sửa
                    </a>
                    
                    {{-- Xóa --}}
                    <form action="{{ route('admin.staffs.destroy', $staff->id) }}" method="POST" class="inline ml-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-delete hover:text-red-700" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên {{ $staff->user->name }} không?')" title="Xóa nhân viên">
                            <i class="fas fa-trash-alt"></i> Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Phân trang --}}
@if(isset($staffs) && method_exists($staffs, 'links'))
    <div class="mt-6 flex justify-end">
        {{ $staffs->links() }}
    </div>
@endif

@endsection