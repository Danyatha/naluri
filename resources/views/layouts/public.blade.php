<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Naluri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles Stack -->
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav x-data="{ open: false }" class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="/" class="text-2xl font-bold tracking-tight text-blue-600 hover:text-blue-700 transition-colors">
                    Naluri
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8 font-medium text-gray-700">
                    <a href="/" class="hover:text-blue-600 transition-colors relative group">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('public.products.index') }}" class="hover:text-blue-600 transition-colors relative group">
                        Produk
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('story.index') }}" class="hover:text-blue-600 transition-colors relative group">
                        Artikel
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    @auth
                    <!-- Settings Dropdown -->
                    <div class="relative" x-data="{ openDropdown: false }">
                        <button @click="openDropdown = !openDropdown" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-colors">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="openDropdown"
                            @click.away="openDropdown = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                            style="display: none;">
                            <div class="py-1">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Guest Links -->
                    <a href="{{ route('login') }}" class="hover:text-blue-600 transition-colors relative group">
                        Login
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-block px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        Register
                    </a>
                    @endif
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden px-6 pb-4 space-y-3 text-lg text-gray-700 bg-gray-50 border-t">
            <a href="/" class="block hover:text-blue-600 py-2 px-3 rounded-lg hover:bg-white transition-all">
                Home
            </a>
            <a href="{{ route('public.products.index') }}" class="block hover:text-blue-600 py-2 px-3 rounded-lg hover:bg-white transition-all">
                Produk
            </a>
            <a href="{{ route('story.index') }}" class="hover:text-blue-600 transition-colors relative group">
                Artikel
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
            </a>
            @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-3 pb-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <a href="{{ route('dashboard') }}" class="block hover:text-blue-600 py-2 px-3 rounded-lg hover:bg-white transition-all">
                    Dashboard
                </a>
                <a href="{{ route('profile.edit') }}" class="block hover:text-blue-600 py-2 px-3 rounded-lg hover:bg-white transition-all">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left hover:text-blue-600 py-2 px-3 rounded-lg hover:bg-white transition-all">
                        Log Out
                    </button>
                </form>
            </div>
            @else
            <a href="{{ route('login') }}" class="block hover:text-blue-600 py-2 px-3 rounded-lg hover:bg-white transition-all">
                Login
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="block hover:text-blue-600 py-2 px-3 rounded-lg hover:bg-white transition-all">
                Register
            </a>
            @endif
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-14">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-16">
        <div class="max-w-7xl mx-auto px-6 py-8 text-center">
            <p class="text-gray-500">
                © {{ date('Y') }} Naluri — All Rights Reserved.
            </p>
        </div>
    </footer>

    <!-- Scripts Stack -->
    @stack('scripts')

</body>

</html>