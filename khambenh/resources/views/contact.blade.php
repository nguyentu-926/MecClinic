@extends('layouts.patient')

@section('title', 'Thủ Tục Nhập Viện và Xuất Viện')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-blue-600">
            THỦ TỤC NHẬP VIỆN VÀ XUẤT VIỆN
        </h1>
        <div class="w-16 h-1 bg-gray-400 mx-auto mt-2"></div>
    </div>

    <p class="mb-12 text-gray-700 leading-relaxed">
        Với trang bị hệ thống thiết bị y tế cao cấp nhập khẩu đồng bộ từ các nước tiên tiến hàng đầu trên thế giới và <span class="font-semibold text-blue-600">đội ngũ chuyên gia, Giáo sư, Tiến sĩ, Bác sĩ hàng đầu</span>, Bệnh viện Đa khoa Tâm Anh mang đến dịch vụ chăm sóc sức khỏe cao cấp, toàn diện và hiệu quả nhất. Dưới đây là **thủ tục nhập viện và xuất viện** tại bệnh viện TAT.
    </p>

    <h2 class="text-2xl font-bold text-blue-900 mb-4">
        Thủ tục nhập viện
    </h2>
    <p class="mb-3 text-gray-700 leading-relaxed">
        Khi có chỉ định nhập viện điều trị tại <span class="font-semibold text-blue-600">BVĐK TAT</span>, Quý khách hàng cần chuẩn bị:
    </p>
    <ul class="list-disc ml-6 space-y-2 text-gray-700 mb-8">
        <li>Sổ khám bệnh hoặc giấy chỉ định nhập viện của bác sĩ (nếu có).</li>
        <li>Giấy CMND, Thẻ BHYT (nếu có).</li>
        <li>Kết quả X-Quang, siêu âm và/hoặc các xét nghiệm/chẩn đoán có liên quan.</li>
        <li>Đối với trẻ em: Mang theo đồ chơi yêu thích, sữa uống, bình sữa và các nhu cầu chế độ ăn uống đặc biệt (nếu có).</li>
        <li>Phí tạm ứng nhập viện (theo thông báo của nhân viên phụ trách nhập viện).</li>
        <li>Hạn chế mang theo các tài sản cá nhân có giá trị cao, nếu có, xin vui lòng liên hệ nhân viên để được hướng dẫn bảo quản tại két sắt an toàn.</li>
    </ul>

    <p class="mb-10 text-gray-700 leading-relaxed">
        Trước khi nhập viện, Quý khách và người nhà sẽ được nhân viên phụ trách hướng dẫn cụ thể các thủ tục và giải thích rõ ràng về quy định, chi phí cũng như các vấn đề liên quan.
    </p>

    <div class="mb-10 p-5 bg-gray-50 border border-gray-200 rounded-lg">
        <p class="mb-3 text-gray-700 leading-relaxed">
            Sau khi làm các thủ tục nhập viện, Quý khách được đưa đến phòng lưu trú trong quá trình điều trị. Tất cả các tầng điều trị đều có đội ngũ y tá, điều dưỡng trực **24/24** hỗ trợ, tư vấn Quý khách trong suốt quá trình điều trị tại bệnh viện TAT.
        </p>
        <p class="mb-3 text-gray-700 leading-relaxed">
            Tại Bệnh viện Đa khoa TAT, Quý khách sẽ nhận được sự chăm sóc chu đáo, tận tâm như đang đi **"nghỉ dưỡng"**: từ chiếc drap trải giường thơm mịn được thay mỗi ngày; những vật dụng cá nhân như khăn, sữa tắm, dầu gội, kem đánh răng, dép đi trong phòng, móc áo,... được trang bị sẵn trong suốt thời gian lưu trú; chuông gọi điều dưỡng đến tận phòng bất cứ lúc nào; dịch vụ lấy mẫu tại phòng; những bữa ăn ấm nóng, đầy đủ dinh dưỡng và những giấc ngủ ngon với hệ thống điều hòa mát mẻ vào mùa hè và hệ thống sưởi ấm áp vào mùa đông...
        </p>
        <p class="text-gray-700 leading-relaxed">
            Bệnh nhân nội trú tại Bệnh viện Đa khoa TAT sẽ được các bác sĩ và chuyên gia dinh dưỡng theo dõi, tư vấn kế hoạch chăm sóc sức khỏe, đảm bảo cung cấp một chế độ ăn uống hợp lý, bao gồm **2 bữa chính (trưa và tối) và 2 bữa phụ (sáng + xế chiều)/ngày.**
        </p>
    </div>

    <h2 class="text-2xl font-bold text-blue-900 mb-4">
        Thủ tục xuất viện
    </h2>
    <p class="mb-3 text-gray-700 leading-relaxed">
        Thủ tục xuất viện sẽ được thực hiện vào **buổi sáng hàng ngày**.
    </p>
    <ul class="list-disc ml-6 space-y-2 text-gray-700 mb-8">
        <li>Quý khách sẽ nhận được các giấy tờ y tế khi xuất viện, bao gồm: **Báo cáo y tế ra viện, kết quả xét nghiệm, kết quả chẩn đoán hình ảnh, bảng kê chi phí và biên lai thanh toán, giấy ra viện, giấy chứng sinh (trường hợp sinh con), toa thuốc (nếu có).**</li>
        <li>Quý khách muốn lấy thuốc theo đơn xuất viện mang về, vui lòng báo điều dưỡng để làm thủ tục. Tiền thuốc sẽ được tính trong chi phí thanh toán ra viện của Quý Khách.</li>
        <li>Đối với trường hợp sinh tại BVĐK TAT: Quý khách sẽ được nhân viên hành chính **khoa Sản** hướng dẫn điền các thông tin cần thiết trên giấy chứng sinh. Giấy chứng sinh sẽ được cấp khi Quý Khách ra viện. Trong trường hợp người liên hệ lấy Giấy chứng sinh không phải là mẹ, người được ủy quyền cần mang theo Chứng minh thư nhân dân và các giấy tờ của mẹ để được giải quyết thủ tục.</li>
        <li>Trong trường hợp viện phí của Quý khách đã được công ty bảo hiểm xác nhận, Quý khách vẫn cần đến quầy thu ngân để ký xác nhận hóa đơn thanh toán và hoàn tất thủ tục xuất viện.</li>
    </ul>

    <h3 class="text-xl font-bold text-gray-800 mb-3">
        Khi xuất viện, Quý khách lưu ý:
    </h3>
    <ul class="list-disc ml-6 space-y-2 text-gray-700 mb-10">
        <li>Đơn thuốc điều trị duy trì tại nhà của bác sĩ cùng với hướng dẫn cụ thể về các loại thuốc cũng như cách sử dụng;</li>
        <li>Giấy xác nhận nằm viện có chữ ký bác sĩ;</li>
        <li>Các kết quả chẩn đoán hình ảnh (X-quang, chụp cắt lớp), các xét nghiệm máu được thực hiện trong khi điều trị;</li>
        <li>Thông báo chi tiết quá trình điều trị nếu cần;</li>
        <li>Phiếu hẹn tái khám nếu có chỉ định của bác sĩ;</li>
        <li>Đồ dùng, vật dụng cá nhân mang theo khi vào viện.</li>
    </ul>

    <p class="mb-8 text-gray-700 leading-relaxed font-semibold">
        Mọi thắc mắc về thủ tục nhập viện và xuất viện, Quý khách vui lòng liên hệ Bộ phận Điều dưỡng hoặc Chăm sóc khách hàng của bệnh viện để được hướng dẫn chi tiết.
    </p>

    <div class="text-center mb-6">
        <h4 class="text-xl font-bold text-gray-800">HỆ THỐNG BỆNH VIỆN ĐA KHOA TAT</h4>
    </div>

    <div class="ml-4 space-y-5">
        
        <div class="space-y-1">
            <h5 class="font-bold text-lg text-gray-800">• Hà Nội:</h5>
            <ul class="list-disc ml-6 space-y-1 text-gray-700">
                <li> 108 Hoàng Như Tiếp, P.Bồ Đề, Q.Long Biên, TP.Hà Nội</li>
                <li> Hotline <a href="tel:02438723872" class="text-blue-600 hover:underline">024 3872 3872</a> – <a href="tel:02471066858" class="text-blue-600 hover:underline">024 7106 6858</a></li>
            </ul>
        </div>
    </div>

</div>
@endsection