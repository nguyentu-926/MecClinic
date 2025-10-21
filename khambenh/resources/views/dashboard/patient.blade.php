@extends('layouts.patient')

@section('content')

<div id="carousel-wrapper" class="relative w-screen h-96 overflow-hidden -ml-20 -mt-3"> 
    {{-- Ảnh --}}
    <img id="carousel-img" src="{{ asset('images/nen1.jpg') }}" class="w-full h-full object-cover transition-opacity duration-700 opacity-100">

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
        '{{ asset("images/nen1.jpg") }}',
        '{{ asset("images/nen2.jpg") }}',
        '{{ asset("images/nen3.jpg") }}'
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
        imgElement.style.opacity = 0;
        setTimeout(() => {
            imgElement.src = images[currentIndex];
            imgElement.style.opacity = 1;
        }, 200); // 200ms fade out before changing

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

@endsection
