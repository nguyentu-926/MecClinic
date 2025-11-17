@component('mail::message')
# 🔔 Lời Nhắc Lịch Khám Quan Trọng

Xin chào **{{ $appointment->patient->user->name }}**,

Chúng tôi xin gửi lời nhắc về lịch khám sức khỏe sắp tới của bạn tại **Phòng khám TAT**. Vui lòng kiểm tra các chi tiết dưới đây và chuẩn bị chu đáo để buổi khám diễn ra suôn sẻ nhất.

---

## ✨ Thông Tin Lịch Khám Chi Tiết

<table class="table-auto w-full text-sm leading-relaxed" style="border-collapse: separate; border-spacing: 0 10px;">
    <tr>
        <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">🏷️ Mã Lịch Hẹn:</td>
        <td style="padding: 5px 0; font-weight: bold; color: #1f2937;">#{{ $appointment->id }}</td>
    </tr>
    <tr>
        <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">👨‍⚕️ Bác sĩ:</td>
        <td style="padding: 5px 0; color: #004d99; font-weight: 700;">{{ $appointment->doctor->user->name ?? 'Đang cập nhật' }} (Khoa {{ $appointment->doctor->specialization ?? 'Chung' }})</td>
    </tr>
    <tr>
        <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">📅 Ngày Khám:</td>
        <td style="padding: 5px 0; font-weight: bold; color: #10b981;">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">🕒 Giờ Khám:</td>
        <td style="padding: 5px 0; font-weight: bold; color: #ef4444;">{{ $appointment->appointment_time }}</td>
    </tr>
    <tr>
        <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">📋 Lý do khám:</td>
        <td style="padding: 5px 0; color: #4b5563; font-style: italic;">{{ Str::limit($appointment->notes ?? 'Chưa ghi chú', 70) }}</td>
    </tr>
    <tr>
        <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">📍 Địa chỉ:</td>
        <td style="padding: 5px 0; color: #1f2937;">Phòng khám TAT, 123 Nguyễn Trãi, Hà Nội</td>
    </tr>
</table>

---

## 📌 Lưu Ý Quan Trọng

* **Vui lòng đến sớm hơn 15 phút** so với giờ hẹn để hoàn thành thủ tục hành chính.
* **Mang theo** giấy tờ tùy thân (CMND/CCCD) và thẻ bảo hiểm y tế (nếu có).
* Nếu cần thay đổi hoặc hủy lịch hẹn, vui lòng thông báo cho chúng tôi qua điện thoại sớm nhất có thể.

@component('mail::button', ['url' => route('patient.appointments', ['id' => $appointment->patient->id]), 'color' => 'success'])
Xem và Quản lý Lịch Khám Của Tôi
@endcomponent

<p style="text-align: center; margin-top: 30px; font-size: 0.9em; color: #6b7280;">
    Cảm ơn bạn đã tin tưởng lựa chọn dịch vụ của chúng tôi.
</p>

Trân trọng,  
**Đội ngũ Chăm sóc Khách hàng Phòng khám TAT**
@endcomponent