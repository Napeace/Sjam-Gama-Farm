<div class="sticky top-0 z-50 bg-green-900 text-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-3">
            <!-- Logo and Brand -->
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 rounded-full">
                <span class="font-semibold text-lg">SJAM GAMA FARM</span>
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#produk-section" class="hover:text-green-300 transition duration-200 font-medium">Produk</a>
                <a href="#video-section" class="hover:text-green-300 transition duration-200 font-medium">Video</a>
                <a href="#pelatihan-section" class="hover:text-green-300 transition duration-200 font-medium">Pelatihan</a>
                <a href="#artikel-section" class="hover:text-green-300 transition duration-200 font-medium">Artikel</a>
                <a href="#review-section" class="hover:text-green-300 transition duration-200 font-medium">Review</a>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden pb-4">
            <div class="flex flex-col space-y-3">
                <a href="#produk-section" class="hover:text-green-300 transition duration-200 py-2">Produk</a>
                <a href="#video-section" class="hover:text-green-300 transition duration-200 py-2">Video</a>
                <a href="#pelatihan-section" class="hover:text-green-300 transition duration-200 py-2">Pelatihan</a>
                <a href="#artikel-section" class="hover:text-green-300 transition duration-200 py-2">Artikel</a>
                <a href="#review-section" class="hover:text-green-300 transition duration-200 py-2">Review</a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Mobile Menu Toggle and Smooth Scrolling -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Smooth scrolling for all navigation links
        const navLinks = document.querySelectorAll('a[href^="#"]');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }

                const targetId = this.getAttribute('href');

                // Only process if the href is a section ID
                if (targetId.startsWith('#') && targetId.length > 1) {
                    e.preventDefault();

                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        // Scroll with offset for the sticky header
                        const headerOffset = 80;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    });
</script>
