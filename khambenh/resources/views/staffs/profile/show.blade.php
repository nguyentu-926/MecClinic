@extends('layouts.staff')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: ULTRA MODERN & CLEAN */
    /* ------------------------------------------- */
    :root {
        --primary-text: #1f2937; /* Gray 900 - Dark text */
        --accent-color: #10b981; /* Emerald 500 - Màu nhấn tươi sáng */
        --border-color: #e5e7eb; /* Gray 200 - Viền rất nhẹ */
        --bg-light: #f9fafb; /* Rất nhạt, gần trắng */
    }

    /* Khối chứa chính */
    .profile-container-modern {
        max-width: 1200px;
        margin: 0 auto;
        padding: rem 0;
    }

    /* Card chính */
    .profile-card-modern {
        background-color: white;
        border-radius: 1rem; /* Góc bo tròn vừa phải */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04); /* Shadow cực kỳ nhẹ */
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    /* Tiêu đề tổng thể */
    .page-title-modern {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--primary-text);
        margin-bottom: 25px;
        padding-left: 10px;
        border-left: 5px solid var(--accent-color); /* Đường kẻ mỏng nhấn */
    }
    
    /* Header cho phần ảnh đại diện và thông tin cơ bản */
    .card-header-modern {
        background-color: var(--bg-light);
        padding: 40px 50px 30px 50px;
        border-bottom: 1px solid var(--border-color);
    }

    /* Wrapper cho ảnh */
    .avatar-wrapper-modern {
        border-radius: 9999px;
        padding: 3px;
        background-color: white;
        box-shadow: 0 0 0 4px var(--accent-color); /* Vòng xanh nhấn nhẹ */
        transition: all 0.3s;
        flex-shrink: 0;
    }

    .avatar-wrapper-modern:hover {
        transform: scale(1.02);
    }

    /* Khu vực chi tiết */
    .detail-section-modern {
        padding: 40px 50px;
    }

    /* Khối hiển thị chi tiết */
    .detail-item-modern {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 0;
        border-bottom: 1px solid #f3f4f6; /* Viền siêu mỏng */
    }
    
    .detail-item-modern:last-child {
        border-bottom: none;
    }

    /* Label chi tiết */
    .detail-label-modern {
        font-weight: 500;
        color: #6b7280; /* Gray 500 */
        font-size: 1rem;
        width: 35%;
        display: flex;
        align-items: center;
    }

    /* Value chi tiết */
    .detail-value-modern {
        font-weight: 600;
        color: var(--primary-text); 
        width: 65%;
        text-align: right;
        font-size: 1.05rem;
        padding-left: 10px;
    }

    /* Value đặc biệt (Địa chỉ) */
    .detail-value-address-modern {
        text-align: left !important;
        font-weight: 400 !important; /* Dùng font nhẹ hơn */
        background-color: #ecfdf5; /* Emerald 50 - Rất nhẹ */
        border: 1px solid #d1fae5;
        border-radius: 8px;
        padding: 12px 15px;
        color: #065f46; /* Dark Emerald */
        width: 100%;
        line-height: 1.6;
    }

    /* Nút Chỉnh sửa */
    .action-area-modern {
        padding: 30px 50px;
        border-top: 1px solid var(--border-color);
        text-align: right; 
    }

    .action-button-modern {
        background-color: var(--accent-color);
        color: white;
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        transition: background-color 0.2s, transform 0.2s;
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }
    .action-button-modern:hover {
        background-color: #059669; /* Darker Emerald */
        transform: translateY(-1px);
    }
</style>

<div class="profile-container-modern">

    <h1 class="page-title-modern">
        Thông tin Cá nhân 
    </h1>

    <div class="profile-card-modern">
        
        {{-- KHU VỰC ẢNH ĐẠI DIỆN VÀ TÓM TẮT --}}
        <div class="card-header-modern">
            <div class="flex flex-col md:flex-row items-center md:items-start">
                
                {{-- Ảnh đại diện --}}
                <div class="flex-shrink-0 mb-6 md:mb-0 md:mr-12">
                    @php
                        $photoUrl = $staff->photo 
                                   ? asset('storage/' . $staff->photo) 
                                   : 'https://placehold.co/150x150/f0fdfa/065f46?text=AV'; // Placeholder mới
                    @endphp
                    <div class="avatar-wrapper-modern">
                        <img src="{{ $photoUrl }}" alt="Ảnh đại diện" 
                             class="w-32 h-32 object-cover rounded-full shadow-lg">
                    </div>
                </div>

                {{-- Thông tin cơ bản --}}
                <div class="flex-grow space-y-1 text-center md:text-left pt-4">
                    <h2 class="text-4xl font-extrabold text-gray-900 leading-tight tracking-tight">
                        {{ auth()->user()->name }}
                    </h2>
                    {{-- Email --}}
                    <div class="flex items-center justify-center md:justify-start text-gray-600">
                        <i class="fas fa-envelope w-4 h-4 mr-3 text-red-500"></i>
                        <span class="text-md font-medium">{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Phần II: Thông tin chi tiết Staff --}}
        <div class="detail-section-modern">
            <h3 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-100">
                <i class="fas fa-address-book mr-2 text-accent-color"></i> Chi tiết Hồ sơ & Liên hệ
            </h3>
            
            @php
                // Hàm trợ giúp để định dạng ngày tháng
                $formatDate = fn($date) => $date ? date('d/m/Y', strtotime($date)) : 'Chưa cập nhật';

                // Hàm trợ giúp để hiển thị giới tính
                $formatGender = fn($gender) => match (strtolower($gender ?? '')) {
                    'male' => 'Nam',
                    'female' => 'Nữ',
                    default => 'Chưa cập nhật',
                };
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-0">
                
                {{-- Số điện thoại --}}
                <div class="detail-item-modern">
                    <div class="detail-label-modern"><i class="fas fa-phone-alt w-4 mr-3 text-gray-400"></i> Số điện thoại</div>
                    <div class="detail-value-modern text-accent-color">{{ $staff->phone ?? 'Chưa cập nhật' }}</div>
                </div>

                {{-- Ngày sinh --}}
                <div class="detail-item-modern">
                    <div class="detail-label-modern"><i class="fas fa-calendar-alt w-4 mr-3 text-gray-400"></i> Ngày sinh</div>
                    <div class="detail-value-modern">{{ $formatDate($staff->date_of_birth) }}</div>
                </div>

                {{-- Giới tính --}}
                <div class="detail-item-modern">
                    <div class="detail-label-modern"><i class="fas fa-venus-mars w-4 mr-3 text-gray-400"></i> Giới tính</div>
                    <div class="detail-value-modern">{{ $formatGender($staff->gender) }}</div>
                </div>
                
                {{-- Quê quán --}}
                <div class="detail-item-modern">
                    <div class="detail-label-modern"><i class="fas fa-map-pin w-4 mr-3 text-gray-400"></i> Quê quán</div>
                    <div class="detail-value-modern">{{ $staff->hometown ?? 'Chưa cập nhật' }}</div>
                </div>

                {{-- Địa chỉ (Chiếm hết hàng) --}}
                <div class="md:col-span-2 pt-4">
                    <div class="detail-label-modern mb-3 w-full"><i class="fas fa-home w-4 mr-3 text-gray-400"></i> Địa chỉ hiện tại</div>
                    <div class="detail-value-address-modern w-full">{{ $staff->address ?? 'Chưa cập nhật' }}</div>
                </div>

            </div>
        </div>

        {{-- Nút Chỉnh sửa --}}
        <div class="action-area-modern">
            <a href="{{ route('staff.profile.edit') }}" 
               class="action-button-modern inline-flex items-center">
                <i class="fas fa-edit w-5 h-5 mr-3"></i> 
                CẬP NHẬT HỒ SƠ CÁ NHÂN
            </a>
        </div>

    </div>

</div>
@endsection