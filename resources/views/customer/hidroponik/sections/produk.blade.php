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

            <!-- Carousel Navigation buttons -->
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

<style>
    #produkCarousel {
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        display: flex;
        scroll-snap-type: x mandatory;
        gap: 10px;
        width: 100%;
        overflow-x: auto;
    }

    #produkCarousel > div {
        scroll-snap-align: start;
        flex: 0 0 auto;
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Setup carousel for produk
        setupCarousel('produkCarousel', 'produkPrev', 'produkNext');
    });
</script>
