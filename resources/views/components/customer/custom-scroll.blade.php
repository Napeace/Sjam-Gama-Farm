<!-- resources/views/components/customer/custom-scroll.blade.php -->
<div id="customScrollbar" class="fixed right-4 top-1/2 transform -translate-y-1/2 z-50 opacity-100 transition-opacity duration-300">
    <div class="flex flex-col items-center">
        <div class="w-1 h-32 bg-black/10 hover:bg-black/20 rounded-full relative cursor-pointer group" id="scrollTrack">
            <div class="absolute w-2 h-6 bg-black/30 group-hover:bg-black/40 rounded-full -left-0.5 transform -translate-x-0 transition-all" id="scrollThumb"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollbar = document.getElementById('customScrollbar');
        const scrollThumb = document.getElementById('scrollThumb');
        const scrollTrack = document.getElementById('scrollTrack');

        // Update scroll thumb position immediately on page load
        updateScrollThumbPosition();

        // Update scroll thumb position when scrolling
        window.addEventListener('scroll', function() {
            updateScrollThumbPosition();
        });

        function updateScrollThumbPosition() {
            const scrollPercentage = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);
            const trackHeight = scrollTrack.offsetHeight;
            const thumbHeight = scrollThumb.offsetHeight;
            const thumbPosition = (trackHeight - thumbHeight) * scrollPercentage;

            scrollThumb.style.top = thumbPosition + 'px';
        }

        // Add scroll track functionality
        scrollTrack.addEventListener('click', function(e) {
            const trackRect = scrollTrack.getBoundingClientRect();
            const clickPositionInTrack = e.clientY - trackRect.top;
            const trackHeight = scrollTrack.offsetHeight;

            const scrollPercentage = clickPositionInTrack / trackHeight;
            const scrollTo = scrollPercentage * (document.documentElement.scrollHeight - window.innerHeight);

            window.scrollTo({
                top: scrollTo,
                behavior: 'smooth'
            });
        });

        // Add drag functionality for thumb
        let isDragging = false;
        let startY = 0;
        let startScroll = 0;

        scrollThumb.addEventListener('mousedown', function(e) {
            isDragging = true;
            startY = e.clientY;
            startScroll = window.scrollY;
            document.body.classList.add('select-none'); // Prevent text selection while dragging
            e.preventDefault(); // Prevent default drag behavior
        });

        document.addEventListener('mousemove', function(e) {
            if (!isDragging) return;

            const deltaY = e.clientY - startY;
            const trackHeight = scrollTrack.offsetHeight;
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;

            const scrollAmount = (deltaY / trackHeight) * scrollHeight;
            window.scrollTo(0, startScroll + scrollAmount);
        });

        document.addEventListener('mouseup', function() {
            isDragging = false;
            document.body.classList.remove('select-none');
        });

        // Optional: Auto-hide feature after inactivity
        let timeout;
        function resetTimeout() {
            clearTimeout(timeout);
            scrollbar.classList.remove('opacity-0');
            scrollbar.classList.add('opacity-100');

            // Comment out the following lines if you want the scrollbar to always stay visible
            timeout = setTimeout(() => {
                scrollbar.classList.remove('opacity-100');
                scrollbar.classList.add('opacity-0');
            }, 3000);
        }

        window.addEventListener('scroll', resetTimeout);
        window.addEventListener('mousemove', resetTimeout);

        // Make scrollbar visible on page load
        resetTimeout();
    });
</script>
