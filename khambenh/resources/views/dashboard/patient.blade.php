
@extends('layouts.patient')

@section('title', 'TAT Clinic - Hệ Thống Y Tế')

@section('content')

<div class="relative w-screen mx-auto -mt-3 -ml-[calc(50vw-50%)] overflow-hidden">

    <div id="carousel-wrapper" class="relative w-full h-96 overflow-hidden"> 

        {{-- Ảnh --}}

        <img id="carousel-img" src="{{ asset('images/n1.png') }}" class="w-full h-full object-cover transition-opacity duration-500 opacity-100">



        {{-- Nút trái --}}

        <button id="prev-btn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-75 z-20">

            &#8592;

        </button>



        {{-- Nút phải --}}

        <button id="next-btn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-75 z-20">

            &#8594;

        </button>



        {{-- Dấu chấm --}}

        <div id="dots" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20"></div>

    </div>

    

    <script>

    document.addEventListener('DOMContentLoaded', function() {

        const images = [

            '{{ asset("images/n1.png") }}',

            '{{ asset("images/n2.png") }}',

            '{{ asset("images/n3.png") }}'

        ];



        let currentIndex = 0;

        const imgElement = document.getElementById('carousel-img');

        const dotsContainer = document.getElementById('dots');



        // Tạo dấu chấm

        images.forEach((_, index) => {

            const dot = document.createElement('div');

            dot.classList.add('w-3','h-3','rounded-full','cursor-pointer');

            dot.classList.add(index === 0 ? 'bg-white' : 'bg-gray-400');

            dot.addEventListener('click', () => {

                currentIndex = index;

                updateCarousel();

            });

            dotsContainer.appendChild(dot);

        });



        const dots = dotsContainer.querySelectorAll('div');



        function updateCarousel() {

            // fade out

            imgElement.classList.add('opacity-0'); 



            setTimeout(() => {

                // Đổi ảnh

                imgElement.src = images[currentIndex];

                // fade in

                imgElement.classList.remove('opacity-0');

            }, 500); 



            dots.forEach((dot, index) => {

                dot.classList.toggle('bg-white', index === currentIndex);

                dot.classList.toggle('bg-gray-400', index !== currentIndex);

            });

        }



        // Tự động chuyển ảnh 5 giây/lần

        setInterval(() => {

            currentIndex = (currentIndex + 1) % images.length;

            updateCarousel();

        }, 5000);



        // Nút trái/phải

        document.getElementById('prev-btn').addEventListener('click', () => {

            currentIndex = (currentIndex - 1 + images.length) % images.length;

            updateCarousel();

        });



        document.getElementById('next-btn').addEventListener('click', () => {

            currentIndex = (currentIndex + 1) % images.length;

            updateCarousel();

        });

    });

    </script>



    {{-- TAT CLINIC Section - Đã loại bỏ lề âm cũ và sử dụng lại cấu trúc full-width --}}

    <div class="relative bg-blue-50/50 py-12 px-4 z-10 w-full"> 

        <div class="container mx-auto max-w-6xl flex flex-col md:flex-row items-center justify-between gap-8">

            

            {{-- Left Content --}}

            <div class="md:w-1/2 text-gray-700 space-y-4">

                <h2 class="text-2xl font-bold text-blue-800 mb-4">

                    TAT CLINIC - HỆ THỐNG Y TẾ HÀN LÂM CHUẨN MỰC QUỐC TẾ

                </h2>

                <p class="leading-relaxed">

                    TAT CLINIC là hệ thống y tế hàn lâm chuẩn mực quốc tế nằm trong Hệ sinh thái Chăm sóc sức khỏe do Tập đoàn TAT đầu tư và phát triển.

                </p>

                <p class="leading-relaxed">

                    Với sứ mệnh **“Vì một cộng đồng khỏe mạnh, nhân văn và thông thái hơn bằng tài năng, y đức, lòng trắc ẩn và tinh thần sẵn sàng cống hiến, phụng sự”**. Cùng nền tảng: Con người tri thức và nhân văn – Hệ thống thông minh – Công nghệ tiên tiến, TAT Clinic mang đến chất lượng điều trị xuất sắc, dịch vụ chăm sóc hoàn hảo, nhiều kết quả nghiên cứu mang tính đột phá và giáo dục nâng tầm tri thức trong lĩnh vực y học vì một cộng đồng khỏe mạnh, nhân văn và tri thức.

                </p>

            </div>



            {{-- Right Image --}}

            <div class="md:w-1/2 flex justify-center md:justify-end">

                <img src="{{ asset('images/c1.png') }}" alt="TAT Hospital Building" class="rounded-lg shadow-lg max-w-full h-auto">

            </div>

        </div>



        {{-- Decorative dots - Vẫn giữ nguyên, thêm hidden md:block để ẩn trên mobile --}}

        <div class="absolute -left-10 top-1/4 w-8 h-8 bg-red-400 rounded-full opacity-60 hidden md:block"></div>

        <div class="absolute -left-5 top-1/2 w-6 h-6 bg-orange-400 rounded-full opacity-60 hidden md:block"></div>

        <div class="absolute -right-10 bottom-1/4 w-10 h-10 bg-green-400 rounded-full opacity-60 hidden md:block"></div>

    </div>

</div> {{-- Kết thúc div bọc ngoài đã được tối ưu --}}

    
    {{-- PHẦN TRANG THIẾT BỊ HIỆN ĐẠI BẮT ĐẦU TẠI ĐÂY --}}
    <div class="container mx-auto px-4 py-12 max-w-6xl">
        <h2 class="text-3xl font-bold text-blue-800 mb-4">Trang thiết bị hiện đại</h2>
        <p class="text-gray-700 mb-10 text-lg">
            Sở hữu hệ thống trang thiết bị y tế cao cấp, hàng đầu thế giới trong chẩn đoán và điều trị.
        </p>
        {{-- GRID LAYOUT --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            
            {{-- Hình ảnh 1: CT Scan --}}
            <div class="relative group col-span-2 lg:col-span-1 rounded-lg overflow-hidden shadow-xl cursor-pointer">
                <img src="{{ asset('images/c7.png') }}" alt="Siêu máy CT" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                {{-- Lớp phủ overlay hiển thị khi hover --}}
                <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-4 text-center">
                    <p class="text-white font-bold text-lg md:text-xl">SIÊU MÁY CT SOMATOM FORCE VB30</p>
                    <p class="text-white text-sm mt-2 hidden md:block">Máy chụp CT hiện đại hàng đầu thế giới, chụp hơn 100.000 lát cắt.</p>
                </div>
            </div>

            {{-- Hình ảnh 2: Thiết bị y tế 1 --}}
            <div class="relative group col-span-1 rounded-lg overflow-hidden shadow-xl cursor-pointer">
                <img src="{{ asset('images/c8.png') }}" alt="Thiết bị 1" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-4 text-center">
                    <p class="text-white font-bold text-lg md:text-xl">KÍNH SINH HIỂN VI PHẪU THUẬT</p>
                    <p class="text-white text-sm mt-2 hidden md:block">Thiết bị phóng đại hình ảnh và chiếu sáng trong quá trình phẫu thuật, hỗ trợ quan sát và kiểm soát được quá trình phẫu thuật. Với thiết kế linh động,...</p>
                </div>
            </div>

            {{-- Hình ảnh 3: Thiết bị y tế 2 --}}
            <div class="relative group col-span-1 rounded-lg overflow-hidden shadow-xl cursor-pointer">
                <img src="{{ asset('images/c9.png') }}" alt="Thiết bị 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-4 text-center">
                    <p class="text-white font-bold text-lg md:text-xl">MÁY PHẪU THUẬT KHÚC XẠ FEMTOSECOND LASER VISUMAX </p>
                    <p class="text-white text-sm mt-2 hidden md:block">Bước tiến đột phá từ công nghệ ReLex Smile. Mổ cận thị Smile Pro đang là lựa chọn hoàn hảo nhất cho khách hàng. Smile Pro giảm hơn 80% tinhg trạng khô mắt</p>
                </div>
            </div>

            {{-- Hình ảnh 4: Thiết bị y tế 3 (2 hàng) --}}
            <div class="relative group col-span-1 rounded-lg overflow-hidden shadow-xl cursor-pointer">
                <img src="{{ asset('images/c10.png') }}" alt="Thiết bị 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-4 text-center">
                    <p class="text-white font-bold text-lg md:text-xl">HỆ THỐNG NGENUITY 3D VISUALIZATION SYSTEM</p>
                    <p class="text-white text-sm mt-2 hidden md:block">Thiết bị cho kết quả hiển thị hình ảnh chất lượng cao với độ hiển thị chi tiết sắc nét, hỗ trợ phẫu thuật viên và người hỗ trợ quan sát</p>
                </div>
            </div>

            {{-- Hình ảnh 5: Thiết bị y tế 4 --}}
             <div class="relative group col-span-1 rounded-lg overflow-hidden shadow-xl cursor-pointer">
                <img src="{{ asset('images/c11.png') }}" alt="Thiết bị 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-4 text-center">
                    <p class="text-white font-bold text-lg md:text-xl">MÁY PHẪU THUẬT KHÚC XẠ EXCIMER LASER MRL 90</p>
                    <p class="text-white text-sm mt-2 hidden md:block"> Thiết bị hiện đại được sử dụng để điều trị các tật khúc xạ như cận thị, viễn thị và loạn thị. Với công nghệ laser femtosecond tiên tiến, máy MEL 90 có khả năng tạo ra các vạt giác mạc mỏng và đều, giúp bác sĩ phẫu thuật thực hiện các thao tác với độ chính xác cao.</p>
                </div>
            </div>
            {{-- Hình ảnh 6: Thiết bị y tế 5 --}}
            <div class="relative group col-span-1 rounded-lg overflow-hidden shadow-xl cursor-pointer">
                <img src="{{ asset('images/c12.png') }}" alt="Thiết bị 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-4 text-center">
                    <p class="text-white font-bold text-lg md:text-xl">HỆ THỐNG THIẾT BỊ PHẪU THUẬT PHACO FEMTO CATAEACT LENX</p>
                    <p class="text-white text-sm mt-2 hidden md:block">LenSx sử dụng công nghệ 3D hiện đại kết hợp trí tuệ nhân tạo Ai. Cơ chế của phẫu thuật này là sử dụng hệ thống Femtosecond Laser có bước sóng cao tạo đường mổ trên giác mạc, đường xé bao trước thể thủy tinh, đường chẻ nhân thể thủy tinh cực kỳ chính xác. </p>
                </div>
            </div>
            
            {{-- Hình ảnh 7: Thiết bị y tế 6 --}}
            <div class="relative group col-span-1 rounded-lg overflow-hidden shadow-xl cursor-pointer">
                <img src="{{ asset('images/c13.png') }}" alt="Thiết bị 6" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-4 text-center">
                    <p class="text-white font-bold text-lg md:text-xl">SIÊU MÁY CT SOMATOM FORCE VB30</p>
                    <p class="text-white text-sm mt-2 hidden md:block"> Máy chụp cắt lớp vi tính sử dụng hai nguồn phát với độ phân giải thời gian vật lí nhanh nhất tạo ra sự khác biệt về ứng dụng lâm sàng. Trong đó, CT một nguồn phát là 115ms và CT FORCE (hai nguồn phát nhanh hơn ~ 2 lần (66ms)). </p>
                </div>
            </div>

            {{-- Hình ảnh 8: Thiết bị y tế 7 --}}
            <div class="relative group col-span-1 rounded-lg overflow-hidden shadow-xl cursor-pointer">
                <img src="{{ asset('images/c14.png') }}" alt="Thiết bị 7" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-4 text-center">
                    <p class="text-white font-bold text-lg md:text-xl">THIẾT BỊ ĐO DINH TRẮC HỌC NHÃN CẦU ARRGOS</p>
                    <p class="text-white text-sm mt-2 hidden md:block">Thiết bị khhaor sát và đo công suất thủy tinh thể nhanh nhất với tốc độ chụp dưới 1 giây, nhanh gấp 1.5 lần so với IOL Master 700 - thiết bị chụp OCT. </p>
                </div>
            </div>
        </div>
    </div>
    {{-- PHẦN TRANG THIẾT BỊ HIỆN ĐẠI KẾT THÚC TẠI ĐÂY --}}
{{-- PHẦN HIỆU QUẢ ĐIỀU TRỊ CAO - BẮT ĐẦU TẠI ĐÂY  --}}
    <div class="container mx-auto px-4 py-12 max-w-6xl">
        <h2 class="text-3xl font-bold text-blue-800 mb-4">Hiệu quả điều trị cao - Thành tựu nổi bật</h2>
        <p class="text-gray-700 mb-10 text-lg">
            Ứng dụng kỹ thuật tiên tiến, phác đồ chuyên biệt, tăng tỷ lệ thành công.
        </p>

        {{-- GRID LAYOUT HÌNH ẢNH --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Hình 1: Phòng lab/thiết bị --}}
           <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/c15.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">Phẫu thuật thay khớp, ghép xương nhân tạo</span>
            <span class="font-medium text-sm block">Điều trị bệnh lý cơ xương khớp, thay khớp, ghép xương nhân tạo. Bệnh nhân ung thư xương, xương khớp hư hỏng nặng vẫn giữ được chi thể, ghép xương nhân tạo duy nhất tại TAT Clinic
            </span>
        </p>
    </div>
</div>

            {{-- Hình 2: Phẫu thuật --}}
            <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/c16.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">30 phút thần tốc cứu bệnh nhân nhồi máu cơ tim</span>
            <span class="font-medium text-sm block">ThS.BS.CKII Võ Anh Minh, Trưởng đơn vị Can thiệp Mạch vành – Trung tâm Can thiệp mạch, BVĐK TAT Clinic cho biết, ông Trí (64 tuổi, Việt kiều Canada) đã xuất viện hoàn toàn khỏe mạnh. 
            </span>
        </p>
    </div>
</div>
            {{-- Hình 3: Ứng dụng công nghệ --}}
            <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/c17.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">Tắc động mạch phổi sau 3 năm uống thuốc ngừa thai</span>
            <span class="font-medium text-sm block">BS.CKI Lê Văn Tuyến, Trung tâm Can thiệp mạch BVĐK TAT Hà Nội cho biết, bệnh nhân Ánh (51 tuổi, ngụ Vĩnh Long) nhập viện trong tình trạng khó thở, đau nặng ngực, nhịp tim nhanh (125 lần/phút).
            </span>
        </p>
    </div>
</div>

            {{-- Hình 4: Phòng mổ --}}
           <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/c18.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">Kỹ thuật cao trong nuôi trẻ sinh cực non</span>
            <span class="font-medium text-sm block">10h sáng 18/5, BS.CKI Tô Vũ Thiên Hương nhận nhiệm vụ đón bé sinh non 26 tuần nặng 800 gram . Bệnh nhi chuyển viện đến Trung tâm Sơ sinh BVĐK TAT Hà Nội chữa trị theo nguyện vọng của gia đình.
            </span>
        </p>
    </div>
</div>
        </div>
    </div>
    {{-- PHẦN HIỆU QUẢ ĐIỀU TRỊ CAO - KẾT THÚC TẠI ĐÂY --}}

    <div class="container mx-auto px-4 py-12 max-w-6xl">
        <h2 class="text-3xl font-bold text-blue-800 mb-4">Quy trình khoa học - Toàn diện - Chuyên nghiệp</h2>
        <p class="text-gray-700 mb-10 text-lg">
            Quy trình khám, tư vấn và điều trị toàn diện, phối hợp chặt chẽ giữa các chuyên khoa.
        </p>

        {{-- GRID LAYOUT HÌNH ẢNH --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Hình 1: Phòng lab/thiết bị --}}
           <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/c19.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">1. CẤP MÃ SỐ ĐỊNH DANH ĐIỆN TỬ</span>
            <span class="font-medium text-sm block">Khách hàng được cấp một mã số định danh điện tử để "lưu trữ" hồ sơ và sử dụng cho tất cả hoạt động khám, xét nghiệm, theo dõi kết quả tại bệnh viện 
            </span>
        </p>
    </div>
</div>

            {{-- Hình 2: Phẫu thuật --}}
            <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/c20.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">2. HỆ THỐNG BẢO MẬT SINH TRẮC VÂN TAY</span>
            <span class="font-medium text-sm block">Hệ thống bảo mật sinh trắc vân tay có chức năng nhận diện qua dấu vân tay, đảm bảo sự chuẩn xác, tránh nhầm lẫn thông tin khách hàng, đặc biệt trong khám và điều trị. 
            </span>
        </p>
    </div>
</div>
            {{-- Hình 3: Ứng dụng công nghệ --}}
            <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/c21.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">3. QUY TRÌNH KHÉP KÍN, THỦ TỤC ĐƠN GIẢN</span>
            <span class="font-medium text-sm block">Thủ tục đơn giản, quy trình khép kín tại 1 tầng riêng biệt, khách hàng không phải di chuyển nhiều. kết quả khám và xét nghiệm có ngay trong ngày, rút ngắn thời gian điều trị.
            </span>
        </p>
    </div>
</div>

            {{-- Hình 4: Phòng mổ --}}
           <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/c22.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">4. LIÊN KẾT CHẠT CHẼ GIỮA CÁC CHUYÊN KHOA</span>
            <span class="font-medium text-sm block">Tại  BVĐK TAT, với sự phối hợp chặt chẽ giữa các chuyên khoa IVF - Sản - Nhi sơ sinh, Nội cơ xương khớp - Phẫu thuật khớp...mang lại hiệu quả điều trị tối ưu cho khách hàng.
            </span>
        </p>
    </div>
</div>
        </div>
    </div>
    {{-- NÚT XEM HƯỚNG DẪN KHÁM BỆNH --}}
<div class="text-center pt-0 pb-4"> 
    <a href="{{ route('patient.guidee') }}" 
        class="inline-block bg-blue-500 hover:bg-blue-500 text-white **text-base** font-bold uppercase tracking-wider 
          px-9 py-4 shadow-2xl transition duration-300 transform hover:scale-100">XEM HƯỚNG DẪN KHÁM BỆNH</a>
</div>
{{-- END NÚT XEM HƯỚNG DẪN KHÁM BỆNH --}}
<div class="container mx-auto px-4 py-12 max-w-6xl">
        <h2 class="text-3xl font-bold text-blue-800 mb-4">Dịch vụ cao cấp - Chi phí hợp lý</h2>
        <p class="text-gray-700 mb-10 text-lg">
            Đội ngũ chăm sóc khách hàng chuyên nghiệp, tư vấn miễn phí qua tổng đài, website và fanpage.
        </p>

        {{-- GRID LAYOUT HÌNH ẢNH --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Hình 1: Phòng lab/thiết bị --}}
           <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/d1.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">1. CÁC SẢNH CHỜ RỘNG RÃI, THOẢI MÁI</span>
            <span class="font-medium text-sm block">Không gian chờ khám, tư vấn, điều trị khang trang, rộng rãi; ghế ngồi êm ái, thoải mái. Wifi tốc độ cao phủ sóng toàn khu vực bệnh viện. Nước uống sạch được phục vụ miễn phí. 
            </span>
        </p>
    </div>
</div>

            {{-- Hình 2: Phẫu thuật --}}
            <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/d2.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">2. PHÒNG NỘI TRÚ TIÊU CHUẨN KHÁCH SẠN "5 SAO"</span>
            <span class="font-medium text-sm block">Cao cấp, sang trọng, tiện nghi với giường tự động; két sắt chống cháy; phòng tắm có đèn sưởi, thanh chống trượt, nút báo cấp cứu; lấy máu, gội đầu tại giường; bữa ăn dinh dưỡng; nhân viên y tế 24/24. 
            </span>
        </p>
    </div>
</div>
            {{-- Hình 3: Ứng dụng công nghệ --}}
            <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/d3.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">3. DỊCH VỤ CHĂM SÓC KHÁCH HÀNG CAO CẤP</span>
            <span class="font-medium text-sm block">Nhân viên chăm sóc khách hàng 24/7 hỗ trợ khách hàng trong suốt quá trình khám và điều trị. Tư vấn miễn phí qua tổng đài và các nền tảng trực tuyến: website, fanpage, ứng dụng thông minh...
            </span>
        </p>
    </div>
</div>

            {{-- Hình 4: Phòng mổ --}}
           <div class="relative group overflow-hidden rounded-lg shadow-lg cursor-pointer">
             <img src="{{ asset('images/d4.png') }}" alt="Thiết bị y tế tiên tiến" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
           <div class="absolute inset-0 bg-blue-800/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4 text-center"> 
            <p class="text-white">
            <span class="font-bold text-base block mb-1">4. CHI PHÍ HỢP LÝ, NHIỀU ƯU ĐÃI HẤP DẪN</span>
            <span class="font-medium text-sm block">Nhiều gói khám và điều trị linh hoạt; phác đồ điều trị hiệu quả, tiết kiệm chi phí; hỗ trợ trả góp không lãi suất, nhiều ưu đãi hấp dẫn khi sử dụng dịch vụ của các đối tác liên kết.
            </span>
        </p>
    </div>
</div>
        </div>
    </div>
    {{-- NÚT XEM HƯỚNG DẪN KHÁM BỆNH --}}
<div class="text-center pt-0 pb-4"> 
    <a href="{{ route('services.list') }}" 
        class="inline-block bg-blue-500 hover:bg-blue-500 text-white **text-base** font-bold uppercase tracking-wider 
          px-9 py-4 shadow-2xl transition duration-300 transform hover:scale-100">XEM CÁC DỊCH VỤ</a>
</div>
{{-- END NÚT XEM HƯỚNG DẪN KHÁM BỆNH --}}
{{-- KHỐI THỐNG KÊ NHÂN SỰ --}}
<div class="container mx-auto px-4 py-5 max-w-7xl">
    
    {{-- TIÊU ĐỀ KHỐI --}}
    <div class="text-center mb-5">
        <h2 class="text-3xl font-bold text-blue-800 mb-4 ">Chuyên gia đầu ngành - bác sĩ giỏi - chuyên viên giàu kinh nghiệm</h2>
    </div>
    <div class="grid grid-cols-3 lg:grid-cols-6 gap-6 mt-8">

        @php
            $stats = [
                ['number' => '24', 'unit' => 'GIÁO SƯ - P.GIÁO SƯ'],
                ['number' => '171', 'unit' => 'TIẾN SĨ - BÁC SĨ CKII'],
                ['number' => '490', 'unit' => 'THẠC SĨ - BÁC SĨ CKI'],
                ['number' => '786', 'unit' => 'BÁC SĨ'],
                ['number' => '155', 'unit' => 'KỸ THUẬT VIÊN'],
                ['number' => '803', 'unit' => 'ĐIỀU DƯỠNG'],
            ];
        @endphp

        @foreach ($stats as $stat)
            {{-- Thẻ Chỉ số --}}
            <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 
                        transition duration-300 hover:shadow-lg hover:border-blue-400 
                        flex flex-col items-center justify-between text-center aspect-square"> 
                        {{-- Dùng aspect-square để đảm bảo hình vuông --}}
                
                {{-- Phần Số liệu --}}
                <div class="flex-grow flex items-center justify-center pt-2">
                    <span class="text-5xl font-light text-blue-500">{{ $stat['number'] }}</span>
                </div>
                
                {{-- Phần Đơn vị/Chú thích --}}
                <div class="w-full">
                    <p class="text-sm font-semibold text-gray-600 uppercase">{{ $stat['unit'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{-- END KHỐI THỐNG KÊ NHÂN SỰ --}}
{{-- KHỐI GIÁ TRỊ KHÁC BIỆT --}}
<div class="container mx-auto px-4 py-5">
    
    {{-- TIÊU ĐỀ KHỐI --}}
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-blue-800 mb-4">GIÁ TRỊ KHÁC BIỆT CỦA TAT CLINIC</h2>
    </div>
    
    {{-- GRID CÁC DỊCH VỤ/GIÁ TRỊ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

        @php
            // ĐÃ THAY THẾ ĐƯỜNG DẪN TUYỆT ĐỐI BẰNG HÀM asset()
            $values = [
                ['img' => asset('images/d22.png'), 'title' => 'CHUYÊN GIA ĐẦU NGÀNH - BÁC SĨ GIỎI - CHUYÊN VIÊN GIÀU KINH NGHIỆM'],
                ['img' => asset('images/d23.png'), 'title' => 'TRANG THIẾT BỊ HIỆN ĐẠI BẬC NHẤT'], 
                ['img' => asset('images/d24.png'), 'title' => 'HIỆU QUẢ ĐIỀU TRỊ CAO THÀNH TỰU NỔI BẬT'], 
                ['img' => asset('images/d25.png'), 'title' => 'QUY TRÌNH TOÀN DIỆN, KHOA HỌC, CHUYÊN NGHIỆP'], 
                ['img' => asset('images/d26.png'), 'title' => 'DỊCH VỤ CAO CẤP CHI PHÍ HỢP LÝ'], 
            ];
        @endphp

        @foreach ($values as $value)
    {{-- Thẻ Giá trị (ĐÃ CHUYỂN MÀU SANG XANH Y TẾ) --}}
    <div class="relative bg-white p-4 rounded-xl shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 flex flex-col items-center text-center border-b-4 border-blue-600 cursor-pointer">
        
        {{-- KHỐI DECORATION GÓC MÀU XANH --}}
        <div class="absolute top-0 left-0 w-10 h-10 bg-blue-600 opacity-70 rounded-tl-xl" 
             style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
        <div class="absolute top-0 right-0 w-10 h-10 bg-blue-600 opacity-70 rounded-tr-xl" 
             style="clip-path: polygon(0 0, 100% 0, 100% 100%);"></div>

        {{-- KHỐI HÌNH ẢNH --}}
        <div class="w-24 h-24 mb-4 mt-2 flex items-center justify-center"> 
            <img src="{{ $value['img'] }}" alt="{{ $value['title'] }}" class="w-full h-full object-contain filter drop-shadow-md">
        </div>
        
        {{-- Nội dung Text --}}
       <p class="text-sm font-extrabold text-blue-800 leading-tight uppercase pt-2">
    {{ $value['title'] }}
</p>
        
        {{-- Mô tả ngắn (Tùy chọn, nếu bạn có mô tả trong $value) --}}
        @isset($value['description'])
        <p class="text-sm text-gray-600 mt-2">
            {{ $value['description'] }}
        </p>
        @endisset

    </div>
@endforeach

    </div>
</div>
{{-- END KHỐI GIÁ TRỊ KHÁC BIỆT --}}
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