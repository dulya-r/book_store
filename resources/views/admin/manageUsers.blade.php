<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Orchid Books</title>
    <!-- Add your CSS framework or custom styles here (e.g., TailwindCSS, Bootstrap, etc.) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

       <!-- Admin Navigation Bar -->
       <nav class="bg-purple-600 text-white p-4">
        <div class="flex justify-between items-center w-full">
            <!-- Admin Logo/Title -->
            <a href="{{ url('admin.home') }}" class="text-xl font-bold">Orchid Books Admin</a>

            <!-- Hamburger Menu (Mobile) -->
            <div id="hamburger" class="lg:hidden block cursor-pointer">
                <span class="block w-6 h-0.5 bg-white mb-1"></span>
                <span class="block w-6 h-0.5 bg-white mb-1"></span>
                <span class="block w-6 h-0.5 bg-white"></span>
            </div>

            <!-- Navigation Links for Desktop -->
            <div class="hidden lg:flex space-x-6 ml-10">
                <a href="{{ route('admin.manageUsers') }}" class="text-lg hover:text-purple-200">Manage Users</a>
                <a href="{{ route('admin.manageBooks') }}" class="text-lg hover:text-purple-200">Manage Books</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-lg hover:text-purple-200">Logout</button>
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

<!-- Manage Users -->
<h3 class="text-2xl font-semibold mb-4 text-purple-600">Manage Users</h3>
<table class="table-auto w-full border-collapse bg-white shadow-lg rounded-lg">
    <thead>
        <tr class="bg-purple-100">
            <th class="border p-2 text-left text-purple-700">Name</th>
            <th class="border p-2 text-left text-purple-700">Email</th>
            <th class="border p-2 text-left text-purple-700">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="hover:bg-purple-50">
            <td class="border p-2">{{ $user->name }}</td>
            <td class="border p-2">{{ $user->email }}</td>
            <td class="border p-2">
                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
  const hamburger = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobileMenu');

  hamburger.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
  });
</script>

</body>
</html>
