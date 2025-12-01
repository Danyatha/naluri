@extends('layouts.public')

@section('title', $story['title'])

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
<style>
    .article-content {
        font-family: 'Merriweather', serif;
    }

    .drop-cap::first-letter {
        font-size: 4.5em;
        font-weight: 700;
        float: left;
        line-height: 0.85;
        margin: 8px 12px 0 0;
        color: #2563eb;
    }
</style>
@endpush

@section('content')

<!-- Breadcrumb -->
<nav class="flex items-center gap-2 text-sm mb-8 text-gray-600">
    <a href="/story" class="hover:text-blue-600 transition-colors">Beranda</a>
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
    </svg>
    <a href="/category/{{ $story['category'] }}" class="hover:text-blue-600 transition-colors">{{ $story['category'] }}</a>
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
    </svg>
    <span class="text-gray-400">{{ $story['title'] }}</span>
</nav>

<!-- Article Header -->
<article class="max-w-4xl mx-auto">
    <header class="mb-10">
        <span class="inline-block px-5 py-2 bg-blue-50 text-blue-600 text-sm font-bold rounded-full uppercase tracking-wider mb-6">
            {{ $story['category'] }}
        </span>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
            {{ $story['title'] }}
        </h1>

        <div class="flex flex-wrap items-center gap-6 py-6 border-y border-gray-200 text-gray-600">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                </svg>
                <span class="font-semibold">{{ $story['author'] }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                </svg>
                <span>{{ $story['date'] }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
                <span>{{ $story['views'] }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                <span>{{ $story['reading_time'] }}</span>
            </div>
        </div>
    </header>

    <!-- Featured Image -->
    <div class="mb-12">
        <img src="{{ $story['image'] }}" alt="{{ $story['title'] }}" class="w-full h-auto rounded-2xl shadow-xl">
    </div>

    <!-- Article Content -->
    <div class="article-content prose prose-lg max-w-none mb-12">
        @foreach(is_array($story['content']) ? $story['content'] : preg_split('/\r\n|\r|\n+/', $story['content']) as $index => $paragraph)
        <p class="text-gray-700 leading-relaxed mb-6 text-lg {{ $index === 0 ? 'drop-cap' : '' }}">
            {{ $paragraph }}
        </p>
        @endforeach
    </div>

    <!-- closing Section -->
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-l-4 border-blue-600 rounded-2xl p-8 md:p-10 mb-12 shadow-sm">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Closing Statement</h3>
                <p class="text-gray-700 text-lg leading-relaxed italic">
                    {{ $story['closing'] }}
                </p>
            </div>
        </div>
    </div>

    <!-- Share Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 py-8 border-y border-gray-200 mb-16">
        <span class="text-gray-700 font-semibold text-lg">Bagikan cerita ini:</span>
        <div class="flex items-center gap-3">
            <a href="#" class="group flex items-center justify-center w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all hover:scale-110 shadow-md hover:shadow-lg" title="Facebook">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                </svg>
            </a>
            <a href="#" class="group flex items-center justify-center w-12 h-12 bg-sky-500 hover:bg-sky-600 text-white rounded-xl transition-all hover:scale-110 shadow-md hover:shadow-lg" title="Twitter">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                </svg>
            </a>
            <a href="#" class="group flex items-center justify-center w-12 h-12 bg-green-600 hover:bg-green-700 text-white rounded-xl transition-all hover:scale-110 shadow-md hover:shadow-lg" title="WhatsApp">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg>
            </a>
            <button class="group flex items-center justify-center w-12 h-12 bg-gray-700 hover:bg-gray-800 text-white rounded-xl transition-all hover:scale-110 shadow-md hover:shadow-lg" title="Copy Link">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </button>
        </div>
    </div>
</article>

<!-- Related Stories -->
@if(count($related) > 0)
<section class="mt-20">
    <div class="mb-10">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Cerita Terkait</h2>
        <p class="text-gray-600 text-lg">Jelajahi cerita serupa yang mungkin Anda suka</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach($related as $item)
        <a href="/story/{{ $item['slug'] }}" class="group block">
            <article class="h-full bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100">
                <div class="relative overflow-hidden aspect-[16/10]">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                <div class="p-6">
                    <span class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-xs font-bold rounded-full uppercase tracking-wider mb-3">
                        {{ $item['category'] }}
                    </span>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-blue-600 transition-colors duration-300">
                        {{ $item['title'] }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed line-clamp-2">
                        {{ $item['excerpt'] }}
                    </p>
                </div>
            </article>
        </a>
        @endforeach
    </div>
</section>
@endif

@endsection