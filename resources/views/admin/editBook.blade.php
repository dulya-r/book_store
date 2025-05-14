@extends('layouts.app')

@section('content')
<div class="bg-gray-100">
    <!-- Admin Navigation Bar -->
    <nav class="bg-purple-600 text-white p-4">
        <div class="flex justify-between items-center w-full">
            <a href="{{ url('admin.home') }}" class="text-xl font-bold">Orchid Books Admin</a>
            <div id="hamburger" class="lg:hidden block cursor-pointer">
                <span class="block w-6 h-0.5 bg-white mb-1"></span>
                <span class="block w-6 h-0.5 bg-white mb-1"></span>
                <span class="block w-6 h-0.5 bg-white"></span>
            </div>
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

    <!-- Edit Book Form -->
    <div class="container mx-auto p-6">
        <h3 class="text-2xl font-semibold mb-4 text-purple-600">Edit Book</h3>

        <form action="{{ route('admin.updateBook', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Book Name -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Book Name</label>
                    <input type="text" id="title" name="title" value="{{ $book->title }}" class="border p-2 w-full" required>
                </div>

                <!-- Author -->
                <div class="mb-4">
                    <label for="author" class="block text-gray-700">Author</label>
                    <input type="text" id="author" name="author" value="{{ $book->author }}" class="border p-2 w-full" required>
                </div>
                <!-- Genre -->
                <div class="mb-4">
                    <label for="genre" class="block text-gray-700">Genre</label>
                    <select id="genre" name="genre" class="border p-2 w-full">
                        <option value="fiction" {{ $book->genre == 'fiction' ? 'selected' : '' }}>Fiction</option>
                        <option value="non-fiction" {{ $book->genre == 'non-fiction' ? 'selected' : '' }}>Non-Fiction</option>
                        <option value="ya" {{ $book->genre == 'ya' ? 'selected' : '' }}>Teens & YA</option>
                        <option value="kids" {{ $book->genre == 'kids' ? 'selected' : '' }}>Kids</option>
                    </select>
                </div>


                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Price</label>
                    <input type="number" id="price" name="price" value="{{ $book->price }}" class="border p-2 w-full" required>
                </div>

                <!-- Current Image -->
                <div class="mb-4">
                    <label class="form-label">Current Book Image</label><br>
                    <img src="{{ asset('storage/books/' . $book->image) }}" alt="Book Image" width="100">
                </div>

                <!-- Upload New Image -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Change Image (optional)</label>
                    <input type="file" id="image" name="image" class="border p-2 w-full">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="3" class="border p-2 w-full">{{ $book->description }}</textarea>
                </div>
            </div>

            <button type="submit" class="bg-purple-600 text-white p-3 rounded hover:bg-purple-700">Update Book</button>
            <a href="{{ route('admin.manageBooks') }}" class="bg-purple-600 text-white p-3 rounded hover:bg-purple-700">Cancel</a>
        </form>
    </div>
</div>

<script>
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');

    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
@endsection
