@extends('layouts.patient')

@section('title', 'Danh Mục Dịch Vụ Kỹ Thuật')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-4xl">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-blue-800 tracking-tight">
            DANH MỤC DỊCH VỤ KỸ THUẬT BỆNH VIỆN ĐA KHOA TAT
        </h1>
        <div class="w-20 h-1 bg-blue-600 mx-auto mt-3 rounded-full"></div>
    </div>

    <p class="mb-8 text-gray-700 leading-relaxed text-lg">
        Khách hàng có thể tham khảo danh mục kỹ thuật của dịch vụ khám, chữa bệnh tại 
        <a href="#" class="text-blue-600 font-semibold hover:text-blue-800 transition duration-300 border-b border-dashed border-blue-600">Bệnh viện Đa khoa TAT</a> bằng cách bấm vào các đường link bên dưới đây:
    </p>

    <ul class="list-disc ml-6 space-y-3 text-blue-600 text-base">
        <li>
            <a href="#" class="hover:underline hover:text-blue-800 transition duration-300">Danh mục kỹ thuật thí điểm kỹ thuật mới, phương pháp mới tại Bệnh viện Đa khoa TAT</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-800 transition duration-300">Danh mục chuyên môn kỹ thuật và hỗ trợ sinh sản</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-800 transition duration-300">Danh mục kỹ thuật thí điểm kỹ thuật mới, phương pháp mới tại Bệnh viện Đa khoa TAT</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-800 transition duration-300">Danh mục kỹ thuật thí điểm kỹ thuật mới, phương pháp mới tại Bệnh viện Đa khoa TAT</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-800 transition duration-300">Bổ sung danh mục kỹ thuật Bệnh viện Đa khoa TAT</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-800 transition duration-300">Danh mục kỹ thuật chuyên môn Bệnh viện Đa khoa TAT</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-800 transition duration-300">Bổ sung danh mục kỹ thuật Bệnh viện Đa khoa TAT</a>
        </li>
    </ul>

    <p class="mt-10 mb-8 text-gray-700 leading-relaxed text-lg">
        Xin vui lòng liên hệ đến Hệ thống Bệnh viện Đa khoa TAT nếu cần tư vấn về dịch vụ.
    </p>

    <div class="space-y-8 pt-4 border-t border-gray-200">
        
        <div>
            <h2 class="font-extrabold text-xl text-blue-800 mb-1">Bệnh viện Đa khoa TAT Hà Nội</h2>
            <p class="text-gray-700 text-base">108 Phố Hoàng Như Tiếp, P. Bồ Đề, Q. Long Biên, Tp. Hà Nội</p>
            <p class="text-blue-600 font-bold text-lg mt-1">
                <a href="tel:02438723872" class="hover:text-red-500 transition duration-300">024 3872 3872</a> <span class="text-gray-500">(HN)</span>
            </p>
        </div>
        
        </div>

</div>
@endsection