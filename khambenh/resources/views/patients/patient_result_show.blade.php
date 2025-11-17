@extends('layouts.patient')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h3 class="text-primary fw-bold mb-0">📄 Kết Quả Khám Chi Tiết</h3>
        
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm shadow-sm">
            🖨️ In / Xuất PDF
        </button>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0">
                <i class="bi bi-calendar-check"></i> Ngày khám: <span class="fw-bold">{{ \Carbon\Carbon::parse($record->appointment->appointment_date)->format('d/m/Y') }}</span>
            </h4>
        </div>
        
        <div class="card-body">
            
            {{-- THÔNG TIN KHÁM BỆNH CƠ BẢN --}}
            <h5 class="text-info fw-bold mb-3 border-bottom pb-2">Thông tin Khám</h5>
            <div class="row mb-4">
                <div class="col-md-4">
                    <strong>Bệnh nhân:</strong> 
                    <p class="fw-bold text-dark">{{ $record->appointment->patient->user->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Bác sĩ Khám:</strong> 
                    <p class="fw-bold text-success">{{ $record->doctor->user->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Phòng Khám:</strong> 
                    <p class="text-muted">{{ $record->appointment->room ?? '—' }}</p>
                </div>
            </div>

            {{-- 1. TRIỆU CHỨNG BAN ĐẦU --}}
            <h5 class="text-primary fw-bold mb-3 border-bottom pb-2">1. Triệu Chứng Ban Đầu</h5>
            <div class="alert alert-secondary mb-4 p-3 fst-italic">
                {{ $record->appointment->notes ?? $record->symptoms ?? 'Không có thông tin triệu chứng ban đầu.' }}
            </div>

            {{-- 2. CHUẨN ĐOÁN --}}
            <h5 class="text-primary fw-bold mb-3 border-bottom pb-2">2. Chuẩn Đoán & Kết Luận</h5>
            <div class="alert alert-danger-light bg-light border-start border-danger border-4 mb-4 p-3">
                <p class="fw-bold mb-0">{{ $record->diagnosis ?? 'Chưa có chuẩn đoán.' }}</p>
            </div>
            
            {{-- 3. KẾ HOẠCH ĐIỀU TRỊ & ĐƠN THUỐC --}}
            <h5 class="text-primary fw-bold mb-3 border-bottom pb-2">3. Đơn Thuốc & Kế Hoạch Điều Trị</h5>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 bg-success-light border-success">
                        <div class="card-header bg-success text-white fw-bold">Đơn Thuốc</div>
                        <div class="card-body">
                            <pre class="mb-0">{{ $record->prescription ?? '—' }}</pre>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 bg-info-light border-info">
                        <div class="card-header bg-info text-white fw-bold">Kế Hoạch Điều Trị</div>
                        <div class="card-body">
                            <pre class="mb-0">{{ $record->treatment_plan ?? '—' }}</pre>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. KẾT QUẢ XÉT NGHIỆM & GHI CHÚ --}}
            <h5 class="text-primary fw-bold mb-3 border-bottom pb-2">4. Kết Quả Xét Nghiệm & Ghi Chú</h5>
            <div class="mb-4">
                <strong>Kết quả xét nghiệm:</strong>
                <p class="text-muted">{{ $record->test_results ?? 'Không có kết quả xét nghiệm được ghi nhận.' }}</p>
            </div>
            <div class="mb-4">
                <strong>Ghi chú thêm của Bác sĩ:</strong>
                <p class="text-muted">{{ $record->notes ?? 'Không có ghi chú thêm.' }}</p>
            </div>

        </div> {{-- /card-body --}}

        <div class="card-footer text-end">
            <a href="{{ route('patient.medicalResults.index') }}" class="btn btn-secondary">← Quay lại danh sách kết quả</a>
        </div>
    </div> {{-- /card --}}
</div>

<style>
/* CSS cho in ấn và pre */
@media print {
    /* ... (CSS cho in ấn) ... */
}
pre {
    white-space: pre-wrap;
    word-wrap: break-word;
    font-family: inherit;
    font-size: inherit;
    background-color: transparent;
    border: none;
    padding: 0;
    margin: 0;
}
</style>
@endsection