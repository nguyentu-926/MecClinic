@extends('layouts.patient')
@section('title', 'CHUYÊN KHOA')

@section('content')

{{-- Banner Full Width --}}
<div class="w-full m-0 p-0">
    <div class="w-full h-[400px] bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/d39.png') }}');">
    </div>
</div>
{{-- KHỐI DỊCH VỤ ĐẶC BIỆT (Cập nhật đầy đủ 16 dịch vụ) --}}
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- TIÊU ĐỀ --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-700 mb-2">DỊCH VỤ ĐẶC BIỆT</h2>
            <div class="w-36 h-1 bg-gray-400 mx-auto mt-2"></div>
        </div>

        @php
            // Dữ liệu dịch vụ đặc biệt tổng hợp từ cả ba ảnh
            $specialServices = [
                // 4 Dịch vụ từ ảnh 1 (image_2d2b0b.png)
                [
                    'icon' => 'doctor', 
                    'title' => 'Dịch vụ cấp cứu 24/7 tại Bệnh viện – Phòng khám Đa khoa', 
                    'description' => 'Dịch vụ cấp cứu 24/7 đóng vai trò quan trọng trong quá trình xử lý ban đầu nhằm giảm thiểu tối đa nguy cơ biến chứng, tử vong của người bệnh...',
                    'link' => '#'
                ],
                [
                    'icon' => 'syringe', 
                    'title' => 'Triển khai dịch vụ tiêm chủng cơ sở BVĐK Tâm Anh TP.HCM', 
                    'description' => 'Từ ngày 07/03/2023, Bệnh viện Đa khoa Tâm Anh TP.HCM chính thức mở rộng dịch vụ tiêm chủng cho người lớn và trẻ em với quy mô lớn hơn nhằm...',
                    'link' => '#'
                ],
                [
                    'icon' => 'vip', 
                    'title' => 'Khu khám VIP BVĐK Tâm Anh', 
                    'description' => 'Khu khám VIP BVĐK Tâm Anh TP.HCM chính thức đưa vào hoạt động nhằm mang đến sự phục vụ chuyên nghiệp, đẳng cấp tiêu chuẩn quốc tế cho quý...',
                    'link' => '#'
                ],
                [
                    'icon' => 'blood', 
                    'title' => 'Khám, tầm soát & điều trị bệnh lý mạch máu', 
                    'description' => 'Thống kê cho thấy, những năm gần đây tình trạng bệnh lý mạch máu tại Việt Nam đang tăng dần về cả số lượng bệnh nhân lẫn mức độ phức tạp của...',
                    'link' => '#'
                ],
                
                // 4 Dịch vụ từ ảnh 2 (image_2d7d63.png)
                [
                    'icon' => 'heart-check', 
                    'title' => 'Khám, tầm soát & Điều trị bệnh tim bẩm sinh', 
                    'description' => 'Theo thống kê từ Bộ Y Tế, cứ 1.000 trẻ em được sinh ra sẽ có 8 trẻ mắc các bệnh tim bẩm sinh. Ước tính mỗi năm tại Việt Nam, có tới 12.000...',
                    'link' => '#'
                ],
                [
                    'icon' => 'heart-beat', 
                    'title' => 'Dịch vụ khám, điều trị bệnh tim mạch cho người lớn', 
                    'description' => 'Bệnh tim mạch được biết đến là nguyên nhân gây tử vong hàng đầu trên thế giới, mỗi năm căn bệnh này cướp đi sinh mạng của hơn 17 triệu...',
                    'link' => '#'
                ],
                [
                    'icon' => 'colon', 
                    'title' => 'Các dịch vụ của Đơn vị Hậu môn – Trực tràng', 
                    'description' => 'Dịch vụ tư vấn, khám và phẫu thuật điều trị các bệnh lý Hậu môn - trực tràng...',
                    'link' => '#'
                ],
                [
                    'icon' => 'microscope', 
                    'title' => 'Dịch vụ giải phẫu bệnh & tế bào', 
                    'description' => 'Giải phẫu bệnh & Tế bào được xem là "tiêu chuẩn vàng" trong chẩn đoán một số bệnh lý, nhất là những bệnh lý ác tính... Kết quả từ Giải phẫu...',
                    'link' => '#'
                ],

                // 8 Dịch vụ từ ảnh 3 (image_2d8081.png)
                [
                    'icon' => 'stem-cell', 
                    'title' => 'Lưu trữ máu dây rốn, mô dây rốn và/hoặc tế bào gốc từ mô mỡ rốn', 
                    'description' => 'Trung tâm Tế bào gốc và Ngân hàng mô, Hệ thống Bệnh viện Đa Khoa Tâm Anh được Bộ Y Tế cấp phép hoạt động vào tháng 7 năm 2019. Trung tâm...',
                    'link' => '#'
                ],
                [
                    'icon' => 'fertility-check', 
                    'title' => 'Khám, tư vấn & điều trị vô sinh hiếm muộn', 
                    'description' => 'Áp dụng kỹ thuật tiên tiến hàng đầu thế giới Phòng lab tiêu chuẩn "sạch" đầu tiên ở Đông Nam Á. Nuôi phôi ứng dụng trí tuệ nhân tạo...',
                    'link' => '#'
                ],
                [
                    'icon' => 'urology', 
                    'title' => 'Khám & Điều trị Nam học – Tiết niệu – Thận học', 
                    'description' => 'Khoa Nam khoa & Tiết niệu (Andrology – Urology) chuyên khám và điều trị các bệnh về đường tiết niệu và cơ quan sinh dục nam...',
                    'link' => '#'
                ],
                [
                    'icon' => 'stomach', 
                    'title' => 'Nội soi, phẫu thuật điều trị bệnh lý tiêu hóa', 
                    'description' => 'Trung tâm Nội soi & Phẫu thuật Nội soi Tiêu hóa, BVĐK Tâm Anh tự tin làm chủ các kỹ thuật tiên tiến trong lĩnh vực nội soi thăm dò và phẫu thuật...',
                    'link' => '#'
                ],
                [
                    'icon' => 'lungs', 
                    'title' => 'Khám & Điều trị bệnh lý hô hấp, COPD', 
                    'description' => 'Khoa Nội hô hấp, BVĐK Tâm Anh cung cấp dịch vụ khám và điều trị chuyên sâu bệnh phổi tắc nghẽn mạn tính và các bệnh lý hô hấp...',
                    'link' => '#'
                ],
                [
                    'icon' => 'fetal-medicine', 
                    'title' => 'Khám & Điều trị bệnh lý Y học bào thai', 
                    'description' => 'Ứng dụng công nghệ Y học bào thai vào các lĩnh vực như: Chẩn đoán trước sinh bằng các xét nghiệm sàng lọc, điều trị xử trí bất thường thai...',
                    'link' => '#'
                ],
                [
                    'icon' => 'newborn', 
                    'title' => 'Chăm sóc Nhi sơ sinh trẻ sinh non', 
                    'description' => 'Với mục tiêu trở thành một trong những chuyên khoa mũi nhọn trong BVĐK Tâm Anh, ngay từ khi thành lập, Khoa Nhi đã được đầu tư về cơ sở vật chất...',
                    'link' => '#'
                ],
                [
                    'icon' => 'cancer', 
                    'title' => 'Tầm soát ung thư', 
                    'description' => 'Hiểu được tính cấp thiết của việc tầm soát ung thư, BVĐK Tâm Anh đầu tư những thiết bị, máy móc tiên tiến, hiện đại, đạt tiêu chuẩn quốc tế...',
                    'link' => '#'
                ],
            ];
        @endphp

        {{-- GRID DỊCH VỤ ĐẶC BIỆT (4 cột) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($specialServices as $service)
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 transition duration-300 hover:shadow-2xl hover:border-blue-400 flex flex-col justify-between">
                    
                    <div class="flex items-start space-x-4 mb-4">
                        {{-- ICON VUÔNG NỀN XANH --}}
                        <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center 
                                    bg-blue-500 rounded-lg text-white shadow-md">
                            
                            {{-- Placeholder SVG (Cần thay bằng icon thực tế) --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                @if ($service['icon'] == 'doctor')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14h1m-1 0a2 2 0 00-2 2v3m-3-12h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                                @elseif ($service['icon'] == 'syringe')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v4M4.5 9h15M17 19h3"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15l2 2 4-4m-6 6h4M3 17h10a2 2 0 002-2V7a2 2 0 00-2-2H3a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                @elseif ($service['icon'] == 'vip')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 18l.867.426-1.533 2.89C8.4 22 7.6 22 7.15 21.317L6 19.5M12 22v-8"></path>
                                @elseif ($service['icon'] == 'blood')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c4.97 0 9-4.03 9-9S16.97 3 12 3 3 7.03 3 12s4.03 9 9 9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h-6"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6"></path>
                                @elseif ($service['icon'] == 'heart-check')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                @elseif ($service['icon'] == 'heart-beat')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364l-1.318 1.318-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                @elseif ($service['icon'] == 'colon')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                @elseif ($service['icon'] == 'microscope')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h4M3 7h18M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v10"></path>
                                @elseif ($service['icon'] == 'stem-cell')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a4 4 0 100-8 4 4 0 000 8z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3"></path>
                                @elseif ($service['icon'] == 'fertility-check')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 0v4m0-4h4m-4 0H8"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0z"></path>
                                @elseif ($service['icon'] == 'urology')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s-8-6-8-12c0-3.314 3.582-6 8-6s8 2.686 8 6c0 6-8 12-8 12z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 100-6 3 3 0 000 6z"></path>
                                @elseif ($service['icon'] == 'stomach')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                @elseif ($service['icon'] == 'lungs')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12c0-2.21 3.582-4 8-4s8 1.79 8 4-3.582 4-8 4-8-1.79-8-4z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16v-8m0 8h-4m4 0h4m-4 0v4m0-4h-4m4 0h4"></path>
                                @elseif ($service['icon'] == 'fetal-medicine')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c4.97 0 9-4.03 9-9S16.97 3 12 3 3 7.03 3 12s4.03 9 9 9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m-3-3h6"></path>
                                @elseif ($service['icon'] == 'newborn')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 100-6 3 3 0 000 6z"></path>
                                @elseif ($service['icon'] == 'cancer')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h-6m3-3v6"></path>
                                @endif
                            </svg>
                        </div>
                        
                        {{-- TIÊU ĐỀ --}}
                        <h4 class="text-lg font-bold text-gray-800 leading-snug">{{ $service['title'] }}</h4>
                    </div>
                    
                    {{-- MÔ TẢ --}}
                    <p class="text-gray-600 mb-4 flex-grow">{{ $service['description'] }}</p>
                    
                    {{-- NÚT XEM THÊM (Icon dấu cộng) --}}
                    <div class="text-right">
                        <a href="{{ $service['link'] }}" class="inline-block p-2 bg-blue-100 rounded-full text-blue-600 hover:bg-blue-200 transition duration-300" title="Xem thêm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
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