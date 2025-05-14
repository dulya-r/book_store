<?php

namespace App\Http\Controllers;

use App\Models\Book;

class ShopController extends Controller
{
    public function showShop()
    {
        // Fetch books by genre
        $fictionBooks = Book::where('genre', 'Fiction')->get();
        $nonFictionBooks = Book::where('genre', 'Non-Fiction')->get();
        $yaBooks = Book::where('genre', 'ya')->get();
        $kidsBooks = Book::where('genre', 'Kids')->get();

        // Pass them to the view
        return view('shop', compact('fictionBooks', 'nonFictionBooks', 'yaBooks', 'kidsBooks'));
    }
}
