@extends('layouts.patient')

@section('content')
<div class="container mt-4">
    <h3>🩺 Đặt lịch khám</h3>

    @if (session('success'))
        <div class="alert alert-success fade show">{{ session('success') }}</div>
    @elseif (session('warning'))
        <div class="alert alert-warning fade show">{{ session('warning') }}</div>
    @endif

    <form method="POST" action="{{ route('appointments.store') }}" id="appointmentForm">
        @csrf
        <div class="mb-3">
            <label>Chuyên khoa</label>
            <select id="specialization" class="form-select" required>
                <option value="">-- Chọn chuyên khoa --</option>
                @foreach($specializations as $sp)
                    <option value="{{ $sp }}">{{ $sp }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Bác sĩ</label>
            <select name="doctor_id" id="doctor" class="form-select" required>
                <option value="">-- Chọn bác sĩ --</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Ngày khám</label>
            <input type="date" name="appointment_date" id="appointment_date" class="form-control" required min="{{ date('Y-m-d') }}">
        </div>

        <div class="mb-3">
            <label>Giờ khám</label>
            <select name="appointment_time" id="appointment_time" class="form-select" required>
                <option value="">-- Chọn khung giờ --</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Triệu chứng / Lý do khám</label>
            <textarea name="health_issue" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Đặt lịch</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Khi chọn chuyên khoa → load bác sĩ
    $('#specialization').change(function(){
        let specialization = $(this).val();
        $('#doctor').html('<option value="">Đang tải...</option>');
        $.get("{{ route('appointments.doctors') }}", { specialization: specialization }, function(data){
            $('#doctor').empty().append('<option value="">-- Chọn bác sĩ --</option>');
            data.forEach(function(doc){
                $('#doctor').append(`<option value="${doc.id}">${doc.user.name} (${doc.room})</option>`);
            });
        });
    });

    // Khi chọn bác sĩ hoặc ngày → load khung giờ
    $('#doctor, #appointment_date').change(function(){
        let doctor_id = $('#doctor').val();
        let date = $('#appointment_date').val();

        if(doctor_id && date){
            $('#appointment_time').html('<option>Đang tải...</option>');
            $.get("{{ route('appointments.availableTimes') }}", 
                { doctor_id: doctor_id, appointment_date: date }, 
                function(data){
                    $('#appointment_time').empty().append('<option value="">-- Chọn khung giờ --</option>');
                    if(data.length === 0){
                        $('#appointment_time').append('<option disabled>❌ Không còn khung giờ trống</option>');
                    } else {
                        data.forEach(function(time){
                            $('#appointment_time').append(`<option value="${time}">${time}</option>`);
                        });
                    }
            });
        }
    });

    // Tự ẩn thông báo sau 3 giây
    setTimeout(() => $('.alert').fadeOut(), 3000);
});
</script>

@endsection
