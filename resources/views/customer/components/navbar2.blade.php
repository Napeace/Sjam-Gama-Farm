<div class="sticky top-0 z-50 bg-green-900 text-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-3">
            <!-- Logo and Brand -->
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 rounded-full">
                <span class="font-semibold text-lg">SJAM GAMA FARM</span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#produk-section" class="hover:text-green-300 transition duration-200 font-medium">Produk</a>
                <a href="#video-section" class="hover:text-green-300 transition duration-200 font-medium">Video</a>
                <a href="#pelatihan-section" class="hover:text-green-300 transition duration-200 font-medium">Pelatihan</a>
                <a href="#artikel-section" class="hover:text-green-300 transition duration-200 font-medium">Artikel</a>
                <a href="#review-section" class="hover:text-green-300 transition duration-200 font-medium">Review</a>

                <!-- Notification Bell -->
                <div class="relative" x-data="notificationSystem" @click.away="showNotifs = false; showPermissionPrompt = false">
                    <button @click="handleBellClick()" class="relative focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span x-show="notifCount > 0" x-text="notifCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"></span>
                    </button>

                    <!-- Permission Prompt Dropdown -->
                    <div x-show="showPermissionPrompt" class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg text-gray-800 z-50">
                        <div class="p-4">
                            <h3 class="font-medium text-gray-800 mb-2">Info Terbaru SJAM GAMA FARM</h3>
                            <p class="text-sm text-gray-600 mb-3">Aktifkan notifikasi untuk mendapatkan update terbaru seputar produk hidroponik dan peternakan.</p>
                            <div class="flex space-x-2">
                                <button @click="allowNotifications()" class="px-3 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition duration-200">
                                    Aktifkan
                                </button>
                                <button @click="denyNotifications()" class="px-3 py-2 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300 transition duration-200">
                                    Nanti saja
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Notification dropdown -->
                    <div x-show="showNotifs" class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg text-gray-800 z-50 max-h-96 overflow-y-auto">
                        <div class="p-3 border-b flex justify-between items-center">
                            <h3 class="font-medium">Notifikasi</h3>
                            <button @click="markAllAsRead()" class="text-sm text-green-600 hover:text-green-800" x-show="notifCount > 0">
                                Tandai semua dibaca
                            </button>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <template x-if="notifications.length === 0">
                                <div class="p-4 text-center text-gray-500">
                                    Tidak ada notifikasi
                                </div>
                            </template>
                            <template x-for="notification in notifications" :key="notification.id">
                                <div @click="openNotification(notification)" :class="{'bg-green-50': !notification.is_read}" class="p-3 hover:bg-gray-50 cursor-pointer">
                                    <div class="flex items-start">
                                        <div x-show="notification.image_url" class="flex-shrink-0 mr-3">
                                            <img :src="notification.image_url" class="h-10 w-10 rounded-md object-cover" alt="Notification Image">
                                        </div>
                                        <div class="flex-grow">
                                            <div class="font-medium" x-text="notification.title"></div>
                                            <div class="text-sm text-gray-600 line-clamp-2" x-text="notification.message"></div>
                                            <div class="text-xs text-gray-500 mt-1" x-text="formatDate(notification.created_at)"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Mobile Menu Button with Notification -->
            <div class="md:hidden flex items-center space-x-4">
                <!-- Mobile Notification Bell -->
                <div class="relative" x-data="notificationSystem" @click.away="showNotifs = false">
                    <button @click="showNotifs = !showNotifs" class="relative focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span x-show="notifCount > 0" x-text="notifCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"></span>
                    </button>

                    <!-- Mobile Notification dropdown -->
                    <div x-show="showNotifs" class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg text-gray-800 z-50 max-h-96 overflow-y-auto">
                        <div class="p-3 border-b flex justify-between items-center">
                            <h3 class="font-medium">Notifikasi</h3>
                            <button @click="markAllAsRead()" class="text-sm text-green-600 hover:text-green-800" x-show="notifCount > 0">
                                Tandai semua dibaca
                            </button>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <template x-if="notifications.length === 0">
                                <div class="p-4 text-center text-gray-500">
                                    Tidak ada notifikasi
                                </div>
                            </template>
                            <template x-for="notification in notifications" :key="notification.id">
                                <div @click="openNotification(notification)" :class="{'bg-green-50': !notification.is_read}" class="p-3 hover:bg-gray-50 cursor-pointer">
                                    <div class="flex items-start">
                                        <div x-show="notification.image_url" class="flex-shrink-0 mr-3">
                                            <img :src="notification.image_url" class="h-10 w-10 rounded-md object-cover" alt="Notification Image">
                                        </div>
                                        <div class="flex-grow">
                                            <div class="font-medium" x-text="notification.title"></div>
                                            <div class="text-sm text-gray-600 line-clamp-2" x-text="notification.message"></div>
                                            <div class="text-xs text-gray-500 mt-1" x-text="formatDate(notification.created_at)"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

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
                        const headerOffset = 50;
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
