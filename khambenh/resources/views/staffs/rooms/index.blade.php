@extends('layouts.staff')



@section('content')



<h1 class="text-3xl font-extrabold text-blue-800 mb-6 border-b-2 pb-2">🚪 Quản lý Phân công Phòng Khám</h1>



{{-- Thông báo --}}

@if(session('success'))

    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border-l-4 border-green-500 shadow-md">

        {{ session('success') }}

    </div>

@endif

@if(session('error'))

    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border-l-4 border-red-500 shadow-md">

        {{ session('error') }}

    </div>

@endif



{{-- KHỐI CHỨC NĂNG TÌM KIẾM/LỌC --}}

<div class="mb-4 flex justify-between items-center">

    <p class="text-gray-600 italic">Tổng số bác sĩ đang hoạt động: <span class="font-bold text-blue-700">{{ $doctors->count() }}</span></p>

    

    {{-- THÊM ID CHO CHỨC NĂNG TÌM KIẾM --}}

    <input type="text" id="searchInput" placeholder="Tìm kiếm theo Tên, SĐT, hoặc Phòng" 

           class="p-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm w-80">

</div>



{{-- KHỐI CUỘN DỌC chứa Bảng --}}

<div class="max-h-[75vh] overflow-y-auto bg-white rounded-xl shadow-xl">

    <div class="overflow-x-auto">

        

        <table class="min-w-full text-sm text-left text-gray-700 divide-y divide-gray-200">

            

            {{-- HEADER CỐ ĐỊNH: ĐÃ THÊM CỘT SĐT --}}

            <thead class="bg-blue-700 text-white uppercase text-xs sticky top-0 z-10">

                <tr>

                    <th scope="col" class="py-3 px-4 w-12">ID</th>

                    <th scope="col" class="py-3 px-4">Tên bác sĩ</th>

                    <th scope="col" class="py-3 px-4">Khoa chuyên môn</th>

                    <th scope="col" class="py-3 px-4 w-32">SĐT</th> 

                    <th scope="col" class="py-3 px-4 text-center w-40">Phòng hiện tại</th>

                    <th scope="col" class="py-3 px-4 w-80">Cập nhật phòng</th>

                </tr>

            </thead>

            

            <tbody id="doctorRoomTable" class="divide-y divide-gray-100">

                @forelse($doctors as $doctor)

                    <tr class="bg-white hover:bg-blue-50 transition duration-150">

                        <td class="py-3 px-4 font-medium">{{ $doctor->id }}</td>

                        {{-- Cột 1: Tên bác sĩ --}}

                        <td class="py-3 px-4 font-semibold text-blue-800">{{ $doctor->user->name ?? 'N/A' }}</td>

                        <td class="py-3 px-4">{{ $doctor->specialization ?? 'Chung' }}</td>

                        

                        {{-- Cột 3: SĐT (MỚI) --}}

                        <td class="py-3 px-4 text-gray-500 font-mono">{{ $doctor->user->phone ?? '---' }}</td>

                        

                        {{-- Cột 4: PHÒNG HIỆN TẠI --}}

                        <td class="py-3 px-4 text-center">

                            <span class="font-extrabold text-lg {{ $doctor->room ? 'text-green-600' : 'text-gray-500 italic' }}">

                                {{ $doctor->room ?? '---' }}

                            </span>

                        </td>

                        

                        {{-- Cột 5: CẬP NHẬT --}}

                        <td class="py-3 px-4">

                            <form action="{{ route('staff.updateRoom', $doctor->id) }}" method="POST" class="flex gap-2 items-center">

                                @csrf

                                @method('PUT') 

                                

                                <select name="room" required class="p-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm w-full">

                                    <option value="">-- Chọn Phòng Mới --</option>

                                    

                                    @foreach($availableRooms as $room)

                                        <option value="{{ $room }}" {{ $doctor->room == $room ? 'selected' : '' }}>

                                            {{ $room }}

                                        </option>

                                    @endforeach

                                </select>

                                

                                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-3 rounded-lg shadow-md transition duration-200 text-sm whitespace-nowrap">

                                    Gán Phòng

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="py-6 text-center text-gray-500 italic text-lg">

                            Không có dữ liệu bác sĩ để quản lý phòng.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        

    </div>

</div>



{{-- --------------------------------- --}}

{{-- --------------------------------- --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const searchInput = document.getElementById('searchInput');

        const tableBody = document.getElementById('doctorRoomTable');

        const rows = tableBody.getElementsByTagName('tr');



        // Gán sự kiện 'input' để tìm kiếm tức thì khi người dùng gõ

        searchInput.addEventListener('input', function () {

            const filter = searchInput.value.toLowerCase();



            for (let i = 0; i < rows.length; i++) {

                let row = rows[i];

                

                // Cột Tên bác sĩ (Index 1)

                let nameCell = row.cells[1]; 

                // Cột SĐT (MỚI: Index 3)

                let phoneCell = row.cells[3]; 

                // Cột Phòng hiện tại (Index 4)

                let roomCell = row.cells[4]; 



                if (nameCell || phoneCell || roomCell) {

                    const nameText = nameCell ? nameCell.textContent || nameCell.innerText : '';

                    const phoneText = phoneCell ? phoneCell.textContent || phoneCell.innerText : '';

                    const roomText = roomCell ? roomCell.textContent || roomCell.innerText : '';



                    // Kiểm tra xem chuỗi tìm kiếm có khớp với Tên, SĐT, HOẶC Mã phòng không

                    if (nameText.toLowerCase().indexOf(filter) > -1 || 

                        phoneText.toLowerCase().indexOf(filter) > -1 ||

                        roomText.toLowerCase().indexOf(filter) > -1) {

                        row.style.display = ""; // Hiển thị hàng

                    } else {

                        row.style.display = "none"; // Ẩn hàng

                    }

                }

            }

        });

    });

</script>



@endsection