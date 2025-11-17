@extends('layouts.patient')



@section('content')

<style>

html, body {

    margin: 0;

    padding: 0;

    overflow-x: hidden;

    width: 100%;

}



/* NỀN FULL HEIGHT */

.tat-form-container-bg {

    position: relative;

    width: 100vw;

    left: 50%;

    right: 50%;

    margin-left: -50vw;

    min-height: 100vh; /* luôn cao tối thiểu bằng viewport */

    height: auto; /* tăng theo nội dung */

    display: flex;

    justify-content: center;

    align-items: flex-start;

    padding: 50px 0;

    box-sizing: border-box;

    overflow: hidden;

}



.tat-form-container-bg img.full-width-image {

    width: 100%;

    height: 100%;

    display: block;

    object-fit: cover;

    position: absolute;

    top: 0;

    left: 0;

    z-index: -1;

}



/* CARD CHÍNH */

.tat-form-card {

    background-color: rgba(255, 255, 255, 0.95);

    border-radius: 12px;

    box-shadow: 0 10px 40px rgba(0, 77, 153, 0.4);

    max-width: 1400px; 

    width: 95%;

    margin: 0 auto;

    overflow: hidden; 

    position: relative;

    z-index: 1;

    flex-direction: column;

}



/* HEADER */

.tat-form-header-bar {

    background-color: #004d99;

    color: white;

    text-align: center;

    padding: 15px 20px;

    font-size: 1.5rem;

    font-weight: 700;

}



/* NÚT CHI TIẾT */

.btn-tat-detail {

    background-color: #ff9900 !important;

    color: white !important;

    font-weight: 600;

    border-radius: 6px;

    border: none;

    padding: 8px 12px;

    text-transform: uppercase;

    transition: background-color 0.2s;

    font-size: 0.875rem;

}

.btn-tat-detail:hover {

    background-color: #e68a00 !important;

}



/* BẢNG */

.tat-table-header {

    background-color: #f0f7ff;

    color: #004d99;

    font-weight: 700;

    text-transform: uppercase;

}

.tat-table-body tr:nth-child(even) {

    background-color: #f9f9f9;

}

.tat-table-body tr:hover {

    background-color: #e6f7ff;

}



/* CẬP NHẬT: SCROLL Ngang và Dọc khi Bảng quá lớn */

.table-wrapper {

    overflow-x: auto;

    /* Thêm cuộn dọc nếu danh sách hồ sơ quá dài, giữ khung card */

    max-height: 600px; 

    overflow-y: auto;

    width: 100%;

}



/* Cần thêm thuộc tính này để thead luôn dính khi cuộn dọc */

.table-wrapper table thead th {

    position: sticky;

    top: 0; /* Dính vào đỉnh của khối table-wrapper */

    z-index: 10;

}

</style>



<div class="tat-form-container-bg">

    <img src="{{ asset('images/nen1.jpg') }}" alt="Nền" class="full-width-image">



    <div class="tat-form-card">

        <div class="tat-form-header-bar">

            🩺 HỒ SƠ KHÁM CỦA TÔI

        </div>



        <div class="p-8">

            @if($records->isEmpty())

                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">

                    <p class="font-bold">Chưa có hồ sơ</p>

                    <p>Bạn chưa có hồ sơ khám nào được hoàn thành.</p>

                </div>

            @else

                <div class="table-wrapper">

                    <table class="w-full border-collapse rounded-lg text-sm min-w-[1000px]">

                        <thead class="tat-table-header">

    <tr>

        <th class="p-3 border border-gray-300 w-12">STT</th>

        <th class="p-3 border border-gray-300 text-left">Bác sĩ</th>

        <th class="p-3 border border-gray-300 w-32">Ngày khám</th>

        <th class="p-3 border border-gray-300 text-left">Chuẩn đoán</th>

        <th class="p-3 border border-gray-300 w-44">Hành động</th>

    </tr>

</thead>

                        <tbody class="tat-table-body text-gray-700">

    @foreach($records as $index => $record)

        <tr class="border-t border-gray-200">

            <td class="p-3 border-r border-l text-center">{{ $index + 1 }}</td>

            <td class="p-3 border-r">{{ $record->doctor->user->name ?? 'Không rõ' }}</td>

            <td class="p-3 border-r text-center">

                {{ date('d/m/Y', strtotime($record->appointment->appointment_date ?? $record->created_at)) }}

            </td>

            <td class="p-3 border-r">{{ Str::limit($record->diagnosis, 60) ?? '-' }}</td>

            <td class="p-3 border-r text-center">

                <a href="{{ route('patient.medical-records.show', $record->id) }}" 

                   class="btn-tat-detail">

                    Xem chi tiết

                </a>

            </td>

        </tr>

    @endforeach

</tbody>

                    </table>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection