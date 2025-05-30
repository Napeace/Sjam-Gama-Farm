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
            <div class="overflow-x-auto">
                <div class="flex gap-4 touch-pan-x cursor-grab" id="videoCarousel">
                    @forelse($trainingVideos as $video)
                    <div class="min-w-[300px] max-w-[300px] p-2 flex-shrink-0">
                        <div class="bg-white shadow rounded-lg overflow-hidden group hover:shadow-lg transition-shadow duration-300 h-full flex flex-col video-card"
                            data-video-id="{{ $video->youtube_video_id }}"
                            data-title="{{ addslashes($video->title) }}"
                            data-description="{{ addslashes($video->description ?? '') }}"
                            data-date="{{ $video->created_at->diffForHumans() }}">

                            <div class="relative pb-[56.25%] cursor-pointer" onclick="openVideoModal('{{ $video->youtube_video_id }}', '{{ addslashes($video->title) }}', '{{ addslashes($video->description ?? '') }}', '{{ $video->created_at->diffForHumans() }}', {{ $video->id }})">
                                {{-- Video Thumbnail --}}
                                @if($video->thumbnail_url)
                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="absolute inset-0 w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('images/videos/video-thumbnail.jpg') }}" alt="{{ $video->title }}" class="absolute inset-0 w-full h-full object-cover">
                                @endif
                            </div>

                            <div class="p-4 flex-1 flex flex-col">
                                <h3 class="text-lg font-semibold text-green-700 mb-2 flex-shrink-0">{{ $video->title }}</h3>
                                @if($video->description)
                                    <p class="text-gray-600 text-sm line-clamp-2 flex-1">{{ Str::limit($video->description, 100) }}</p>
                                @endif
                                <div class="flex items-center justify-end mt-3 text-xs text-gray-500 flex-shrink-0">
                                    <span>{{ $video->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="min-w-full p-2">
                        <div class="bg-white shadow rounded-lg p-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-500">Belum ada video pembelajaran tersedia</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Carousel Navigation --}}
            <button type="button" class="absolute left-[-4rem] top-1/2 -translate-y-1/2 bg-gray-100 p-2 rounded-full shadow-lg z-10 hover:bg-green-50 cursor-pointer focus:outline-none" id="videoPrev">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button type="button" class="absolute right-[-4rem] top-1/2 -translate-y-1/2 bg-gray-100 p-2 rounded-full shadow-lg z-10 hover:bg-green-50 cursor-pointer focus:outline-none" id="videoNext">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>

{{-- Simple Video Modal --}}
<div id="videoModal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4">
    <button id="closeVideoModal"
        class="cursor-pointer absolute top-4 right-4 text-white bg-white/20 hover:bg-white/40 transition rounded-full p-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Video Container -->
    <div class="relative w-full max-w-4xl">
        <div class="relative" style="padding-bottom: 56.25%;">
            <iframe id="youtubePlayer" src=""
                class="absolute inset-0 w-full h-full rounded-lg"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>

{{-- Video Description Hover Modal --}}
<div id="videoDescriptionModal" class="fixed bg-white rounded-lg shadow-xl border p-4 max-w-sm z-50 hidden pointer-events-none">
    <h4 id="hoverVideoTitle" class="text-lg font-semibold text-green-700 mb-2"></h4>
    <p id="hoverVideoDescription" class="text-gray-600 text-sm mb-2"></p>
    <div class="text-xs text-gray-500">
        <span id="hoverVideoDate"></span>
    </div>
</div>

<style>
    /* Video Section Styles */
    #videoCarousel {
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        display: flex;
        scroll-snap-type: x mandatory;
        gap: 16px;
        width: 100%;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #videoCarousel > div {
        scroll-snap-align: start;
        flex: 0 0 auto;
        width: 300px;
        min-width: 300px;
        max-width: 300px;
    }

    /* Video Card Styles - FIXED VERSION */
    .video-card {
        height: 360px;
        transition: all 0.3s ease;
        position: relative;
    }

    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Video card container with consistent height */
    #videoCarousel .bg-white {
        height: 360px;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        overflow: hidden; /* Hapus atau ubah jadi visible saat hover */
    }

    /* Video thumbnail hover effects */
    .group:hover img {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    /* Play button hover animation */
    .group:hover .w-16 {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }

    /* Line clamp for video descriptions */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Video modal animations */
    #videoModal {
        backdrop-filter: blur(8px);
    }

    /* Video Description Modal Styles */
    #videoDescriptionModal {
        transition: all 0.2s ease;
        backdrop-filter: blur(8px);
        background: rgba(255, 255, 255, 0.95);
    }

    #videoDescriptionModal.show {
        opacity: 1;
        transform: translateY(0);
    }

    #videoCarousel::-webkit-scrollbar {
        display: none;
    }

    /* Cursor states for drag scrolling */
    .cursor-grabbing {
        cursor: grabbing;
    }

    /* Video card hover effects */
    .group {
        transition: all 0.3s ease;
    }

    .group:hover {
        transform: translateY(-2px);
    }

    /* Navigation button hover effects */
    #videoPrev, #videoNext {
        transition: all 0.3s ease;
    }

    #videoPrev:hover, #videoNext:hover {
        transform: scale(1.1);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    /* PENTING: Pastikan modal bisa scroll tapi background tidak */
    .modal-open {
        overflow: hidden;
        padding-right: 15px; /* Kompensasi scrollbar yang hilang */
    }

    .modal-open .modal-content {
        overflow-y: auto;
    }

    /* Video modal responsive adjustments */
    @media (max-width: 768px) {
        #videoModalContent {
            margin: 1rem;
            max-height: calc(100vh - 2rem);
        }

        #videoModal .p-6 {
            padding: 1rem;
        }
    }

    /* Video thumbnail loading state */
    .video-thumbnail {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }

    /* Enhanced play button */
    .play-button {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .play-button:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.2);
    }

    /* Video modal overlay */
    #videoModal.flex {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* YouTube iframe responsive container */
    .youtube-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 */
        height: 0;
        overflow: hidden;
    }

    .youtube-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

<script>
    // Video Section JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Video Modal Elements
        const videoModal = document.getElementById('videoModal');
        const closeVideoModal = document.getElementById('closeVideoModal');
        const youtubePlayer = document.getElementById('youtubePlayer');

        // Video Description Modal Elements
        const descriptionModal = document.getElementById('videoDescriptionModal');
        const hoverVideoTitle = document.getElementById('hoverVideoTitle');
        const hoverVideoDescription = document.getElementById('hoverVideoDescription');
        const hoverVideoDate = document.getElementById('hoverVideoDate');

        // Global function to open video modal
        window.openVideoModal = function(videoId, title, description, date = '', dbVideoId = null) {
            if (!videoId) return;

            const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
            youtubePlayer.src = embedUrl;

            videoModal.classList.remove('hidden');
            videoModal.classList.add('flex');
        };

        // Close video modal
        function closeModal() {
            youtubePlayer.src = '';
            videoModal.classList.add('hidden');
            videoModal.classList.remove('flex');
        }

        if (closeVideoModal) {
            closeVideoModal.addEventListener('click', closeModal);
        }

        // Close when clicking outside
        videoModal.addEventListener('click', function(e) {
            if (e.target === videoModal) {
                closeModal();
            }
        });

        // Video card hover functionality
        const videoCards = document.querySelectorAll('.video-card');

        videoCards.forEach(card => {
            let hoverTimer;

            card.addEventListener('mouseenter', function(e) {
                const title = this.dataset.title;
                const description = this.dataset.description;
                const date = this.dataset.date;

                // Clear any existing timer
                clearTimeout(hoverTimer);

                // Set modal content
                hoverVideoTitle.textContent = title;
                hoverVideoDescription.textContent = description || 'Tidak ada deskripsi tersedia';
                hoverVideoDate.textContent = date;

                // Position modal
                const rect = this.getBoundingClientRect();
                const modalWidth = 320; // max-w-sm = ~320px
                const modalHeight = 150; // approximate height

                let left = rect.right + 10; // 10px gap from card
                let top = rect.top + (rect.height / 2) - (modalHeight / 2);

                // Check if modal goes off screen horizontally
                if (left + modalWidth > window.innerWidth - 20) {
                    left = rect.left - modalWidth - 10; // Show on left side
                }

                // Check if modal goes off screen vertically
                if (top < 20) {
                    top = 20;
                } else if (top + modalHeight > window.innerHeight - 20) {
                    top = window.innerHeight - modalHeight - 20;
                }

                descriptionModal.style.left = left + 'px';
                descriptionModal.style.top = top + 'px';

                // Show modal with delay
                hoverTimer = setTimeout(() => {
                    descriptionModal.classList.remove('hidden');
                    descriptionModal.classList.add('show');
                }, 500); // 500ms delay
            });

            card.addEventListener('mouseleave', function() {
                clearTimeout(hoverTimer);
                descriptionModal.classList.add('hidden');
                descriptionModal.classList.remove('show');
            });
        });

        // Hide description modal when scrolling
        window.addEventListener('scroll', function() {
            descriptionModal.classList.add('hidden');
            descriptionModal.classList.remove('show');
        });

        // Video carousel setup
        setupVideoCarousel();

        function setupVideoCarousel() {
            const videoCarousel = document.getElementById('videoCarousel');
            const videoPrev = document.getElementById('videoPrev');
            const videoNext = document.getElementById('videoNext');

            if (!videoCarousel || !videoPrev || !videoNext) {
                console.error('Video carousel elements not found');
                return;
            }

            // Calculate scroll amount based on visible items
            function getVideoScrollAmount() {
                const itemWidth = videoCarousel.children[0]?.offsetWidth || 300;

                if (window.innerWidth < 640) {
                    return itemWidth;
                } else if (window.innerWidth < 1024) {
                    return itemWidth * 2;
                } else {
                    return itemWidth * 3;
                }
            }

            // Navigation buttons
            videoNext.addEventListener('click', function() {
                videoCarousel.scrollBy({
                    left: getVideoScrollAmount(),
                    behavior: 'smooth'
                });
            });

            videoPrev.addEventListener('click', function() {
                videoCarousel.scrollBy({
                    left: -getVideoScrollAmount(),
                    behavior: 'smooth'
                });
            });

            // Show/hide buttons based on scroll position
            function updateVideoButtonVisibility() {
                const isScrollable = videoCarousel.scrollWidth > videoCarousel.clientWidth;

                if (!isScrollable) {
                    videoPrev.style.display = 'none';
                    videoNext.style.display = 'none';
                    return;
                }

                const isAtStart = videoCarousel.scrollLeft <= 1;
                const isAtEnd = videoCarousel.scrollLeft + videoCarousel.clientWidth >= videoCarousel.scrollWidth - 1;

                videoPrev.style.display = isAtStart ? 'none' : 'block';
                videoNext.style.display = isAtEnd ? 'none' : 'block';
            }

            // Add scroll event listener
            videoCarousel.addEventListener('scroll', updateVideoButtonVisibility);
            window.addEventListener('resize', updateVideoButtonVisibility);

            // Initial visibility check
            updateVideoButtonVisibility();

            // Touch/drag support for video carousel
            let isDown = false;
            let startX;
            let scrollLeft;

            videoCarousel.addEventListener('mousedown', function(e) {
                isDown = true;
                videoCarousel.classList.add('cursor-grabbing');
                startX = e.pageX - videoCarousel.offsetLeft;
                scrollLeft = videoCarousel.scrollLeft;
                e.preventDefault();
            });

            videoCarousel.addEventListener('mouseleave', function() {
                isDown = false;
                videoCarousel.classList.remove('cursor-grabbing');
            });

            videoCarousel.addEventListener('mouseup', function() {
                isDown = false;
                videoCarousel.classList.remove('cursor-grabbing');
            });

            videoCarousel.addEventListener('mousemove', function(e) {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - videoCarousel.offsetLeft;
                const walk = (x - startX);
                videoCarousel.scrollLeft = scrollLeft - walk;
            });

            // Touch events
            videoCarousel.addEventListener('touchstart', function(e) {
                isDown = true;
                startX = e.touches[0].pageX - videoCarousel.offsetLeft;
                scrollLeft = videoCarousel.scrollLeft;
            });

            videoCarousel.addEventListener('touchend', function() {
                isDown = false;
            });

            videoCarousel.addEventListener('touchmove', function(e) {
                if (!isDown) return;
                const x = e.touches[0].pageX - videoCarousel.offsetLeft;
                const walk = (x - startX);
                videoCarousel.scrollLeft = scrollLeft - walk;
            });
        }
    });
</script>
