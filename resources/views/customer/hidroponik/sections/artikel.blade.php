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
