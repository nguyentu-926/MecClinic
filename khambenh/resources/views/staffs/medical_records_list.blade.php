@extends('layouts.staff')

@section('content')
<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO CẤU TRÚC CARD KHÔNG NỀN */
/* ------------------------------------------- */

/* KHỐI CARD CHÍNH - Đã điều chỉnh để không cần nền */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); 
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 1500px; /* Điều chỉnh max-width cho bảng rộng */
    width: 100%; 
    margin: 30px auto 50px auto; /* Thêm margin top/bottom cho card */
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
/* CSS BẢNG VÀ NÚT HÀNH ĐỘNG MỚI (Giữ nguyên) */
/* ------------------------------------------- */

/* Thêm thanh cuộn ngang nếu bảng quá rộng */
.table-responsive {
    overflow-x: auto;
    width: 100%;
}

.tat-table-head {
    background-color: #004d99; /* Xanh đậm */
    color: white;
}

/* Nút Tạo Hồ Sơ */
.btn-tat-create {
    background-color: #ff9900; /* Màu cam nổi bật */
    color: white;
    font-weight: 600;
    border-radius: 6px;
    padding: 6px 10px;
    transition: background-color 0.2s;
    font-size: 0.875rem;
    box-shadow: 0 2px 4px rgba(255, 153, 0, 0.4);
}
.btn-tat-create:hover {
    background-color: #e68a00;
}
/* Nút Đã Tạo Hồ Sơ (Secondary) */
.badge-created {
    background-color: #6b7280; /* Xám */
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 500;
}

</style>

{{-- CHỈ CÒN KHỐI CARD CHÍNH, BỎ CONTAINER NỀN --}}
<div class="tat-form-card">
    
    {{-- Tiêu đề Card đồng bộ --}}
    <div class="tat-form-header-bar">
        🩺 DANH SÁCH LỊCH HẸN ĐÃ DUYỆT - TẠO HỒ SƠ KHÁM
    </div>

    <div class="p-8">
        {{-- Thông báo --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300 shadow-md">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-300 shadow-md">
                {{ session('error') }}
            </div>
        @endif

        {{-- Bảng danh sách --}}
        <div class="table-responsive">
            <table class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg shadow-md overflow-hidden">
                
                <thead class="text-xs uppercase tat-table-head">
                    <tr class="text-center">
                        <th scope="col" class="py-3 px-3 w-10">#</th>
                        <th scope="col" class="py-3 px-3">Bệnh nhân</th>
                        <th scope="col" class="py-3 px-3">Ngày sinh</th>
                        <th scope="col" class="py-3 px-3">Giới tính</th>
                        <th scope="col" class="py-3 px-3">SĐT</th>
                        <th scope="col" class="py-3 px-3">Bác sĩ</th>
                        <th scope="col" class="py-3 px-3">Ngày khám</th>
                        <th scope="col" class="py-3 px-3">Giờ khám</th>
                        <th scope="col" class="py-3 px-3">Khoa</th>
                        <th scope="col" class="py-3 px-3">Triệu chứng/Lý do khám</th>
                        <th scope="col" class="py-3 px-3">Phòng</th>
                        <th scope="col" class="py-3 px-3">Trạng thái</th>
                        <th scope="col" class="py-3 px-3 w-32">Hành động</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($confirmedAppointments as $appointment)
                        <tr class="bg-white border-b hover:bg-gray-50 text-center align-middle">
                            <td class="py-2 px-3 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="py-2 px-3 font-semibold">{{ $appointment->patient->user->name ?? 'N/A' }}</td>
                            <td class="py-2 px-3">{{ \Carbon\Carbon::parse($appointment->patient->date_of_birth ?? '1970-01-01')->format('d/m/Y') }}</td>
                            <td class="py-2 px-3">
                                @switch($appointment->patient->gender ?? '—')
                                    @case('male') Nam @break
                                    @case('female') Nữ @break
                                    @case('other') Khác @break
                                    @default —
                                @endswitch
                            </td>
                            <td class="py-2 px-3">{{ $appointment->patient->phone ?? '-' }}</td>
                            <td class="py-2 px-3">{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                            <td class="py-2 px-3 font-bold text-blue-700">{{ \Carbon\Carbon::parse($appointment->appointment_date ?? '1970-01-01')->format('d/m/Y')}}</td>
                            <td class="py-2 px-3 font-bold text-orange-600">{{ $appointment->appointment_time }}</td>
                            <td class="py-2 px-3">{{ $appointment->doctor->specialization ?? '—' }}</td>
                            <td class="py-2 px-3 text-left max-w-xs">{{ Str::limit($appointment->notes ?? '—', 50) }}</td>
                            <td class="py-2 px-3 font-medium">{{ $appointment->room ?? '—' }}</td>
                            <td class="py-2 px-3">
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-0.5 rounded-full">
                                    Đã duyệt
                                </span>
                            </td>
                            <td class="py-2 px-3 whitespace-nowrap">
                                @if(!$appointment->medicalRecord)
                                    <form action="{{ route('staff.createMedicalRecord', $appointment->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="btn-tat-create">
                                            🩺 Tạo Hồ Sơ
                                        </button>
                                    </form>
                                @else
                                    <span class="badge-created">Đã tạo hồ sơ</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white">
                            <td colspan="13" class="py-4 text-center text-muted italic">Không có lịch hẹn đã duyệt nào cần tạo hồ sơ.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@endsection