@extends('layouts.patient')
@section('title', 'CHUYÊN KHOA')

@section('content')

{{-- Banner Full Width --}}
<div class="w-full m-0 p-0">
    <div class="w-full h-[400px] bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/d38.png') }}');">
    </div>
</div>
{{-- KHỐI DANH SÁCH CHUYÊN KHOA (Cập nhật đầy đủ 16 chuyên khoa) --}}
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- TIÊU ĐỀ --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-700 mb-2">DANH SÁCH CHUYÊN KHOA</h2>
            <div class="w-32 h-1 bg-gray-400 mx-auto mt-2"></div>
        </div>

        @php
            // Dữ liệu chuyên khoa đã được tổng hợp từ cả hai ảnh (image_fb3966.png và image_2d0c61.png)
            $departments = [
                // 8 chuyên khoa từ ảnh 1 (image_fb3966.png)
                ['name' => 'KHOA XẠ TRỊ', 'icon' => 'radiation'],
                ['name' => 'KHOA NGOẠI NHI', 'icon' => 'child-doctor'],
                ['name' => 'TRUNG TÂM VIÊM GAN VÀ GAN NHIỄM MỠ', 'icon' => 'liver'],
                ['name' => 'KIỂM SOÁT CÂN NẶNG VÀ ĐIỀU TRỊ BÉO PHÌ', 'icon' => 'weight'],
                ['name' => 'KHOA NGOẠI THẦN KINH – CỘT SỐNG', 'icon' => 'brain'],
                ['name' => 'TRUNG TÂM HỖ TRỢ SINH SẢN', 'icon' => 'fertility'],
                ['name' => 'TRUNG TÂM MẮT CÔNG NGHỆ CAO', 'icon' => 'eye'],
                ['name' => 'TRUNG TÂM NỘI SOI & PHẪU THUẬT', 'icon' => 'intestine'],
                ['name' => 'KHOA CƠ XƯƠNG KHỚP', 'icon' => 'bone'],
                ['name' => 'TRUNG TÂM TIM MẠCH', 'icon' => 'heart'],
                ['name' => 'TRUNG TÂM TIM MẠCH CAN THIỆP', 'icon' => 'heart-interventional'],
                ['name' => 'KHOA NGOẠI LỒNG NGỰC – MẠCH MÁU', 'icon' => 'chest'],
                ['name' => 'TRUNG TÂM SẢN PHỤ KHOA', 'icon' => 'uterus'],
                ['name' => 'TRUNG TÂM Y HỌC BÀO THAI', 'icon' => 'fetus'],
                ['name' => 'TRUNG TÂM TIẾT NIỆU – THẬN HỌC – NAM KHOA', 'icon' => 'kidney'],
                ['name' => 'KHOA MIỄN DỊCH LÂM SÀNG', 'icon' => 'immunity'],
            ];
        @endphp

        {{-- GRID CHUYÊN KHOA (4 cột trên màn hình lớn) --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($departments as $dept)
                <a href="#" class="block">
                    <div class="bg-white p-6 h-full rounded-xl shadow-lg border border-gray-100 transition duration-300 hover:shadow-2xl hover:border-blue-400 text-center flex flex-col justify-between">
                        
                        {{-- ICON TRÒN VIỀN XANH --}}
                        <div class="w-24 h-24 mx-auto mb-4 flex items-center justify-center 
                                    border-4 border-blue-400 rounded-full text-blue-600 
                                    transition duration-300 group-hover:bg-blue-50">
                            
                            {{-- Placeholder SVG: Sử dụng các icon tương ứng --}}
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                @if ($dept['icon'] == 'radiation')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m-3 0h3m-3 0a9 9 0 01-9-9m9 9a9 9 0 01-9-9"></path>
                                @elseif ($dept['icon'] == 'child-doctor')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H9a3 3 0 01-3-3v-2a4 4 0 00-4-4H5m0 0l-2-2m2 2l2 2m7-2V7m-4 7h4m-4 0v4m-3 3h10a3 3 0 003-3v-4a4 4 0 00-4-4h-4a4 4 0 00-4 4v4a3 3 0 003 3z"></path>
                                @elseif ($dept['icon'] == 'liver')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28c.204 0 .399-.074.544-.208l1.396-1.264c.243-.22.413-.538.441-.884l.51-6.417h-2.585a1 1 0 01-.842-.49L14 9z"></path>
                                @elseif ($dept['icon'] == 'weight')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                @elseif ($dept['icon'] == 'brain')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.79-2 5-2 5s2 1 2 5m-2-5c0 3.79 2 5 2 5s-2 1-2 5M12 11c0-3.79 2-5 2-5s-2-1-2-5m2 5c0-3.79-2-5-2-5s2-1 2-5M12 11V6M12 11V16"></path>
                                @elseif ($dept['icon'] == 'fertility')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v-4m-4 4v-4m-4 4v-4m4 4h4m-4 0h-4m4 4v4m0-4h-4m4 0h4"></path>
                                @elseif ($dept['icon'] == 'eye')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                @elseif ($dept['icon'] == 'intestine')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12 17.25a.75.75 0 100-1.5.75.75 0 000 1.5zM12 13.5a.75.75 0 100-1.5.75.75 0 000 1.5zM12 9.75a.75.75 0 100-1.5.75.75 0 000 1.5zM18.75 12h.008v.008H18.75V12zM5.25 12h.008v.008H5.25V12z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12a7.5 7.5 0 0115 0"></path>
                                @elseif ($dept['icon'] == 'bone')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3h8v4m-4 8v-8m-4 8v-8m-4 8v-8m-4 8v-8"></path>
                                @elseif ($dept['icon'] == 'heart')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                @elseif ($dept['icon'] == 'heart-interventional')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12 17.25a.75.75 0 100-1.5.75.75 0 000 1.5zM12 13.5a.75.75 0 100-1.5.75.75 0 000 1.5zM12 9.75a.75.75 0 100-1.5.75.75 0 000 1.5zM18.75 12h.008v.008H18.75V12zM5.25 12h.008v.008H5.25V12z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                @elseif ($dept['icon'] == 'chest')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                @elseif ($dept['icon'] == 'uterus')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6-6h12a3 3 0 003-3V6a3 3 0 00-3-3H6a3 3 0 00-3 3v4a3 3 0 003 3z"></path>
                                @elseif ($dept['icon'] == 'fetus')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c4.97 0 9-4.03 9-9S16.97 3 12 3 3 7.03 3 12s4.03 9 9 9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m-3-3h6"></path>
                                @elseif ($dept['icon'] == 'kidney')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12c0-4.97-4.03-9-9-9S3 7.03 3 12s4.03 9 9 9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-6m-3 3h6"></path>
                                @elseif ($dept['icon'] == 'immunity')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                                @endif
                            </svg>
                        </div>
                        
                        {{-- TÊN CHUYÊN KHOA --}}
                        <div class="mt-2">
                            <h4 class="text-base font-bold text-gray-700 leading-snug">{{ $dept['name'] }}</h4>
                        </div>
                    </div>
                </a>
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