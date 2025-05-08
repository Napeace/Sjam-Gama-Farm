{{-- Simplified Enhanced Navbar for SJAM GAMA FARM --}}
<nav class="sticky top-0 z-50 transition-all duration-300" id="main-navbar">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between">
            {{-- Logo and Brand with enhanced styling --}}
            <div class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-green-600 to-green-300 rounded-full opacity-0 group-hover:opacity-75 blur transition duration-500"></div>
                    <div class="relative">
                        <img src="/images/logo.png" alt="Logo" class="h-10 w-10 rounded-full border-2 border-white shadow-md transform transition duration-300 group-hover:scale-110">
                    </div>
                </div>
                <h1 class="text-white font-bold text-xl tracking-wider group-hover:text-green-200 transition-colors duration-300">SJAM GAMA FARM</h1>
            </div>

            {{-- Optional subtle animation effect on the right side --}}
            <div class="hidden md:flex">
                <div class="w-8 h-8 flex items-center justify-center relative overflow-hidden">
                    <span class="leaf-animation absolute"></span>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- Add this CSS to your global styles or in your <style> section --}}
<style>
    /* Navbar Styles */
    #main-navbar {
        background-color: rgba(22, 101, 52, 0.95); /* green-800 with opacity */
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    #main-navbar.scrolled {
        background-color: rgba(22, 101, 52, 0.98);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Leaf animation */
    .leaf-animation {
        width: 12px;
        height: 12px;
        background-color: rgba(255, 255, 255, 0.1);
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        animation: rotate 3s linear infinite;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg) scale(0.8);
            opacity: 0.5;
        }
        50% {
            transform: rotate(180deg) scale(1.2);
            opacity: 1;
        }
        100% {
            transform: rotate(360deg) scale(0.8);
            opacity: 0.5;
        }
    }
</style>

{{-- Add this JavaScript to your existing script section --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Navbar scroll effect
        const navbar = document.getElementById('main-navbar');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    });
</script>
