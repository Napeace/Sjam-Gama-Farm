{{-- Carousel Script --}}
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
</script>
