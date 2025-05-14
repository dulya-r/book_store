<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Fetch the cart items of the authenticated user
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total = $cartItems->sum('subtotal');
        return view('cart', compact('cartItems', 'total'));
    }

    public function addToCart(Request $request, $book_id)
    {
        
        if (!Auth::check()) {
            // Store the intended URL in the session
            session(['redirectTo' => route('shop')]);
    
            // Redirect to the login page
            return redirect()->route('login');
        }
    
        
        $book = Book::findOrFail($book_id);
    
        $cart = Cart::where('user_id', Auth::id())
                    ->where('book_id', $book_id)
                    ->first();
    
        if ($cart) {
            $cart->quantity += 1;
            $cart->subtotal = $cart->quantity * $book->price;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'quantity' => 1,
                'subtotal' => $book->price
            ]);
        }
    
        return redirect()->route('cart.index')->with('success', 'Book added to cart!');
    }
    

    public function removeFromCart($cart_id)
    {
        // Find the cart item by ID and delete it
        Cart::findOrFail($cart_id)->delete();

        
        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
}
