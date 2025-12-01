@extends('layouts.public')
@section ('title', $product->name)
@section('content')

<div class="max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="mb-6 flex items-center gap-2 text-sm">
        <a href="{{ route('public.products.index') }}" class="text-gray-500 hover:text-gray-700">Home</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <a href="{{ route('public.products.index') }}" class="text-gray-500 hover:text-gray-700">Produk</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">{{ $product->name }}</span>
    </nav>

    <!-- Product Detail Section -->
    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="grid lg:grid-cols-2 gap-8 p-8">
            <!-- Left: Image Gallery -->
            <div class="space-y-4">

                <!-- Main Image -->
                <div class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl overflow-hidden relative group">

                    @php
                    $mainImage = $product->images->where('is_primary', 1)->first()
                    ?? $product->images->first();
                    @endphp

                    @if($mainImage)
                    <img src="{{ $mainImage->url }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover">
                    @else
                    {{-- Placeholder kalau tidak ada gambar --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    @endif

                    <!-- Stock Badge -->
                    <div class="absolute top-4 right-4
            {{ $product->stock > 10 ? 'bg-green-500' :
               ($product->stock > 0 ? 'bg-yellow-500' : 'bg-red-500') }}
            text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        @if($product->stock > 10)
                        Stok Tersedia
                        @elseif($product->stock > 0)
                        Stok Terbatas ({{ $product->stock }})
                        @else
                        Stok Habis
                        @endif
                    </div>
                </div>

                <!-- Thumbnail Gallery -->
                @if($product->images && $product->images->count() > 0)
                <div class="grid grid-cols-4 gap-3">
                    @foreach($product->images->take(4) as $image)
                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden cursor-pointer hover:ring-2 hover:ring-blue-500 transition-all">
                        <img src="{{ $image->url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
                @endif

            </div>

            <!-- Right: Product Info -->
            <div class="flex flex-col">
                <!-- Title & Price -->
                <div class="mb-6">
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                        {{ $product->name }}
                    </h1>

                    <div class="flex items-baseline gap-3 mb-4">
                        <span class="text-4xl font-bold text-blue-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        <span class="text-sm text-gray-500">/ unit</span>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="grid grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Stok</p>
                            <p class="font-semibold text-gray-900">{{ $product->stock }} unit</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Status</p>
                            <p class="font-semibold text-green-600">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description Preview -->
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Deskripsi Produk
                    </h3>

                    <div x-data="{ expanded: false }">
                        <div class="text-gray-600 leading-relaxed">
                            <p :class="expanded ? '' : 'line-clamp-3'">
                                {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}
                            </p>
                        </div>

                        @if(strlen($product->description) > 150)
                        <button
                            @click="expanded = !expanded"
                            class="mt-3 text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center gap-1 transition-colors">
                            <span x-text="expanded ? 'Tampilkan Lebih Sedikit' : 'Selengkapnya'"></span>
                            <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-auto space-y-3">
                    <!-- Contact/Order Button -->
                    <button
                        onclick="openContactModal()"
                        class="w-full px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all hover:shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Hubungi Penjual
                    </button>

                    <!-- Share Button -->
                    <button
                        onclick="shareProduct()"
                        class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        Bagikan Produk
                    </button>

                    <!-- Back Button -->
                    <a href="{{ route('public.products.index') }}"
                        class="w-full px-6 py-3 bg-white border-2 border-gray-200 hover:border-gray-300 text-gray-700 font-medium rounded-xl transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Info Tabs -->
        <div class="border-t border-gray-200">
            <div class="p-8" x-data="{ activeTab: 'details' }">
                <!-- Tab Headers -->
                <div class="flex gap-4 border-b border-gray-200 mb-6">
                    <button
                        @click="activeTab = 'details'"
                        :class="activeTab === 'details' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="px-4 py-3 font-semibold border-b-2 transition-colors">
                        Detail Lengkap
                    </button>
                    <button
                        @click="activeTab = 'specs'"
                        :class="activeTab === 'specs' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="px-4 py-3 font-semibold border-b-2 transition-colors">
                        Spesifikasi
                    </button>
                </div>

                <!-- Tab Content -->
                <div x-show="activeTab === 'details'" class="prose max-w-none">
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Deskripsi Lengkap</h4>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $product->description ?? 'Tidak ada deskripsi lengkap untuk produk ini.' }}</p>
                    </div>
                </div>

                <div x-show="activeTab === 'specs'" class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Nama Produk</p>
                            <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Kategori</p>
                            <p class="font-semibold text-gray-900">{{ $product->category->name ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Harga</p>
                            <p class="font-semibold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Stok Tersedia</p>
                            <p class="font-semibold text-gray-900">{{ $product->stock }} unit</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Terakhir Diperbarui</p>
                            <p class="font-semibold text-gray-900">{{ $product->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Ditambahkan</p>
                            <p class="font-semibold text-gray-900">{{ $product->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    @if($product->category && $product->category->products->where('id_product', '!=', $product->id_product)->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($product->category->products->where('id_product', '!=', $product->id_product)->where('is_active', true)->take(4) as $relatedProduct)
            <a href="{{ route('public.products.show', $relatedProduct->id_product) }}"
                class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-gray-100 hover:border-blue-200 transition-all">
                <div class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                        {{ $relatedProduct->name }}
                    </h3>
                    <p class="text-blue-600 font-bold">
                        Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Contact Modal -->
<div id="contactModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full shadow-2xl transform transition-all" onclick="event.stopPropagation()">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Hubungi Penjual</h3>
                <button onclick="closeContactModal()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div class="bg-blue-50 rounded-xl p-4">
                    <p class="text-sm text-gray-600 mb-2">Produk yang Anda minati:</p>
                    <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                    <p class="text-blue-600 font-bold mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="space-y-3">
                    <a href="https://wa.me/6285875194996?text=Halo, saya tertarik dengan produk {{ $product->name }} seharga Rp {{ number_format($product->price, 0, ',', '.') }}, apakah masih tersedia?"
                        target="_blank"
                        class="flex items-center gap-3 p-4 bg-green-500 hover:bg-green-600 text-black rounded-xl transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        <div class="text-left">
                            <p class="font-semibold">WhatsApp</p>
                            <p class="text-xs text-green-100">Hubungi via WhatsApp</p>
                        </div>
                    </a>

                    <a href="mailto:?subject=Informasi Produk {{ $product->name }}&body=Saya tertarik dengan produk {{ $product->name }} seharga Rp {{ number_format($product->price, 0, ',', '.') }}"
                        class="flex items-center gap-3 p-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <div class="text-left">
                            <p class="font-semibold">Email</p>
                            <p class="text-xs text-gray-500">Kirim via Email</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openContactModal() {
        const modal = document.getElementById('contactModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeContactModal() {
        const modal = document.getElementById('contactModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('contactModal')?.addEventListener('click', closeContactModal);

    function shareProduct() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $product->name }}',
                text: '{{ $product->description }}',
                url: window.location.href
            });
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(window.location.href);
            alert('Link produk berhasil disalin!');
        }
    }
</script>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@endsection