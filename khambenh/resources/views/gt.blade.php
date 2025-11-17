@extends('layouts.patient')

@section('title', 'Hướng dẫn khám bệnh & Dịch vụ')

@section('content')

{{-- Banner Full Width --}}
<div class="w-full m-0 p-0">
    <div class="w-full h-[400px] bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/d27.png') }}');">
    </div>
</div>
{{-- KHỐI VỀ CHÚNG TÔI (image_f87f0f.jpg) --}}
<div class="py-16 bg-blue-50">
    <div class="container mx-auto px-4 max-w-7xl">
        {{-- TIÊU ĐỀ KHỐI --}}
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-blue-800 mb-2">TAT CLIINIC - HỆ THỐNG Y TẾ HÀN LÂM CHUẨN MỰC QUỐC TẾ</h2>
            <div class="w-20 h-1 bg-blue-400 mx-auto mt-2"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            
            {{-- CỘT NỘI DUNG (ĐÃ THÊM KHỐI CUỘN) --}}
            <div class="space-y-4">
                {{-- KHỐI CHỨA VĂN BẢN VỚI THANH CUỘN DỌC --}}
                <div class="max-h-[290px] overflow-y-auto pr-4 custom-scrollbar"> 
                    {{-- Ghi chú: 'pr-4' để tạo khoảng trống cho thanh cuộn. 'custom-scrollbar' nếu bạn muốn tùy chỉnh thanh cuộn --}}

                    <p class="text-gray-700">TAT Clinic là hệ thống y tế hàn lâm chuẩn mực quốc tế thuộc Hệ sinh thái Chăm sóc sức khỏe Tập đoàn TAT. Thành lập năm 2024, TAT hiện là tập đoàn kinh tế đa ngành với hơn 30 đơn vị thành viên hoạt động trong và ngoài nước (Mỹ, Canada...), trên các lĩnh vực cốt lõi: Công nghiệp, Công nghệ, Giáo dục đào tạo, Chăm sóc sức khỏe và các dịch vụ khác.</p>
                    <p class="text-gray-700">Với định hướng phát triển bền vững và nền tảng vững chắc về khoa học công nghệ, hệ thống chuyên nghiệp, con người sẵn sàng thích ứng - đổi mới, hoạt động theo mô hình Hệ sinh thái "3 Nhà": Nhà Sản xuất Kinh doanh - Nhà Khoa học Công nghệ - Nhà Giáo dục Đào tạo, TAT đang vươn lên mạnh mẽ. </p>
                    <p class="text-gray-700 font-semibold">Tầm nhìn: Trở thành một trong những hệ thống y tế hàng đầu Việt Nam và khu vực.</p>

                    {{-- Thêm nội dung dài hơn để kích hoạt thanh cuộn --}}
                    <p class="text-gray-700 mt-4">Năm 2025, Tập đoàn TAT mở rộng lĩnh vực hoạt động sang Y tế với mục tiêu xây dựng hệ thống y tế chuẩn mực quốc tế, cung cấp dịch vụ chăm sóc sức khỏe toàn diện, chất lượng cao, tiếp cận công nghệ y khoa tiên tiến trên thế giới. TAT Clinic ra đời với sứ mệnh chăm sóc sức khỏe cộng đồng bằng trí tuệ, khoa học và công nghệ, góp phần nâng cao chất lượng sống cho người Việt Nam.</p>
                    <p class="text-gray-700">Hệ thống Y tế TAT Clinic được đầu tư đồng bộ, hiện đại từ cơ sở vật chất, trang thiết bị đến đội ngũ chuyên gia, bác sĩ hàng đầu. TAT Clinic đảm bảo ứng dụng các thành tựu khoa học kỹ thuật mới nhất vào khám chữa bệnh, mang lại hiệu quả điều trị tối ưu cho bệnh nhân.</p>
                </div>
                {{-- END KHỐI CUỘN --}}
            </div>

            {{-- CỘT HÌNH ẢNH --}}
            <div>
                <img src="{{ asset('images/d28.png') }}" alt="Toàn cảnh bệnh viện PhenikaaMec" class="rounded-xl shadow-2xl w-full h-auto object-cover">
            </div>
        </div>
    </div>
</div>
{{-- END KHỐI VỀ CHÚNG TÔI --}}
{{-- TẦM NHÌN - SỨ MỆNH - GIÁ TRỊ CỐT LÕI --}}
<div class="py-16 bg-blue-50">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- TIÊU ĐỀ --}}
        <div class="text-left mb-12">
            <h2 class="text-3xl font-bold text-blue-800 mb-2">TẦM NHÌN - SỨ MỆNH - GIÁ TRỊ CỐT LÕI</h2>
        </div>

        {{-- PHẦN 1: 3 THẺ LỚN (TAB BUTTONS) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

            {{-- Dữ liệu dùng chung cho cả 6 khối --}}
            @php
                $items = [
                    'vision' => [
                        'title' => 'Tầm nhìn',
                        'image_small' => 'images/d29.png', // Ảnh cho thẻ nhỏ trên
                        'image_large' => 'images/d29.png', // Ảnh cho khối nội dung dưới
                        'content_title' => 'TẦM NHÌN',
                        'content_text' => 'Trở thành Hệ thống y tế hàn lâm chuẩn mực quốc tế, hướng tới các giá trị Chân – Thiện – Mỹ bằng nghiên cứu đột phá, chất lượng điều trị xuất sắc, dịch vụ chăm sóc hoàn hảo và giáo dục nâng tầm tri thức.',
                    ],
                    'mission' => [
                        'title' => 'Sứ mệnh',
                        'image_small' => 'images/d30.png',
                        'image_large' => 'images/d30.png',
                        'content_title' => 'SỨ MỆNH',
                        'content_text' => 'Cung cấp các giải pháp chăm sóc sức khỏe và y tế học đường toàn diện, tiên tiến, nhân văn, góp phần nâng cao chất lượng cuộc sống cho cộng đồng.',
                    ],
                    'core_value' => [
                        'title' => 'Giá trị cốt lõi',
                        'image_small' => 'images/d31.png',
                        'image_large' => 'images/d31.png',
                        'content_title' => 'GIÁ TRỊ CỐT LÕI',
                        'content_text' => 'Chính trực, Trách nhiệm, Sáng tạo, Nhân văn. Đây là kim chỉ nam cho mọi hoạt động, giúp chúng tôi xây dựng một môi trường y tế chuyên nghiệp và đáng tin cậy.',
                    ],
                ];
            @endphp

            @foreach ($items as $key => $item)
                {{-- Thẻ Tab lớn (Dùng class active để highlight) --}}
                <div id="card-{{ $key }}" data-tab="{{ $key }}"
                    class="tab-card-button relative overflow-hidden rounded-2xl shadow-xl cursor-pointer transition duration-300
                    @if ($key == 'vision') active bg-blue-600 text-white shadow-blue-400/50 @else bg-white hover:shadow-2xl @endif">
                    
                    {{-- Ảnh --}}
                    <div class="h-48 bg-cover bg-center" style="background-image: url('{{ asset($item['image_small']) }}');">
                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-black bg-opacity-30 transition duration-300
                            @if ($key == 'vision') bg-opacity-0 @endif">
                        </div>
                    </div>

                    {{-- Tiêu đề --}}
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-center z-10">
                        <h4 class="text-xl font-bold 
                            @if ($key == 'vision') text-white @else text-gray-800 @endif">
                            {{ $item['title'] }}
                        </h4>
                    </div>
                </div>
            @endforeach
        </div>
        
        {{-- PHẦN 2: NỘI DUNG CHI TIẾT (2 CỘT: ẢNH LỚN + TEXT) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 bg-white p-6 md:p-5 rounded-2xl shadow-xl border border-blue-50">

            @foreach ($items as $key => $item)
                {{-- Khối Nội dung chi tiết --}}
                <div id="content-{{ $key }}" class="tab-content-detail lg:col-span-2 grid grid-cols-1 lg:grid-cols-2 gap-10 transition duration-500 ease-in-out
                    @if ($key == 'vision') block @else hidden @endif"
                    data-tab-content="{{ $key }}">
                    
                    {{-- Cột 1: Ảnh lớn --}}
                    <div class="p-0 relative overflow-hidden rounded-xl shadow-lg border-4 border-blue-500">
                        <img src="{{ asset($item['image_large']) }}" alt="{{ $item['title'] }}" 
                            class="w-full h-full object-cover rounded-md"/>
                    </div>

                    {{-- Cột 2: Text --}}
                    <div class="py-2">
                        <h3 class="text-3xl font-extrabold text-blue-800 mb-5 border-l-4 border-blue-500 pl-3">
                            {{ $item['content_title'] }}
                        </h3>
                        <p class="text-gray-700 leading-relaxed text-lg">
                            {{ $item['content_text'] }}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
{{-- Khối 3: CƠ SỞ VẬT CHẤT HIỆN ĐẠI (Dựa trên image_fa48a9.jpg) --}}
<div class="py-1 bg-blue-50">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- TIÊU ĐỀ & MÔ TẢ --}}
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-800 mb-4">CƠ SỞ VẬT CHẤT HIỆN ĐẠI</h2>
            <div class="w-20 h-1 bg-blue-400 mx-auto mt-2"></div>
            <p class="text-gray-700 mt-6">
                TAT CLINIC là hệ thống y tế hàn lâm chuẩn mực Quốc tế thuộc hệ sinh thái chăm sóc sức khỏe TAT. Với sự đầu tư mạnh mẽ, sử dụng các trang thiết bị y tế, máy móc hiện đại bậc nhất trên thế giới cùng với cơ sở vật chất tiêu chuẩn 5 sao, TAT CLINIC sẽ là một trong những mô hình có dịch vụ y tế chất lượng cao, quy mô lớn trên cả nước.
            </p>
        </div>

        {{-- KHỐI SLIDER GIẢ ĐỊNH (Simulating carousel with grid and buttons) --}}
        <div class="relative">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Ảnh 1 --}}
                <div class="rounded-xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/d32.png') }}" alt="Phòng khám" class="w-full h-72 object-cover transition duration-500 hover:opacity-80">
                </div>
                {{-- Ảnh 2 --}}
                <div class="rounded-xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/d33.png') }}" alt="Khu điều trị" class="w-full h-72 object-cover transition duration-500 hover:opacity-80">
                </div>
                {{-- Ảnh 3 --}}
                <div class="rounded-xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/d34.png') }}" alt="Phòng bệnh" class="w-full h-72 object-cover transition duration-500 hover:opacity-80">
                </div>
            </div>

            {{-- Nút điều hướng (Nếu dùng thư viện carousel thực tế) --}}
            <button class="absolute top-1/2 left-0 transform -translate-y-1/2 p-3 bg-white rounded-full shadow-lg opacity-80 hover:opacity-100 transition duration-300 ml-4 hidden lg:block">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button class="absolute top-1/2 right-0 transform -translate-y-1/2 p-3 bg-white rounded-full shadow-lg opacity-80 hover:opacity-100 transition duration-300 mr-4 hidden lg:block">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>
</div>

{{-- KHỐI CÔNG TY CỔ PHẦN Y HỌC VĨNH THỊNH (Giới thiệu các cơ sở) --}}
<div class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- TIÊU ĐỀ & MÔ TẢ CHUNG --}}
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-800 mb-4">CÔNG TY CỔ PHẦN Y HỌC TAT</h2>
            <div class="w-40 h-1 bg-blue-400 mx-auto mt-2"></div>
            <p class="text-gray-700 mt-6 text-left">
                Là đơn vị chủ quản của Bệnh viện TAT, nằm trong hệ sinh thái chăm sóc sức khỏe của TAT clinic, Công ty CP Y Học TAT là đơn vị bảo hộ và quản lý các hoạt động đồng bộ cho các đơn vị trong lĩnh vực chăm sóc sức khỏe của Tập đoàn và đảm bảo công tác vận hành, đào tạo chuyên môn, nghiên cứu khoa học.
                Trên chặng đường Chăm sóc sức khỏe, các dự án trọng tâm của Vĩnh Thịnh bao gồm: Bệnh viện TATvà Hệ thống phòng khám vệ tinh, Trung tâm Y khoa phục vụ giảng dạy và nghiên cứu. Hệ thống Bệnh viện an điện tử, quản lý bệnh viện theo hướng số hóa, triển khai y tế từ xa...
            </p>
        </div>

        {{-- GRID GIỚI THIỆU CÁC CƠ SỞ --}}
        <div class="grid grid-cols-1 gap-8">
            
            <div class="bg-blue-50 p-6 rounded-xl shadow-lg flex flex-col lg:flex-row gap-6">
                <div class="lg:w-1/2 flex-shrink-0">
                    <img src="{{ asset('images/d35.png') }}" alt="Bệnh viện " class="rounded-xl shadow-lg w-full h-full object-cover">
                </div>
                <div class="lg:w-1/2 space-y-3">
                    <h3 class="text-2xl font-bold text-blue-800 border-b pb-2">Bệnh viện TAT</h3>
                    <p class="text-gray-700">
                        Bệnh viện TAT là dự án trọng điểm trong lĩnh vực chăm sóc sức khỏe của Tập đoàn TAT. Với tổng diện tích sàn xây dựng xấp xỉ **90.000 m2** trong khuôn viên rộng hơn 3.1 hecta gồm 4 tòa nhà chính và các công trình cảnh quan, giao thông đáp ứng hơn **2000 lượt khám mỗi ngày** với gần **800 giường bệnh** phục vụ điều trị nội trú. Bệnh viện TAT mang nhiều kỳ vọng sẽ tạo dựng các chuẩn mực cao cấp trong xu hướng hài hòa y học và công nghệ.
                    </p>
                </div>
            </div>

            {{-- CARD 2 & 3: PHÒNG KHÁM ĐA KHOA & RĂNG HÀM MẶT --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-blue-50 p-6 rounded-xl shadow-lg space-y-3">
                    <h3 class="text-2xl font-bold text-blue-800 border-b pb-2">Phòng khám Đa khoa TAT</h3>
                    <p class="text-gray-700">
                        Phòng khám - Đa khoa Bệnh viện TAT thuộc Hệ sinh thái chăm sóc sức khỏe TAT với nền tảng **Công nghệ tiên tiến**. Mang đến chất lượng điều trị xuất sắc, dịch vụ chăm sóc hoàn hảo, kết quả nghiên cứu chuyên sâu, Phòng khám Đa khoa TAT là địa chỉ khám chữa bệnh uy tín cho mọi người dân.
                    </p>
                    <div class="h-48 overflow-hidden rounded-xl shadow-md mt-4">
                         <img src="{{ asset('images/d36.png') }}" alt="Phòng khám Đa khoa" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="bg-blue-50 p-6 rounded-xl shadow-lg space-y-3">
                    <h3 class="text-2xl font-bold text-blue-800 border-b pb-2">Phòng khám Răng Hàm Mặt TAT</h3>
                    <p class="text-gray-700">
                        Cuối năm 2025, Phòng khám Răng Hàm Mặt TAT ra đời và đi vào vận hành, đánh dấu bước đầu tiên trong việc hiện thực hóa các cam kết trong lĩnh vực Chăm sóc sức khỏe của Tập đoàn. Sứ mệnh của Phòng khám không chỉ dừng lại ở việc chăm sóc răng miệng truyền thống, mà còn tạo ra môi trường nuôi dưỡng tối ưu.
                    </p>
                     <div class="h-48 overflow-hidden rounded-xl shadow-md mt-4">
                         <img src="{{ asset('images/d37.png') }}" alt="Phòng khám Răng Hàm Mặt" class="w-full h-full object-cover">
                    </div>
                </div>

            </div>
        </div>
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

{{-- SCRIPT --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cardButtons = document.querySelectorAll('.tab-card-button');
    const contentDetails = document.querySelectorAll('.tab-content-detail');

    function updateContent(target) {
        // Ẩn tất cả nội dung chi tiết
        contentDetails.forEach(content => {
            content.classList.add('hidden');
            content.classList.remove('block');
        });

        // Hiện nội dung chi tiết tương ứng
        const selectedContent = document.querySelector(`[data-tab-content="${target}"]`);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
            selectedContent.classList.add('block');
        }

        // Cập nhật style cho các thẻ (buttons)
        cardButtons.forEach(button => {
            const isTarget = button.dataset.tab === target;
            
            // Xóa style cũ
            button.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-blue-400/50');
            button.querySelector('.absolute.inset-0').classList.remove('bg-opacity-0');
            button.querySelector('h4').classList.remove('text-white');
            button.classList.add('bg-white', 'hover:shadow-2xl');
            button.querySelector('h4').classList.add('text-gray-800');

            // Áp dụng style mới cho thẻ được chọn
            if (isTarget) {
                button.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-blue-400/50');
                button.classList.remove('bg-white', 'hover:shadow-2xl');
                button.querySelector('.absolute.inset-0').classList.add('bg-opacity-0');
                button.querySelector('h4').classList.add('text-white');
                button.querySelector('h4').classList.remove('text-gray-800');
            }
        });
    }
    
    // Gán sự kiện click cho các thẻ
    cardButtons.forEach(button => {
        button.addEventListener('click', () => {
            const target = button.dataset.tab;
            updateContent(target);
        });
    });
    
    // Khởi tạo trạng thái ban đầu (vision là active)
    // Cần gọi hàm này nếu không muốn thẻ đầu tiên bị highlight theo class tĩnh
    // updateContent('vision'); 
});
</script>
@endsection

