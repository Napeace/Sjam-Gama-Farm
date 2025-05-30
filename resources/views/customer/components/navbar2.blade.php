<!-- Updated navbar.blade.php -->
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

                <!-- Notification Bell - Desktop -->
                <div x-data="notificationSystem" class="relative">
                    <button @click="handleBellClick()"
                            class="relative focus:outline-none hover:text-green-300 transition duration-200 p-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <!-- Notification badge -->
                        <span x-show="notifCount > 0"
                              x-text="notifCount"
                              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center min-w-5"></span>
                    </button>

                    <!-- Permission Prompt Dropdown -->
                    <div x-show="showPermissionPrompt"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="showPermissionPrompt = false"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg text-gray-800 z-50 border border-gray-200">
                        <div class="p-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="p-2 bg-green-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-800">Info Terbaru SJAM GAMA FARM</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-4">Aktifkan notifikasi untuk mendapatkan update terbaru seputar produk hidroponik, peternakan, dan artikel menarik lainnya.</p>
                            <div class="flex gap-2">
                                <button @click="allowNotifications()"
                                        class="cursor-pointer flex-1 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition duration-200">
                                    Ya, Aktifkan
                                </button>
                                <button @click="denyNotifications()"
                                        class="cursor-pointer flex-1 px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition duration-200">
                                    Nanti Saja
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Notification dropdown -->
                    <div x-show="showNotifs"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="showNotifs = false"
                         class="absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-lg text-gray-800 z-50 max-h-96 overflow-hidden border border-gray-200">

                        <!-- Header -->
                        <div class="p-4 border-b border-gray-100 bg-gray-50">
                            <div class="flex justify-between items-center">
                                <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                                <div class="flex items-center space-x-2">
                                    <button x-show="notifCount > 0"
                                            @click="markAllAsRead()"
                                            class="cursor-pointer text-sm text-green-600 hover:text-green-800 font-medium">
                                        Tandai semua dibaca
                                    </button>
                                    <button x-show="notifications.length > 0"
                                            @click="deleteAllNotifications()"
                                            class="cursor-pointer text-sm text-red-600 hover:text-red-800 font-medium">
                                        Hapus semua
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications List -->
                        <div class="max-h-80 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 hover:scrollbar-thumb-gray-400">
                            <template x-if="notifications.length === 0">
                                <div class="p-8 text-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <p>Tidak ada notifikasi</p>
                                </div>
                            </template>

                            <template x-for="notification in notifications" :key="notification.id">
                                <div class="border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition duration-150"
                                     :class="{'bg-green-50': !notification.is_read}">
                                    <div class="p-4 flex items-start gap-3 relative">
                                        <!-- Image or Icon -->
                                        <div class="flex-shrink-0">
                                            <img x-show="notification.image_url"
                                                 :src="notification.image_url"
                                                 class="h-12 w-12 rounded-lg object-cover"
                                                 alt="Notification Image">
                                            <div x-show="!notification.image_url"
                                                 class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-grow cursor-pointer" @click="openNotification(notification)">
                                            <div class="font-medium text-gray-800" x-text="notification.title"></div>
                                            <div class="text-sm text-gray-600 mt-1 line-clamp-2" x-text="notification.message"></div>
                                            <div class="text-xs text-gray-500 mt-2 flex items-center gap-2">
                                                <span x-text="formatDate(notification.created_at)"></span>
                                                <span x-show="!notification.is_read" class="inline-block w-2 h-2 bg-green-500 rounded-full"></span>
                                            </div>
                                        </div>

                                        <!-- Delete button -->
                                        <div class="absolute top-3 right-3">
                                            <button @click="deleteNotification($event, notification.id)"
                                                    class="cursor-pointer text-gray-400 hover:text-red-600 transition-colors duration-200 p-1 rounded-full hover:bg-red-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
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
                <div x-data="notificationSystem" class="relative">
                    <button @click="handleBellClick()"
                            class="relative focus:outline-none hover:text-green-300 transition duration-200 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span x-show="notifCount > 0"
                              x-text="notifCount"
                              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center min-w-5"></span>
                    </button>

                    <!-- Mobile Permission Prompt -->
                    <div x-show="showPermissionPrompt"
                         x-transition
                         @click.away="showPermissionPrompt = false"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg text-gray-800 z-50 border border-gray-200">
                        <div class="p-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="p-2 bg-green-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-800">Info Terbaru</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-4">Aktifkan notifikasi untuk update terbaru dari SJAM GAMA FARM.</p>
                            <div class="flex gap-2">
                                <button @click="allowNotifications()"
                                        class="flex-1 px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition duration-200">
                                    Ya
                                </button>
                                <button @click="denyNotifications()"
                                        class="flex-1 px-3 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition duration-200">
                                    Nanti
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Notifications dropdown -->
                    <div x-show="showNotifs"
                         x-transition
                         @click.away="showNotifs = false"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg text-gray-800 z-50 max-h-96 overflow-hidden border border-gray-200">

                        <!-- Header -->
                        <div class="p-3 border-b border-gray-100 bg-gray-50">
                            <div class="flex justify-between items-center">
                                <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                                <div class="flex items-center space-x-2">
                                    <button x-show="notifCount > 0"
                                            @click="markAllAsRead()"
                                            class="text-xs text-green-600 hover:text-green-800 font-medium">
                                        Tandai dibaca
                                    </button>
                                    <button x-show="notifications.length > 0"
                                            @click="deleteAllNotifications()"
                                            class="text-xs text-red-600 hover:text-red-800 font-medium">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Notifications List -->
                        <div class="max-h-72 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 hover:scrollbar-thumb-gray-400">
                            <template x-if="notifications.length === 0">
                                <div class="p-6 text-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <p class="text-sm">Tidak ada notifikasi</p>
                                </div>
                            </template>

                            <template x-for="notification in notifications" :key="notification.id">
                                <div class="border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition duration-150"
                                     :class="{'bg-green-50': !notification.is_read}">
                                    <div class="p-3 flex items-start gap-3 relative">
                                        <!-- Mobile Image/Icon -->
                                        <div class="flex-shrink-0">
                                            <img x-show="notification.image_url"
                                                 :src="notification.image_url"
                                                 class="h-10 w-10 rounded-lg object-cover"
                                                 alt="Notification">
                                            <div x-show="!notification.image_url"
                                                 class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Mobile Content -->
                                        <div class="flex-grow cursor-pointer" @click="openNotification(notification)">
                                            <div class="font-medium text-gray-800 text-sm" x-text="notification.title"></div>
                                            <div class="text-xs text-gray-600 mt-1 line-clamp-2" x-text="notification.message"></div>
                                            <div class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                                <span x-text="formatDate(notification.created_at)"></span>
                                                <span x-show="!notification.is_read" class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                            </div>
                                        </div>

                                        <!-- Mobile Delete button -->
                                        <div class="absolute top-2 right-2">
                                            <button @click="deleteNotification($event, notification.id)"
                                                    class="text-gray-400 hover:text-red-600 transition-colors duration-200 p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <button id="mobile-menu-button" class="text-white focus:outline-none p-2">
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

<!-- Custom CSS for scrollbar -->
<style>
    /* Custom scrollbar styles */
    .scrollbar-thin {
        scrollbar-width: thin;
    }

    .scrollbar-thumb-gray-300::-webkit-scrollbar-thumb {
        background-color: #d1d5db;
        border-radius: 9999px;
    }

    .scrollbar-track-gray-100::-webkit-scrollbar-track {
        background-color: #f3f4f6;
        border-radius: 9999px;
    }

    .hover\:scrollbar-thumb-gray-400:hover::-webkit-scrollbar-thumb {
        background-color: #9ca3af;
    }

    /* Webkit scrollbar styles */
    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 9999px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 9999px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>

<!-- JavaScript for Mobile Menu Toggle, Smooth Scrolling, and Notification System -->
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
                        const headerOffset = 60;
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

    // Alpine.js Notification System Component
    document.addEventListener('alpine:init', () => {
        Alpine.data('notificationSystem', () => ({
            showPermissionPrompt: false,
            showNotifs: false,
            notifications: [],
            notifCount: 0,
            visitorId: null,

            init() {
                // Generate or get visitor ID
                this.visitorId = this.getOrCreateVisitorId();

                // Check if user has already made permission choice
                const hasPermission = localStorage.getItem('notification_permission');
                if (hasPermission === null) {
                    // User hasn't been asked yet, will show prompt on first bell click
                } else if (hasPermission === 'granted') {
                    // User has granted permission, load notifications
                    this.loadNotifications();
                }

                // Set up periodic refresh for notifications
                setInterval(() => {
                    if (localStorage.getItem('notification_permission') === 'granted') {
                        this.loadNotifications();
                    }
                }, 30000); // Refresh every 30 seconds
            },

            getOrCreateVisitorId() {
                let visitorId = localStorage.getItem('visitor_id');
                if (!visitorId) {
                    visitorId = 'visitor_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
                    localStorage.setItem('visitor_id', visitorId);

                    // Also set as cookie for server-side access
                    document.cookie = `visitor_id=${visitorId}; path=/; max-age=${365*24*60*60}`;
                }
                return visitorId;
            },

            handleBellClick() {
                const hasPermission = localStorage.getItem('notification_permission');

                if (hasPermission === null) {
                    // First time clicking, show permission prompt
                    this.showPermissionPrompt = true;
                    this.showNotifs = false;
                } else if (hasPermission === 'granted') {
                    // User has granted permission, show notifications
                    this.loadNotifications();
                    this.showNotifs = true;
                    this.showPermissionPrompt = false;
                } else {
                    // User denied permission, show prompt again
                    this.showPermissionPrompt = true;
                    this.showNotifs = false;
                }
            },

            allowNotifications() {
                localStorage.setItem('notification_permission', 'granted');
                this.showPermissionPrompt = false;
                this.loadNotifications();
                this.showNotifs = true;
            },

            denyNotifications() {
                localStorage.setItem('notification_permission', 'denied');
                this.showPermissionPrompt = false;
            },

            async loadNotifications() {
                try {
                    const response = await fetch('/notifications', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Visitor-ID': this.visitorId
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        this.notifications = data.notifications || [];
                        this.notifCount = data.unread_count || 0;
                    } else {
                        console.error('Failed to load notifications:', response.status, response.statusText);
                    }
                } catch (error) {
                    console.error('Error loading notifications:', error);
                }
            },

            async markAllAsRead() {
                try {
                    const response = await fetch('/notifications/mark-all-read', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Visitor-ID': this.visitorId
                        }
                    });

                    if (response.ok) {
                        this.notifications.forEach(notif => notif.is_read = true);
                        this.notifCount = 0;
                    } else {
                        console.error('Failed to mark all as read:', response.status);
                    }
                } catch (error) {
                    console.error('Error marking all as read:', error);
                }
            },

            async deleteNotification(event, notificationId) {
                // Prevent event bubbling
                event.stopPropagation();
                event.preventDefault();

                console.log('=== DELETE NOTIFICATION DEBUG ===');
                console.log('Notification ID:', notificationId);
                console.log('Notification ID type:', typeof notificationId);
                console.log('Visitor ID:', this.visitorId);
                console.log('Current URL:', window.location.href);
                console.log('Base URL:', window.location.origin);

                if (!this.visitorId) {
                    console.error('No visitor ID available');
                    alert('Visitor ID tidak ditemukan');
                    return;
                }

                if (!notificationId) {
                    console.error('No notification ID provided');
                    alert('Notification ID tidak valid');
                    return;
                }

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfToken) {
                        console.error('CSRF token not found');
                        alert('CSRF token tidak ditemukan');
                        return;
                    }

                    // Construct the URL
                    const deleteUrl = `${window.location.origin}/notifications/${notificationId}/delete`;
                    console.log('Delete URL:', deleteUrl);

                    const requestHeaders = {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                        'X-Visitor-ID': this.visitorId
                    };

                    console.log('Request headers:', requestHeaders);

                    const response = await fetch(deleteUrl, {
                        method: 'DELETE',
                        headers: requestHeaders
                    });

                    console.log('Response status:', response.status);
                    console.log('Response headers:', Object.fromEntries(response.headers.entries()));

                    if (response.ok) {
                        const result = await response.json();
                        console.log('Delete result:', result);

                        // Remove from local array immediately for better UX
                        const index = this.notifications.findIndex(n => n.id === notificationId);
                        console.log('Found notification at index:', index);

                        if (index > -1) {
                            const notification = this.notifications[index];
                            this.notifications.splice(index, 1);

                            // Update unread count if notification was unread
                            if (!notification.is_read) {
                                this.notifCount = Math.max(0, this.notifCount - 1);
                            }
                        }

                        console.log('Notification deleted successfully from UI');
                    } else {
                        const responseText = await response.text();
                        console.error('Response error text:', responseText);

                        let errorData;
                        try {
                            errorData = JSON.parse(responseText);
                        } catch (e) {
                            errorData = { message: responseText };
                        }

                        console.error('Failed to delete notification:', response.status, errorData);

                        // Show user-friendly error message with more details
                        alert(`Gagal menghapus notifikasi.\nStatus: ${response.status}\nError: ${errorData.message || 'Unknown error'}`);
                    }
                } catch (error) {
                    console.error('Network/JavaScript error:', error);
                    alert(`Terjadi kesalahan jaringan: ${error.message}`);
                }
            },

            async deleteAllNotifications() {
                if (!confirm('Apakah Anda yakin ingin menghapus semua notifikasi?')) {
                    return;
                }

                try {
                    const response = await fetch('/notifications/delete-all', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Visitor-ID': this.visitorId
                        }
                    });

                    if (response.ok) {
                        this.notifications = [];
                        this.notifCount = 0;
                        console.log('All notifications deleted successfully');
                    } else {
                        console.error('Failed to delete all notifications:', response.status);
                        alert('Gagal menghapus semua notifikasi. Silakan coba lagi.');
                    }
                } catch (error) {
                    console.error('Error deleting all notifications:', error);
                    alert('Terjadi kesalahan saat menghapus notifikasi.');
                }
            },

            async openNotification(notification) {
                // Mark as read if not already read
                if (!notification.is_read) {
                    try {
                        const response = await fetch(`/notifications/${notification.id}/mark-read`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'X-Visitor-ID': this.visitorId
                            }
                        });

                        if (response.ok) {
                            notification.is_read = true;
                            this.notifCount = Math.max(0, this.notifCount - 1);
                        }
                    } catch (error) {
                        console.error('Error marking notification as read:', error);
                    }
                }

                // Open link if available
                if (notification.link_url) {
                    window.open(notification.link_url, '_self');
                }

                // Close notification dropdown
                this.showNotifs = false;
            },

            formatDate(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const diffTime = Math.abs(now - date);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // Format waktu lengkap
                const timeString = date.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                if (diffDays === 0) {
                    return `Hari ini, ${timeString}`;
                } else if (diffDays === 1) {
                    return `Kemarin, ${timeString}`;
                } else if (diffDays <= 7) {
                    return `${diffDays - 1} hari lalu, ${timeString}`;
                } else {
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                }
            }
        }));
    });
</script>
