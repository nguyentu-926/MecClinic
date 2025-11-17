@extends('layouts.patient')

@section('title', 'Quy Trình Khám và Điều Trị Ngoại Trú')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-blue-600">
            QUY TRÌNH KHÁM VÀ ĐIỀU TRỊ NGOẠI TRÚ
        </h1>
        <div class="w-16 h-1 bg-gray-400 mx-auto mt-2"></div>
    </div>

    <p class="mb-8 text-gray-700 leading-relaxed">
        Với mong muốn đáp ứng nhu cầu khám chữa bệnh, chăm sóc sức khỏe tốt nhất cho tất cả khách hàng, đồng thời giảm thiểu tối đa việc quá tải giường bệnh, tránh việc lây nhiễm chéo trong suốt thời gian nằm viện, đặc biệt là những thời điểm dịch bệnh vào mùa... Bệnh viện Đa khoa TAT triển khai dịch vụ <span class="font-bold">thăm khám và điều trị ngoại trú</span> cho tất cả khách hàng.
    </p>
    <p class="mb-12 text-gray-700 leading-relaxed">
        Chấp hành đầy đủ quy định của Bộ Y tế, <span class="text-blue-600 font-semibold">Bệnh viện Đa khoa TAT</span> triển khai thực hiện việc thăm khám và điều trị bệnh thông tuyến bảo hiểm y tế (viết tắt là BHYT) trên toàn quốc. Theo đó, khách hàng có hoặc không tham gia BHYT đến thăm khám và điều trị tại Bệnh viện Đa khoa TAT đều hưởng đầy đủ các quyền lợi đúng tuyến với chất lượng dịch vụ cao cấp, nhanh chóng, trực tiếp thăm khám và điều trị bởi các chuyên gia, bác sĩ đầu ngành.
    </p>

    <h2 class="text-2xl sm:text-3xl font-bold text-blue-900 mb-8">
        Quy trình thăm khám và điều trị bệnh ngoại trú tại Bệnh viện Đa khoa TAT
    </h2>

    <div class="mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-3">
            Bước 1: Đăng ký khám, xuất trình giấy tờ tùy thân và BHYT tại quầy Lễ tân
        </h3>
        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li>Khách hàng xuất trình giấy tờ tùy thân (Chứng minh nhân dân, Thẻ căn cước công dân, Passport) cùng thẻ BHYT cho bộ phận Lễ tân.</li>
            <li>Nhân viên bộ phận Lễ tân đối chiếu thông tin thẻ BHYT và giấy tờ tùy thân, tiến hành đăng ký lịch khám với bác sĩ theo yêu cầu của khách hàng.</li>
        </ul>
    </div>

    <div class="mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-3">
            Bước 2: Thực hiện kiểm tra sinh hiệu tại quầy Điều dưỡng ở phòng khám
        </h3>
        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li>Khách hàng theo số thứ tự khám bệnh đã lấy từ quầy Lễ tân đến quầy Điều dưỡng phòng khám để được kiểm tra sinh hiệu.</li>
        </ul>
    </div>

    <div class="mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-3">
            Bước 3: Gặp bác sĩ khám, chẩn đoán và chỉ định các xét nghiệm, điều trị tiếp theo (nếu có)
        </h3>
        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li>Các bác sĩ, chuyên gia đầu ngành trực tiếp thăm khám và đánh giá tình trạng; chẩn đoán, tư vấn và yêu cầu các chỉ định lâm sàng (xét nghiệm, X-quang, siêu âm...).</li>
        </ul>
    </div>

    <div class="mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-3">
            Bước 4: Thanh toán phí cận lâm sàng tại quầy Thu ngân
        </h3>
        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li>Khách hàng tiến hành thanh toán các khoản phí cận lâm sàng.</li>
        </ul>
    </div>

    <div class="mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-3">
            Bước 5: Thực hiện các xét nghiệm cận lâm sàng theo chỉ định của bác sĩ
        </h3>
        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li>Dựa trên chỉ định của bác sĩ mà khách hàng lần lượt tiến hành các xét nghiệm cận lâm sàng như siêu âm, xét nghiệm máu, chụp X-quang, MRI, CT scanner...</li>
        </ul>
    </div>

    <div class="mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-3">
            Bước 6: Gặp bác sĩ đọc kết quả và tư vấn phương pháp điều trị
        </h3>
        <ul class="list-disc ml-6 space-y-2 text-gray-700">
            <li>Sau khi có đầy đủ kết quả kiểm tra cận lâm sàng cần thiết, khách hàng gặp bác sĩ để được tư vấn tình trạng, phương pháp điều trị, cho toa thuốc, chỉ định nhập viện, chuyển viện hoặc hướng điều trị phù hợp và tốt nhất cho từng khách hàng.</li>
            <li>Khách hàng còn được tư vấn chế độ dinh dưỡng, tập luyện, các biện pháp phòng ngừa bệnh tật hiệu quả.</li>
        </ul>
    </div>

    <div class="mb-10">
        <h3 class="text-xl font-bold text-gray-800 mb-3">
            Bước 7: Mua thuốc và thanh toán tại Nhà thuốc bệnh viện
        </h3>
        <div class="ml-4 space-y-4">
            <h4 class="font-semibold text-gray-700">Đối với khách hàng không có BHYT:</h4>
            <ul class="list-disc ml-6 space-y-2 text-gray-700">
                <li>Khách hàng tiến hành mua thuốc và nghe hướng dẫn cách sử dụng thuốc.</li>
            </ul>
            
            <h4 class="font-semibold text-gray-700">Đối với khách hàng có BHYT:</h4>
            <ul class="list-disc ml-6 space-y-2 text-gray-700">
                <li>Khách hàng được hướng dẫn dẫn thủ tục ra viện (nếu nhập viện), được thông báo khoản chi phí cuối cùng phải thanh toán sau trừ thẻ BHYT.</li>
                <li>Khách hàng nhận lại thẻ BHYT cùng các giấy tờ tùy thân.</li>
                <li>Khách hàng nhận thuốc và được hướng dẫn, giải thích về liều lượng thuốc dùng theo chỉ định của bác sĩ.</li>
            </ul>
        </div>
    </div>
    
    <div class="mb-10 border-t pt-6 border-gray-200">
        <p class="text-gray-700 leading-relaxed">
            <span class="font-bold text-gray-900">Lưu ý:</span> Trong tất cả những bước trên, nếu Quý khách hàng gặp khó khăn hoặc bất tiện ở bất kỳ bước nào xin vui lòng liên hệ nhân viên tại quầy Chăm sóc khách hàng hoặc Nhân viên y tế để được hướng dẫn chi tiết và nhanh chóng.
        </p>
    </div>

    <p class="mb-8 text-gray-700 leading-relaxed">
        Để được tư vấn về <span class="font-bold">quy trình khám và điều trị ngoại trú, đặt lịch khám online</span> với các chuyên gia đầu ngành tại Bệnh viện Đa khoa TAT, quý khách hàng vui lòng liên hệ:
    </p>

    <div class="text-center mb-6">
        <h4 class="text-xl font-bold text-gray-800">HỆ THỐNG BỆNH VIỆN ĐA KHOA TAT</h4>
    </div>

    <div class="ml-4 space-y-5">
        
        <div class="space-y-1">
            <h5 class="font-bold text-lg text-gray-800">• Hà Nội:</h5>
            <ul class="list-disc ml-6 space-y-1 text-gray-700">
                <li> Hotline <a href="tel:02438723872" class="text-blue-600 hover:underline">024 3872 3872</a> – <a href="tel:02471066858" class="text-blue-600 hover:underline">024 7106 6858</a></li>
                <li> Địa chỉ: 108 Hoàng Như Tiếp, phường Bồ Đề, TP. Hà Nội</li>
            </ul>
        </div>
        <ul class="list-disc ml-6 space-y-1 text-gray-700">
            <li>
                <span class="font-bold text-gray-800">Fanpage Bệnh viện Đa khoa TAT</span>: 
                <a href="#" class="text-blue-600 hover:underline">Bệnh viện Đa khoa TAT</a>
            </li>
        </ul>
        
    </div>

</div>
@endsection