@extends('layouts.patient') 

@section('title', 'DANH SÁCH DỊCH VỤ')

@section('content')

<div class="container mx-auto px-4 py-12 max-w-7xl">
    
    {{-- PHẦN TIÊU ĐỀ DỊCH VỤ --}}
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-blue-800 uppercase mb-4">DANH SÁCH DỊCH VỤ</h1>
        <p class="text-gray-700 max-w-4xl mx-auto text-lg">
            TAT CLINIC cung cấp các giải pháp y tế tiên tiến với chất lượng cao, đội ngũ bác sĩ và nhân viên chuyên nghiệp, trang 
            thiết bị hiện đại, cùng sự hỗ trợ toàn diện cho bệnh nhân quốc tế, từ dịch vụ phiên dịch và hỗ trợ visa đến các tiện nghi và 
            dịch vụ chăm sóc đặc biệt, nhằm đảm bảo trải nghiệm điều trị tốt nhất cho người bệnh.
        </p>
    </div>

    {{-- GRID DANH SÁCH DỊCH VỤ (8 MỤC) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- Item 1: Khám Sàng Lọc Bệnh Lý Tim Bẩm Sinh --}}
        @php
            $services = [
                ['img' => 'images/d9.png', 'title' => 'Khám Sàng Lọc Bệnh Lý Tim Bẩm Sinh'],
                ['img' => 'images/d8.png', 'title' => 'Chăm Sóc Thai Sản Trọn Gói'],
                ['img' => 'images/d7.png', 'title' => 'Gói Phục Hồi Chức Năng'],
                ['img' => 'images/d6.png', 'title' => 'Nội Soi Tiêu Hóa'],
                ['img' => 'images/d10.png', 'title' => 'Xét Nghiệm Theo Yêu Cầu'],
                ['img' => 'images/d11.png', 'title' => 'Gói Sàng Lọc Trước Sinh'],
                ['img' => 'images/d12.png', 'title' => 'Gói Khám Nhi'],
                ['img' => 'images/d13.png', 'title' => 'Tầm soát ung thư toàn diện'],
                ['img' => 'images/d14.png', 'title' => 'Quản Lý Song Thai - Đa Thai'],
                ['img' => 'images/d15.png', 'title' => 'Gói Thai Sản 12 tuần'],
                ['img' => 'images/d16.png', 'title' => 'Gói Thai Sản 22 tuần'],
                ['img' => 'images/d17.png', 'title' => 'Gói Thai Sản 32 tuần'],
                ['img' => 'images/d18.png', 'title' => 'Chụp PET/CT'],
                ['img' => 'images/d19.png', 'title' => 'Gói Sinh Mổ'],
                ['img' => 'images/d20.png', 'title' => 'Chăm Sóc Mẹ Và Bé Sau Sinh'],
                ['img' => 'images/d21.png', 'title' => 'Gói Khám Sức Khỏe'],
            ];
        @endphp

        @foreach ($services as $service)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-2xl">
                {{-- Khu vực hình ảnh --}}
                <div class="relative w-full h-48 bg-gray-100">
                    {{-- Giả sử bạn đã thay thế các ảnh dịch vụ vào public/images với tên service_1.jpg, ... --}}
                    <img src="{{ asset($service['img']) }}" alt="{{ $service['title'] }}" class="w-full h-full object-cover">
                </div>
                
                {{-- Khu vực tên dịch vụ --}}
                <div class="p-4 text-center h-20 flex items-center justify-center bg-gray-50">
                    <h3 class="text-lg font-semibold text-blue-800 leading-snug">{{ $service['title'] }}</h3>
                </div>
                
                {{-- Nút chi tiết (Tùy chọn, bạn có thể thêm liên kết chi tiết tại đây) --}}
                {{-- <a href="#" class="block w-full text-center py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600">Xem chi tiết</a> --}}
            </div>
        @endforeach
        
    </div>
</div>
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
@endsection