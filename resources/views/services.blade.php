<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Our Services - Orchid Books</title>

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
        <img src="{{ asset('images/services-bg.jpg') }}" alt="Services Background Image" class="w-full h-full object-cover absolute inset-0">
    </section>

<!-- Welcome Text Section -->
<section class="bg-purple-100 py-12 text-center mt-8">
  <h1 class="text-4xl font-bold text-purple-600">Our Services</h1>
  <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto px-4">
      Every book enthusiast should have an amazing experience with Orchid Books. Our services are geared at making your literary journey as seamless and pleasurable as we can, emphasizing convenience, quality,
      and customization.
  </p>
</section>


<!-- Services Information Section -->
<section class="bg-white py-16">
  <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-3xl font-bold text-purple-600 mb-6">What We Offer</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
      </div>

      <!-- Image and Text Sections (for Author Events and Gift Cards) -->
      <div class="container-intro grid grid-cols-1 sm:grid-cols-2 gap-8 mt-8">
          <!-- Author Events Image -->
          <div class="image">
              <img src="{{ asset('images/author-events-page.jpg') }}" alt="Author Events" class="w-full h-auto rounded-lg shadow-lg"/>
          </div>
          <div class="text">
              <h3 class="text-xl font-semibold text-purple-600 mb-4">Author Events</h3>
              <p class="text-gray-700">
                  We at Orchid Books want to connect you with the creative brains behind the beloved stories. Our invitation-only author events offer a special chance to interact with your favorite authors, learn about their creative processes, and learn where their inspiration comes from.
              </p>
          </div>

          <!-- Gift Cards Image -->
          <div class="image">
              <img src="{{ asset('images/gift-card-page.jpg') }}" alt="Gift Cards" class="w-full h-auto rounded-lg shadow-lg"/>
          </div>
          <div class="text">
              <h3 class="text-xl font-semibold text-purple-600 mb-4">Gift Cards</h3>
              <p class="text-gray-700">
                  Orchid Books Gift Cards are a great way to spread the love of reading. Our gift cards are ideal for every occasion since they let your loved ones pick from our wide selection, making sure they discover exactly what they're looking for. It's the ideal approach to present the gift of your choosing.
              </p>
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
