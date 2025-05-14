@extends('layouts.app')

@section('content')

    <!-- Navigation Bar -->  
    <nav class="bg-purple-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-white text-xl font-bold">Orchid    Books</a>

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

    <!-- Checkout Page Content -->
    <div class="container mx-auto px-4 py-6 bg-purple-50">
        <h1 class="text-3xl font-semibold mb-6 text-purple-600 text-center">Checkout</h1>

        <!-- Cart Summary -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
            <h2 class="text-2xl font-semibold text-purple-600 p-4">Order Summary</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-purple-600 text-white">
                        <th class="py-2 px-4 text-center">Product</th>
                        <th class="py-2 px-4 text-center">Quantity</th>
                        <th class="py-2 px-4 text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                        <tr class="border-b hover:bg-purple-50">
                            <td class="py-2 px-4 text-center">{{ $cartItem->book->title }}</td>
                            <td class="py-2 px-4 text-center">{{ $cartItem->quantity }}</td>
                            <td class="py-2 px-4 text-center">{{ $cartItem->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                <strong class="text-xl">Total: </strong><span class="text-lg font-semibold">{{ $cartItems->sum('subtotal') }}</span>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <form action="{{ route('order.place') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-black-600">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-black-600">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="phone" class="block text-black-600">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="address" class="block text-black-600">Address</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="country" class="block text-black-600">Country</label>
                        <input type="text" name="country" id="country" value="{{ old('country') }}" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="city" class="block text-black-600">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="payment_method" class="block text-black-600">Payment Method</label>
                        <input type="text" name="payment_method" id="payment_method" value="{{ old('payment_method') }}" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="pincode" class="block text-black-600">Pincode</label>
                        <input type="text" name="pincode" id="pincode" value="{{ old('pincode') }}" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        @error('pincode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="bg-purple-600 text-white py-2 px-6 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    @if(session('orderPlaced'))
    <div id="successModal" class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-purple-600">Thank You! Your Order has been placed.</h2>
            <div class="mt-4 text-center">
                <button id="closeModal" class="bg-purple-600 text-white py-2 px-6 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    OK
                </button>
            </div>
        </div>
    </div>
    @endif

    <script>
        document.getElementById('closeModal').addEventListener('click', function() {
            window.location.reload();
        });

        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileNav = document.getElementById('mobile-nav');

        hamburgerBtn.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
        });
    </script>

@endsection
