@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">📊 Thống kê hệ thống</h2>

<div class="grid grid-cols-2 gap-6">

    {{-- Biểu đồ 1: Lịch hẹn theo tháng --}}
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-xl mb-2">Lịch hẹn theo tháng</h3>
        <canvas id="chartMonth"></canvas>
    </div>

    {{-- Biểu đồ 2: Trạng thái lịch hẹn --}}
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-xl mb-2">Trạng thái lịch hẹn</h3>
        <canvas id="chartStatus"></canvas>
    </div>

    {{-- Biểu đồ 3: Số user theo role --}}
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-xl mb-2">Các tài khoản</h3>
        <canvas id="chartRoles"></canvas>
    </div>

    {{-- Biểu đồ 4: Lịch hẹn theo từng bác sĩ --}}
    <div class="bg-white p-4 rounded shadow col-span-2">
        <h3 class="text-xl mb-2">Lịch hẹn từng Bác sĩ</h3>
        <canvas id="chartDoctors"></canvas>
    </div>

</div>

{{-- Top 5 bác sĩ bận nhất --}}
<div class="mt-8 bg-white p-4 rounded shadow">
    <h3 class="text-xl mb-3">🏆 Top 5 bác sĩ bận nhất</h3>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Bác sĩ</th>
                <th class="p-2 border">Tổng lịch hẹn</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topDoctors as $doc)
                <tr>
                    <td class="p-2 border">{{ $doc->doctor_name }}</td>
                    <td class="p-2 border text-center">{{ $doc->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
   const monthly = @json($appointmentsByMonth);
    const statusData = @json($appointmentStatus);
    const roles = @json($userRoles);
    const doctors = @json($appointmentsPerDoctor);
    const topDoctors = @json($topDoctors);

    // ===== Chart 1: Lịch hẹn theo tháng =====
    new Chart(document.getElementById('chartMonth'), {
        type: 'line',
        data: {
            labels: Object.keys(monthly),
            datasets: [{
                label: 'Lịch hẹn',
                data: Object.values(monthly),
            }]
        }
    });

    // ===== Chart 2: Trạng thái lịch hẹn =====
    new Chart(document.getElementById('chartStatus'), {
        type: 'bar',
        data: {
            labels: Object.keys(statusData),
            datasets: [{
                label: 'Số lượng',
                data: Object.values(statusData),
            }]
        }
    });

    // ===== Chart 3: User theo role =====
    new Chart(document.getElementById('chartRoles'), {
        type: 'pie',
        data: {
            labels: Object.keys(roles),
            datasets: [{
                data: Object.values(roles),
            }]
        }
    });

    // ===== Chart 4: Lịch hẹn theo từng bác sĩ =====
    new Chart(document.getElementById('chartDoctors'), {
        type: 'bar',
        data: {
            labels: doctors.map(d => d.doctor_name),
            datasets: [{
                label: 'Lịch hẹn',
                data: doctors.map(d => d.total),
            }]
        }
    });

</script>
@endsection
