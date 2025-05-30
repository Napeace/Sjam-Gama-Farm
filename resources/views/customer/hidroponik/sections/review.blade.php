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

<style>
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
        const reviewsData = @json($reviews ?? []);

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

                // Show navigation buttons and update their visibility
                showNavigationButtons();
                updateNavigationButtons();
            }
        }

        // Close modal with animation
        function closeModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            // Hide navigation buttons immediately when closing
            hideNavigationButtons();

            // Wait for animation to complete before hiding modal
            setTimeout(() => {
                reviewModal.classList.add('hidden');
                reviewModal.classList.remove('flex');
            }, 300);
        }

        // Show navigation buttons
        function showNavigationButtons() {
            // Only show if there are multiple reviews
            if (reviewsData.length > 1) {
                prevReviewBtn.classList.remove('hidden');
                nextReviewBtn.classList.remove('hidden');
            }
        }

        // Hide navigation buttons
        function hideNavigationButtons() {
            prevReviewBtn.classList.add('hidden');
            nextReviewBtn.classList.add('hidden');
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

        // Update navigation buttons visibility based on current position
        function updateNavigationButtons() {
            // Only show buttons if modal is open and there are multiple reviews
            if (reviewModal.classList.contains('hidden') || reviewsData.length <= 1) {
                hideNavigationButtons();
                return;
            }

            // Show both buttons first
            showNavigationButtons();

            // Hide specific buttons based on position
            if (currentReviewIndex === 0) {
                prevReviewBtn.classList.add('hidden');
            }

            if (currentReviewIndex === reviewsData.length - 1) {
                nextReviewBtn.classList.add('hidden');
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

        // Ensure navigation buttons are hidden on page load
        hideNavigationButtons();
    });
</script>
