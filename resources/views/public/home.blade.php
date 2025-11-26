@extends('layouts.public')

@section('title', 'Home')

@push('styles')
<style>
    /* Hero Section Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .delay-1 {
        animation-delay: 0.2s;
        opacity: 0;
    }

    .delay-2 {
        animation-delay: 0.4s;
        opacity: 0;
    }

    .delay-3 {
        animation-delay: 0.6s;
        opacity: 0;
    }

    /* Floating Animation */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .float-animation {
        animation: float 3s ease-in-out infinite;
    }

    /* Gradient Text */
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Card Hover Effect */
    .feature-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .feature-card:hover {
        transform: translateY(-10px) scale(1.02);
    }

    /* Stats Counter Animation */
    .stat-number {
        transition: all 0.5s ease;
    }

    /* Testimonial Card */
    .testimonial-card {
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: scale(1.05);
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-purple-50 -mx-6 px-6 -mt-14 pt-14 pb-20">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 items-center min-h-[600px]">
            <!-- Left Content -->
            <div class="space-y-8">
                <h1 class="text-5xl md:text-6xl font-bold leading-tight fade-in-up">
                    Belanja Mudah,
                    <span class="gradient-text">Harga Terbaik</span>
                </h1>

                <p class="text-xl text-gray-600 leading-relaxed fade-in-up delay-1">
                    Temukan berbagai produk berkualitas dengan harga terjangkau.
                    Belanja online jadi lebih mudah dan menyenangkan bersama Naluri.
                </p>

                <div class="flex flex-wrap gap-4 fade-in-up delay-2">
                    <a href="{{ route('public.products.index') }}"
                        class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transform hover:scale-105 transition-all shadow-lg hover:shadow-xl">
                        Mulai Belanja
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <a href="#about"
                        class="inline-flex items-center px-8 py-4 bg-white text-gray-700 font-semibold rounded-full hover:bg-gray-50 transform hover:scale-105 transition-all shadow-md border border-gray-200">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8 fade-in-up delay-3">
                    <div>
                        <div class="text-3xl font-bold text-blue-600 stat-number">500+</div>
                        <div class="text-sm text-gray-600 mt-1">Produk</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-blue-600 stat-number">10K+</div>
                        <div class="text-sm text-gray-600 mt-1">Pelanggan</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-blue-600 stat-number">4.8★</div>
                        <div class="text-sm text-gray-600 mt-1">Rating</div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Illustration -->
            <div class="relative float-animation">
                <div class="relative z-10 bg-gradient-to-br from-blue-100 to-purple-100 rounded-3xl p-8 shadow-2xl">
                    <svg class="w-full h-auto" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Shopping Bag -->
                        <rect x="150" y="150" width="200" height="250" rx="20" fill="#667eea" opacity="0.2" />
                        <rect x="160" y="160" width="180" height="220" rx="15" fill="#667eea" opacity="0.4" />
                        <path d="M200 160 C200 120, 300 120, 300 160" stroke="#667eea" stroke-width="8" fill="none" />

                        <!-- Cart Icon -->
                        <circle cx="250" cy="280" r="60" fill="white" />
                        <path d="M230 260 L270 260 L265 300 L235 300 Z" fill="#667eea" />
                        <circle cx="240" cy="305" r="5" fill="#667eea" />
                        <circle cx="260" cy="305" r="5" fill="#667eea" />
                    </svg>
                </div>

                <!-- Decorative Elements -->
                <div class="absolute top-10 -right-10 w-20 h-20 bg-purple-300 rounded-full opacity-50 blur-xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-300 rounded-full opacity-50 blur-xl"></div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20" id="features">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Kenapa Pilih Naluri?</h2>
            <p class="text-gray-600 text-lg">Nikmati pengalaman belanja terbaik dengan berbagai keunggulan</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="feature-card bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Produk Berkualitas</h3>
                <p class="text-gray-600">Semua produk telah melalui quality control ketat untuk memastikan kualitas terbaik.</p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Harga Terjangkau</h3>
                <p class="text-gray-600">Dapatkan harga terbaik dengan berbagai promo dan diskon menarik setiap hari.</p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Pengiriman Cepat</h3>
                <p class="text-gray-600">Barang sampai dengan cepat dan aman ke alamat Anda di seluruh Indonesia.</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50 -mx-6 px-6" id="about">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Left - Image -->
            <div class="relative">
                <div class="bg-gradient-to-br from-blue-200 to-purple-200 rounded-3xl p-12 shadow-2xl">
                    <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="200" cy="200" r="150" fill="white" opacity="0.9" />
                        <circle cx="200" cy="200" r="120" fill="#667eea" opacity="0.3" />
                        <path d="M150 200 L180 230 L250 160" stroke="#667eea" stroke-width="15" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="absolute -bottom-6 -right-6 w-40 h-40 bg-purple-300 rounded-full opacity-30 blur-2xl"></div>
            </div>

            <!-- Right - Content -->
            <div class="space-y-6">
                <h2 class="text-4xl font-bold">Tentang Naluri</h2>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Naluri adalah platform e-commerce terpercaya yang menyediakan berbagai produk berkualitas dengan harga terjangkau.
                    Kami berkomitmen untuk memberikan pengalaman belanja online terbaik bagi pelanggan di seluruh Indonesia.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Dengan sistem yang aman, pengiriman cepat, dan customer service yang responsif,
                    kami siap melayani kebutuhan belanja Anda kapan saja.
                </p>

                <div class="grid grid-cols-2 gap-6 pt-6">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <div class="text-3xl font-bold text-blue-600 mb-2">5+</div>
                        <div class="text-gray-600">Tahun Pengalaman</div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <div class="text-3xl font-bold text-blue-600 mb-2">50+</div>
                        <div class="text-gray-600">Kota Terjangkau</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20" id="testimonials">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Apa Kata Mereka?</h2>
            <p class="text-gray-600 text-lg">Testimoni pelanggan setia Naluri</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        A
                    </div>
                    <div class="ml-4">
                        <div class="font-bold">Andi Wijaya</div>
                        <div class="text-sm text-gray-500">Jakarta</div>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">★★★★★</div>
                <p class="text-gray-600 italic">"Belanja di Naluri sangat mudah! Produk berkualitas dan pengiriman cepat. Highly recommended!"</p>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        S
                    </div>
                    <div class="ml-4">
                        <div class="font-bold">Siti Nurhaliza</div>
                        <div class="text-sm text-gray-500">Bandung</div>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">★★★★★</div>
                <p class="text-gray-600 italic">"Harga terjangkau dengan kualitas premium. Customer service ramah dan responsif. Puas banget!"</p>
            </div>

            <!-- Testimonial 3 -->
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        B
                    </div>
                    <div class="ml-4">
                        <div class="font-bold">Budi Santoso</div>
                        <div class="text-sm text-gray-500">Surabaya</div>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">★★★★★</div>
                <p class="text-gray-600 italic">"Sudah langganan 2 tahun, gak pernah kecewa! Packaging rapi dan barang selalu sesuai deskripsi."</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-blue-600 to-purple-600 -mx-6 px-6 text-white">
    <div class="max-w-4xl mx-auto text-center space-y-8">
        <h2 class="text-4xl md:text-5xl font-bold">Siap Mulai Belanja?</h2>
        <p class="text-xl text-blue-100">
            Bergabunglah dengan ribuan pelanggan yang puas dan nikmati pengalaman belanja terbaik bersama Naluri
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('public.products.index') }}"
                class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-100 transform hover:scale-105 transition-all shadow-lg">
                Lihat Produk
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

@endsection