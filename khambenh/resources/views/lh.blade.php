@extends('layouts.patient')

@section('title', 'Liên Hệ - Bệnh viện Đa khoa TAT')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-blue-600">
            LIÊN HỆ VỚI BỆNH VIỆN ĐA KHOA TAT
        </h1>
        <div class="w-16 h-1 bg-gray-400 mx-auto mt-2"></div>
    </div>

    <p class="mb-12 text-center text-gray-700 leading-relaxed">
        Sức khỏe của Quý khách là ưu tiên hàng đầu của chúng tôi. Quý khách vui lòng liên hệ với Bệnh viện Đa khoa TAT qua các kênh sau để được hỗ trợ nhanh chóng và chính xác nhất.
    </p>

    {{-- KHỐI THÔNG TIN LIÊN HỆ CHÍNH (3 CỘT) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 text-center">
        
        {{-- 1. Hotline --}}
        <div class="p-6 bg-white border-t-4 border-blue-500 rounded-lg shadow-lg">
            <svg class="w-8 h-8 text-blue-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Hotline (Cấp cứu & Đặt lịch)</h3>
            <p class="text-3xl font-extrabold text-blue-600">1900 1234</p>
            <p class="text-sm text-gray-500 mt-1">Hỗ trợ **24/7** (Cấp cứu, Đặt hẹn)</p>
        </div>

        {{-- 2. Email --}}
        <div class="p-6 bg-white border-t-4 border-green-500 rounded-lg shadow-lg">
            <svg class="w-8 h-8 text-green-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2 4v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"></path></svg>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Gửi Email</h3>
            <p class="text-blue-600 font-medium break-words">phongkhamtat@gmail.com</p>
            <p class="text-sm text-gray-500 mt-1">Phản hồi trong vòng 24 giờ làm việc</p>
        </div>

        {{-- 3. Địa chỉ --}}
        <div class="p-6 bg-white border-t-4 border-red-500 rounded-lg shadow-lg">
            <svg class="w-8 h-8 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Địa Chỉ</h3>
            <p class="text-gray-700 font-medium">123 Đường Sức Khỏe, Phường Y Tế, TP. Hà Nội</p>
            <p class="text-sm text-gray-500 mt-1">Mở cửa: T2 - T7 (7:30 - 17:00)</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        {{-- KHỐI FORM LIÊN HỆ (Để gửi yêu cầu tư vấn) --}}
        <div class="bg-gray-50 p-6 md:p-8 rounded-xl shadow-xl">
            <h2 class="text-2xl font-bold text-blue-900 mb-6 border-b pb-2">
                Form hướng dẫn gửi yêu cầu tư vấn & hỗ trợ
            </h2>
            
            <form action="" method="POST">
                @csrf
                
                <div class="space-y-4">
                    {{-- Họ và Tên --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Họ và Tên (*)</label>
                        <input type="text" name="name" id="name" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nguyễn Văn A">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email (*)</label>
                        <input type="email" name="email" id="email" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               placeholder="contact@example.com">
                    </div>

                    {{-- Số Điện Thoại --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số Điện Thoại (*)</label>
                        <input type="tel" name="phone" id="phone" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               placeholder="09xx xxx xxx">
                    </div>

                    {{-- Chủ đề --}}
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Chủ đề</label>
                        <select name="subject" id="subject"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="Đặt lịch khám">Đặt lịch khám</option>
                            <option value="Thắc mắc về chi phí">Thắc mắc về chi phí</option>
                            <option value="Yêu cầu hỗ trợ nội trú">Yêu cầu hỗ trợ nội trú</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>

                    {{-- Nội dung tin nhắn --}}
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Nội dung Thắc mắc (*)</label>
                        <textarea name="message" id="message" rows="4" required
                                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Chi tiết yêu cầu của Quý khách..."></textarea>
                    </div>
                </div>
            </form>
        </div>

        {{-- KHỐI VỊ TRÍ VÀ THÔNG TIN CHI TIẾT --}}
        <div>
            <h2 class="text-2xl font-bold text-blue-900 mb-4">II. Vị Trí & Giờ Làm Việc</h2>
            
            <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Địa chỉ Bệnh viện</h3>
                <p class="text-gray-700 font-medium">
                    <span class="font-bold">BVĐK TAT:</span> 123 Đường Sức Khỏe, Phường Y Tế, TP. Hà Nội
                </p>
                <p class="text-gray-600 mt-2">
                    <span class="font-bold">Giờ làm việc:</span> Thứ Hai – Thứ Bảy (7:30 - 17:00)
                </p>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Bản đồ</h3>
                {{-- Chèn Google Map nhúng tại đây --}}
                <div class="aspect-w-16 aspect-h-9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.380790897711!2d105.79564617515053!3d21.01633518937083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab7a8f158589%3A0x1d7c3d2e68c92b23!2zSGFub2kgTGlkbyBIb3NwaXRhbA!5e0!3m2!1sen!2s" 
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="rounded-lg shadow-md"
                    ></iframe>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-blue-900 mb-4">III. Kênh Liên Lạc Khác</h2>
            <p class="text-gray-700 leading-relaxed mb-2">
                **Email:** <span class="font-semibold text-blue-600">phongkhamtat@gmail.com</span>
            </p>
            <p class="text-gray-700 leading-relaxed">
                **Fax:** (024) 3876 5432
            </p>

        </div>
    </div>

    <div class="mt-12 pt-4 border-t border-gray-200 text-center">
        <p class="text-gray-700 leading-relaxed italic">
            Mọi thắc mắc về dịch vụ, thủ tục y tế, hoặc cần hỗ trợ cấp cứu, Quý khách vui lòng gọi ngay Hotline **1900 1234** để nhận sự hỗ trợ kịp thời.
        </p>
    </div>

</div>
@endsection