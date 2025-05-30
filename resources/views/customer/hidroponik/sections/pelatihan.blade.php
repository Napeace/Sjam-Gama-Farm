{{-- resources/views/customer/hidroponik/sections/pelatihan.blade.php --}}
<section id="pelatihan-section" class="py-16 bg-gradient-to-br from-green-50 via-white to-emerald-50 relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-32 h-32 bg-green-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-emerald-400 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-green-300 rounded-full blur-2xl"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Enhanced Header Section -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full mb-6 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-green-700 to-emerald-600 bg-clip-text text-transparent mb-4">
                Pelatihan Offline
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Bergabunglah dengan pelatihan hidroponik offline kami dan pelajari teknik bercocok tanam modern langsung dari para ahli
            </p>
            <div class="w-24 h-1 bg-gradient-to-r from-green-500 to-emerald-500 mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="max-w-6xl mx-auto">
            @if($trainingForms && $trainingForms->count() > 0)
                <!-- Container dengan Alpine.js untuk navigasi kartu -->
                <div x-data="trainingCarousel({{ $trainingForms->count() }})" class="relative">
                    <!-- Tombol navigasi kiri -->
                    <button
                        @click="previousSlide()"
                        x-show="canGoPrev"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95 -translate-x-4"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-x-0"
                        class="cursor-pointer absolute left-0 top-1/2 transform -translate-y-1/2 z-20 bg-white shadow-xl rounded-full p-4 border border-gray-100 hover:bg-green-50 hover:border-green-200 transition-all duration-300 hover:shadow-2xl group">
                        <svg class="w-6 h-6 text-gray-600 group-hover:text-green-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>

                    <!-- Tombol navigasi kanan -->
                    <button
                        @click="nextSlide()"
                        x-show="canGoNext"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95 translate-x-4"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-x-0"
                        class="cursor-pointer absolute right-0 top-1/2 transform -translate-y-1/2 z-20 bg-white shadow-xl rounded-full p-4 border border-gray-100 hover:bg-green-50 hover:border-green-200 transition-all duration-300 hover:shadow-2xl group">
                        <svg class="w-6 h-6 text-gray-600 group-hover:text-green-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <!-- Container untuk kartu pelatihan -->
                    <div class="overflow-hidden mx-16">
                        <div
                            x-ref="cardContainer"
                            class="flex transition-transform duration-700 ease-out"
                            :style="`transform: translateX(-${currentIndex * 100}%)`">
                            @foreach($trainingForms as $index => $trainingForm)
                                <div class="w-full flex-none px-6">
                                    <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 max-w-3xl mx-auto border border-gray-100 relative overflow-hidden group hover:-translate-y-2">
                                        <!-- Decorative gradient overlay -->
                                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-green-500 via-emerald-500 to-green-600"></div>

                                        <!-- Status badge -->
                                        <div class="absolute top-6 right-6">
                                            @if($trainingForm->is_active && $trainingForm->hasAvailableQuota())
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                                    Tersedia
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                                    @if(!$trainingForm->is_active) Ditutup @else Penuh @endif
                                                </span>
                                            @endif
                                        </div>

                                        <div class="mb-8">
                                            <div class="flex flex-wrap items-center mb-6">
                                                <p class="text-gray-600 text-base font-medium">Pelatihan bulan ini:</p>
                                                @if($trainingForm->is_active && $trainingForm->hasAvailableQuota())
                                                    <a href="{{ route('training.register', $trainingForm->id) }}"
                                                       class="text-green-600 ml-2 hover:text-green-700 font-semibold text-base hover:underline transition-colors duration-200">
                                                        segera isi form
                                                    </a>
                                                    <p class="text-gray-600 ml-1 text-base">untuk mengikutinya</p>
                                                @else
                                                    <span class="text-red-500 ml-2 font-semibold text-base">
                                                        @if(!$trainingForm->is_active)
                                                            (Pendaftaran Ditutup)
                                                        @else
                                                            (Kuota Penuh)
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>

                                            <h3 class="text-3xl font-bold text-gray-800 mb-4 leading-tight">{{ $trainingForm->title }}</h3>

                                            @if($trainingForm->description)
                                                <div class="bg-gray-50 rounded-xl p-4 border-l-4 border-green-500 mb-6">
                                                    <p class="text-gray-700 text-base leading-relaxed">{{ Str::words($trainingForm->description, 20, '...') }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Enhanced info grid with better spacing and icons -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                            <div class="space-y-4">
                                                <div class="flex items-start p-4 bg-green-50 rounded-xl border border-green-100 group-hover:bg-green-100 transition-colors duration-300">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-4">
                                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-green-800 mb-1">Tanggal & Waktu</p>
                                                        <p class="text-gray-700 font-semibold">
                                                            {{ $trainingForm->training_date->format('d F Y') }}
                                                            @if($trainingForm->training_time)
                                                                <br><span class="text-sm text-gray-600">{{ $trainingForm->training_time->format('H:i') }} WIB</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                @if($trainingForm->location)
                                                    <div class="flex items-start p-4 bg-blue-50 rounded-xl border border-blue-100 group-hover:bg-blue-100 transition-colors duration-300">
                                                        <div class="flex-shrink-0 w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-medium text-blue-800 mb-1">Lokasi</p>
                                                            <p class="text-gray-700 font-semibold">{{ $trainingForm->location }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="space-y-4">
                                                <div class="flex items-start p-4 bg-purple-50 rounded-xl border border-purple-100 group-hover:bg-purple-100 transition-colors duration-300">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4">
                                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-purple-800 mb-1">Kuota Peserta</p>
                                                        <p class="text-gray-700 font-semibold">
                                                            {{ $trainingForm->actual_current_quota }}/{{ $trainingForm->max_quota }} peserta
                                                        </p>
                                                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                                            @if($trainingForm->quota_percentage < 50)
                                                                <div class="h-2 rounded-full transition-all duration-500 bg-green-500"
                                                                    style="width: {{ $trainingForm->quota_percentage }}%">
                                                                </div>
                                                            @elseif($trainingForm->quota_percentage < 80)
                                                                <div class="h-2 rounded-full transition-all duration-500 bg-yellow-500"
                                                                    style="width: {{ $trainingForm->quota_percentage }}%">
                                                                </div>
                                                            @else
                                                                <div class="h-2 rounded-full transition-all duration-500 bg-red-500"
                                                                    style="width: {{ $trainingForm->quota_percentage }}%">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @if($trainingForm->quota_percentage >= 100)
                                                            <p class="text-xs text-red-600 mt-1 font-medium">Kuota Penuh</p>
                                                        @elseif($trainingForm->quota_percentage >= 80)
                                                            <p class="text-xs text-orange-600 mt-1 font-medium">Hampir Penuh</p>
                                                        @else
                                                            <p class="text-xs text-green-600 mt-1 font-medium">{{ $trainingForm->available_quota }} slot tersisa</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="flex items-start p-4 bg-orange-50 rounded-xl border border-orange-100 group-hover:bg-orange-100 transition-colors duration-300">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center mr-4">
                                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-orange-800 mb-1">Biaya Pelatihan</p>
                                                        <p class="text-gray-700 font-bold text-lg">{{ $trainingForm->formatted_price }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Enhanced CTA Button -->
                                        <div class="text-center">
                                            @if($trainingForm->is_active && $trainingForm->hasAvailableQuota())
                                                <a href="{{ route('training.register', $trainingForm->id) }}"
                                                   class="inline-flex items-center justify-center bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-4 px-10 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl shadow-lg text-base group">
                                                    <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Daftar Sekarang
                                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </a>
                                            @else
                                                <button disabled class="inline-flex items-center justify-center bg-gray-400 text-white font-semibold py-4 px-10 rounded-xl cursor-not-allowed opacity-70 text-base">
                                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    @if(!$trainingForm->is_active)
                                                        Pendaftaran Ditutup
                                                    @else
                                                        Kuota Penuh
                                                    @endif
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Enhanced Indikator dots -->
                    @if($trainingForms->count() > 1)
                        <div class="flex justify-center mt-10 space-x-3">
                            <template x-for="(item, index) in Array(totalItems)" :key="index">
                                <button
                                    @click="goToSlide(index)"
                                    class="w-4 h-4 rounded-full transition-all duration-300 transform hover:scale-110"
                                    :class="currentIndex === index ?
                                        'bg-gradient-to-r from-green-500 to-emerald-500 shadow-lg' :
                                        'bg-gray-300 hover:bg-gray-400 hover:shadow-md'">
                                </button>
                            </template>
                        </div>
                    @endif
                </div>

                <!-- Enhanced Alpine.js Script untuk Carousel -->
                <script>
                function trainingCarousel(totalItems) {
                    return {
                        currentIndex: 0,
                        totalItems: totalItems,
                        autoSlideInterval: null,

                        init() {
                            // Auto slide setiap 8 detik
                            this.startAutoSlide();
                        },

                        get canGoPrev() {
                            return this.currentIndex > 0;
                        },

                        get canGoNext() {
                            return this.currentIndex < this.totalItems - 1;
                        },

                        nextSlide() {
                            if (this.canGoNext) {
                                this.currentIndex++;
                            } else {
                                this.currentIndex = 0; // Loop kembali ke awal
                            }
                            this.resetAutoSlide();
                        },

                        previousSlide() {
                            if (this.canGoPrev) {
                                this.currentIndex--;
                            } else {
                                this.currentIndex = this.totalItems - 1; // Loop ke akhir
                            }
                            this.resetAutoSlide();
                        },

                        goToSlide(index) {
                            if (index >= 0 && index < this.totalItems) {
                                this.currentIndex = index;
                                this.resetAutoSlide();
                            }
                        },

                        startAutoSlide() {
                            if (this.totalItems > 1) {
                                this.autoSlideInterval = setInterval(() => {
                                    this.nextSlide();
                                }, 8000);
                            }
                        },

                        resetAutoSlide() {
                            if (this.autoSlideInterval) {
                                clearInterval(this.autoSlideInterval);
                                this.startAutoSlide();
                            }
                        }
                    }
                }
                </script>

            @else
                <!-- Enhanced Empty State -->
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Pelatihan</h3>
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            Pelatihan offline sedang dalam persiapan. Pantau terus halaman ini untuk mendapatkan informasi pelatihan terbaru!
                        </p>
                        <div class="inline-flex items-center px-6 py-3 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            Segera Hadir
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
