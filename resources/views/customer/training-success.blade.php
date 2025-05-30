@extends('customer.components.layouts')

@section('title', 'Pendaftaran Berhasil - SJAM GAMA FARM')

@section('content')
{{-- Custom Scrollbar Component --}}
@include('customer.components.custom-scroll')

<div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50">
    <!-- Header Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-2xl font-bold text-green-600">SJAM GAMA FARM</a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/hidroponik#pelatihan-section" class="text-gray-600 hover:text-green-600 transition-colors duration-300">
                        ← Kembali ke Daftar Pelatihan
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto">
            <!-- Success Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Success Animation Section -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-12 text-center">
                    <!-- Success Icon with Animation -->
                    <div class="mb-6">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-lg animate-bounce">
                            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>

                    <h1 class="text-4xl font-bold text-white mb-4">
                        Pendaftaran Berhasil!
                    </h1>
                    <p class="text-xl text-green-100">
                        Terima kasih telah mendaftar pelatihan hidroponik
                    </p>
                </div>

                <!-- Content Section -->
                <div class="p-8 md:p-12">
                    <!-- Status Information -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 mb-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-blue-800 mb-2">
                                    Status Pendaftaran Anda
                                </h3>
                                <p class="text-blue-700 leading-relaxed mb-3">
                                    Pendaftaran Anda sedang diproses. Silakan menunggu admin
                                    mengkonfirmasi pembayaran dan kelengkapan data Anda dalam waktu <strong>2x24 jam</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp Contact Section -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 mb-8">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-green-800 mb-3">
                                Butuh Konfirmasi Lebih Cepat?
                            </h3>
                            <p class="text-green-700 mb-4">
                                Hubungi admin kami via WhatsApp untuk upload bukti pembayaran dan konfirmasi pendaftaran
                            </p>
                            <a href="https://wa.me/6285156422350" target='_blank'
                               id="whatsappBtn"
                               class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.032-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                Hubungi via WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="/hidroponik"
                           class="inline-flex items-center justify-center bg-white border-2 border-gray-300 hover:border-green-500 text-gray-700 hover:text-green-600 font-semibold py-3 px-8 rounded-xl transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Kembali ke Hidroponik
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
