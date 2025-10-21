@extends('layouts.doctor')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">👨‍⚕️ Lịch hẹn của bác sĩ</h2>

    {{-- ĐÃ DUYỆT --}}
    <h4 class="text-success mb-2">✅ Lịch hẹn đã duyệt</h4>
    <table class="table table-striped table-bordered">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Bệnh nhân</th>
                <th>Ngày</th>
                <th>Giờ</th>
                <th>Phòng</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($confirmedAppointments as $index => $app)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $app->patient->user->name ?? '-' }}</td>
                    <td>{{ $app->appointment_date }}</td>
                    <td>{{ $app->appointment_time }}</td>
                    <td>{{ $app->room }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Không có lịch hẹn đã duyệt</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- CHƯA DUYỆT --}}
    <h4 class="text-warning mt-5 mb-2">🕓 Lịch hẹn đang chờ duyệt</h4>
    <table class="table table-striped table-bordered">
        <thead class="table-warning">
            <tr>
                <th>#</th>
                <th>Bệnh nhân</th>
                <th>Ngày</th>
                <th>Giờ</th>
                <th>Phòng</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendingAppointments as $index => $app)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $app->patient->user->name ?? '-' }}</td>
                    <td>{{ $app->appointment_date }}</td>
                    <td>{{ $app->appointment_time }}</td>
                    <td>{{ $app->room }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Không có lịch hẹn chờ duyệt</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
