@extends('layouts.public')
@section('title', 'Katalog Produk')
@section('content')

<div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">
            Katalog Produk
        </h1>
        <p class="text-gray-600 text-lg">
            Temukan produk terbaik untuk kebutuhan Anda
        </p>
    </div>

    <!-- Main Layout: Sidebar + Content -->
    <div class="flex flex-col lg:flex-row gap-6" x-data="{ 
        sidebarOpen: false,
        minPrice: {{ request('min_price', 0) }},
        maxPrice: {{ request('max_price', 10000000) }}
    }">

        <!-- Sidebar Filter - Desktop -->
        <aside class="hidden lg:block w-72 flex-shrink-0">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </h2>
                    @if(request()->hasAny(['category', 'min_price', 'max_price', 'search']))
                    <a href="{{ route('public.products.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Reset
                    </a>
                    @endif
                </div>

                <form action="{{ route('public.products.index') }}" method="GET" class="space-y-6">
                    <!-- Keep search parameter -->
                    @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <!-- Category Filter -->
                    <div class="pb-6 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Kategori
                        </h3>
                        <div class="space-y-2 max-h-64 overflow-y-auto pr-2">
                            <!-- All -->
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input
                                    type="radio"
                                    name="category"
                                    value=""
                                    {{ request('category') == '' || !request()->has('category') ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                    onchange="this.form.submit()">
                                <span class="text-sm text-gray-700 group-hover:text-gray-900">Semua Kategori</span>
                            </label>
                            <!-- Dynamic Categories -->
                            @foreach($categories as $category)
                            <label class="flex items-center justify-between gap-3 cursor-pointer group">
                                <div class="flex items-center gap-3">
                                    <input
                                        type="radio"
                                        name="category"
                                        value="{{ $category->id_category }}"
                                        {{ request('category') == $category->id_category ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                        onchange="this.form.submit()">
                                    <span class="text-sm text-gray-700 group-hover:text-gray-900">{{ $category->name }}</span>
                                </div>
                                <span class="text-xs text-gray-500">{{ $category->products_count }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="pb-6 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Range Harga
                        </h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs text-gray-600 mb-1 block">Min</label>
                                    <input
                                        type="number"
                                        name="min_price"
                                        x-model="minPrice"
                                        placeholder="0"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-600 mb-1 block">Max</label>
                                    <input
                                        type="number"
                                        name="max_price"
                                        x-model="maxPrice"
                                        placeholder="10000000"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                                </div>
                            </div>
                            <!-- Quick Price Ranges -->
                            <div class="space-y-2">
                                <p class="text-xs text-gray-500">Pilihan Cepat:</p>
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" @click="minPrice = 0; maxPrice = 100000" class="px-3 py-1 text-xs bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors">
                                        < 100rb</button>
                                            <button type="button" @click="minPrice = 100000; maxPrice = 500000" class="px-3 py-1 text-xs bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors">100rb - 500rb</button>
                                            <button type="button" @click="minPrice = 500000; maxPrice = 1000000" class="px-3 py-1 text-xs bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors">500rb - 1jt</button>
                                            <button type="button" @click="minPrice = 1000000; maxPrice = 10000000" class="px-3 py-1 text-xs bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors">> 1jt</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="pb-6 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                            Urutkan
                        </h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="sort" value="newest" {{ request('sort') == 'newest' || !request('sort') ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="text-sm text-gray-700 group-hover:text-gray-900">Terbaru</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="sort" value="name" {{ request('sort') == 'name' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="text-sm text-gray-700 group-hover:text-gray-900">Nama (A-Z)</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="sort" value="price_low" {{ request('sort') == 'price_low' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="text-sm text-gray-700 group-hover:text-gray-900">Harga Terendah</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="sort" value="price_high" {{ request('sort') == 'price_high' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="text-sm text-gray-700 group-hover:text-gray-900">Harga Tertinggi</span>
                            </label>
                        </div>
                    </div>

                    <!-- Apply Filter Button -->
                    <button type="submit" class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Terapkan Filter
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Filter Sidebar (Slide from left) -->
        <div class="lg:hidden">
            <!-- Overlay -->
            <div
                x-show="sidebarOpen"
                @click="sidebarOpen = false"
                x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/50 z-40"
                x-cloak>
            </div>

            <!-- Sidebar -->
            <div
                x-show="sidebarOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="fixed inset-y-0 left-0 w-80 bg-white z-50 overflow-y-auto shadow-2xl"
                x-cloak>

                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Filter Produk
                        </h2>
                        <button @click="sidebarOpen = false" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Same form as desktop -->
                    <form action="{{ route('public.products.index') }}" method="GET" class="space-y-6">
                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <!-- Category Filter -->
                        <div class="pb-6 border-b border-gray-100">
                            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Kategori
                            </h3>
                            <div class="space-y-2 max-h-64 overflow-y-auto pr-2">
                                <!-- All -->
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input
                                        type="radio"
                                        name="category"
                                        value=""
                                        {{ request('category') == '' || !request()->has('category') ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                        onchange="this.form.submit()">
                                    <span class="text-sm text-gray-700 group-hover:text-gray-900">Semua Kategori</span>
                                </label>
                                <!-- Dynamic Categories -->
                                @foreach($categories as $category)
                                <label class="flex items-center justify-between gap-3 cursor-pointer group">
                                    <div class="flex items-center gap-3">
                                        <input
                                            type="radio"
                                            name="category"
                                            value="{{ $category->id_category }}"
                                            {{ request('category') == $category->id_category ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                            onchange="this.form.submit()">
                                        <span class="text-sm text-gray-700 group-hover:text-gray-900">{{ $category->name }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ $category->products_count }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="pb-6 border-b border-gray-100">
                            <h3 class="font-semibold text-gray-900 mb-4">Range Harga</h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-xs text-gray-600 mb-1 block">Min</label>
                                        <input
                                            type="number"
                                            name="min_price"
                                            x-model="minPrice"
                                            placeholder="0"
                                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-600 mb-1 block">Max</label>
                                        <input
                                            type="number"
                                            name="max_price"
                                            x-model="maxPrice"
                                            placeholder="10000000"
                                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs text-gray-500">Pilihan Cepat:</p>
                                    <div class="flex flex-wrap gap-2">
                                        <button type="button" @click="minPrice = 0; maxPrice = 100000" class="px-3 py-1 text-xs bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg">
                                            < 100rb</button>
                                                <button type="button" @click="minPrice = 100000; maxPrice = 500000" class="px-3 py-1 text-xs bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg">100rb - 500rb</button>
                                                <button type="button" @click="minPrice = 500000; maxPrice = 1000000" class="px-3 py-1 text-xs bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg">500rb - 1jt</button>
                                                <button type="button" @click="minPrice = 1000000; maxPrice = 10000000" class="px-3 py-1 text-xs bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg">> 1jt</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sort Options -->
                        <div class="pb-6 border-b border-gray-100">
                            <h3 class="font-semibold text-gray-900 mb-4">Urutkan</h3>
                            <div class="space-y-2">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="sort" value="newest" {{ request('sort') == 'newest' || !request('sort') ? 'checked' : '' }} class="w-4 h-4 text-blue-600">
                                    <span class="text-sm text-gray-700">Terbaru</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="sort" value="name" {{ request('sort') == 'name' ? 'checked' : '' }} class="w-4 h-4 text-blue-600">
                                    <span class="text-sm text-gray-700">Nama (A-Z)</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="sort" value="price_low" {{ request('sort') == 'price_low' ? 'checked' : '' }} class="w-4 h-4 text-blue-600">
                                    <span class="text-sm text-gray-700">Harga Terendah</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="sort" value="price_high" {{ request('sort') == 'price_high' ? 'checked' : '' }} class="w-4 h-4 text-blue-600">
                                    <span class="text-sm text-gray-700">Harga Tertinggi</span>
                                </label>
                            </div>
                        </div>

                        <!-- Apply Button -->
                        <div class="flex gap-2">
                            <a href="{{ route('public.products.index') }}" class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors text-center">
                                Reset
                            </a>
                            <button type="submit" class="flex-1 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-colors">
                                Terapkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 min-w-0">
            <!-- Search Bar & Mobile Filter Button -->
            <div class="mb-6 flex gap-3">
                <form action="{{ route('public.products.index') }}" method="GET" class="flex-1 flex gap-3">
                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari produk..."
                            class="search-input w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <!-- Keep filters in search -->
                    @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('min_price'))
                    <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                    @endif
                    @if(request('max_price'))
                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                    @endif
                    @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <!-- Search Button -->
                    <button type="submit" class="px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-colors flex items-center gap-2 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="hidden sm:inline">Cari</span>
                    </button>
                </form>

                <!-- Mobile Filter Toggle -->
                <button
                    @click="sidebarOpen = true"
                    class="lg:hidden px-6 py-3.5 bg-white border-2 border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors flex items-center gap-2 whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter
                </button>
            </div>

            <!-- Active Filters Display -->
            @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
            <div class="mb-6 p-4 bg-blue-50 rounded-xl">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm font-medium text-gray-700">Filter aktif:</span>

                    @if(request('search'))
                    <div class="flex items-center gap-1.5 px-3 py-1.5 bg-white text-gray-700 rounded-lg text-sm shadow-sm">
                        <span>Pencarian: <strong>"{{ request('search') }}"</strong></span>
                        <a href="{{ route('public.products.index', request()->except('search')) }}" class="hover:text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    </div>
                    @endif

                    @if(request('category'))
                    <div class="flex items-center gap-1.5 px-3 py-1.5 bg-white text-gray-700 rounded-lg text-sm shadow-sm">
                        <span>Kategori: <strong>{{ $categories->firstWhere('id', request('category'))->name ?? 'Unknown' }}</strong></span>
                        <a href="{{ route('public.products.index', request()->except('category')) }}" class="hover:text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    </div>
                    @endif

                    @if(request('min_price') || request('max_price'))
                    <div class="flex items-center gap-1.5 px-3 py-1.5 bg-white text-gray-700 rounded-lg text-sm shadow-sm">
                        <span>Harga: <strong>Rp {{ number_format(request('min_price', 0), 0, ',', '.') }} - Rp {{ number_format(request('max_price', 10000000), 0, ',', '.') }}</strong></span>
                        <a href="{{ route('public.products.index', request()->except(['min_price', 'max_price'])) }}" class="hover:text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    </div>
                    @endif

                    <a href="{{ route('public.products.index') }}" class="ml-auto text-sm text-blue-600 hover:text-blue-700 font-medium underline">
                        Reset Semua Filter
                    </a>
                </div>
            </div>
            @endif

            <!-- Results Count & View Options -->
            <div class="mb-6 flex items-center justify-between">
                <p class="text-gray-600">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $products->count() }}</span> dari
                    <span class="font-semibold text-gray-900">{{ $products->total() }}</span> produk
                </p>
            </div>

            <!-- Product Grid -->
            @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-12">
                @foreach($products as $p)
                <a href="{{ route('public.products.show', $p->id_product) }}"
                    class="product-card group relative bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl border border-gray-100 hover:border-blue-200">

                    <!-- Image Container -->
                    <div class="product-image relative aspect-square bg-gradient-to-br from-gray-50 to-gray-100">
                        <!-- Placeholder -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300 group-hover:text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>

                        <!-- Category Badge -->
                        @if($p->category)
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-gray-700 shadow-sm">
                            {{ $p->category->name }}
                        </div>
                        @endif

                        <!-- New Badge -->
                        @if($p->created_at && $p->created_at->diffInDays(now()) < 7)
                            <div class="badge-new absolute top-3 right-3 bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                            Baru
                    </div>
                    @endif
            </div> {{-- TUTUP IMAGE CONTAINER --}}

            <!-- Product Info -->
            <div class="p-5">
                <!-- Product Name -->
                <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2 min-h-[3.5rem]">
                    {{ $p->name }}
                </h3>

                <!-- Description -->
                <p class="text-gray-600 text-sm mb-4 line-clamp-2 min-h-[2.5rem]">
                    {{ $p->description }}
                </p>

                <!-- Price & Action -->
                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <div>
                        <p class="text-xs text-gray-500 mb-0.5">Harga</p>
                        <p class="text-blue-600 font-bold text-xl">
                            Rp {{ number_format($p->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Arrow Icon -->
                    <div class="w-10 h-10 rounded-full bg-blue-50 group-hover:bg-blue-600 flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            </a>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Produk tidak ditemukan</h3>
            <p class="text-gray-600 mb-6">Coba ubah kata kunci pencarian atau filter yang Anda gunakan</p>
            <a href="{{ route('public.products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Reset Semua Filter
            </a>
        </div>
        @endif

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="mt-12">
            {{ $products->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
</div>

@endsection