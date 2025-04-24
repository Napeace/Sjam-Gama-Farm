@extends('layouts.customer')

@section('title', 'SJAM GAMA FARM - Beranda')

@section('content')
    {{-- Navbar Component --}}
    <x-customer.navbar1 />

    {{-- Hero Section --}}
    <section class="relative h-screen flex flex-col items-center justify-center overflow-hidden" id="hero">
        {{-- Background overlay with bottom dark gradient --}}
        <div class="absolute inset-0 w-full h-full bg-gradient-to-t from-black/70 via-black/40 to-transparent z-10"></div>

        {{-- Background image --}}
        <img src="{{ asset('images/farm-background.png') }}" alt="Farm Background" class="absolute inset-0 w-full h-full object-cover" />

        {{-- Text content --}}
        <div class="relative z-20 text-center text-white px-4 -mt-24">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-wide drop-shadow-lg">
                SJAM GAMA FARM
            </h1>
            <p class="text-base md:text-lg max-w-2xl mx-auto drop-shadow">
                Perkebunan organik unggulan yang menyediakan produk pertanian berkualitas tinggi. Kami berkomitmen untuk praktik pertanian berkelanjutan demi masa depan yang lebih baik.
            </p>
        </div>

        {{-- Tombol scroll ke bawah --}}
        <button onclick="scrollToSection()" class="absolute z-30 animate-bounce bg-green-600 hover:bg-green-700 cursor-pointer text-white p-3 rounded-full shadow-lg transition duration-300 hover:scale-105" style="bottom: 4rem;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </section>

    {{-- Carousel Section --}}
    <section id="categories" class="scroll-target">
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

        <x-customer.carousel :categories="$categories" />
    </section>

    {{-- Footer --}}
    <x-customer.footer />

    {{-- Custom Scrollbar Component --}}
    <x-customer.custom-scroll />

    <script>
        function scrollToSection() {
            const categoriesSection = document.getElementById('categories');
            if (categoriesSection) {
                categoriesSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    </script>
@endsection
