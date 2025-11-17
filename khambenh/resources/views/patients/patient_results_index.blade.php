@extends('layouts.patient')

@section('content')
<div class="container mt-5">
    <h3 class="text-center text-primary mb-5 fw-bold border-bottom pb-3">
        📄 Lịch Sử Kết Quả Khám Của Tôi
    </h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-primary text-white text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="min-width: 150px;">Bác sĩ Khám</th>
                    <th scope="col">Ngày Khám</th>
                    <th scope="col">Chuẩn Đoán Chính</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="fw-bold text-success">{{ $record->doctor->user->name ?? 'N/A' }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($record->appointment->appointment_date)->format('d/m/Y') }}</td>
                        <td class="fst-italic text-dark">{{ Str::limit($record->diagnosis ?? 'Đang chờ chuẩn đoán', 70) }}</td>
                        <td class="text-center">
                            <span class="badge bg-success p-2">Đã Hoàn Tất</span>
                        </td>
                        <td class="text-center">
                            {{-- Nút xem chi tiết --}}
                            <a href="{{ route('patient.medicalResults.show', $record->id) }}" class="btn btn-sm btn-primary fw-bold shadow-sm">
                                🧾 Xem Kết Quả
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Không có kết quả khám bệnh nào đã được hoàn tất.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection