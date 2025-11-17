@extends('layouts.admin')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: LUXURY MINIMALIST (Đồng bộ với Admin layout) */
    /* ------------------------------------------- */
    :root {
        --admin-primary: #dc2626; /* Red 600 */
        --admin-accent: #2563eb; /* Blue 600 */
        --bg-hover-light: #fef2f2; /* Red 50 */
    }

    /* Tiêu đề trang */
    .admin-title {
        font-size: 2rem; /* text-3xl */
        font-weight: 800;
        color: #1f2937; /* gray-800 */
        padding-bottom: 10px;
        margin-bottom: 25px;
        border-bottom: 3px solid var(--admin-accent); /* Dùng màu accent cho tiêu đề */
    }

    /* Nút chính (Thêm bác sĩ) */
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

    /* Bảng */
    .admin-table-doctor {
        border-collapse: collapse;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        overflow: hidden; 
        width: 100%;
    }
    .admin-table-doctor th, .admin-table-doctor td {
        padding: 14px 16px; 
        text-align: left;
        vertical-align: middle;
    }
    .admin-table-doctor thead tr {
        background-color: var(--admin-accent); /* Header màu xanh Blue */
        color: white;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
    }
    .admin-table-doctor tbody tr {
        border-bottom: 1px solid #e5e7eb; /* gray-200 */
        transition: background-color 0.15s;
    }
    .admin-table-doctor tbody tr:last-child {
        border-bottom: none;
    }
    .admin-table-doctor tbody tr:hover {
        background-color: var(--bg-hover-light); 
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
    <i class="fas fa-user-md mr-2 text-admin-accent"></i> Danh Sách Bác Sĩ
</h2>

<a href="{{ route('admin.doctors.create') }}" class="admin-btn-primary flex items-center space-x-2 mb-6 w-fit">
    <i class="fas fa-plus-circle"></i>
    <span>Thêm Bác Sĩ Mới</span>
</a>

{{-- Bảng danh sách Bác sĩ --}}
<div class="overflow-x-auto">
    <table class="admin-table-doctor">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Bằng cấp</th> {{-- CỘT MỚI: Bằng cấp --}}
                <th>Chuyên Khoa</th>
                <th>Phòng</th>
                <th>SĐT</th> {{-- CỘT MỚI: SĐT --}}
                <th>Kinh nghiệm</th>
                <th>Lịch làm việc</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
            <tr>
                <td class="text-sm font-mono text-gray-600">{{ $doctor->id }}</td>
                
                {{-- Tên --}}
                <td class="font-bold text-gray-800">
                    <i class="fas fa-user-tag mr-1 text-admin-accent"></i>
                    {{ $doctor->user->name }}
                </td>
                
                {{-- Email --}}
                <td class="text-gray-600">
                    <i class="fas fa-envelope mr-1 text-gray-500"></i>
                    {{ $doctor->user->email }}
                </td>
                
                {{-- Bằng cấp (MỚI) --}}
                <td class="font-bold text-sm text-admin-primary">
                    {{ $doctor->degree ?? '-' }}
                </td>
                
                {{-- Chuyên Khoa --}}
                <td class="font-medium text-admin-primary">
                    <i class="fas fa-stethoscope mr-1"></i>
                    {{ $doctor->specialization }}
                </td>
                
                {{-- Phòng --}}
                <td class="font-bold text-lg text-gray-800 text-center">
                    {{ $doctor->room }}
                </td>
                
                {{-- SĐT (MỚI) --}}
                <td class="text-gray-700 whitespace-nowrap">
                    <i class="fas fa-phone mr-1 text-gray-500"></i>
                    {{ $doctor->phone ?? '-' }}
                </td>
                
                {{-- Kinh nghiệm --}}
                <td class="text-gray-700 text-center">
                    {{ $doctor->experience }} năm
                </td>
                
                {{-- Lịch làm việc (Giới hạn hiển thị) --}}
                <td class="text-gray-600">
                    {{ Str::limit($doctor->working_hours, 15) }}
                </td>

                {{-- Hành động --}}
                <td class="text-center space-x-3 whitespace-nowrap">
                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="action-link hover:text-blue-700" title="Sửa thông tin">
                        <i class="fas fa-edit"></i> Sửa
                    </a>
                    
                    <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="inline ml-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-delete hover:text-red-700" onclick="return confirm('Bạn có chắc chắn muốn xóa bác sĩ {{ $doctor->user->name }} không?')" title="Xóa bác sĩ">
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
<div class="mt-6 flex justify-end">
    {{ $doctors->links() }}
</div>

@endsection