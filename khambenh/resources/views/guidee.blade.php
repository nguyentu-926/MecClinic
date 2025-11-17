@extends('layouts.patient')

@section('title', 'HƯỚNG DẪN KHÁM BỆNH')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-6xl">
    <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">
        HƯỚNG DẪN KHÁM BỆNH
    </h1>

    <div class="text-gray-700 space-y-5 text-justify">
        <p>
            Ngay nay, nhu cầu khám chữa bệnh, chăm sóc sức khỏe của người dân ngày một gia tăng và yêu cầu cao hơn về chất lượng và dịch vụ. Nhờ việc thăm khám sức khỏe thường xuyên và định kỳ mà họ có thể phát hiện sớm các căn bệnh nguy hiểm để có hướng điều trị kịp thời, tránh các nguy cơ ảnh hưởng xấu đến sức khỏe trong tương lai. Dưới đây là quy trình **hướng dẫn khám bệnh** chi tiết từ A-Z tại Bệnh viện Đa khoa TAT.
        </p>
        <p>
            Với mục tiêu xây dựng và định hướng **Bệnh viện Đa khoa TAT** trở thành địa chỉ tin cậy trong việc khám, chữa bệnh cao cấp theo tiêu chuẩn Bệnh viện khách sạn. Bệnh viện Đa khoa TAT đã đầu tư hệ thống trang thiết bị, tiện nghi hiện đại, đội ngũ chuyên gia, bác sỹ, nhân viên y tế hàng đầu trực tiếp thăm khám, điều trị nhằm đáp ứng toàn diện nhu cầu chăm sóc sức khỏe cao cấp của khách hàng, bệnh nhân trên cả nước.
        </p>

        <h2 class="text-2xl font-bold text-blue-800 mt-8 mb-4">
            Khách hàng sẽ nhận được
        </h2>
        {{-- Phần nội dung chi tiết về Khách hàng sẽ nhận được --}}
        <p>
            Tại Bệnh viện Đa khoa TAT, mỗi người bệnh đều được xác định là một khách hàng quan trọng – đối tượng cần phải được chăm sóc và phục vụ đặc biệt, toàn diện **24/24** bao gồm cả dịch vụ y tế cũng như các dịch vụ ăn, nghỉ, giải trí theo tiêu chuẩn của các khách sạn cao cấp.
        </p>
        {{-- ... (Thêm các đoạn p và ul khác ở đây) ... --}}
        <p>
            Khách hàng/bệnh nhân sẽ được đón tiếp, chăm sóc và hướng dẫn tận tình, chuyên nghiệp bởi đội ngũ nhân viên chăm sóc khách hàng được đào tạo bài bản các kỹ năng cần thiết, giúp mang lại cảm giác thân thiện, thoải mái và hài lòng nhất.
        </p>
        <p>
            Khách hàng có thể đến để được tư vấn, khám, chữa bệnh với các dịch vụ có sẵn, hoặc yêu cầu các dịch vụ theo nhu cầu của từng cá nhân với phòng chờ và phòng khám riêng biệt, quyền lựa chọn giờ khám, bác sỹ khám… khu vực dành cho rộng rãi, tiện nghi với nước uống, chăn lạnh, wifi, sách, báo, tạp chí miễn phí. Nhà hàng, quán café sang trọng tại tầng 6 phục vụ 24/24 với thực đơn phong phú, giá cả hợp lí.
        </p>
        <p>
            Bệnh viện Đa khoa TAT sẵn sàng tiếp nhận bệnh nhân đến khám thông thường mà không hẹn trước. Tuy nhiên chúng tôi khuyến khích quý khách nên đặt hẹn trước ít nhất một ngày để giảm thiểu thời gian chờ đợi.
        </p>

        <ul class="list-disc ml-6 space-y-2">
            <li>
                Để đặt hẹn, vui lòng gọi theo số: **024 3872 3872** (Hà Nội).
            </li>
            <li>
                Bộ phận đặt hẹn của chúng tôi làm việc 24/24 và 7 ngày/tuần để thuận tiện cho quý khách.
            </li>
            <li>
                Đối với khách hàng có hẹn: vui lòng ngày hẹn, quý khách sẽ được đón tiếp và hướng dẫn điền hồ sơ cá nhân (nếu là lần đầu đến khám) và khám theo giờ hẹn. Quý khách vui lòng bấm vào **Đăng Ký Khám Bệnh** để tiến hành đặt lịch hẹn nhé.
            </li>
            <li>
                Đối với khách hàng không hẹn trước: Bệnh nhân được tiếp đón và hoàn thiện các thủ tục (điền hồ sơ với khách hàng lần đầu) và thăm khám theo thứ tự.
            </li>
        </ul>

        <p>
            Bệnh viện Đa khoa TAT áp dụng chính sách ưu tiên thứ tự khám với bệnh nhân cấp cứu, Mẹ Việt Nam Anh Hùng. Ngoài ra còn có **Cách mạng, thương bệnh binh và các trường hợp đặc biệt**. Tuy nhiên, chúng tôi vẫn cố gắng đảm bảo giờ khám, lượt khám đối với các khách hàng khác. Nếu khách hàng có các vấn đề cá nhân đặc biệt, xin vui lòng thông báo khi đặt hẹn hoặc với nhân viên tại quầy làm thủ tục khám.
        </p>

        <h2 class="text-2xl font-bold text-red-600 mt-8 mb-4">
            Lưu ý
        </h2>
        <ul class="list-disc ml-6 space-y-2">
            <li>
                Nếu không thể tới đúng giờ hẹn hoặc muốn dời hẹn sang ngày khác, xin quý khách vui lòng liên lạc với bộ phận đặt hẹn.
            </li>
            <li>
                Khi đi khám, quý khách vui lòng mang theo các kết quả xét nghiệm, chẩn đoán hình ảnh và đơn thuốc đã làm ở nơi khác (nếu có). Tuy nhiên, bác sỹ có thể yêu cầu quý khách làm lại hoặc làm thêm các thăm khám khác nếu cần thiết.
            </li>
            <li>
                Đối với khách hàng đến khám lần đầu cần mang theo chứng minh nhân dân (đối với người Việt Nam) và hộ chiếu (đối với khách nước ngoài).
            </li>
        </ul>
        
        <p class="text-center font-semibold mt-8 italic">
            Cảm ơn Quý vị đã lựa chọn sử dụng dịch vụ tại Bệnh viện Đa khoa TAT!
        </p>
    </div>
</div>
{{-- PHẦN ĐỐI TÁC BẢO HIỂM --}}
<div class="container mx-auto px-4 pt-0 pb-8 max-w-6xl">
    <h2 class="text-3xl font-bold text-blue-800 mb-6 text-center">
        ĐỐI TÁC BẢO HIỂM
    </h2>
    {{-- Sử dụng grid-cols-2 trên mobile, grid-cols-3 trên sm, và grid-cols-5 trên lg để căn 5 logo --}}
    <div class="grid grid-cols-3 sm:grid-cols-5 gap-4 items-center justify-items-center">
        
        {{-- Logo 1: MIC --}}
        <div class="p-2">
            <img src="{{ asset('images/b1.png') }}" alt="Logo MIC" class="h-16 w-auto object-contain mx-auto">
        </div>
        
        {{-- Logo 2: AIA --}}
        <div class="p-2">
            <img src="{{ asset('images/b2.png') }}" alt="Logo AIA" class="h-16 w-auto object-contain mx-auto">
        </div>

        {{-- Logo 3: VietinBank Insurance --}}
        <div class="p-2">
            <img src="{{ asset('images/b3.png') }}" alt="Logo VietinBank Insurance" class="h-16 w-auto object-contain mx-auto">
        </div>
        
        {{-- Logo 4: PJICO --}}
        <div class="p-2">
            <img src="{{ asset('images/b4.png') }}" alt="Logo PJICO" class="h-16 w-auto object-contain mx-auto">
        </div>
        
        {{-- Logo 5: Insmart --}}
        <div class="p-2">
            <img src="{{ asset('images/b5.png') }}" alt="Logo Insmart" class="h-16 w-auto object-contain mx-auto">
        </div>
    </div>
</div>
{{-- END PHẦN ĐỐI TÁC BẢO HIỂM --}}
@endsection