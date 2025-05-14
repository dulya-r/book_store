<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;


class BookController extends Controller
{
    // Display all books for admin management
    public function index()
    {
        $books = Book::all(); // Fetch all books
        return view('admin.manageBooks', compact('books')); 
    }

    // Show individual book details
    public function show(Book $book)
    {
        return view('book_details', compact('book')); 
    }

    // Show the form to create a new book
    public function create()
    {
        return view('admin.createBook'); 
    }

    // Store a newly created book in the database
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',  
            'author' => 'required',  
            'genre' => 'required|string',
            'price' => 'required|numeric',  
            'image' => 'nullable|image',  
            'description' => 'required',  
        ]);

        // Handle the image upload if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');  
        }

        // Create a new book record
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'price' => $request->price,
            'image' => $imagePath,  
            'description' => $request->description,
        ]);

        
        return redirect()->route('admin.manageBooks')->with('success', 'Book added successfully.');
    }

    // Show the form to edit an existing book
    public function edit(Book $book)
    {
        return view('admin.editBook', compact('book'));  
    }

    public function update(Request $request, $id)
    {
        
        $book = Book::findOrFail($id);
    
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required|string', 
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $book->title = $request->title;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->price = $request->price;
        $book->description = $request->description;
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $book->image = basename($imagePath);
        }
    
        $book->save();
    
        return redirect()->route('admin.manageBooks')->with('success', 'Book updated successfully!');
    }
    
    
    public function destroy(Book $book)
    {
        // Delete the book record
        $book->delete();

        
        return redirect()->route('admin.manageBooks')->with('success', 'Book deleted successfully.');
    }
}
