<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Orchid Books</title>

    <!-- Fonts & Tailwind CSS -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-purple-100 text-gray-900">

    <!-- Navigation Bar -->
    <nav class="bg-purple-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-white text-xl font-bold">Orchid Books</a>

             <!-- Mobile Hamburger Button -->
            <div class="lg:hidden">
                <button id="hamburger-btn" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Links -->
            <ul class="hidden lg:flex space-x-6">
                <li><a href="{{ route('home') }}" class="text-white hover:underline">Home</a></li>
                <li><a href="{{ route('shop') }}" class="text-white hover:underline">Shop</a></li>
                <li><a href="{{ route('services') }}" class="text-white hover:underline">Our Services</a></li>
                @guest
                    <li><a href="{{ route('login') }}" class="text-white hover:underline">Login</a></li>
                    <li><a href="{{ route('register') }}" class="text-white hover:underline">Register</a></li>
                @else
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:text-gray-300">Log Out</button>
                </form>
                @endguest
            </ul>
        </div>

        <!-- Mobile Links -->
        <div id="mobile-nav" class="lg:hidden hidden">
            <ul class="space-y-4 px-4 py-3">
                <li><a href="{{ route('home') }}" class="text-white hover:underline">Home</a></li>
                <li><a href="{{ route('shop') }}" class="text-white hover:underline">Shop</a></li>
                <li><a href="{{ route('services') }}" class="text-white hover:underline">Our Services</a></li>
                @guest
                    <li><a href="{{ route('login') }}" class="text-white hover:underline">Login</a></li>
                    <li><a href="{{ route('register') }}" class="text-white hover:underline">Register</a></li>
                @else
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-gray-300">Log Out</button>
                    </form>
                 @endguest
            </ul>
        </div>
    </nav>



<!-- Welcome Section (Cover Image) -->
<section class="relative flex flex-col items-center justify-center text-center min-h-screen bg-purple-600">
    <img src="{{ asset('images/home-bg.jpg') }}" alt="Cover Image" class="w-full h-full object-cover absolute inset-0">
</section>

<!-- Welcome Text Section -->
<section class="bg-purple-100 py-12 text-center mt-8">
    <h1 class="text-4xl font-bold text-purple-600">Welcome to Orchid Books</h1>
    <p class="text-gray-700 leading-relaxed">Discover a world of stories and knowledge.</p>
</section>




    <!-- About Us Section -->
    <section class="py-16 bg-white text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-purple-600 mb-6">About Orchid Books</h2>
            <p class="text-gray-700 leading-relaxed">
                Orchid Books is a premier online bookstore dedicated to providing a wide range of books across various genres. Whether you're a fan of fiction, non-fiction, we have something for everyone. Our mission is to make reading accessible and enjoyable for all.
            </p>
        </div>
    </section>

    <!-- Login/Register Boxes -->
    <section class="py-16 bg-purple-50">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-purple-600 mb-10">Get Started with Orchid Books</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-purple-600 mb-4">Login</h3>
                    <p class="text-gray-700 mb-6">Already have an account? Log in to explore our amazing collection.</p>
                    <a href="{{ route('login') }}" class="block px-6 py-2 bg-purple-600 text-white rounded shadow">Login</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-purple-600 mb-4">Register</h3>
                    <p class="text-gray-700 mb-6">New to Orchid Books? Sign up now to start your reading journey.</p>
                    <a href="{{ route('register') }}" class="block px-6 py-2 bg-purple-600 text-white rounded shadow">Register</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-purple-600 text-white py-8">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; {{ now()->year }} Orchid Books. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileNav = document.getElementById('mobile-nav');

        hamburgerBtn.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
        });
    </script>
</body>
</html>
