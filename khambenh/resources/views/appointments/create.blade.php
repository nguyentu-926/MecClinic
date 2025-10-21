@extends('layouts.patient')

@section('content')
<style>
/* ------------------------------------------- */
/* KHẮC PHỤC TRÀN NGANG VÀ DỊCH CHUYỂN KHỐI CONTAINER LÊN TRÊN */
/* ------------------------------------------- */
html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden; /* Cấm cuộn ngang */
    width: 100%;
}

.tat-form-container-bg {
    position: relative;
    width: 100vw;            
    left: 50%;              
    right: 50%;
    margin-left: -50vw;     
    min-height: 100vh;
    overflow: hidden; 
    
    /* ĐIỀU CHỈNH ĐỂ DỊCH CHUYỂN TOÀN BỘ CONTAINER LÊN SÁT ĐỈNH HƠN */
    padding-top: 0; 
    margin-top: -20px; /* Kéo khối container lên trên 20 pixels */
    padding-bottom: 50px; 
    box-sizing: border-box; 
    
    display: flex; 
    align-items: flex-start; 
}

.tat-form-container-bg img.full-width-image {
    width: 100%;             
    height: 100%;
    display: block;
    object-fit: cover;      
    position: absolute;
    /* Giữ nguyên dịch chuyển ảnh nền lên 100px so với container cha */
    top: -100px; 
    left: 0;
    z-index: -1;
}

/* Khối Form (Card) */
.tat-form-card {
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);
    max-width: 900px;
    margin: 0 auto;
    overflow: hidden;
    display: flex;
    flex-wrap: wrap; 
    position: relative;
    z-index: 1;
}

/* Cột trái */
.tat-info-panel {
    flex: 0 0 40%;
    padding: 30px;
    background-color: #f0f7ff;
    border-right: 1px solid #e0e0e0;
}

/* Cột phải */
.tat-input-panel {
    flex: 1;
    padding: 30px;
}

/* Thanh tiêu đề form */
.tat-form-header-bar {
    background-color: #004d99;
    color: white;
    text-align: center;
    padding: 15px 20px;
    margin: -30px;
    margin-bottom: 20px;
}

.tat-form-header-bar h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Form input */
.form-control, .form-select, textarea {
    display: block;
    width: 100%;
    border-radius: 6px;
    padding: 10px 12px;
    border: 1px solid #d9d9d9;
    margin-top: 4px;
    font-size: 1rem;
}

/* Nút đặt lịch */
.btn-primary {
    background-color: #ff9900 !important;
    color: white !important;
    font-weight: 700;
    border-radius: 6px;
    border: none;
    padding: 12px 20px;
    text-transform: uppercase;
    width: 100%;
    margin-top: 20px;
    box-shadow: 0 4px 10px rgba(255, 153, 0, 0.4);
    transition: background-color 0.2s;
}
.btn-primary:hover {
    background-color: #e68a00 !important;
}

/* Nội dung hướng dẫn */
.tat-info-panel .guide-title {
    color: #004d99;
    font-weight: 700;
    margin-bottom: 10px;
}
.tat-info-panel ul {
    list-style-type: none;
    padding-left: 0;
    font-size: 0.95rem;
}
</style>

<div class="tat-form-container-bg">
    <img src="{{ asset('images/nen1.jpg') }}" alt="Nền" class="full-width-image">

    <div class="py-12 px-4" style="max-width: 1200px; margin: 0 auto;">
        <div class="tat-form-card">
            
            {{-- Cột Trái: Thông tin / Hướng dẫn --}}
            <div class="tat-info-panel">
                <h4 class="guide-title">ĐẶT LỊCH KHÁM BỆNH</h4>
                <div class="mb-4">
                    <ul class="space-y-2">
                        <li>• Hà Nội: <strong class="text-red-600">024 7106 6858</strong></li>
                        <li>• Tổng đài thường: <strong class="text-red-600">093 180 6858</strong></li>
                    </ul>
                </div>
                
                <div class="mt-4 p-3 border-t border-gray-300">
                    <p>Quý khách hàng có nhu cầu đặt hẹn khám tại Hệ thống Bệnh viện Đa khoa TAT, xin vui lòng thực hiện theo hướng dẫn:</p>
                    <ul class="list-disc pl-5 mt-2">
                        <li>Đặt hẹn bằng cách gọi tổng đài Chăm sóc khách hàng tại số <strong>024 3872 3872 – 024 7106 6858</strong></li>
                        <li>Đặt hẹn trực tuyến bằng cách điền thông tin vào mẫu bên dưới.</li>
                        <li>Trong trường hợp khẩn cấp, vui lòng đến ngay cơ sở y tế gần nhất.</li>
                    </ul>
                </div>
            </div>

            {{-- Cột Phải: Form --}}
            <div class="tat-input-panel">
                <div class="tat-form-header-bar">
                    <h3 class="mb-0">ĐẶT LỊCH KHÁM BỆNH</h3>
                </div>

                <form method="POST" action="{{ route('appointments.store') }}" id="appointmentForm">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
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
                    </div>

                    <div class="mb-3 mt-3">
                        <label>Triệu chứng / Lý do khám</label>
                        <textarea name="health_issue" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">ĐẶT LỊCH NGAY</button>
                </form>
            </div>

        </div>
    </div>
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
        }).fail(function() {
             $('#doctor').html('<option value="">Không tải được bác sĩ</option>');
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
            }).fail(function() {
                 $('#appointment_time').html('<option value="">Không tải được khung giờ</option>');
            });
        }
    });

    // Tự ẩn thông báo sau 3 giây
    setTimeout(() => $('.alert').fadeOut(), 3000);
});
</script>
@endsection