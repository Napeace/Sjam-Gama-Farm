@extends('customer.components.layouts')

@section('title', 'SJAM GAMA FARM - Hidroponik')

@section('content')
    {{-- Navbar Component --}}
    @include('customer.components.navbar2')

    {{-- Hero Banner Section --}}
    <section class="relative w-full bg-green-700 overflow-hidden">
        <div class="absolute inset-0 w-full h-full overflow-hidden">
            <img src="{{ asset('images/farm-background.png') }}" alt="Hidroponik Banner" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="container mx-auto px-4 py-16 relative z-10 text-center text-white">
            <h1 class="text-5xl font-bold mb-4">HIDROPONIK</h1>
            <p class="max-w-3xl mx-auto text-lg">
                Hidroponik merupakan cara menanam dengan media selain tanah. Dalam sistem hidroponik, nutrisi untuk tanaman berasal dari larutan mineral yang terlarut dalam air dan diberikan langsung ke akar tanaman. Sistem ini ideal untuk memaksimalkan ruang dan air.
            </p>
        </div>
    </section>

    {{-- Produk Section --}}
    <section id="produk-section" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-green-700 mb-8">Produk</h2>

            <div class="flex flex-wrap items-center justify-center mb-6">
                <p class="text-gray-700">Ada beberapa varian sayur yang tersedia</p>
                <a href="https://wa.me/6285156422350" target='_blank' class="text-green-500 ml-2 hover:underline">hubungi kami</a>
                <p class="text-gray-700 ml-2">untuk informasi lebih lanjut</p>
            </div>

            {{-- Produk Carousel Container --}}
            <div class="relative max-w-5xl mx-auto">
                <div class="overflow-x-auto">
                    <div class="flex gap-4 touch-pan-x cursor-grab" id="produkCarousel">
                        @forelse($products as $product)
                        <div class="min-w-[250px] max-w-[250px] p-2 flex-shrink-0">
                            <div class="border border-gray-200 p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="w-full h-48 object-contain mb-4">
                                <h3 class="text-xl font-semibold text-green-700 flex-grow text-center">{{ $product->nama }}</h3>
                            </div>
                        </div>
                        @empty
                        <div class="min-w-full p-2">
                            <div class="border border-gray-200 p-4 rounded-lg text-center">
                                <p class="text-gray-500">Belum ada produk tersedia</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Carousel Navigation buttons - keep these as they are -->
                <button type="button" class="absolute left-[-4rem] top-1/2 -translate-y-1/2 bg-gray-100 p-2 rounded-full shadow-lg z-10 hover:bg-green-50 cursor-pointer focus:outline-none" id="produkPrev">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button type="button" class="absolute right-[-4rem] top-1/2 -translate-y-1/2 bg-gray-100 p-2 rounded-full shadow-lg z-10 hover:bg-green-50 cursor-pointer focus:outline-none" id="produkNext">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            {{-- "Selengkapnya" Button --}}
            <div class="text-right mt-4 max-w-5xl mx-auto">
                <a href="{{ route('produk.index') }}" class="text-green-600 hover:text-green-800 font-medium">Lihat selengkapnya...</a>
            </div>
        </div>
    </section>

    {{-- Video Pembelajaran Section --}}
    <section id="video-section" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-green-700 mb-8">Video Pembelajaran</h2>

            <div class="flex flex-wrap items-center justify-center mb-6">
                <p class="text-gray-700">Kami memiliki beberapa video pembelajaran yang membahas berbagai teknik dan tips <br>
            dalam budidaya hidroponik, cocok untuk pemula hingga yang sudah berpengalaman. </p>
            </div>

            {{-- Video Carousel --}}
            <div class="relative max-w-5xl mx-auto">
                <div class="flex overflow-hidden scroll-smooth cursor-grab" id="videoCarousel">
                    <div class="min-w-full sm:min-w-[33.333%] p-2 flex-shrink-0">
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="relative pb-[56.25%]">
                                <img src="{{ asset('images/videos/video-thumbnail.jpg') }}" alt="Video Thumbnail" class="absolute inset-0 w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">Cara lorem ipsum</h3>
                            </div>
                        </div>
                    </div>
                    <div class="min-w-full sm:min-w-[33.333%] p-2 flex-shrink-0">
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="relative pb-[56.25%]">
                                <img src="{{ asset('images/videos/video-thumbnail.jpg') }}" alt="Video Thumbnail" class="absolute inset-0 w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">Cara lorem ipsum</h3>
                            </div>
                        </div>
                    </div>
                    <div class="min-w-full sm:min-w-[33.333%] p-2 flex-shrink-0">
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="relative pb-[56.25%]">
                                <img src="{{ asset('images/videos/video-thumbnail.jpg') }}" alt="Video Thumbnail" class="absolute inset-0 w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">Cara lorem ipsum</h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Carousel Navigation --}}
                <button type="button" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-lg z-10 hover:bg-green-50 cursor-pointer focus:outline-none" id="videoPrev">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button type="button" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-lg z-10 hover:bg-green-50 cursor-pointer focus:outline-none" id="videoNext">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    {{-- Pelatihan Offline Section --}}
    <section id="pelatihan-section" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-green-700 mb-8">Pelatihan Offline</h2>

            <div class="max-w-4xl mx-auto">
                <div class="flex flex-wrap items-center mb-6">
                    <p class="text-gray-700">Pelatihan bulan ini : Hidroponik lorem ipsum</p>
                    <a href="#" class="text-green-500 ml-2 hover:underline">segera isi form</a>
                    <p class="text-gray-700 ml-2">untuk mengikutinya</p>
                </div>

                <div class="bg-gray-100 rounded-lg p-6 flex flex-col md:flex-row gap-6">
                    <div class="md:w-1/3">
                        <img src="{{ asset('images/training/hidroponik-training.jpg') }}" alt="Pelatihan Hidroponik" class="w-full h-48 object-cover rounded">
                    </div>
                    <div class="md:w-2/3">
                        <h3 class="text-2xl font-bold text-green-700 mb-2">Hidroponik Lorem Ipsum</h3>
                        <p class="mb-2">tanggal : 25 April 2025</p>
                        <p class="mb-4">kelas usia 6-10 tahun</p>
                        <a href="#" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition duration-300">
                            klik untuk daftar sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Artikel Section --}}
    <section id="artikel-section" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-green-700 mb-8">Artikel</h2>

            <div class="max-w-4xl mx-auto">
                <div class="space-y-6">
                    @if($artikels->count() > 0)
                        @foreach($artikels->take(3) as $artikel)
                            <div class="flex flex-col md:flex-row gap-4 bg-white p-4 rounded-lg shadow-sm">
                                <div class="md:w-1/4">
                                    @if($artikel->gambar)
                                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-32 object-cover rounded">
                                    @else
                                        <img src="{{ asset('images/articles/article-thumb.jpg') }}" alt="Article Thumbnail" class="w-full h-32 object-cover rounded">
                                    @endif
                                </div>
                                <div class="md:w-3/4">
                                    <h3 class="text-xl font-semibold text-green-700">{{ $artikel->judul }}</h3>
                                    <p class="text-gray-600">{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
                                    <a href="/artikel/{{ $artikel->slug }}" class="text-green-600 hover:text-green-800 mt-2 inline-block">Baca selengkapnya</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center py-8">
                            <p class="text-gray-600">Belum ada artikel tentang hidroponik saat ini.</p>
                        </div>
                    @endif

                    @if($artikels->count() > 3)
                        <div class="text-right">
                            <a href="{{ route('artikel.hidroponik') }}" class="text-green-600 hover:text-green-800 font-medium">Lihat selengkapnya...</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Review Section --}}
    <section id="review-section" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-green-700 mb-8">Review</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                {{-- Review Items from Database --}}
                @forelse($reviews as $review)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm review-item cursor-pointer" data-id="{{ $review->id }}">
                        @if($review->image)
                            <img src="{{ asset('storage/' . $review->image) }}" alt="Review" class="w-full h-48 object-cover rounded mb-4">
                        @else
                            <img src="{{ asset('images/reviews/review-thumb.jpg') }}" alt="Review" class="w-full h-48 object-cover rounded mb-4">
                        @endif
                        <p class="text-gray-700 italic line-clamp-2">{{ Str::limit($review->description, 100) }}</p>
                    </div>
                @empty
                    {{-- Fallback to show default reviews if none exist in the database --}}
                    @for ($i = 0; $i < 6; $i++)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <img src="{{ asset('images/reviews/review-thumb.jpg') }}" alt="Review" class="w-full h-48 object-cover rounded mb-4">
                        <p class="text-gray-700 italic">"Produk hidroponik dari SJAM GAMA FARM sangat segar dan berkualitas. Sangat direkomendasikan!"</p>
                    </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </section>

    {{-- Review Modal --}}
    <div id="reviewModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-all duration-300">
        <div class="bg-white rounded-xl max-w-5xl w-full max-h-[90vh] overflow-hidden relative shadow-2xl transform transition-all duration-500 scale-95 opacity-0" id="modalContent">
            {{-- Close button --}}
            <button id="closeReviewModal" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 hover:bg-opacity-70 cursor-pointer rounded-full p-2 z-10 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Modal content --}}
            <div class="flex flex-col md:flex-row">
                {{-- Review Image --}}
                <div class="md:w-1/2 relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-[1] md:hidden"></div>
                    <img id="modalReviewImage" src="" alt="Review" class="w-full h-full object-cover">
                </div>

                {{-- Review Content --}}
                <div class="md:w-1/2 p-6 md:p-8 bg-white relative">
                    {{-- User info section --}}
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-green-700 flex items-center justify-center overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 id="modalReviewName" class="font-bold text-lg text-green-800">Pelanggan SJAM</h3>
                            <p id="modalReviewDate" class="text-sm text-gray-500"></p>
                        </div>
                    </div>

                    {{-- Review description with quotation marks --}}
                    <div class="relative">
                        <svg class="absolute -top-4 -left-2 h-8 w-8 text-green-200 transform -rotate-180" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                        <div id="modalReviewDescription" class="text-gray-700 mt-6 pt-4 pl-6 pr-2 text-lg leading-relaxed min-h-[200px] max-h-[300px] overflow-y-auto"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Navigation arrows --}}
    <button id="prevReview" class="fixed left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white cursor-pointer rounded-full p-3 shadow-lg z-[51] hidden hover:scale-110 transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="nextReview" class="fixed right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white cursor-pointer rounded-full p-3 shadow-lg z-[51] hidden hover:scale-110 transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    {{-- Custom Scrollbar Component --}}
    @include('customer.components.custom-scroll')

    {{-- Footer --}}
    @include('customer.components.footer')

<!-- Update the CSS section in your blade template -->
<style>
    #produkCarousel, #videoCarousel {
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        display: flex;
        scroll-snap-type: x mandatory;
        gap: 10px;
        width: 100%;
        overflow-x: auto; /* Ensure this is present */
    }

    #produkCarousel > div, #videoCarousel > div {
        scroll-snap-align: start;
        flex: 0 0 auto; /* Prevent items from shrinking/growing */
    }

    .cursor-grabbing {
        cursor: grabbing;
    }

    /* Hide scrollbar but allow scrolling */
    .overflow-x-auto {
        overflow-x: auto;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE and Edge */
    }

    .overflow-x-auto::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
    }
    /* For truncating review text preview */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Add hover effect for review items */
    .review-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .review-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);

    }
    #review-section {
        scroll-margin-top: 60px;
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Improved setup for carousels
        function setupCarousel(carouselId, prevBtnId, nextBtnId) {
            const carousel = document.getElementById(carouselId);
            const prevBtn = document.getElementById(prevBtnId);
            const nextBtn = document.getElementById(nextBtnId);

            if (!carousel || !prevBtn || !nextBtn) {
                console.error('Carousel elements not found:', carouselId, prevBtnId, nextBtnId);
                return;
            }

            // Calculate scroll amount based on visible items
            function getScrollAmount() {
                // Default to 250px (approximate width of one item plus padding)
                const itemWidth = 250;

                // For smaller screens, scroll one full item
                if (window.innerWidth < 640) {
                    return itemWidth;
                }
                // For medium screens, scroll 2 items
                else if (window.innerWidth < 1024) {
                    return itemWidth * 2;
                }
                // For larger screens, scroll 3 items
                else {
                    return itemWidth * 3;
                }
            }

            // Debug information
            console.log('Carousel:', carouselId);
            console.log('- Total width:', carousel.scrollWidth);
            console.log('- Visible width:', carousel.clientWidth);
            console.log('- Item count:', carousel.children.length);

            // Mouse events for drag scrolling
            let isDown = false;
            let startX;
            let scrollLeft;

            carousel.addEventListener('mousedown', function(e) {
                isDown = true;
                carousel.classList.add('cursor-grabbing');
                startX = e.pageX - carousel.offsetLeft;
                scrollLeft = carousel.scrollLeft;
                e.preventDefault();
            });

            carousel.addEventListener('mouseleave', function() {
                isDown = false;
                carousel.classList.remove('cursor-grabbing');
            });

            carousel.addEventListener('mouseup', function() {
                isDown = false;
                carousel.classList.remove('cursor-grabbing');
            });

            carousel.addEventListener('mousemove', function(e) {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - carousel.offsetLeft;
                const walk = (x - startX); // More direct 1:1 movement for better control
                carousel.scrollLeft = scrollLeft - walk;
            });

            // Touch events for mobile
            carousel.addEventListener('touchstart', function(e) {
                isDown = true;
                startX = e.touches[0].pageX - carousel.offsetLeft;
                scrollLeft = carousel.scrollLeft;
            });

            carousel.addEventListener('touchend', function() {
                isDown = false;
            });

            carousel.addEventListener('touchmove', function(e) {
                if (!isDown) return;
                const x = e.touches[0].pageX - carousel.offsetLeft;
                const walk = (x - startX);
                carousel.scrollLeft = scrollLeft - walk;
            });

            // Navigation buttons
            nextBtn.addEventListener('click', function() {
                carousel.scrollBy({
                    left: getScrollAmount(),
                    behavior: 'smooth'
                });
            });

            prevBtn.addEventListener('click', function() {
                carousel.scrollBy({
                    left: -getScrollAmount(),
                    behavior: 'smooth'
                });
            });

            // Show/hide buttons based on scroll position
            function updateButtonVisibility() {
                const isScrollable = carousel.scrollWidth > carousel.clientWidth;

                if (!isScrollable) {
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'none';
                    return;
                }

                const isAtStart = carousel.scrollLeft <= 1;
                const isAtEnd = carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth - 1;

                prevBtn.style.display = isAtStart ? 'none' : 'block';
                nextBtn.style.display = isAtEnd ? 'none' : 'block';
            }

            // Add scroll event listener to update button visibility
            carousel.addEventListener('scroll', updateButtonVisibility);

            // Update on window resize
            window.addEventListener('resize', function() {
                updateButtonVisibility();
            });

            // Initial visibility check
            updateButtonVisibility();
        }

        // Initialize both carousels
        setupCarousel('produkCarousel', 'produkPrev', 'produkNext');
        setupCarousel('videoCarousel', 'videoPrev', 'videoNext');
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Variables for modal
        const reviewModal = document.getElementById('reviewModal');
        const modalContent = document.getElementById('modalContent');
        const closeReviewModal = document.getElementById('closeReviewModal');
        const modalReviewImage = document.getElementById('modalReviewImage');
        const modalReviewDate = document.getElementById('modalReviewDate');
        const modalReviewName = document.getElementById('modalReviewName');
        const modalReviewDescription = document.getElementById('modalReviewDescription');
        const prevReviewBtn = document.getElementById('prevReview');
        const nextReviewBtn = document.getElementById('nextReview');

        // Get all review items
        const reviewItems = document.querySelectorAll('.review-item');
        let currentReviewIndex = 0;

        // Reviews data from the database (embedded directly in the page)
        const reviewsData = @json($reviews);

        // Add click event to review items
        reviewItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                openReviewModal(index);
            });
        });

        // Open the review modal with the specified review
        function openReviewModal(index) {
            currentReviewIndex = index;

            if (reviewsData.length > 0 && reviewsData[index]) {
                const review = reviewsData[index];

                // Set image
                if (review.image) {
                    modalReviewImage.src = `/storage/${review.image}`;
                } else {
                    modalReviewImage.src = '/images/reviews/review-thumb.jpg';
                }

                // Set name (if available, otherwise default)
                if (review.user_name) {
                    modalReviewName.textContent = review.user_name;
                } else {
                    modalReviewName.textContent = 'Pelanggan SJAM';
                }

                // Format date (if available)
                if (review.created_at) {
                    const date = new Date(review.created_at);
                    modalReviewDate.textContent = date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                } else {
                    modalReviewDate.textContent = '';
                }

                // Set description
                modalReviewDescription.textContent = review.description;

                // Show modal with animation
                reviewModal.classList.remove('hidden');
                reviewModal.classList.add('flex');


                // Use setTimeout to ensure the transition works properly
                setTimeout(() => {
                    modalContent.classList.add('scale-100', 'opacity-100');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                }, 10);

                // Show/hide navigation buttons
                updateNavigationButtons();
            }
        }

        // Close modal with animation
        function closeModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            // Wait for animation to complete before hiding
            setTimeout(() => {
                reviewModal.classList.add('hidden');
                reviewModal.classList.remove('flex');
            }, 300);
        }

        // Close button
        closeReviewModal.addEventListener('click', closeModal);

        // Close modal when clicking outside
        reviewModal.addEventListener('click', function(e) {
            if (e.target === reviewModal) {
                closeModal();
            }
        });

        // Navigation buttons
        prevReviewBtn.addEventListener('click', function() {
            if (currentReviewIndex > 0) {
                // Add slide-out animation
                modalContent.classList.add('translate-x-4', 'opacity-0');

                setTimeout(() => {
                    openReviewModal(currentReviewIndex - 1);
                    // Reset and add slide-in animation
                    modalContent.classList.remove('translate-x-4');
                    modalContent.classList.add('-translate-x-4');

                    setTimeout(() => {
                        modalContent.classList.remove('-translate-x-4', 'opacity-0');
                    }, 10);
                }, 200);
            }
        });

        nextReviewBtn.addEventListener('click', function() {
            if (currentReviewIndex < reviewsData.length - 1) {
                // Add slide-out animation
                modalContent.classList.add('-translate-x-4', 'opacity-0');

                setTimeout(() => {
                    openReviewModal(currentReviewIndex + 1);
                    // Reset and add slide-in animation
                    modalContent.classList.remove('-translate-x-4');
                    modalContent.classList.add('translate-x-4');

                    setTimeout(() => {
                        modalContent.classList.remove('translate-x-4', 'opacity-0');
                    }, 10);
                }, 200);
            }
        });

        // Update navigation buttons visibility
        function updateNavigationButtons() {
            if (reviewsData.length <= 1) {
                prevReviewBtn.classList.add('hidden');
                nextReviewBtn.classList.add('hidden');
                return;
            }

            if (currentReviewIndex === 0) {
                prevReviewBtn.classList.add('hidden');
            } else {
                prevReviewBtn.classList.remove('hidden');
            }

            if (currentReviewIndex === reviewsData.length - 1) {
                nextReviewBtn.classList.add('hidden');
            } else {
                nextReviewBtn.classList.remove('hidden');
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (reviewModal.classList.contains('hidden')) return;

            if (e.key === 'Escape') {
                closeModal();
            } else if (e.key === 'ArrowLeft' && currentReviewIndex > 0) {
                prevReviewBtn.click();
            } else if (e.key === 'ArrowRight' && currentReviewIndex < reviewsData.length - 1) {
                nextReviewBtn.click();
            }
        });

        // Preload next and previous images for smoother transitions
        function preloadAdjacentImages(index) {
            if (reviewsData.length <= 1) return;

            // Preload next image
            if (index < reviewsData.length - 1) {
                const nextImg = new Image();
                if (reviewsData[index + 1].image) {
                    nextImg.src = `/storage/${reviewsData[index + 1].image}`;
                } else {
                    nextImg.src = '/images/reviews/review-thumb.jpg';
                }
            }

            // Preload previous image
            if (index > 0) {
                const prevImg = new Image();
                if (reviewsData[index - 1].image) {
                    prevImg.src = `/storage/${reviewsData[index - 1].image}`;
                } else {
                    prevImg.src = '/images/reviews/review-thumb.jpg';
                }
            }
        }

        // Add swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        reviewModal.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });

        reviewModal.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50; // minimum distance for swipe

            if (touchEndX < touchStartX - swipeThreshold && currentReviewIndex < reviewsData.length - 1) {
                // Swipe left - go to next
                nextReviewBtn.click();
            }

            if (touchEndX > touchStartX + swipeThreshold && currentReviewIndex > 0) {
                // Swipe right - go to previous
                prevReviewBtn.click();
            }
        }

        // Enhance the review item cards in the grid
        reviewItems.forEach(item => {
            // Add hover effect classes
            item.classList.add('transform', 'transition-all', 'duration-300');
        });
    });
</script>
@endsection
