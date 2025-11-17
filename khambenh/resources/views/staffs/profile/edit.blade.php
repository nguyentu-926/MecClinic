@extends('layouts.staff')

@section('content')

<style>
    /* ------------------------------------------- */
    /* CSS STYLE: ULTRA MODERN & CLEAN (Edit Form) */
    /* ------------------------------------------- */
    :root {
        --primary-text: #1f2937; /* Gray 900 - Dark text */
        --accent-color: #10b981; /* Emerald 500 - Màu nhấn tươi sáng */
        --border-color: #e5e7eb; /* Gray 200 - Viền rất nhẹ */
        --bg-field: #f9fafb; /* Nền field rất nhẹ */
        --error-red: #ef4444;
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
        border-radius: 1rem; 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04); 
        border: 1px solid var(--border-color);
        padding: 40px 50px;
    }

    /* Tiêu đề tổng thể */
    .page-title-modern {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--primary-text);
        margin-bottom: 25px;
        padding-left: 10px;
        border-left: 5px solid var(--accent-color); 
    }

    /* Input và Select */
    .tat-input-modern {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 15px;
        width: 100%;
        transition: all 0.2s ease;
        background-color: var(--bg-field); 
        color: var(--primary-text);
        font-weight: 500;
    }
    .tat-input-modern:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); 
        background-color: white;
        outline: none;
    }

    /* Label */
    .tat-label-modern {
        font-weight: 600;
        color: #374151; /* Gray 700 */
        margin-bottom: 5px;
        display: block;
        font-size: 0.95rem;
    }
    
    /* Input type file */
    .tat-file-input {
        background-color: white;
        padding: 8px;
        border-radius: 8px;
    }

    /* Tiêu đề phân đoạn */
    .section-header-modern {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-text);
        margin-bottom: 20px;
        border-left: 4px solid #3b82f6; /* Blue 500 */
        padding-left: 10px;
    }
    .section-header-modern.red {
        border-left-color: var(--error-red);
    }
    .section-header-modern.green {
        border-left-color: var(--accent-color);
    }

    /* Nút Cập nhật */
    .action-button-save {
        background-color: var(--accent-color);
        color: white;
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        transition: background-color 0.2s, transform 0.2s;
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }
    .action-button-save:hover {
        background-color: #059669; 
        transform: translateY(-1px);
    }

    /* Nút Hủy */
    .action-button-cancel {
        background-color: #9ca3af; /* Gray 400 */
        color: white;
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: background-color 0.2s;
    }
    .action-button-cancel:hover {
        background-color: #6b7280; /* Gray 500 */
    }

    /* Ảnh đại diện hiện tại */
    .current-avatar {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid var(--accent-color);
    }
    
    .text-error {
        color: var(--error-red);
        font-size: 0.875rem; /* text-sm */
        margin-top: 4px;
        font-weight: 500;
    }
</style>

<div class="profile-container-modern">

    <h1 class="page-title-modern">
        📝 Chỉnh sửa Hồ sơ cá nhân
    </h1>
    
    <div class="profile-card-modern">

        {{-- Hiển thị thông báo lỗi/thành công nếu có --}}
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-700 border border-red-200 font-semibold">
                <i class="fas fa-exclamation-triangle mr-2"></i> Vui lòng kiểm tra lại các trường thông tin bị lỗi.
            </div>
        @endif
        
        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-700 border border-green-200 font-semibold">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('staff.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Phần 1: Ảnh đại diện --}}
            <div class="border-b pb-6 border-gray-100">
                <h2 class="section-header-modern blue"><i class="fas fa-camera mr-2"></i> Ảnh đại diện</h2>

                @php
                    $photoUrl = $staff->photo 
                                   ? asset('storage/' . $staff->photo) 
                                   : asset('images/default-avatar.png');
                @endphp

                <div class="flex items-center space-x-6">
                    {{-- Ảnh hiện tại --}}
                    <div class="flex-shrink-0">
                        <img src="{{ $photoUrl }}" alt="Ảnh đại diện hiện tại" 
                             class="current-avatar shadow-md">
                    </div>
                    
                    {{-- Input upload --}}
                    <div class="flex-grow">
                        <label for="photo" class="tat-label-modern">Cập nhật ảnh mới</label>
                        <input type="file" name="photo" id="photo" 
                               class="tat-input-modern tat-file-input @error('photo') border-error-red @enderror">
                        <p class="mt-1 text-sm text-gray-500">Chấp nhận: JPG, PNG, WEBP (Tối đa 2MB)</p>
                        @error('photo')
                            <p class="text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Phần 2: Thông tin cơ bản --}}
            <div>
                <h2 class="section-header-modern red"><i class="fas fa-user-edit mr-2"></i> Thông tin chung</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Tên --}}
                    <div>
                        <label for="name" class="tat-label-modern">Tên</label>
                        <input type="text" name="name" id="name" 
                               class="tat-input-modern @error('name') border-error-red @enderror"
                               value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <p class="text-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Số điện thoại --}}
                    <div>
                        <label for="phone" class="tat-label-modern">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" 
                               class="tat-input-modern @error('phone') border-error-red @enderror"
                               value="{{ old('phone', $staff->phone) }}">
                        @error('phone')
                            <p class="text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Ngày sinh --}}
                    <div>
                        <label for="date_of_birth" class="tat-label-modern">Ngày sinh</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" 
                               class="tat-input-modern @error('date_of_birth') border-error-red @enderror"
                               value="{{ old('date_of_birth', $staff->date_of_birth) }}">
                        @error('date_of_birth')
                            <p class="text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Giới tính --}}
                    <div>
                        <label for="gender" class="tat-label-modern">Giới tính</label>
                        <select name="gender" id="gender" 
                                class="tat-input-modern @error('gender') border-error-red @enderror">
                            <option value="">-- Chọn --</option>
                            <option value="male" {{ (old('gender', $staff->gender) == 'male') ? 'selected' : '' }}>Nam</option>
                            <option value="female" {{ (old('gender', $staff->gender) == 'female') ? 'selected' : '' }}>Nữ</option>
                            <option value="other" {{ (old('gender', $staff->gender) == 'other') ? 'selected' : '' }}>Khác</option>
                        </select>
                        @error('gender')
                            <p class="text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div> 
            </div>

            <hr class="my-6 border-gray-100">

            {{-- Phần 3: Địa chỉ và Ghi chú --}}
            <div>
                <h2 class="section-header-modern green"><i class="fas fa-map-marked-alt mr-2"></i> Địa chỉ & Ghi chú</h2>
                
                {{-- Địa chỉ --}}
                <div class="mb-6">
                    <label for="address" class="tat-label-modern">Địa chỉ hiện tại</label>
                    <input type="text" name="address" id="address" 
                           class="tat-input-modern @error('address') border-error-red @enderror"
                           value="{{ old('address', $staff->address) }}" placeholder="Số nhà, đường, quận/huyện...">
                    @error('address')
                        <p class="text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Quê quán --}}
                <div class="mb-6">
                    <label for="hometown" class="tat-label-modern">Quê quán</label>
                    <input type="text" name="hometown" id="hometown" 
                           class="tat-input-modern @error('hometown') border-error-red @enderror"
                           value="{{ old('hometown', $staff->hometown) }}" placeholder="Tỉnh/Thành phố">
                    @error('hometown')
                        <p class="text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ghi chú --}}
                <div class="mb-6">
                    <label for="notes" class="tat-label-modern">Ghi chú / Thông tin thêm</label>
                    <textarea name="notes" id="notes" rows="4" 
                              class="tat-input-modern @error('notes') border-error-red @enderror" placeholder="Viết vài ghi chú cá nhân hoặc thông tin cần thiết.">{{ old('notes', $staff->notes) }}</textarea>
                    @error('notes')
                        <p class="text-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Khối Nút hành động --}}
            <div class="flex justify-end pt-4">
                {{-- Nút Hủy --}}
                <a href="{{ route('staff.profile.show') }}" 
                   class="action-button-cancel inline-flex items-center mr-4">
                    <i class="fas fa-times-circle w-4 h-4 mr-2"></i> Hủy
                </a>
                
                {{-- Nút Cập nhật --}}
                <button type="submit" 
                        class="action-button-save inline-flex items-center">
                    <i class="fas fa-save w-4 h-4 mr-2"></i> CẬP NHẬT & LƯU
                </button>
            </div>

        </form>

    </div>

</div>
@endsection