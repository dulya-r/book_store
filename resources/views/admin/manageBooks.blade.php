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
    <!-- Container for content with margin -->
    <div class="container mx-auto p-6">
      <h3 class="text-2xl font-semibold mb-4 text-purple-600">Add New Book</h3>

      <!-- Add New Book Form -->
      <form action="{{ route('admin.storeBook') }}" method="POST" enctype="multipart/form-data" class="mb-8">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="mb-4">
                  <label for="title" class="block text-gray-700">Title</label>
                  <input type="text" id="title" name="title" class="border p-2 w-full" required>
              </div>
              <div class="mb-4">
                  <label for="author" class="block text-gray-700">Author</label>
                  <input type="text" id="author" name="author" class="border p-2 w-full" required>
              </div>
              <div class="mb-4">
                <label for="genre" class="block text-gray-700">Genre</label>
                <select id="genre" name="genre" class="border p-2 w-full" required>
                    <option value="fiction">Fiction</option>
                    <option value="non-fiction">Non-Fiction</option>
                    <option value="ya">Teens & YA</option>
                    <option value="kids">Kids</option>
                </select>
            </div>            
              <div class="mb-4">
                  <label for="price" class="block text-gray-700">Price</label>
                  <input type="number" id="price" name="price" class="border p-2 w-full" required>
              </div>
              <div class="mb-4">
                  <label for="description" class="block text-gray-700">Description</label>
                  <textarea id="description" name="description" class="border p-2 w-full" rows="4" required></textarea>
              </div>
              <div class="mb-4">
                  <label for="image" class="block text-gray-700">Image</label>
                  <input type="file" id="image" name="image" class="border p-2 w-full">
              </div>
          </div>
          <button type="submit" class="bg-purple-600 text-white p-3 rounded hover:bg-purple-700">Add Book</button>
      </form>

      <!-- Books Table -->
      <h3 class="text-2xl font-semibold mb-4 text-purple-600">Manage Books</h3>
      <table class="table-auto w-full border-collapse bg-white shadow-lg rounded-lg">
          <thead>
              <tr class="bg-purple-100">
                  <th class="border p-2 text-left text-purple-700">Name</th>
                  <th class="border p-2 text-left text-purple-700">Author</th>
                  <th class="border p-2 text-left text-purple-700">Genre</th>
                  <th class="border p-2 text-left text-purple-700">Price</th>
                  <th class="border p-2 text-left text-purple-700">Description</th>
                  <th class="border p-2 text-left text-purple-700">Actions</th>
              </tr>
          </thead>
          <tbody>
              @foreach($books as $book)
              <tr class="hover:bg-purple-50">
                  <td class="border p-2">{{ $book->title }}</td>
                  <td class="border p-2">{{ $book->author }}</td>
                  <td class="border p-2">{{ $book->genre }}</td>
                  <td class="border p-2">{{ $book->price }}</td>
                  <td class="border p-2">{{ $book->description }}</td>
                  <td class="border p-2">
                      <a href="{{ route('admin.editBook', $book->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a> |
                      <form action="{{ route('admin.deleteBook', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                      </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
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
