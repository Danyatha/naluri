@extends('layouts.public')

@section('title', 'Kategori: ' . $category)

@section('content')

<!-- Breadcrumb -->
<nav class="flex items-center gap-2 text-sm mb-8 text-gray-600">
    <a href="/story" class="hover:text-blue-600 transition-colors">Beranda</a>
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
    </svg>
    <span class="text-gray-400">{{ $category }}</span>
</nav>

<!-- Page Header -->
<header class="text-center mb-16">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl mb-6 shadow-lg">
        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
        </svg>
    </div>

    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-4">
        {{ $category }}
    </h1>

    <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-6">
        Jelajahi koleksi cerita {{ strtolower($category) }} dari berbagai daerah di Indonesia
    </p>

    <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-50 text-blue-600 rounded-full font-semibold">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
        </svg>
        <span>{{ count($filtered) }} cerita ditemukan</span>
    </div>
</header>

<!-- Stories Grid -->
@if(count($filtered) > 0)
<section>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach($filtered as $story)
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
</section>
@else
<!-- Empty State -->
<section class="text-center py-20">
    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
    </div>
    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">Belum Ada Cerita</h3>
    <p class="text-gray-600 text-lg mb-8">Kategori ini belum memiliki cerita. Silakan coba kategori lainnya.</p>
    <a href="/story" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition-all hover:shadow-lg hover:scale-105">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Beranda Artikel
    </a>
</section>
@endif

@endsection

@push('styles')
<style>
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