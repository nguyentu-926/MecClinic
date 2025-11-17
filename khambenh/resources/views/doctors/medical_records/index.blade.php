@extends('layouts.doctor')

@section('content')

<style>
/* ------------------------------------------- */
/* CSS ĐỒNG BỘ CHO CẤU TRÚC CARD & TIÊU ĐỀ */
/* ------------------------------------------- */

/* KHỐI CARD CHÍNH - Container lớn bao quanh nội dung */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95); 
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(21, 128, 61, 0.3); 
    max-width: 1500px; 
    width: 100%; 
    margin: 0px auto 0px auto; 
    overflow: hidden;
    position: relative;
    z-index: 10; 
}

/* Thanh Tiêu đề Card (Phần đầu card, đồng bộ màu xanh lá đậm) */
.tat-form-header-bar {
    background-color: #004d99; /* Xanh lá đậm của Doctor Layout */
    color: white;
    text-align: center;
    padding: 18px 20px;
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: 1px;
}

/* Tiêu đề phụ (tat-subheader): Đã chỉnh màu sắc đồng bộ với Doctor Layout */
.tat-subheader {
    color: #15803d; /* Xanh lá đậm */
    border-bottom: 2px solid #ff9900; /* Đường viền cam nổi bật */
    display: inline-block;
    padding-bottom: 5px;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
}

/* STYLE CHO BẢNG */
.tat-table-header {
    background-color: #004d99; 
    color: white;
    padding: 12px 8px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.75rem;
    text-align: center;
    white-space: nowrap;
}

.tat-table-cell {
    padding: 10px 8px;
    border-right: 1px solid #e5e7eb;
    border-bottom: 1px solid #e5e7eb;
    font-size: 0.875rem;
    vertical-align: middle;
}

.tat-table-row:nth-child(even) {
    background-color: #f9fafb; 
}

/* TAG TRẠNG THÁI */
.status-tag {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 700;
}

.status-initiated {
    background-color: #fef3c7; 
    color: #b45309; 
}
.status-completed {
    background-color: #d1fae5; 
    color: #065f46; 
}
.status-unknown { 
    background-color: #e5e7eb; 
    color: #4b5563; 
}

/* NÚT HÀNH ĐỘNG */
.tat-action-button-main {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 600;
    transition: background-color 0.2s;
    background-color: #004d99; /* Xanh dương đậm y tế */
    color: white;
    text-decoration: none;
    display: inline-block;
}
.tat-action-button-main:hover {
    background-color: #003366;
}

/* STYLE CHO MODAL XÁC NHẬN SỬA */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none; /* Mặc định ẩn */
    justify-content: center;
    align-items: center;
    z-index: 50;
}
.modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    max-width: 450px;
    width: 90%;
    text-align: center;
}
</style>

{{-- KHỐI CARD CHÍNH --}}
<div class="tat-form-card">
    
    {{-- Tiêu đề Card đồng bộ --}}
    <div class="tat-form-header-bar">
        📝 DANH SÁCH HỒ SƠ KHÁM 
    </div>

    <div class="p-8">
        
        @if(session('success'))
            {{-- Sử dụng style alert Tailwind đồng bộ --}}
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <span class="font-medium">Thành công!</span> {{ session('success') }}
            </div>
        @endif

        <h2 class="text-center mx-auto tat-subheader">🩺 Danh sách bệnh án cần xử lý</h2>

        <div class="overflow-x-auto shadow-xl rounded-lg mt-6">
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr>
                        <th class="tat-table-header tat-table-cell w-10">#</th>
                        <th class="tat-table-header tat-table-cell w-36">Bệnh nhân</th>
                        <th class="tat-table-header tat-table-cell w-16">Giới tính</th>
                        <th class="tat-table-header tat-table-cell w-28">SĐT</th>
                        <th class="tat-table-header tat-table-cell w-36">Quê quán</th>
                        <th class="tat-table-header tat-table-cell w-20">Ngày khám</th>
                        <th class="tat-table-header tat-table-cell">Triệu chứng ban đầu</th>
                        <th class="tat-table-header tat-table-cell w-32">Trạng thái hồ sơ</th>
                        <th class="tat-table-header tat-table-cell w-36">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr class="tat-table-row text-center">
                            <td class="tat-table-cell">{{ $loop->iteration }}</td>
                            <td class="tat-table-cell text-left font-medium text-blue-800">{{ $record->appointment->patient->user->name ?? 'N/A' }}</td>
                            
                            <td class="tat-table-cell">
                                @switch($record->appointment->patient->gender ?? '—')
                                    @case('male') Nam @break
                                    @case('female') Nữ @break
                                    @default —
                                @endswitch
                            </td>
                            <td class="tat-table-cell">{{ $record->appointment->patient->phone ?? '-' }}</td>
                            <td class="tat-table-cell text-sm text-left">{{ Str::limit($record->appointment->patient->address ?? '-', 25) }}</td>

                            <td class="tat-table-cell font-semibold text-green-700">{{ \Carbon\Carbon::parse($record->appointment->appointment_date)->format('d/m/Y') }}</td>
                            
                            <td class="tat-table-cell text-left italic text-gray-600 text-xs">{{ Str::limit($record->appointment->notes ?? '—', 60) }}</td>
                            
                            <td class="tat-table-cell">
                                @if($record->status === 'initiated' || $record->status === 'draft')
                                    <span class="status-tag status-initiated">⏳ Chờ điền hồ sơ</span>
                                @elseif($record->status === 'completed')
                                    <span class="status-tag status-completed">✅ Đã hoàn tất khám</span>
                                @else
                                    <span class="status-tag status-unknown">Chưa rõ</span>
                                @endif
                            </td>
                            
                            {{-- LOGIC HÀNH ĐỘNG MỚI --}}
                            <td class="tat-table-cell text-center">
                                @if($record->status === 'initiated' || $record->status === 'draft')
                                    {{-- Nút Điền Hồ Sơ: Dùng cho hồ sơ chưa hoàn tất --}}
                                    <a href="{{ route('doctor.medicalRecords.edit', $record->id) }}" class="tat-action-button-main">
                                        ✍️ Điền Hồ Sơ
                                    </a>
                                @elseif($record->status === 'completed')
                                    {{-- Nút Sửa Hồ Sơ: Dùng cho hồ sơ đã hoàn tất, kích hoạt modal xác nhận --}}
                                    <button onclick="openEditModal('{{ route('doctor.medicalRecords.edit', $record->id) }}')" 
                                            class="tat-action-button-main bg-orange-600 hover:bg-orange-700">
                                        ✍️ Sửa Hồ Sơ
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="tat-table-cell text-center text-gray-500 py-6">
                                Không có hồ sơ khám bệnh nào được giao cho bạn.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- MODAL XÁC NHẬN SỬA HỒ SƠ --}}
<div id="editConfirmationModal" class="modal-overlay">
    <div class="modal-content">
        <h3 class="text-xl font-bold text-red-600 mb-4">⚠️ Xác nhận Sửa Hồ Sơ</h3>
        <p class="text-gray-700 mb-6">
            Bạn có chắc chắn muốn **sửa đổi** hồ sơ khám bệnh đã hoàn tất này không? 
            Thao tác này sẽ ghi đè lên dữ liệu hiện tại.
        </p>
        <div class="flex justify-center gap-4">
            <button onclick="closeEditModal()" class="px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                Hủy
            </button>
            <a id="confirmEditButton" href="#" class="px-5 py-2 bg-orange-600 text-white rounded-md font-semibold hover:bg-orange-700 transition">
                Chắc chắn Sửa
            </a>
        </div>
    </div>
</div>

<script>
    // Biến toàn cục để lưu trữ URL chỉnh sửa
    let editUrl = '';

    function openEditModal(url) {
        editUrl = url;
        document.getElementById('confirmEditButton').href = editUrl;
        document.getElementById('editConfirmationModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editConfirmationModal').style.display = 'none';
        document.getElementById('confirmEditButton').href = '#'; // Xóa URL sau khi đóng
    }
    
    // Đóng modal khi click ra ngoài
    document.getElementById('editConfirmationModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
</script>

@endsection