<!-- Enhanced 3D Carousel without Progress Indicator -->
<div class="relative w-full overflow-hidden bg-white h-screen flex flex-col" data-carousel="agroindustry">
    <div class="container mx-auto px-4 flex-grow flex items-center justify-center">
        <!-- 3D Carousel container - made larger -->
        <div class="relative h-[600px] w-full overflow-visible">
            <!-- Carousel items container -->
            <div class="carousel-container relative h-full w-full flex items-center justify-center">
                @foreach($categories as $index => $category)
                <div class="carousel-item absolute transition-all duration-700 ease-in-out"
                    data-index="{{ $index }}"
                    data-slug="{{ $category['slug'] ?? '' }}"
                    data-available="{{ $category['slug'] === 'hidroponik' ? 'true' : 'false' }}">
                    <!-- Main content will be positioned in JS -->
                    <div class="relative overflow-hidden rounded-lg shadow-xl transform transition-all duration-700">
                        <img
                            src="{{ asset('images/categories/' . ($category['image'] ?? '')) }}"
                            alt="{{ $category['name'] ?? '' }}"
                            class="object-cover"
                        />
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-green-900/60 via-green-800/40 to-transparent p-4 text-white">
                            <h3 class="text-2xl font-bold">{{ $category['name'] ?? '' }}</h3>
                            <p class="mt-2 flex items-center text-green-100">
                                Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation arrows with green circles and white arrows -->
            <button type="button" class="carousel-prev absolute left-4 top-1/2 -translate-y-1/2 cursor-pointer transition-all z-20">
                <div class="relative w-10 h-10 bg-green-600 hover:bg-green-700 rounded-full shadow-lg">
                    <span class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-white">&lt;</span>
                </div>
            </button>
            <button type="button" class="carousel-next absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer transition-all z-20">
                <div class="relative w-10 h-10 bg-green-600 hover:bg-green-700 rounded-full shadow-lg">
                    <span class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-white">&gt;</span>
                </div>
            </button>

            <!-- Indicators -->
            <div class="absolute -bottom-4 left-0 right-0 flex justify-center space-x-2 py-4 z-20">
                @foreach($categories as $index => $category)
                <button type="button" class="carousel-indicator h-2 w-8 rounded-full transition-all hover:cursor-pointer"
                    data-index="{{ $index }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Toast notification system for unavailable categories -->
<div id="categoryNotification" class="fixed top-20 right-0 z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="bg-white rounded-l-lg shadow-lg p-4 border-l-4 border-green-600 flex items-center">
        <div class="text-green-600 mr-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h3 class="font-bold text-gray-800" id="notificationTitle">Info</h3>
            <p class="text-sm text-gray-600" id="notificationMessage">Fitur ini belum tersedia saat ini</p>
        </div>
        <button class="ml-4 text-gray-500 hover:text-gray-700" onclick="hideNotification()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize each carousel on the page
    document.querySelectorAll('[data-carousel]').forEach(carousel => {
        const container = carousel.querySelector('.carousel-container');
        const items = carousel.querySelectorAll('.carousel-item');
        const indicators = carousel.querySelectorAll('.carousel-indicator');
        const prevBtn = carousel.querySelector('.carousel-prev');
        const nextBtn = carousel.querySelector('.carousel-next');

        const totalItems = items.length;
        let currentIndex = 0;
        let isAnimating = false;

        // Auto-advance timer settings
        const autoAdvanceDelay = 6000; // 6 seconds between slides
        let autoAdvanceTimer = null;

        // Set initial positions
        function initCarousel() {
            items.forEach((item, index) => {
                // Set initial dimensions for the items
                const img = item.querySelector('img');
                const cardDiv = item.querySelector('div');

                // Ensure all cards have overflow hidden
                cardDiv.style.overflow = 'hidden';

                // Main active item dimensions
                if (index === currentIndex) {
                    img.style.width = '400px';
                    img.style.height = '500px';
                } else {
                    img.style.width = '250px';
                    img.style.height = '350px';
                }
            });

            // Calculate position
            positionItems();

            // Set initial indicator states
            updateIndicators();

            // Start auto-advance timer
            startAutoAdvance();
        }

        // Position items in a carousel with side previews
        function positionItems() {
            // Reset all items first - make sure all items are not visible first
            items.forEach(item => {
                item.style.opacity = '0';
                item.style.zIndex = '0';
                item.style.transform = 'scale(0.5)';
                // Add overflow hidden to prevent card parts from being visible behind
                item.querySelector('div').style.overflow = 'hidden';
                item.style.filter = 'brightness(1)';
            });

            // Calculate indices for all visible positions
            const mainIndex = currentIndex;
            const leftIndex1 = (currentIndex - 1 + totalItems) % totalItems;
            const leftIndex2 = (currentIndex - 2 + totalItems) % totalItems;
            const rightIndex1 = (currentIndex + 1) % totalItems;
            const rightIndex2 = (currentIndex + 2) % totalItems;

            // Position elements from back to front to ensure proper stacking

            // 1. Position rearmost cards first (lowest z-index)
            // Position second item to the right (even smaller, more dimmed)
            const rightItem2 = items[rightIndex2];
            const rightImg2 = rightItem2.querySelector('img');
            rightItem2.style.left = '80%';  // Adjusted for overlap
            rightItem2.style.transform = 'translateX(-50%) scale(0.7)';
            rightItem2.style.zIndex = '10'; // Lowest z-index
            rightItem2.style.opacity = '0.4';
            rightItem2.style.filter = 'brightness(0.6)';
            rightImg2.style.width = '230px';
            rightImg2.style.height = '330px';

            // Position second item to the left (even smaller, more dimmed)
            const leftItem2 = items[leftIndex2];
            const leftImg2 = leftItem2.querySelector('img');
            leftItem2.style.left = '20%';  // Adjusted for overlap
            leftItem2.style.transform = 'translateX(-50%) scale(0.7)';
            leftItem2.style.zIndex = '10'; // Lowest z-index
            leftItem2.style.opacity = '0.4';
            leftItem2.style.filter = 'brightness(0.6)';
            leftImg2.style.width = '230px';
            leftImg2.style.height = '330px';

            // 2. Position middle secondary cards (medium z-index)
            // Position first item to the right (slightly smaller, dimmed)
            const rightItem1 = items[rightIndex1];
            const rightImg1 = rightItem1.querySelector('img');
            rightItem1.style.left = '68%';
            rightItem1.style.transform = 'translateX(-50%) scale(0.85)';
            rightItem1.style.zIndex = '20'; // Medium z-index
            rightItem1.style.opacity = '0.7';
            rightItem1.style.filter = 'brightness(0.7)';
            rightImg1.style.width = '280px';
            rightImg1.style.height = '380px';

            // Position first item to the left (slightly smaller, dimmed)
            const leftItem1 = items[leftIndex1];
            const leftImg1 = leftItem1.querySelector('img');
            leftItem1.style.left = '32%';
            leftItem1.style.transform = 'translateX(-50%) scale(0.85)';
            leftItem1.style.zIndex = '20'; // Medium z-index
            leftItem1.style.opacity = '0.7';
            leftItem1.style.filter = 'brightness(0.7)';
            leftImg1.style.width = '280px';
            leftImg1.style.height = '380px';

            // 3. Position center card (highest z-index)
            // Position main item (center, full size)
            const mainItem = items[mainIndex];
            const mainImg = mainItem.querySelector('img');
            mainItem.style.left = '50%';
            mainItem.style.transform = 'translateX(-50%) scale(1)';
            mainItem.style.zIndex = '30'; // Highest z-index
            mainItem.style.opacity = '1';
            mainImg.style.width = '400px';
            mainImg.style.height = '500px';

            // Additional: Clearer shadow effect to define card boundaries
            items.forEach(item => {
                const cardDiv = item.querySelector('div');
                cardDiv.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.3)';

                // Add transparent overlay on sides to ensure front card covers it
                if (item !== mainItem) {
                    // Remove any existing overlay first
                    const existingOverlay = cardDiv.querySelector('.card-overlay');
                    if (existingOverlay) {
                        existingOverlay.remove();
                    }

                    const overlay = document.createElement('div');
                    overlay.style.position = 'absolute';
                    overlay.style.top = '0';
                    overlay.style.left = '0';
                    overlay.style.right = '0';
                    overlay.style.bottom = '0';
                    overlay.style.background = 'rgba(0,0,0,0.05)';
                    overlay.style.zIndex = '5';
                    overlay.classList.add('card-overlay');
                    cardDiv.appendChild(overlay);
                }
            });

            // Additional: Set wider width for center item
            // and ensure other items are properly cropped
            mainItem.style.width = '400px';
            leftItem1.style.width = '280px';
            rightItem1.style.width = '280px';
            leftItem2.style.width = '230px';
            rightItem2.style.width = '230px';

            // Set proper spacing between cards
            const spacing = 5; // Spacing in pixels
            rightItem1.style.left = `calc(50% + ${200 + spacing}px)`;
            leftItem1.style.left = `calc(50% - ${200 + spacing}px)`;
            rightItem2.style.left = `calc(50% + ${340 + spacing*2}px)`;
            leftItem2.style.left = `calc(50% - ${340 + spacing*2}px)`;
        }

        // Update indicators
        function updateIndicators() {
            indicators.forEach((indicator, index) => {
                if (index === currentIndex) {
                    indicator.classList.add('bg-green-600', 'w-10');
                    indicator.classList.remove('bg-gray-400');
                } else {
                    indicator.classList.add('bg-gray-400');
                    indicator.classList.remove('bg-green-600', 'w-10');
                }
            });
        }

        // Start auto-advance timer
        function startAutoAdvance() {
            // Clear any existing timer
            if (autoAdvanceTimer) {
                clearTimeout(autoAdvanceTimer);
            }

            // Set timer for auto-advance
            autoAdvanceTimer = setTimeout(() => {
                if (!isAnimating) {
                    updateCarousel(currentIndex + 1);
                }
            }, autoAdvanceDelay);
        }

        // Update the carousel display
        function updateCarousel(newIndex) {
            if (isAnimating) return;
            isAnimating = true;

            // Cancel current auto-advance timer
            if (autoAdvanceTimer) {
                clearTimeout(autoAdvanceTimer);
                autoAdvanceTimer = null;
            }

            currentIndex = (newIndex + totalItems) % totalItems;

            // Reposition all items
            positionItems();

            // Update indicators
            updateIndicators();

            // Start new auto-advance timer
            startAutoAdvance();

            // Reset animation lock after transition
            setTimeout(() => {
                isAnimating = false;
            }, 700);
        }

        // Set up navigation buttons
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                updateCarousel(currentIndex - 1);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                updateCarousel(currentIndex + 1);
            });
        }

        // Set up indicators
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                updateCarousel(index);
            });
        });

        // Enable keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                updateCarousel(currentIndex - 1);
            } else if (e.key === 'ArrowRight') {
                updateCarousel(currentIndex + 1);
            }
        });

        // Touch swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchStartX - touchEndX > 50) {
                // Swipe left
                updateCarousel(currentIndex + 1);
            } else if (touchEndX - touchStartX > 50) {
                // Swipe right
                updateCarousel(currentIndex - 1);
            }
        }

        function stopAutoAdvance() {
            // Clear any existing timer
            if (autoAdvanceTimer) {
                clearTimeout(autoAdvanceTimer);
                autoAdvanceTimer = null;
            }
        }

        function resumeAutoAdvance() {
            // Start a new timer
            startAutoAdvance();
        }

        // Pause auto-advance on hover or touch
        carousel.addEventListener('mouseenter', stopAutoAdvance);
        carousel.addEventListener('touchstart', stopAutoAdvance);

        // Resume auto-advance when mouse leaves
        carousel.addEventListener('mouseleave', resumeAutoAdvance);
        carousel.addEventListener('touchend', () => {
            setTimeout(resumeAutoAdvance, 1000);
        });

        // Make carousel items clickable to navigate to their pages
        items.forEach((item, index) => {
            item.addEventListener('click', () => {
                if (index === currentIndex) {
                    const slug = item.dataset.slug;
                    const isAvailable = item.dataset.available === 'true';

                    if (slug) {
                        if (isAvailable) {
                            // Direct to the category page for available categories
                            window.location.href = `/${slug}`;
                        } else {
                            // Show notification for unavailable categories
                            showNotification(
                                `Fitur ${item.querySelector('h3').textContent} Belum Tersedia`,
                                "Mohon maaf, fitur ini masih dalam pengembangan dan akan segera hadir."
                            );
                        }
                    }
                } else {
                    updateCarousel(index);
                }
            });

            // Add cursor pointer to indicate clickable
            item.classList.add('cursor-pointer');
        });

        // Initialize and start auto-advance
        initCarousel();
        updateCarousel(0);
        startAutoAdvance();
    });
});

// Notification functions
function showNotification(title, message) {
    const notification = document.getElementById('categoryNotification');
    document.getElementById('notificationTitle').textContent = title;
    document.getElementById('notificationMessage').textContent = message;

    // Show notification
    notification.classList.remove('translate-x-full');
    notification.classList.add('translate-x-0');

    // Auto hide after 5 seconds
    setTimeout(hideNotification, 5000);
}

function hideNotification() {
    const notification = document.getElementById('categoryNotification');
    notification.classList.remove('translate-x-0');
    notification.classList.add('translate-x-full');
}
</script>
