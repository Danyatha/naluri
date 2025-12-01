@extends('layouts.admin')

@section('title', 'Create Story')

@section('page-title', 'Create New Story')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-sm text-slate-600 mb-6">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('admin.stories.index') }}" class="hover:text-blue-600 transition">Stories</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-slate-900 font-medium">Create</span>
    </nav>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6 animate-fade-in">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Error Alert -->
    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6 animate-fade-in">
        <div class="flex">
            <svg class="w-5 h-5 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h3 class="text-red-800 font-medium mb-2">Please fix the following errors:</h3>
                <ul class="list-disc list-inside text-red-700 space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">Story Details</h2>
                    <p class="text-blue-100 text-sm">Fill in the information below to create a new story</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.stories.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf

            <!-- Title & Category Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">
                        Story Title <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('title') border-red-500 @enderror"
                            placeholder="Enter compelling story title"
                            required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                        </div>
                    </div>
                    @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-slate-700 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            name="category"
                            id="category"
                            value="{{ old('category') }}"
                            list="categories"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('category') border-red-500 @enderror"
                            placeholder="e.g., Technology, Travel, Lifestyle"
                            required>
                        <datalist id="categories">
                            @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat }}">
                                @endforeach
                        </datalist>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                    </div>
                    @error('category')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Author & Reading Time Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Author -->
                <div>
                    <label for="author" class="block text-sm font-semibold text-slate-700 mb-2">
                        Author Name <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            name="author"
                            id="author"
                            value="{{ old('author') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('author') border-red-500 @enderror"
                            placeholder="Author name"
                            required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    @error('author')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reading Time -->
                <div>
                    <label for="reading_time" class="block text-sm font-semibold text-slate-700 mb-2">
                        Reading Time <span class="text-slate-400 text-xs">(Optional)</span>
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            name="reading_time"
                            id="reading_time"
                            value="{{ old('reading_time') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="e.g., 5 min read">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-xs text-slate-500">Leave empty for auto-calculation based on content</p>
                </div>
            </div>

            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-sm font-semibold text-slate-700 mb-2">
                    Excerpt <span class="text-red-500">*</span>
                </label>
                <textarea
                    name="excerpt"
                    id="excerpt"
                    rows="3"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none @error('excerpt') border-red-500 @enderror"
                    placeholder="Brief description of the story (max 500 characters)"
                    maxlength="500"
                    required>{{ old('excerpt') }}</textarea>
                <div class="flex justify-between items-center mt-2">
                    <p class="text-xs text-slate-500">A compelling summary that appears in story previews</p>
                    <p class="text-sm text-slate-600 font-medium">
                        <span id="excerptCount">0</span><span class="text-slate-400">/500</span>
                    </p>
                </div>
                @error('excerpt')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">
                    Story Content <span class="text-red-500">*</span>
                </label>
                <textarea
                    name="content"
                    id="content"
                    rows="16"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none font-mono text-sm @error('content') border-red-500 @enderror"
                    placeholder="Write your story content here... Support for paragraphs, formatting, and rich text."
                    required>{{ old('content') }}</textarea>
                <p class="mt-2 text-xs text-slate-500">Write the full story content with proper formatting</p>
                @error('content')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Featured Image -->
            <div>
                <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">
                    Featured Image <span class="text-red-500">*</span>
                </label>
                <div class="relative border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:border-blue-500 transition-all bg-slate-50 @error('image') border-red-500 @enderror">
                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        required>
                    <div id="uploadPlaceholder" class="space-y-3">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-700 font-medium">Click to upload or drag and drop</p>
                            <p class="text-slate-500 text-sm mt-1">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>

                    <!-- Image Preview -->
                    <div id="imagePreview" class="hidden">
                        <img src="" alt="Preview" class="max-w-full max-h-64 rounded-lg mx-auto shadow-lg">
                        <p class="text-sm text-slate-600 mt-3">Click to change image</p>
                    </div>
                </div>
                @error('image')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-slate-200">
                <a
                    href="{{ route('admin.stories.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-all duration-200 font-medium group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Cancel
                </a>

                <div class="flex items-center space-x-3">
                    <button
                        type="button"
                        onclick="document.getElementById('content').value = ''; document.getElementById('title').value = ''; document.getElementById('excerpt').value = '';"
                        class="inline-flex items-center px-6 py-3 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl group">
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Publish Story
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Character counter for excerpt
    const excerpt = document.getElementById('excerpt');
    const excerptCount = document.getElementById('excerptCount');

    excerpt.addEventListener('input', function() {
        excerptCount.textContent = this.value.length;
    });

    // Image preview
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const previewImg = imagePreview.querySelector('img');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                uploadPlaceholder.classList.add('hidden');
                imagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Set initial excerpt count if there's old value
    if (excerpt.value) {
        excerptCount.textContent = excerpt.value.length;
    }

    // Auto-save draft to localStorage (optional feature)
    const formElements = ['title', 'category', 'author', 'excerpt', 'content'];

    formElements.forEach(elementId => {
        const element = document.getElementById(elementId);
        if (element) {
            // Load saved draft
            const savedValue = localStorage.getItem(`draft_${elementId}`);
            if (savedValue && !element.value) {
                element.value = savedValue;
                if (elementId === 'excerpt') {
                    excerptCount.textContent = savedValue.length;
                }
            }

            // Save on input
            element.addEventListener('input', function() {
                localStorage.setItem(`draft_${elementId}`, this.value);
            });
        }
    });

    // Clear draft on successful submit
    document.querySelector('form').addEventListener('submit', function() {
        formElements.forEach(elementId => {
            localStorage.removeItem(`draft_${elementId}`);
        });
    });
</script>
@endsection