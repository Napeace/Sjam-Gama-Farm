<!-- Sidebar -->
<div id="sidebar" class="bg-white border-r border-gray-300 transition-all duration-300 flex flex-col justify-between py-6 relative" style="width: 240px; overflow: hidden;">
    <button id="sidebarToggle" class="absolute top-4 text-gray-700 p-1.5 rounded-md hover:bg-gray-100 cursor-pointer transition-all duration-200 focus:outline-none z-10 right-4">
        <svg id="hamburgerIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
        </svg>
        <svg id="collapseIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Profile Section -->
    <div class="flex flex-col items-center sidebar-content max-w-full">
        <div class="block relative group">
            <div class="h-16 w-16 rounded-full overflow-hidden mb-2 bg-gray-100 shadow-md transition-all duration-200">
                <img src="{{ asset('images/profile-user.png') }}" alt="Profil" class="object-cover h-full w-full">
            </div>
        </div>

        <p class="text-sm font-semibold text-gray-800 sidebar-text">Admin</p>

        <!-- Link ke Edit Akun - Dengan lebar yang dibatasi -->
        <a href="{{ route('mitra.DataAkun') }}" class="mt-3 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-green-700 text-sm font-medium rounded-lg transition duration-200 flex items-center sidebar-text mx-auto w-48 max-w-[85%]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="truncate">Akun</span>
        </a>

        <hr class="my-4 w-4/5 border-gray-300" />
    </div>

    <!-- Footer Section - Fixed positioning -->
    <div class="footer-section mt-auto">
        <!-- Logout - For expanded state -->
        <form action="{{ route('mitra.logout') }}" method="POST" class="expanded-logout sidebar-content">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-50 hover:bg-red-100 cursor-pointer text-red-600 text-sm font-medium rounded-lg transition duration-200 flex items-center mx-auto w-48 max-w-[85%]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="truncate">Logout</span>
            </button>
        </form>

        <!-- Logout - For collapsed state -->
        <form action="{{ route('mitra.logout') }}" method="POST" class="collapsed-logout sidebar-collapsed-only hidden">
            @csrf
            <button type="submit" class="p-2 bg-red-50 hover:bg-red-100 cursor-pointer text-red-600 rounded-lg transition duration-200 flex items-center justify-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const hamburgerIcon = document.getElementById('hamburgerIcon');
        const collapseIcon = document.getElementById('collapseIcon');
        const sidebarContents = document.querySelectorAll('.sidebar-content');
        const collapsedOnlyElements = document.querySelectorAll('.sidebar-collapsed-only');

    // Mulai dengan sidebar collapsed
    sidebar.classList.add('sidebar-collapsed');
    sidebar.style.width = '60px'; // Set lebar untuk sidebar collapsed
    

    // Sembunyikan konten dan tampilkan elemen collapsed-only
    sidebarContents.forEach(element => {
        element.style.opacity = '0';
        element.style.pointerEvents = 'none';
    });

    collapsedOnlyElements.forEach(element => {
        element.classList.remove('hidden');
    });

    // Atur posisi dan ikon toggle
    hamburgerIcon.classList.remove('hidden');
    collapseIcon.classList.add('hidden');
    sidebarToggle.classList.add('left-1/2', 'transform', '-translate-x-1/2');
    sidebarToggle.classList.remove('right-4');

    // Fungsi toggle tetap sama
    function toggleSidebar() {
        if (sidebar.classList.contains('sidebar-collapsed')) {
            // Expand sidebar
            sidebar.classList.remove('sidebar-collapsed');
            sidebar.style.width = '240px';

            setTimeout(() => {
                sidebarContents.forEach(element => {
                    element.style.opacity = '1';
                    element.style.pointerEvents = 'auto';
                });
            }, 50);

            collapsedOnlyElements.forEach(element => {
                element.classList.add('hidden');
            });

            hamburgerIcon.classList.add('hidden');
            collapseIcon.classList.remove('hidden');
            sidebarToggle.classList.remove('left-1/2', 'transform', '-translate-x-1/2');
            sidebarToggle.classList.add('right-4');
        } else {
            // Collapse sidebar
            sidebar.classList.remove('sidebar-expanded');
            sidebar.classList.add('sidebar-collapsed');
            sidebar.style.width = '60px';

            sidebarContents.forEach(element => {
                element.style.opacity = '0';
                element.style.pointerEvents = 'none';
            });

            setTimeout(() => {
                collapsedOnlyElements.forEach(element => {
                    element.classList.remove('hidden');
                });
            }, 150);

            hamburgerIcon.classList.remove('hidden');
            collapseIcon.classList.add('hidden');
            sidebarToggle.classList.remove('right-4');
            sidebarToggle.classList.add('left-1/2', 'transform', '-translate-x-1/2');
        }
    }

    sidebarToggle.addEventListener('click', toggleSidebar);

    // Fix for initially hidden elements - force a redraw
    setTimeout(() => {
        sidebar.style.opacity = '0.99';
        setTimeout(() => {
            sidebar.style.opacity = '1';
        }, 50);
    }, 100);
});
</script>
