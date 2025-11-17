@extends('layouts.doctor')

@section('content')

<style>
    /* ------------------------------------------- */
    /* STYLE CHUNG */
    /* ------------------------------------------- */
    :root {
        --doctor-primary: #004d99; /* Xanh lá đậm */
        --doctor-secondary: #004d99; /* Xanh dương y tế */
    }

    /* Các khối card chính */
    .tat-card {
        background-color: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border-radius: 16px;
        padding: 3px;
        border: 1px solid #e5e7eb;
    }

    /* Tiêu đề chính */
    .tat-header {
        font-size: 1.875rem; /* text-3xl */
        font-weight: 800;
        color: var(--doctor-secondary);
        border-bottom: 3px solid var(--doctor-primary);
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: inline-block;
    }

    /* Nút Xem Ngày/Xem Tuần */
    .tat-btn-primary {
        background-color: var(--doctor-primary);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .tat-btn-primary:hover {
        background-color: #0e7456; /* Xanh đậm hơn */
        box-shadow: 0 4px 10px rgba(21, 128, 61, 0.3);
    }

    /* Thanh điều hướng tuần */
    .tat-nav-btn {
        background-color: #eff6ff; /* bg-blue-50 */
        color: var(--doctor-secondary);
        padding: 8px 16px;
        border-radius: 9999px;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    .tat-nav-btn:hover {
        background-color: #dbeafe; /* bg-blue-100 */
    }

    /* ------------------------------------------- */
    /* STYLE BẢNG CHI TIẾT */
    /* ------------------------------------------- */
    .tat-table-header {
        background-color: var(--doctor-secondary);
        color: white;
        font-weight: 700;
        text-transform: uppercase;
    }
    .tat-table-cell {
        padding: 16px;
        border-right: 1px solid #e5e7eb;
    }
    .tat-table-row:nth-child(even) {
        background-color: #f9fafb;
    }
    .tat-table-row:hover {
        background-color: #ecfdf5; /* Xanh lá nhạt */
    }

    /* ------------------------------------------- */
    /* STYLE BẢNG LỊCH TUẦN (GRID) */
    /* ------------------------------------------- */
    .tat-grid-header {
        background-color: var(--doctor-primary);
        color: white;
    }
    .tat-grid-slot {
        background-color: #e0f2f1; /* Xanh ngọc nhạt */
        color: #047857;
        font-weight: 700;
    }
    .tat-grid-cell {
        min-height: 80px;
        border: 1px solid #e5e7eb;
        transition: background-color 0.15s;
    }
    .appt-info {
        background-color: #ecfdf5; /* Xanh lá rất nhạt */
        border: 2px solid #a7f3d0;
        border-radius: 8px;
        padding: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
</style>

{{-- ------------------------------------------------ --}}
{{-- PHẦN 1: DANH SÁCH LỊCH HẸN CHI TIẾT NGÀY ĐƯỢC CHỌN --}}
{{-- ------------------------------------------------ --}}
<div class="tat-card mb-8">

    {{-- Header và Bộ chọn ngày --}}
    <div class="w-full flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-4 border-b border-gray-200">
        <h2 class="tat-header text-xl font-extrabold mb-3 sm:mb-0">
            📋 Lịch Hẹn Chi Tiết Ngày:
            <strong class="text-xl text-red-600 ml-2">{{ date('d/m/Y', strtotime($selectedDate)) }}</strong>
        </h2>

        {{-- Bộ chọn ngày thủ công --}}
        <form method="GET" action="{{ route('doctor.schedule') }}" class="flex items-center space-x-3 flex-shrink-0">
            <label for="date-selector" class="text-gray-600 font-medium text-sm hidden sm:block">Xem ngày khác:</label>
            <input type="date" name="date" id="date-selector" value="{{ $selectedDate }}"
                class="border border-gray-300 rounded-lg p-2 text-sm focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out cursor-pointer">
            <button type="submit" class="tat-btn-primary shadow-emerald-400/50">
                <i class="fas fa-search mr-1"></i> Xem
            </button>
        </form>
    </div>

    @php
        // Lọc lịch hẹn cho ngày được chọn
        $dailyAppointments = $appointments->filter(function($appt) use ($selectedDate) {
            return \Carbon\Carbon::parse($appt->appointment_date)->toDateString() === \Carbon\Carbon::parse($selectedDate)->toDateString();
        })->sortBy('appointment_time'); // Sắp xếp theo giờ
    @endphp

    @if($dailyAppointments->isEmpty())
        <div class="p-6 bg-blue-50 border-l-4 border-blue-400 text-blue-700 rounded-lg">
            <p class="font-semibold text-lg">
                🎉 Không có lịch khám nào được xếp vào ngày
                <strong class="text-blue-600">{{ date('d/m/Y', strtotime($selectedDate)) }}</strong>.
            </p>
        </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full min-w-[1200px] border-collapse border border-gray-200 rounded-xl overflow-hidden text-sm">
            <thead class="tat-table-header">
                <tr>
                    <th class="tat-table-cell w-10 text-center">id</th>
                    <th class="tat-table-cell text-left w-40">Bệnh nhân</th>
                    {{-- CỘT BỔ SUNG: GIỚI TÍNH --}}
                    <th class="tat-table-cell w-16 text-center">Giới tính</th> 
                    {{-- CỘT BỔ SUNG: SĐT --}}
                    <th class="tat-table-cell w-28 text-center">SĐT</th>      
                    {{-- CỘT BỔ SUNG: QUÊ QUÁN --}}
                    <th class="tat-table-cell w-48 text-left">Quê quán</th>   
                    <th class="tat-table-cell w-20 text-center">Giờ khám</th>
                    <th class="tat-table-cell w-16 text-center">Phòng</th>
                    <th class="tat-table-cell text-left">Triệu chứng (Ghi chú)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dailyAppointments as $index => $appt)
                    <tr class="border-b border-gray-100 tat-table-row">
                        <td class="tat-table-cell text-center font-medium text-gray-600">{{ $index + 1 }}</td>
                        <td class="tat-table-cell font-bold text-blue-700">
                            {{ $appt->patient->user->name ?? 'Bệnh nhân (Không rõ)' }}
                        </td>
                        
                        {{-- DỮ LIỆU BỔ SUNG: GIỚI TÍNH --}}
                        <td class="tat-table-cell text-center text-gray-700">
                             @switch($appt->patient->gender ?? '—')
                                @case('male') Nam @break
                                @case('female') Nữ @break
                                @default —
                            @endswitch
                        </td>
                        
                        {{-- DỮ LIỆU BỔ SUNG: SĐT --}}
                        <td class="tat-table-cell text-center text-gray-700 font-mono">
                            {{ $appt->patient->phone ?? '—' }}
                        </td>
                        
                        {{-- DỮ LIỆU BỔ SUNG: QUÊ QUÁN/ĐỊA CHỈ --}}
                        <td class="tat-table-cell text-left text-xs text-gray-700">
                            {{ Str::limit($appt->patient->address ?? '—', 25) }}
                        </td>
                        
                        {{-- CÁC CỘT GỐC (Giờ khám) --}}
                        <td class="tat-table-cell text-center font-mono text-base bg-yellow-50/70 text-yellow-800 font-extrabold">
                            {{ \Carbon\Carbon::parse($appt->appointment_time)->format('H:i') }}
                        </td>
                        
                        {{-- CÁC CỘT GỐC (Phòng) --}}
                        <td class="tat-table-cell text-center font-extrabold text-red-600 bg-red-50/70">
                            {{ $appt->room ?? '—' }}
                        </td>
                        
                        {{-- CÁC CỘT GỐC (Triệu chứng) --}}
                        <td class="tat-table-cell text-gray-700 italic">
                            {{ Str::limit($appt->notes, 70) ?? 'Không có thông tin' }}
                    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
</div>
{{-- ------------------------------------------------ --}}
{{-- PHẦN 2: LỊCH TUẦN DẠNG BẢNG (SCHEDULE GRID) --}}
{{-- ------------------------------------------------ --}}
<div class="tat-card">
    @php
        // Tính toán lại weekDays, startOfWeek, endOfWeek dựa trên $selectedDate
        $weekDays = [];
        $carbonSelectedDate = \Carbon\Carbon::parse($selectedDate);
        // Thiết lập tuần bắt đầu từ Thứ Hai
        $startOfWeek = $carbonSelectedDate->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
        $endOfWeek = $carbonSelectedDate->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

        // TÍNH NGÀY TUẦN TRƯỚC VÀ TUẦN SAU CHO CÁC NÚT BẤM
        $prevWeekDate = $carbonSelectedDate->copy()->subWeek()->toDateString();
        $nextWeekDate = $carbonSelectedDate->copy()->addWeek()->toDateString();
            
        for ($i = 0; $i < 7; $i++) {
            $weekDays[] = $startOfWeek->copy()->addDays($i);
        }

        // Khung giờ cố định theo yêu cầu
        $fixedSlots = [
            '08:00', '09:30', '13:00', '14:30', '15:30'
        ];
    @endphp
    
    {{-- Thanh Điều Hướng Tuần --}}
    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
        {{-- Nút Chuyển Tuần Trước --}}
        <a href="{{ route('doctor.schedule', ['date' => $prevWeekDate]) }}"
            class="tat-nav-btn shadow-md">
            <i class="fas fa-chevron-left mr-2"></i> Tuần Trước
        </a>

        <h2 class="text-xl font-extrabold text-emerald-700 text-center mx-4">
            🗓️ Lịch Khám Tuần
            <div class="text-base font-medium text-gray-600 mt-1">
                <span class="font-bold text-blue-600">{{ $startOfWeek->format('d/m/Y') }}</span>
                —
                <span class="font-bold text-blue-600">{{ $endOfWeek->format('d/m/Y') }}</span>
            </div>
        </h2>

        {{-- Nút Chuyển Tuần Sau --}}
        <a href="{{ route('doctor.schedule', ['date' => $nextWeekDate]) }}"
            class="tat-nav-btn shadow-md">
            Tuần Sau <i class="fas fa-chevron-right ml-2"></i>
        </a>
    </div>

    {{-- Bảng Lịch Tuần --}}
    <div class="overflow-x-auto mt-4">
        <table class="w-full text-sm border-separate border-spacing-0 rounded-lg overflow-hidden min-w-[1000px]">
            <thead class="tat-grid-header">
                <tr>
                    <th class="p-3 border-r border-emerald-700 w-32 text-center sticky left-0 z-20 tat-grid-header">Khung Giờ</th>
                    @foreach ($weekDays as $day)
                        @php
                            $isToday = $day->isToday();
                            $isSelectedDay = $day->toDateString() === \Carbon\Carbon::parse($selectedDate)->toDateString();
                            
                            $headerClass = $isToday ? 'bg-blue-600 text-white font-extrabold border-blue-700 shadow-xl' : 'tat-grid-header';
                            $linkClass = $isSelectedDay ? 'bg-amber-100 text-amber-900 font-black border-amber-300 border-2' : 'hover:bg-emerald-500';
                        @endphp
                        {{-- Tiêu đề ngày là link để chuyển sang chế độ xem chi tiết ngày đó --}}
                        <th class="p-3 border-r text-center {{ $headerClass }} transition duration-150 ease-in-out">
                            <a href="{{ route('doctor.schedule', ['date' => $day->toDateString()]) }}" 
                               class="block p-2 rounded-lg {{ $linkClass }} transition">
                                <span class="text-lg">{{ $day->translatedFormat('l') }}</span><br>
                                <span class="text-sm font-medium">{{ $day->format('d/m') }}</span>
                            </a>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($fixedSlots as $startTime)
                    @php
                        // Tính toán thời gian kết thúc cho slot 1 giờ (trừ slot 15:30)
                        $endTime = ($startTime === '15:30') ? '16:30' : \Carbon\Carbon::createFromFormat('H:i', $startTime)->addHour()->format('H:i');
                        $slotRange = "{$startTime}-{$endTime}";
                    @endphp
                    <tr class="border-b border-gray-100">
                        {{-- Cột Giờ Cố Định --}}
                        <td class="p-3 border-r border-gray-200 text-center font-bold sticky left-0 z-10 tat-grid-slot">{{ $slotRange }}</td>
                        
                        @foreach ($weekDays as $day)
                            @php
                                $currentDateString = $day->toDateString();
                                $appointment = $appointments->first(function($appt) use ($currentDateString, $startTime) {
                                    $apptTimeHour = \Carbon\Carbon::parse($appt->appointment_time)->format('H:i');
                                    return $appt->appointment_date === $currentDateString
                                        && $apptTimeHour === $startTime;
                                });
                                
                                $cellClasses = $appointment 
                                    ? 'bg-green-50/70 hover:bg-green-100' 
                                    : ($day->isPast() ? 'bg-gray-50/50' : 'bg-white hover:bg-gray-50');
                            @endphp

                            <td class="p-2 border-r border-gray-200 text-center align-middle tat-grid-cell {{ $cellClasses }}">
                                @if ($appointment)
                                    <div class="appt-info text-left">
                                        <div class="text-blue-800 font-extrabold leading-tight">
                                            {{ Str::limit($appointment->patient->user->name ?? 'Bệnh nhân', 15) }}
                                        </div>
                                        <div class="text-gray-600 text-xs mt-1">Phòng: <span class="font-bold text-red-700">{{ $appointment->room ?? '-' }}</span></div>
                                        <div class="text-emerald-700 text-xs italic font-medium mt-1">
                                            ✅ Đã XN
                                        </div> 

                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center h-full min-h-[40px] py-2">
                                        <span class="text-gray-400 text-xs font-light">— Trống —</span>
                                    </div>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection