@extends('layouts.patient')

@section('title', 'Hướng Dẫn Khám Bệnh')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-blue-600">
            HƯỚNG DẪN KHÁM BỆNH
        </h1>
        <div class="w-12 h-1 bg-gray-400 mx-auto mt-2"></div>
    </div>

    <p class="mb-5 text-gray-700 leading-relaxed">
        Ngày nay, nhu cầu khám chữa bệnh, chăm sóc sức khỏe của người dân ngày một gia tăng và yêu cầu cao hơn về chất lượng và dịch vụ. Nhờ việc thăm khám sức khỏe thường xuyên và định kỳ mà họ có thể phát hiện sớm các căn bệnh nguy hiểm để có hướng điều trị kịp thời, tránh các nguy cơ ảnh hưởng xấu đến sức khỏe trong tương lai. Dưới đây là quy trình **hướng dẫn khám bệnh** chi tiết từ A-Z tại bệnh viện Đa khoa TAT.
    </p>

    <p class="mb-8 text-gray-700 leading-relaxed">
        Với mục tiêu xây dựng và định hướng <span class="text-blue-600 font-semibold">Bệnh viện Đa khoa TAT</span> trở thành địa chỉ tin cậy trong việc khám, chữa bệnh cao cấp theo tiêu chuẩn Bệnh viện khách sạn. Bệnh viện Đa khoa TAT đã đầu tư hệ thống trang thiết bị, tiện nghi hiện đại, đội ngũ **chuyên gia, bác sỹ, nhân viên y tế** hàng đầu trực tiếp thăm khám, điều trị nhằm đáp ứng toàn diện nhu cầu chăm sóc sức khỏe cao cấp của khách hàng, bệnh nhân trên cả nước.
    </p>

    <h2 class="text-xl sm:text-2xl font-bold text-blue-800 mb-4">
        Khách hàng sẽ nhận được
    </h2>

    <p class="mb-5 text-gray-700 leading-relaxed">
        Tại Bệnh viện Đa khoa TAT, mỗi người bệnh đều được xác định là một khách hàng quan trọng – đối tượng cần phải được chăm sóc và phục vụ đặc biệt, toàn diện **24/24** bao gồm cả dịch vụ y tế cũng như các dịch vụ ăn, nghỉ, giải trí theo tiêu chuẩn của các khách sạn sang cao cấp.
    </p>
    <p class="mb-5 text-gray-700 leading-relaxed">
        Khách hàng/bệnh nhân sẽ được đón tiếp, chăm sóc và hướng dẫn tận tình, chuyên nghiệp bởi đội ngũ nhân viên chăm sóc khách hàng được đào tạo bài bản các kỹ năng cần thiết, giúp mang lại cảm giác thân thiện, thoải mái và hài lòng nhất.
    </p>
    <p class="mb-8 text-gray-700 leading-relaxed">
        Khách hàng có thể đến để được tư vấn, khám, chữa bệnh với các dịch vụ có sẵn, hoặc yêu cầu các dịch vụ theo nhu cầu của từng cá nhân với phòng chờ và phòng khám riêng biệt, quyền lựa chọn giờ khám, bác sỹ khám... Khu vực sảnh chờ rộng rãi, tiện nghi với nước uống, khăn lạnh, wifi, sách, báo, tạp chí miễn phí. Nhà hàng, quán café sang trọng tại tầng 6 phục vụ **24/24** với thực đơn phong phú, giá cả hợp lí.
    </p>

    <p class="mb-5 text-gray-700 leading-relaxed">
        Bệnh viện Đa khoa TAT sẵn sàng tiếp nhận bệnh nhân đến khám thông thường mà không hẹn trước. Tuy nhiên chúng tôi khuyên quý khách nên **đặt hẹn trước** ít nhất một ngày để giảm thiểu thời gian chờ đợi.
    </p>

    <ul class="list-disc ml-5 space-y-3 text-gray-700 mb-8">
        <li>
            Để đặt hẹn, vui lòng gọi theo số: <span class="text-blue-600 font-bold hover:underline">0914106932</span> (Hà Nội).
        </li>
        <li>
            Bộ phận đặt hẹn của chúng tôi làm việc **24/24** và **7 ngày/tuần** để thuận tiện cho quý khách.
        </li>
        <li>
            Đối với khách hàng có hẹn: vào ngày hẹn khám, quý khách sẽ được đón tiếp và hướng dẫn đến hồ sơ cá nhân (nếu là lần đầu đến khám) và khám theo giờ hẹn. Quý khách vui lòng bấm vào <span class="text-blue-600 font-semibold hover:underline">Đăng Ký Khám Bệnh</span> để tiến hành đặt lịch hẹn nhé.
        </li>
        <li>
            Đối với khách hàng hẹn trước: Bệnh nhân được tiếp đón và hoàn thiện các thủ tục (điền hồ sơ với khách khám lần đầu) và thăm khám theo thứ tự.
        </li>
    </ul>

    <p class="mb-8 text-gray-700 leading-relaxed">
        Bệnh viện Đa khoa TAT áp dụng chính sách ưu tiên thứ tự khám với bệnh nhân cấp cứu, Mẹ Việt Nam Anh Hùng, Người có công với Cách mạng, thương bệnh binh và các trường hợp đặc biệt. Tuy nhiên, chúng tôi vẫn cố gắng đảm bảo giờ khám, lượt khám đối với các khách hàng khác. Nếu khách hàng có các vấn đề cá nhân đặc biệt, xin vui lòng thông báo khi đặt hẹn hoặc với nhân viên tại quầy làm thủ tục khám.
    </p>

    <h2 class="text-xl sm:text-2xl font-bold text-blue-800 mb-4">
        Lưu ý
    </h2>

    <ul class="list-disc ml-5 space-y-3 text-gray-700 mb-10">
        <li>
            Nếu không thể tới đúng giờ hẹn hoặc muốn dời hẹn sang ngày khác, xin quý khách vui lòng liên lạc với bộ phận đặt hẹn.
        </li>
        <li>
            Khi đi khám, quý khách vui lòng mang theo các **kết quả xét nghiệm, chẩn đoán hình ảnh và đơn thuốc** đã làm ở nơi khác (nếu có). Tuy nhiên, bác sỹ có thể yêu cầu quý khách làm lại hoặc làm thêm các thăm khám khác nếu cần thiết.
        </li>
        <li>
            Đối với khách hàng đến khám lần đầu cần mang theo **chứng minh nhân dân** (đối với người Việt Nam) và **hộ chiếu** (đối với khách nước ngoài).
        </li>
    </ul>

    <p class="text-center italic text-gray-600 pt-5 border-t border-gray-200">
        Cảm ơn Quý vị đã lựa chọn sử dụng dịch vụ tại Bệnh viện Đa khoa TAT!
    </p>

</div>
@endsection