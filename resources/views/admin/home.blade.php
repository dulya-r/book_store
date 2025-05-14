<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Orchid Books</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Admin Navigation Bar -->
    <nav class="bg-purple-600 text-white p-4">
        <div class="flex justify-between items-center w-full">
            <a href="{{ url('admin.home') }}" class="text-xl font-bold">Orchid Books Admin</a>

            <!-- Hamburger Menu (Mobile) -->
            <div id="hamburger" class="lg:hidden block cursor-pointer">
                <span class="block w-6 h-0.5 bg-white mb-1"></span>
                <span class="block w-6 h-0.5 bg-white mb-1"></span>
                <span class="block w-6 h-0.5 bg-white"></span>
            </div>

            <!-- Navigation Links for Desktop -->
            <div class="hidden lg:flex space-x-6 ml-10">
                <a href="{{ route('admin.manageUsers') }}" class="text-lg hover:underline">Manage Users</a>
                <a href="{{ route('admin.manageBooks') }}" class="text-lg hover:underline">Manage Books</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-lg hover:underline">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Dropdown Menu for Mobile -->
    <div id="mobileMenu" class="lg:hidden hidden bg-purple-700 absolute top-16 left-0 right-0 py-4">
        <a href="{{ route('admin.manageUsers') }}" class="block px-4 py-2 text-lg text-white hover:bg-purple-800">Manage Users</a>
        <a href="{{ route('admin.manageBooks') }}" class="block px-4 py-2 text-lg text-white hover:bg-purple-800">Manage Books</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block px-4 py-2 text-lg text-white hover:bg-purple-800">Logout</button>
        </form>
    </div>

    <!-- Dashboard Content -->
    <div class="container mx-auto my-8">
        <h2 class="text-3xl font-semibold text-center mb-6 text-purple-600">Admin Dashboard</h2>

        <!-- Dashboard Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Users Card -->
            <div class="bg-white p-6 shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold text-purple-600">Users</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $usersCount }}</p>
            </div>

            <!-- Books Card -->
            <div class="bg-white p-6 shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold text-purple-600">Books</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $booksCount }}</p>
            </div>

            <!-- Pending Orders Card -->
            <div class="bg-white p-6 shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold text-purple-600">Pending Orders</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $pendingOrders }}</p>
            </div>

            <!-- Delivered Orders Card -->
            <div class="bg-white p-6 shadow-lg rounded-lg">
                <h3 class="text-xl font-semibold text-purple-600">Delivered Orders</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $deliveredOrders }}</p>
            </div>
        </div>
    </div>

<!-- Manage Orders Section -->
<div class="container mx-auto my-8">
    <h2 class="text-2xl font-semibold text-center mb-4 text-purple-600">Manage Orders</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-purple-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-center">Order ID</th>
                    <th class="py-3 px-4 text-center">Customer</th>
                    <th class="py-3 px-4 text-center">Email</th> <!-- New Email Column -->
                    <th class="py-3 px-4 text-center">Phone</th> <!-- New Phone Column -->
                    <th class="py-3 px-4 text-center">Total</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b">
                    <td class="py-3 px-4 text-center">{{ $order->id }}</td>
                    <td class="py-3 px-4 text-center">{{ $order->name }}</td>
                    <td class="py-3 px-4 text-center">{{ $order->email }}</td> <!-- Display Email -->
                    <td class="py-3 px-4 text-center">{{ $order->phone }}</td> <!-- Display Phone -->
                    <td class="py-3 px-4 text-center">${{ number_format($order->total, 2) }}</td>
                    <td class="py-3 px-4 text-center">
                        <span class="px-2 py-1 rounded-lg text-white {{ $order->status == 'pending' ? 'bg-red-500' : 'bg-green-700' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <form method="POST" action="{{ route('admin.updateOrderStatus', $order->id) }}">
                            @csrf
                            @method('PUT')
                            <select name="status" class="p-1 border rounded">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                            <button type="submit" class="ml-2 bg-purple-600 text-white px-3 py-1 rounded">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    <script>
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
