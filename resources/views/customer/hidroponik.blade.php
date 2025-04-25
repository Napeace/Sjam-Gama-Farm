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
                <a href="#" class="text-green-500 ml-2 hover:underline">hubungi kami</a>
                <p class="text-gray-700 ml-2">untuk informasi lebih lanjut</p>
            </div>

            {{-- Produk Carousel --}}
            <div class="relative max-w-5xl mx-auto">
                <div class="flex overflow-hidden scroll-smooth" id="produkCarousel">
                    <div class="min-w-full sm:min-w-[33.333%] p-2">
                        <div class="border border-gray-200 p-4 rounded-lg text-center">
                            <img src="{{ asset('images/products/selada-air.png') }}" alt="Selada Air" class="w-full h-48 object-contain mb-4">
                            <h3 class="text-xl font-semibold text-green-700">Selada Air</h3>
                        </div>
                    </div>
                    <div class="min-w-full sm:min-w-[33.333%] p-2">
                        <div class="border border-gray-200 p-4 rounded-lg text-center">
                            <img src="{{ asset('images/products/selada-air.png') }}" alt="Selada Air" class="w-full h-48 object-contain mb-4">
                            <h3 class="text-xl font-semibold text-green-700">Selada Air</h3>
                        </div>
                    </div>
                    <div class="min-w-full sm:min-w-[33.333%] p-2">
                        <div class="border border-gray-200 p-4 rounded-lg text-center">
                            <img src="{{ asset('images/products/selada-air.png') }}" alt="Selada Air" class="w-full h-48 object-contain mb-4">
                            <h3 class="text-xl font-semibold text-green-700">Selada Air</h3>
                        </div>
                    </div>
                    <div class="min-w-full sm:min-w-[33.333%] p-2">
                        <div class="border border-gray-200 p-4 rounded-lg text-center">
                            <img src="{{ asset('images/products/selada-air.png') }}" alt="Selada Air" class="w-full h-48 object-contain mb-4">
                            <h3 class="text-xl font-semibold text-green-700">Selada Air</h3>
                        </div>
                    </div>
                </div>

                {{-- Carousel Navigation --}}
                <button type="button" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-lg z-10 hover:cursor-pointer" id="produkPrev">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button type="button" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-lg z-10 hover:cursor-pointer" id="produkNext">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
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
                <div class="flex overflow-hidden scroll-smooth" id="videoCarousel">
                    <div class="min-w-full sm:min-w-[33.333%] p-2">
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
                    <div class="min-w-full sm:min-w-[33.333%] p-2">
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
                    <div class="min-w-full sm:min-w-[33.333%] p-2">
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
                <button type="button" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-lg z-10" id="videoPrev">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button type="button" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow-lg z-10" id="videoNext">
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
                {{-- Review Items --}}
                @for ($i = 0; $i < 6; $i++)
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <img src="{{ asset('images/reviews/review-thumb.jpg') }}" alt="Review" class="w-full h-48 object-cover rounded mb-4">
                    <p class="text-gray-700 italic">"Produk hidroponik dari SJAM GAMA FARM sangat segar dan berkualitas. Sangat direkomendasikan!"</p>
                </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- Custom Scrollbar Component --}}
    @include('customer.components.custom-scroll')

    {{-- Footer --}}
    @include('customer.components.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Produk Carousel
            const produkCarousel = document.getElementById('produkCarousel');
            const produkPrev = document.getElementById('produkPrev');
            const produkNext = document.getElementById('produkNext');

            if (produkCarousel && produkPrev && produkNext) {
                // Get width of one slide (including padding)
                const slideWidth = produkCarousel.children[0].offsetWidth;

                produkNext.addEventListener('click', () => {
                    produkCarousel.scrollBy({ left: slideWidth, behavior: 'smooth' });
                });

                produkPrev.addEventListener('click', () => {
                    produkCarousel.scrollBy({ left: -slideWidth, behavior: 'smooth' });
                });
            }

            // Video Carousel
            const videoCarousel = document.getElementById('videoCarousel');
            const videoPrev = document.getElementById('videoPrev');
            const videoNext = document.getElementById('videoNext');

            if (videoCarousel && videoPrev && videoNext) {
                // Get width of one slide (including padding)
                const slideWidth = videoCarousel.children[0].offsetWidth;

                videoNext.addEventListener('click', () => {
                    videoCarousel.scrollBy({ left: slideWidth, behavior: 'smooth' });
                });

                videoPrev.addEventListener('click', () => {
                    videoCarousel.scrollBy({ left: -slideWidth, behavior: 'smooth' });
                });
            }
        });
    </script>
@endsection
