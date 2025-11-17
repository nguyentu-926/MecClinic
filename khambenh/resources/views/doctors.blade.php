@extends('layouts.patient')

@section('title', 'Hướng Dẫn Khách Hàng Điều Trị Nội Trú')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-blue-600">
            HƯỚNG DẪN KHÁCH HÀNG ĐIỀU TRỊ NỘI TRÚ
        </h1>
        <div class="w-16 h-1 bg-gray-400 mx-auto mt-2"></div>
    </div>

    <p class="mb-12 text-gray-700 leading-relaxed">
        Sức khỏe là vốn quý nhất của con người, BVĐK TAT luôn mong muốn dành những điều tốt đẹp nhất cho quý khách. Dưới đây là một số thông tin **hướng dẫn khách hàng điều trị nội trú** cần thiết dành cho khách hàng trong trường hợp khách hàng cần điều trị nội trú. Quý khách vui lòng đọc kỹ các hướng dẫn này để được phục vụ tốt nhất.
    </p>

    <h2 class="text-2xl font-bold text-blue-900 mb-4">
        Đăng ký nhập viện điều trị nội trú
    </h2>
    <p class="mb-8 text-gray-700 leading-relaxed">
        Khi có chỉ định nhập viện điều trị nội trú, khách hàng sẽ được tư vấn chi phí điều trị, hướng dẫn lựa chọn phòng nội trú và nộp tạm ứng để nhập viện. Chi phí giường bệnh được tính từ thời điểm quý khách nhận viên cho tới khi trả phòng.
    </p>

    <h2 class="text-2xl font-bold text-blue-900 mb-4">
        Thủ tục nhập viện
    </h2>
    <p class="mb-3 text-gray-700 leading-relaxed">
        Để hoàn tất thủ tục hành chính, quý khách lưu ý cần mang theo một số giấy tờ cần thiết bao gồm:
    </p>
    <ul class="list-disc ml-6 space-y-2 text-gray-700 mb-8">
        <li>Chứng minh thư nhân dân/Căn cước công dân/Hộ chiếu, Giấy khai sinh (nếu là trẻ em).</li>
        <li>Thẻ Bảo hiểm tư nhân (bắt buộc trong vòng 24h kể từ giờ nhập viện – nếu có).</li>
        <li>Thẻ Bảo hiểm y tế nhà nước (trong trường hợp quý khách muốn làm giấy nghỉ hưởng bảo hiểm xã hội).</li>
        <li>Sổ hộ khẩu (photo) của sản phụ (trong trường hợp sinh bé).</li>
        <li>Các loại thẻ ưu đãi khác (nếu có).</li>
        <li>Hồ sơ y tế khác theo yêu cầu của bác sĩ (kết quả chẩn đoán hình ảnh, đơn thuốc...).</li>
    </ul>

    <h2 class="text-2xl font-bold text-blue-900 mb-4">
        Thời gian Nhập viện
    </h2>
    <p class="mb-3 text-gray-700 leading-relaxed">
        Thời gian tiếp nhận **24/7** theo chỉ định của bác sĩ. Thời gian nhận phòng và trả phòng tính từ mốc thời gian 12:00pm. Ngoài thời gian trên sẽ tính theo phụ thu thực tế thời gian lưu viện cụ thể. Nếu cần hỗ trợ hoặc hướng dẫn, Quý khách có thể đến Quầy Lễ tân sảnh chính để được giúp đỡ.
    </p>
    <p class="text-gray-700 leading-relaxed italic mb-8">
        Xem thêm: <a href="#" class="text-blue-600 hover:underline">Thủ tục nhập và xuất viện tại bệnh viện Đa khoa TAT</a>
    </p>

    <div class="mb-8 p-3 bg-red-50/50 border-l-4 border-red-500 rounded-sm">
        <p class="text-red-700 leading-relaxed">
            <span class="font-bold">Lưu ý:</span> Sau khi Quý Khách đồng ý nhập viện, Quý khách vui lòng hoàn tất tạm ứng viện phí trước khi nhập viện tại Quầy Thu ngân. Tạm ứng có thể khác với chi phí thực tế, phụ thuộc vào tình trạng sức khỏe, phương pháp điều trị, thuốc và các vật tư y tế sẽ được sử dụng trong quá trình lưu viện của Quý Khách. Nếu quý khách đang điều trị ngoại trú thì cần thanh toán hết chi phí này trước khi làm thủ tục nhập viện.
        </p>
    </div>

    <h2 class="text-2xl font-bold text-blue-900 mb-4">
        Thời gian lưu viện
    </h2>
    <p class="mb-3 text-gray-700 leading-relaxed">
        Trong suốt thời gian lưu viện điều trị nội trú, khách hàng sẽ được mang vòng định danh trên tay với các thông số cơ bản: Họ và tên; Ngày sinh; Mã Bệnh nhân. Trước khi thực hiện bất cứ thăm khám, can thiệp y tế, phẫu thuật nào, Quý khách sẽ được định danh bằng ít nhất 2 thông số:
    </p>
    <ol class="list-decimal ml-6 space-y-2 text-gray-700">
        <li>Họ tên đầy đủ</li>
        <li>Ngày tháng năm sinh để tránh tối đa các sai sót có thể xảy ra.</li>
    </ol>

    <p class="mt-4 mb-8 text-gray-700 leading-relaxed">
        Với mong muốn Quý khách có thời gian lưu viện thoải mái và dễ chịu nhất, đội ngũ bác sĩ và điều dưỡng của bệnh viện sẽ luôn đồng hành để chăm sóc, luôn sẵn sàng hỗ trợ Quý khách trong bất cứ tình huống nào. Quý khách có thể bấm nút **"Chuông báo"** được lắp đặt sẵn tại đầu giường để đàm thoại 2 chiều với điều dưỡng. Khi cần giúp đỡ trong phòng vệ sinh, Quý khách giật dây **"Chuông báo"** để gọi điều dưỡng. Các vật dụng được cung cấp miễn phí trong quá trình nằm viện: Đồ phục người bệnh theo quy định của bệnh viện, Drap trải giường sẽ được thay mỗi ngày. Toàn bộ vật dụng trong phòng: khăn, sữa tắm, dầu gội, kem đánh răng, dép đi trong phòng, móc áo... được trang bị sẵn trong suốt thời gian lưu trú. Nước uống được cung cấp thường xuyên. Nếu cần thêm nước nóng, vui lòng gọi Nhân viên dịch vụ phòng/Điều dưỡng để được hỗ trợ.
    </p>

    <p class="mb-3 text-gray-700 leading-relaxed font-semibold">
        Bên cạnh đó về việc điều trị trong thời gian lưu viện được đảm bảo an toàn và hiệu quả, Quý khách hàng sử dụng dịch vụ điều trị nội trú cần tuân thủ nội quy lưu viện:
    </p>
    <ul class="list-disc ml-6 space-y-2 text-gray-700 mb-8">
        <li>Cần chấp hành nghiêm y lệnh điều trị, chăm sóc của bác sĩ điều trị và nhân viên y tế. Khi có điều gì chưa rõ về phương pháp điều trị và chăm sóc đề nghị gặp bác sĩ điều trị và nhân viên y tế để được giải đáp.</li>
        <li>Luôn có mặt tại buồng bệnh trong thời gian điều trị nội trú, khi ra khỏi khoa phải được sự đồng ý của bác sĩ điều trị và nhân viên y tế. Nếu người bệnh ra khỏi bệnh viện phải ký vào hồ sơ bệnh án.</li>
        <li>Chỉ sử dụng chẩn đoán khẩn cấp (nếu có) khi người bệnh có diễn biến bất thường hoặc cần sự giúp đỡ từ nhân viên y tế.</li>
        <li>Giữ gìn các tài sản mượn và các phương tiện có trong buồng bệnh, nếu làm mất, vỡ, hỏng phải bồi thường theo quy định của bệnh viện. Khi có phương tiện hỏng đề nghị báo ngay cho nhân viên y tế được biết.</li>
        <li>Sử dụng điện nước tiết kiệm, trước khi ra khỏi phòng, đề nghị tắt tất cả các thiết bị đang sử dụng (điện, nước v.v..). Không mang vật dụng đun nấu, giặt giũ, các vật liệu dễ cháy nổ vào sử dụng trong buồng bệnh.</li>
        <li>Giữ gìn vệ sinh (buồng bệnh, hành lang, vệ sinh v.v). Giữ trật tự, yên lặng, tuyệt đối không hút thuốc trong buồng bệnh.</li>
        <li>Người nhà đến thăm người bệnh không được ngồi hoặc nằm trên giường bệnh.</li>
        <li>Để đồ đạc, đồ dùng cá nhân đúng vị trí (trong ngăn tủ) theo quy định. Bệnh viện đã có phương tiện cung cấp nước uống thuốc, tủ đựng đồ cho người bệnh, đề nghị hạn chế mang các vật dụng không cần thiết vào buồng bệnh.</li>
        <li>Người bệnh có trách nhiệm thanh toán viện phí theo đúng quy định của nhà nước và thanh toán các dịch vụ theo quy định của bệnh viện.</li>
        <li>Khi vào thăm người bệnh nếu đưa trẻ em dưới 12 tuổi phải có người lớn đi kèm, không vào buồng bệnh quá 3 người.</li>
    </ul>

    <p class="mb-3 text-gray-700 leading-relaxed">
        **Bệnh nhân nội trú tại Bệnh viện Đa khoa TAT** sẽ được các bác sĩ và chuyên gia dinh dưỡng theo dõi, tư vấn chăm sóc sức khỏe, đảm bảo cung cấp một chế độ ăn uống hợp lý, bao gồm **3 bữa chính** (sáng, trưa và tối) và **1 bữa phụ vào lúc xế chiều**.
    </p>
    <p class="mb-8 text-gray-700 leading-relaxed">
        Nhằm đảm bảo cung cấp cho Quý khách chế độ ăn uống hợp lý, vệ sinh theo tư vấn của bác sĩ chuyên khoa dinh dưỡng của bệnh viện, vào buổi sáng lúc **8h30-9h** ngày hôm trước, nhân viên phục vụ phòng sẽ gặp Quý khách để nhận thông tin lựa chọn thực đơn cho ngày hôm sau và khoảng **15h** cùng ngày (khi mang bữa xế sang) sẽ chốt lại lần nữa, nếu Quý khách hàng có nhu cầu thay đổi món có thể báo lại với điều dưỡng. Với các trường hợp có nhu cầu cung cấp món ăn đặc biệt, Quý khách vui lòng thông báo cho điều dưỡng.
    </p>

    <div class="mb-10 p-3 bg-red-50/50 border-l-4 border-red-500 rounded-sm">
        <p class="text-red-700 leading-relaxed">
            <span class="font-bold">Lưu ý:</span> Vì lý do y tế, người nhà khách hàng đang điều trị nội trú vui lòng không mang đồ ăn từ ngoài vào và ăn trong phòng bệnh.
        </p>
        <p class="text-red-700 leading-relaxed mt-2">
            <span class="font-bold">Phí lưu viện:</span> Phí lưu viện được tính từ thời điểm nhập viện cho tới khi trả phòng để xuất viện. Phí lưu viện 01 (một) ngày được tính 24 tiếng từ 12 giờ hôm trước đến 12 giờ hôm sau.
        </p>
    </div>

    <h2 class="text-2xl font-bold text-blue-900 mb-4">
        Thủ tục xuất viện
    </h2>
    <p class="mb-3 text-gray-700 leading-relaxed">
        Thủ tục xuất viện sẽ được thực hiện vào buổi sáng hàng ngày. Quý Khách sẽ nhận được các giấy tờ y tế khi xuất viện, bao gồm: **Báo cáo y tế ra viện, Kết quả xét nghiệm, kết quả chẩn đoán hình ảnh, bảng kê chi phí và biên lai thanh toán, giấy ra viện, giấy chứng sinh (trường hợp sinh con), toa thuốc (nếu có).**
    </p>
    <p class="mb-3 text-gray-700 leading-relaxed">
        Quý khách muốn lấy thuốc theo đơn xuất viện mang về, vui lòng báo điều dưỡng để làm thủ tục. Tiền thuốc sẽ được tính trong chi phí thanh toán ra viện của Quý khách.
    </p>
    <p class="mb-8 text-gray-700 leading-relaxed">
        Đối với trường hợp sinh tại BVĐK TAT: Quý khách sẽ được nhân viên hành chính trung **tâm Sản Phụ khoa** hướng dẫn điền các thông tin cần thiết trên giấy chứng sinh. Giấy chứng sinh sẽ được cấp khi Quý Khách ra viện. Trong trường hợp người liên hệ lấy Giấy chứng sinh không phải là mẹ, người được ủy quyền cần mang theo Chứng minh thư nhân dân và các giấy tờ của mẹ để được giải quyết thủ tục.
    </p>

    <p class="mb-8 text-gray-700 leading-relaxed">
        Ngoài chi phí tạm ứng ban đầu, các chi phí phát sinh của Quý khách sẽ được thông báo và bổ sung tạm ứng nếu số tiền viện phí thực tế vượt số tiền tạm ứng. Quý khách hoặc gia đình vui lòng thanh toán tại **Quầy Thu ngân** của bệnh viện.
    </p>

    <h2 class="text-2xl font-bold text-blue-900 mb-6">
        Giờ vào thăm bệnh
    </h2>
    <div class="mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-2">Bệnh viện Đa khoa TAT Hà Nội</h3>
        <h4 class="font-semibold text-gray-700 mb-2">Giờ thăm người bệnh</h4>
        <p class="mb-2 text-gray-700 leading-relaxed">
            Khung giờ thăm bệnh từ Thứ Hai đến Chủ Nhật, bao gồm các ngày Lễ, Tết:
        </p>
        <ul class="list-disc ml-6 space-y-1 text-gray-700 mb-3">
            <li>Sáng từ 11:00 – 12:00</li>
            <li>Chiều từ 15:00 – 20:00</li>
        </ul>
        <div class="ml-4 space-y-2">
            <h5 class="font-semibold text-gray-700">Lưu ý:</h5>
            <ul class="list-disc ml-6 space-y-1 text-gray-700">
                <li>Thời gian thăm bệnh tại khoa ICU và NICU tối đa **10 phút/ lượt.**</li>
                <li>Số lượng người thăm: **01 người/ lượt** và tối đa **2 lượt thăm/ khung giờ**</li>
            </ul>
        </div>
        
        <h4 class="font-semibold text-gray-700 mt-5 mb-2">Giờ thăm người bệnh điều trị tại các Khoa Nội trú khác</h4>
        <p class="mb-2 text-gray-700 leading-relaxed">
            Khung giờ thăm bệnh từ Thứ Hai đến Thứ Bảy:
        </p>
        <ul class="list-disc ml-6 space-y-1 text-gray-700 mb-3">
            <li>Sáng từ 6:00 – 7:00</li>
            <li>Chiều từ 15:00 – 20:00</li>
        </ul>
        <p class="mb-2 text-gray-700 leading-relaxed">
            Chủ Nhật và các ngày Lễ, Tết: 6:00 – 20:00
        </p>
        
        <div class="ml-4 space-y-2">
            <h5 class="font-semibold text-gray-700">Lưu ý:</h5>
            <ul class="list-disc ml-6 space-y-1 text-gray-700">
                <li>Số lượng người thăm: tối đa **2 người/ lượt** dành cho người bệnh lưu trú tại phòng đôi, tối đa **3 người/ lượt** dành cho người bệnh lưu trú tại phòng đơn hoặc bao phòng.</li>
                <li>Thời gian thăm bệnh tối đa **30 phút/ lượt**</li>
            </ul>
        </div>
    </div>

    <div class="mt-8 pt-4 border-t border-gray-200">
        <p class="text-gray-700 leading-relaxed">
            Mọi thắc mắc về thủ tục nhập viện hoặc cần **hướng dẫn điều trị nội trú** tại bệnh viện Đa khoa TAT, quý khách vui lòng liên hệ **Điều dưỡng hoặc nhân viên chăm sóc khách hàng** để được hướng dẫn.
        </p>
    </div>

</div>
@endsection