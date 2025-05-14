{{-- @extends('layouts.app')

@section('content')

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
    <!-- Cart Page Content -->
    <div class="container mx-auto px-4 py-6 bg-purple-50">
        <h1 class="text-3xl font-semibold mb-6 text-purple-600 text-center">My Cart</h1>

        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-purple-600 text-white">
                    <th class="py-2 px-4 text-center">Product</th>
                    <th class="py-2 px-4 text-center">Quantity</th>
                    <th class="py-2 px-4 text-center">Subtotal</th>
                    <th class="py-2 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $cartItem)
                    <tr class="border-b hover:bg-purple-50">
                        <td class="py-2 px-4 text-center">{{ $cartItem->book->title }}</td>
                        <td class="py-2 px-4 text-center">{{ $cartItem->quantity }}</td>
                        <td class="py-2 px-4 text-center">{{ $cartItem->subtotal }}</td>
                        <td class="py-2 px-4 text-center">
                            <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <strong class="text-xl">Total: </strong><span class="text-lg font-semibold">{{ $total }}</span>
        </div>

        <a href="{{ route('checkout') }}" class="mt-4 inline-block bg-purple-600 text-white py-2 px-6 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
            Proceed to Checkout
        </a>
        <a href="{{ route('shop') }}" class="mt-4 inline-block bg-purple-600 text-white py-2 px-6 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
            Back to Shop
        </a>
    </div>

    <script>
      const hamburgerBtn = document.getElementById('hamburger-btn');
      const mobileNav = document.getElementById('mobile-nav');

      hamburgerBtn.addEventListener('click', () => {
          mobileNav.classList.toggle('hidden');
      });
  </script>


@endsection --}}
@extends('layouts.app')

@section('content')
    @livewire('cartpage')
@endsection
