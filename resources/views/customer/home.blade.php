@extends('customer.components.layouts')

@section('title', 'SJAM GAMA FARM - Perkebunan Organik Unggulan')

@section('content')
    {{-- Navbar Component --}}
    @include('customer.components.navbar1')

    {{-- Enhanced Hero Section --}}
    <section class="relative h-screen flex flex-col items-center justify-center overflow-hidden" id="hero">
        {{-- Background image with enhanced parallax effect --}}
        <div class="absolute inset-0 w-full h-full">
            <img src="{{ asset('images/homepage.png') }}" alt="Farm Background"
                 class="absolute inset-0 w-full h-full object-cover transform scale-105 transition-transform duration-3000" />
        </div>

        {{-- Animated leaf particles --}}
        <div class="leaf-container absolute inset-0 z-5 pointer-events-none"></div>

        {{-- Overlay gradient with pulse animation --}}
        <div class="absolute inset-0 bg-gradient-to-t from-green-900/90 via-green-800/50 to-black/30 z-10 animate-pulse-slow"></div>

        {{-- Text content with enhanced animations --}}
        <div class="relative z-20 text-center text-white px-4 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight drop-shadow-lg animate-slideDown">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-green-200">SJAM GAMA FARM</span>
            </h1>
            <p class="text-lg md:text-xl max-w-2xl mx-auto leading-relaxed mb-8 text-green-50 animate-fadeInDelay">
                SJAM GAMA FARM merupakan perusahaan pertanian terpadu yang mengelola hidroponik skala besar serta mengembangkan sektor pertanian organik, pupuk hayati, dan biogas sebagai bagian dari upaya pertanian berkelanjutan.
            </p>

            {{-- Button with enhanced hover effects --}}
            <div class="mt-12 animate-fadeInDelayLongest">
                <button onclick="scrollToSection()"
                   class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden font-medium transition-all duration-300 ease-out border-2 border-green-500 rounded-full shadow-md bg-white/90 hover:bg-green-500 hover:text-white cursor-pointer">
                    <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 translate-y-full bg-green-600 group-hover:translate-y-0 ease">
                        <span>Jelajahi Lebih Lanjut</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </span>
                    <span class="absolute flex items-center justify-center w-full h-full text-green-800 transition-all duration-300 transform group-hover:translate-y-full ease">Jelajahi Lebih Lanjut</span>
                    <span class="relative invisible">Jelajahi Lebih Lanjut</span>
                </button>
            </div>
        </div>

        {{-- Animated farm elements --}}
        <div class="absolute bottom-0 left-0 w-full z-15 opacity-70 animate-slideUp">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
                <path fill="#166534" fill-opacity="0.5" d="M0,224L60,208C120,192,240,160,360,165.3C480,171,600,213,720,224C840,235,960,213,1080,181.3C1200,149,1320,107,1380,85.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
            </svg>
        </div>

        {{-- Enhanced bouncing arrow with glow effect --}}
        <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
            <div class="relative">
                <div class="absolute inset-0 rounded-full bg-white/30 blur-md animate-pulse"></div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
                </svg>
            </div>
        </div>

        {{-- Mouse scroll indicator --}}
        <div class="absolute bottom-28 left-1/2 transform -translate-x-1/2 z-20 animate-fadeInDelay">
            <div class="mouse">
                <div class="wheel"></div>
            </div>
        </div>
    </section>

        @php
            $categories = [
                [
                    'name' => 'Hidroponik',
                    'image' => 'hidroponik.png',
                    'description' => 'Selengkapnya +',
                    'slug' => 'hidroponik'
                ],
                [
                    'name' => 'Peternakan',
                    'image' => 'peternakan.png',
                    'description' => 'Selengkapnya +',
                    'slug' => 'peternakan'
                ],
                [
                    'name' => 'Microgreen',
                    'image' => 'microgreen.png',
                    'description' => 'Selengkapnya +',
                    'slug' => 'microgreen'
                ],
                [
                    'name' => 'Biogas',
                    'image' => 'biogas.png',
                    'description' => 'Selengkapnya +',
                    'slug' => 'biogas'
                ],
                [
                    'name' => 'Pupuk',
                    'image' => 'pupuk.png',
                    'description' => 'Selengkapnya +',
                    'slug' => 'pupuk'
                ],
                [
                    'name' => 'Perikanan',
                    'image' => 'perikanan.png',
                    'description' => 'Selengkapnya +',
                    'slug' => 'perikanan'
                ],
            ];
        @endphp
        <div class="scroll-container">
            @include('customer.components.carousel', ['categories' => $categories])
        </div>
    </section>

    {{-- Benefits Section --}}
    <section class="bg-green-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-2">Keunggulan Kami</h2>
                <div class="w-24 h-1 bg-white mx-auto mb-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-green-700 p-6 rounded-lg shadow-lg transform transition hover:scale-105">
                    <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-center">100% Organik</h3>
                    <p class="text-green-100 text-center">Bebas dari bahan kimia berbahaya dan pestisida, kami memprioritaskan kesehatan Anda.</p>
                </div>

                <div class="bg-green-700 p-6 rounded-lg shadow-lg transform transition hover:scale-105">
                    <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-4.9-6.7" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13V5a3 3 0 00-6 0v8" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-center">Ramah Lingkungan</h3>
                    <p class="text-green-100 text-center">Praktik pertanian kami dirancang untuk meminimalkan dampak pada lingkungan.</p>
                </div>

                <div class="bg-green-700 p-6 rounded-lg shadow-lg transform transition hover:scale-105">
                    <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-center">Kualitas Premium</h3>
                    <p class="text-green-100 text-center">Setiap produk melewati kontrol kualitas ketat untuk memastikan standar tertinggi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('customer.components.footer')

    {{-- Custom Scrollbar Component --}}
    @include('customer.components.custom-scroll')

    {{-- Enhanced CSS Animations & Styles --}}
    <style>
        /* Base animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeIn {
            animation: fadeIn 1.2s ease-out forwards;
        }

        /* New animations */
        @keyframes slideDown {
            0% { opacity: 0; transform: translateY(-50px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            0% { opacity: 0; transform: translateY(50px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes zoomIn {
            0% { opacity: 0; transform: scale(0.5); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Apply animations */
        .animate-slideDown {
            animation: slideDown 1s ease forwards;
        }

        .animate-slideUp {
            animation: slideUp 1s ease forwards;
        }

        .animate-zoomIn {
            animation: zoomIn 1s ease forwards;
        }

        .animate-fadeInDelay {
            animation: fadeIn 1.2s ease-out 0.3s forwards;
            opacity: 0;
        }

        .animate-fadeInDelayLonger {
            animation: fadeIn 1.2s ease-out 0.6s forwards;
            opacity: 0;
        }

        .animate-fadeInDelayLongest {
            animation: fadeIn 1.2s ease-out 0.9s forwards;
            opacity: 0;
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s infinite;
        }

        .animate-floating {
            animation: floating 3s ease-in-out infinite;
        }

        /* Scroll container */
        .scroll-container {
            overflow-x: auto;
            overflow-y: hidden;
            scrollbar-width: none;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        /* General body styles */
        body {
            overflow-x: hidden !important;
        }

        /* Hero section styles */
        #hero {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        #hero img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.1);
            transition: transform 0.3s ease-out;
        }

        #hero .bg-gradient-to-t {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
        }

        /* Mouse scroll animation */
        .mouse {
            width: 26px;
            height: 40px;
            border: 2px solid white;
            border-radius: 20px;
            position: relative;
        }

        .wheel {
            width: 4px;
            height: 8px;
            background-color: white;
            border-radius: 2px;
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
            animation: mouseScroll 1.5s infinite;
        }

        @keyframes mouseScroll {
            0% { opacity: 1; transform: translateX(-50%) translateY(0); }
            100% { opacity: 0; transform: translateX(-50%) translateY(15px); }
        }

        /* Leaf animation */
        .leaf-container {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .leaf {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50% 0;
            opacity: 0.5;
            animation-name: leafFall;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        @keyframes leafFall {
            0% {
                transform: translateY(-20px) rotate(0deg) scale(0.7);
                opacity: 0;
            }
            10% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(100vh) rotate(360deg) scale(1);
                opacity: 0;
            }
        }
    </style>

    <script>
        function scrollToSection() {
            // Sesuaikan nilai ini untuk mengatur jarak scroll dalam pixel
            const scrollDistance = 740; // Scroll sebanyak 600 pixel

            // Gunakan smooth scrolling
            window.scroll({
                top: window.pageYOffset + scrollDistance,
                behavior: 'smooth'
            });
        }

        // Enhanced Image Parallax
        document.addEventListener('DOMContentLoaded', function() {
            const heroImage = document.querySelector('#hero img');
            const heroSection = document.querySelector('#hero');

            // Handle parallax scrolling
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;
                const heroHeight = heroSection.offsetHeight;

                if (scrollPosition < heroHeight) {
                    const scale = 1.05 + (scrollPosition * 0.0005);
                    const translateY = scrollPosition * 0.05;

                    heroImage.style.transform = `scale(${scale}) translateY(${translateY}px)`;
                }
            });

            // Create falling leaf elements
            createLeafElements();
        });

        // Function to create falling leaf elements
        function createLeafElements() {
            const leafContainer = document.querySelector('.leaf-container');
            const leafCount = 15;
            const colors = ['#a5d6a7', '#81c784', '#66bb6a', '#4caf50', '#43a047'];

            for (let i = 0; i < leafCount; i++) {
                const leaf = document.createElement('div');
                leaf.className = 'leaf';

                // Randomize leaf properties
                const size = Math.random() * 15 + 10;
                const positionX = Math.random() * 100;
                const delay = Math.random() * 10;
                const duration = Math.random() * 15 + 10;
                const rotationDirection = Math.random() > 0.5 ? 1 : -1;

                // Apply styling
                leaf.style.width = `${size}px`;
                leaf.style.height = `${size}px`;
                leaf.style.left = `${positionX}%`;
                leaf.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                leaf.style.animationDuration = `${duration}s`;
                leaf.style.animationDelay = `${delay}s`;
                leaf.style.transform = `rotate(${Math.random() * 360}deg)`;

                leafContainer.appendChild(leaf);
            }
        }

        // Add a slight parallax effect on mouse move
        document.addEventListener('mousemove', function(e) {
            const heroSection = document.querySelector('#hero');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            const moveX = (mouseX - 0.5) * 20;
            const moveY = (mouseY - 0.5) * 20;

            heroSection.querySelector('img').style.transform = `scale(1.1) translate(${moveX}px, ${moveY}px)`;
        });
    </script>
@endsection
