@extends('layouts.admin')

@section('content')
<h2 class="text-2xl mb-4">Hồ sơ khám: {{ $patient->name }}</h2>

<table class="w-full border border-gray-300">
    <thead>
        <tr class="bg-gray-200">
            <th>ID</th>
            <th>Ngày khám</th>
            <th>Bác sĩ</th>
            <th>Triệu chứng</th>
            <th>Chuẩn đoán</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach($medicalRecords as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->appointment?->appointment_date ? \Carbon\Carbon::parse($record->appointment->appointment_date)->format('d/m/Y') : 'N/A' }}</td>
            <td>{{ $record->doctor?->user->name ?? 'N/A' }}</td>
            <td>{{ Str::limit($record->symptoms, 50) }}</td>
            <td>{{ Str::limit($record->diagnosis, 50) }}</td>
            <td>{{ $record->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $medicalRecords->links() }}

<a href="{{ route('admin.patients.index') }}" class="mt-4 inline-block text-blue-600">← Quay lại danh sách bệnh nhân</a>
@endsection
