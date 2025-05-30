@extends('customer.components.layouts')

@section('title', 'SJAM GAMA FARM - Hidroponik')

@section('content')
    {{-- Navbar Component --}}
    @include('customer.components.navbar2')

    {{-- Hero Banner Section --}}
    @include('customer.hidroponik.sections.hero-banner')

    {{-- Produk Section --}}
    @include('customer.hidroponik.sections.produk')

    {{-- Video Pelatihan Section --}}
    @include('customer.hidroponik.sections.video-pembelajaran')

    {{-- Pelatihan Offline Section --}}
    @include('customer.hidroponik.sections.pelatihan', ['trainingForms' => $trainingForms])

    {{-- Artikel Section --}}
    @include('customer.hidroponik.sections.artikel', ['artikels' => $artikels])

    {{-- Review Section --}}
    @include('customer.hidroponik.sections.review', ['reviews' => $reviews])

    {{-- Carousel Script --}}
    @include('customer.hidroponik.sections.carousel-script')

    {{-- Custom Scrollbar Component --}}
    @include('customer.components.custom-scroll')

    {{-- Footer --}}
    @include('customer.components.footer')
@endsection
