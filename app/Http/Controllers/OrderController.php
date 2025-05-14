<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Checkout page
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('checkout', compact('cartItems'));
    }

    // Store order directly (no checkout_details table)
    public function placeOrder(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'country' => 'required|string',
            'city' => 'required|string',
            'payment_method' => 'required|string',
            'pincode' => 'required|string|max:10',
        ]);

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum('subtotal');

        // Create order (no separate checkout_details table)
        $order = Order::create([
            'user_id' => $userId,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'payment_method' => $request->payment_method,
            'pincode' => $request->pincode,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Clear cart after placing the order
        Cart::where('user_id', $userId)->delete();

        return redirect('/shop')->with('success', 'order placed successfully');

        // return redirect()->route('order.success')->with('orderPlaced', 'Thank you! Your order has been placed.');
    }
}
