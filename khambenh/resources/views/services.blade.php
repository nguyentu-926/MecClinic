@extends('layouts.patient')

@section('title', 'Danh Mục Dịch Vụ')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <h1 class="text-3xl font-bold text-gray-800 mb-6">🌟 Danh Mục Dịch Vụ Kỹ Thuật Bệnh Viện</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500 hover:shadow-xl transition-shadow">
            <h2 class="text-xl font-bold text-red-600 mb-2">Trung Tâm Tiêm Chủng</h2>
            <p class="text-gray-600 mb-4">Cung cấp các gói tiêm chủng đa dạng, vắc-xin chất lượng cao cho trẻ em và người lớn.</p>
            <a href="#" class="text-red-500 font-semibold hover:text-red-700">Tìm hiểu chi tiết &rarr;</a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow">
            <h2 class="text-xl font-bold text-blue-600 mb-2">Khoa Hồi Sức Cấp Cứu (ICU)</h2>
            <p class="text-gray-600 mb-4">Đội ngũ y bác sĩ chuyên môn cao, trang thiết bị hiện đại, sẵn sàng cấp cứu 24/7.</p>
            <a href="#" class="text-blue-500 font-semibold hover:text-blue-700">Tìm hiểu chi tiết &rarr;</a>
        </div>

    </div>
</div>
@endsection