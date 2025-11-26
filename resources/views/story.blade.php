@extends('layouts.public')

@section('title', 'Beranda Artikel')

@section('content')

<!-- Hero Featured Story -->
<section class="mb-16">
    <a href="/story/{{ $featured['slug'] }}" class="block group">
        <div class="relative h-[550px] md:h-[600px] rounded-3xl overflow-hidden shadow-2xl">
            <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12 lg:p-16">
                <span class="inline-flex items-center px-5 py-2 bg-blue-600/90 backdrop-blur-sm text-white text-xs md:text-sm font-bold rounded-full mb-4 uppercase tracking-widest shadow-lg">
                    {{ $featured['category'] }}
                </span>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 md:mb-6 leading-tight tracking-tight">
                    {{ $featured['title'] }}
                </h1>
                <p class="text-gray-100 text-base md:text-xl mb-6 md:mb-8 leading-relaxed max-w-4xl">
                    {{ $featured['excerpt'] }}
                </p>
                <div class="flex flex-wrap gap-4 md:gap-6 text-sm md:text-base text-gray-200">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                        </svg>
                        {{ $featured['author'] }}
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        {{ $featured['date'] }}
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        {{ $featured['views'] }}
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        {{ $featured['reading_time'] }}
                    </span>
                </div>
            </div>
        </div>
    </a>
</section>

<!-- Categories -->
<section class="mb-16" id="categories">
    <div class="flex items-center gap-3 overflow-x-auto pb-4 scrollbar-hide">
        <a href="/" class="group relative px-8 py-3 bg-blue-600 text-white rounded-full font-semibold whitespace-nowrap transition-all hover:bg-blue-700 hover:shadow-lg hover:scale-105">
            Semua
        </a>
        @foreach($categories as $cat)
        <a href="/category/{{ $cat }}" class="group relative px-8 py-3 bg-white text-gray-700 border-2 border-gray-200 hover:border-blue-600 hover:text-blue-600 rounded-full font-semibold whitespace-nowrap transition-all hover:shadow-lg hover:scale-105">
            {{ $cat }}
        </a>
        @endforeach
    </div>
</section>

<!-- Latest Stories -->
<section id="trending" class="mb-16">
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-2">Cerita Terbaru</h2>
        </div>
        <a href="#" class="hidden md:flex items-center gap-2 text-blue-600 hover:text-blue-700 font-bold text-lg transition-colors group">
            Lihat Semua
            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach($latest as $story)
        <a href="/story/{{ $story['slug'] }}" class="group block">
            <article class="h-full bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100">
                <div class="relative overflow-hidden aspect-[16/10]">
                    <img src="{{ $story['image'] }}" alt="{{ $story['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                <div class="p-6 md:p-7">
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-xs font-bold rounded-full uppercase tracking-wider">
                            {{ $story['category'] }}
                        </span>
                        <svg class="w-6 h-6 text-gray-300 transition-all duration-300 group-hover:text-blue-600 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-blue-600 transition-colors duration-300">
                        {{ $story['title'] }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-5 line-clamp-2">
                        {{ $story['excerpt'] }}
                    </p>
                    <div class="flex justify-between items-center pt-5 border-t border-gray-100">
                        <span class="text-sm font-semibold text-gray-700">{{ $story['author'] }}</span>
                        <span class="text-sm text-gray-500 font-medium">{{ $story['reading_time'] }}</span>
                    </div>
                </div>
            </article>
        </a>
        @endforeach
    </div>

    <div class="mt-12 text-center md:hidden">
        <a href="#" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition-all hover:shadow-lg hover:scale-105">
            Lihat Semua Cerita
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</section>

@endsection

@push('styles')
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .aspect-\[16\/10\] {
        aspect-ratio: 16 / 10;
    }
</style>
@endpush