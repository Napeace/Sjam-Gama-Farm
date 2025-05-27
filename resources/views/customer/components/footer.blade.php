{{-- resources/views/components/customer/footer.blade.php --}}
<footer class="bg-emerald-600 text-white px-4 sm:px-6 md:px-10 py-8 shadow-inner border-t-4 border-emerald-800">
    <div class="max-w-6xl mx-auto">
        <!-- Main Content -->
        <div class="flex flex-col md:flex-row justify-between items-start">
            <!-- Contact Info -->
            <div class="w-full md:w-1/2 mb-6 md:mb-0">
                <h2 class="text-2xl font-bold mb-4 border-b-2 border-emerald-500 pb-2 inline-block">Contact Us</h2>
                <div class="grid grid-cols-1 gap-4 mt-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-500 rounded-full p-2 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-emerald-200 text-sm">Phone</p>
                            <p class="font-medium">0812-3932-018</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-500 rounded-full p-2 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-emerald-200 text-sm">Email</p>
                            <p class="font-medium">SJAMGAMA@gmail.com</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="bg-emerald-500 rounded-full p-2 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-emerald-200 text-sm">Location</p>
                            <p class="font-medium">Jl. Gajah Mada 8 No.200, Jambidan, Kec. Banguntapan, Kab. Bantul, Jawa Timur 68121</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo & Social Media -->
            <div class="w-full md:w-1/3">
                <div class="flex flex-col items-center md:items-end">
                    <h2 class="text-2xl font-bold mb-4">SJAM GAMA FARM</h2>
                    <div class="flex space-x-4 mt-2">
                        <a href="https://wa.me/6285156422350" target="_blank" class="bg-emerald-500 hover:bg-emerald-400 transition-colors p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 32 32" fill="currentColor">
                                <path d="M16.004 2.002c-7.73 0-13.998 6.268-13.998 13.998a13.9 13.9 0 002.024 7.209l-2.138 6.193 6.368-2.096a13.894 13.894 0 007.744 2.287c7.73 0 13.998-6.268 13.998-13.998 0-3.739-1.456-7.253-4.1-9.897a13.9 13.9 0 00-9.898-4.1zm0 2c3.244 0 6.29 1.264 8.575 3.55a11.88 11.88 0 013.553 8.574c0 6.623-5.375 11.998-11.998 11.998a11.9 11.9 0 01-6.617-1.957l-.472-.309-3.826 1.26 1.289-3.74-.298-.484a11.899 11.899 0 01-1.8-6.767c0-6.623 5.375-11.998 11.998-11.998zm-3.25 6.55c-.186 0-.405.008-.62.008-.312 0-.647.094-.939.484-.267.366-1.238 1.21-1.238 2.94s1.269 3.408 1.444 3.642c.175.234 2.438 3.803 6.02 5.18 2.976 1.16 3.52.93 4.145.873.625-.057 2.048-.837 2.342-1.645.295-.809.295-1.5.208-1.645-.087-.146-.318-.234-.664-.41s-1.996-.996-2.307-1.111c-.312-.116-.54-.174-.767.174s-.883 1.11-1.083 1.342c-.2.234-.393.26-.73.088s-1.426-.524-2.717-1.673c-1.004-.897-1.682-2.003-1.882-2.34s-.02-.521.146-.695c.148-.148.33-.392.49-.586.161-.194.213-.33.321-.548s.053-.438-.027-.612c-.08-.173-.748-1.815-1.029-2.48-.24-.567-.504-.59-.713-.598z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-emerald-500 hover:bg-emerald-400 transition-colors p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-emerald-500 hover:bg-emerald-400 transition-colors p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-emerald-500 mt-6 pt-4 text-center">
            <p class="text-sm text-emerald-100">&copy; 2025 <span class="font-bold">SJAM Gama Farm</span>. All rights reserved.</p>
        </div>
    </div>
</footer>
