<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index()
    {
        if(Auth::user()->usertype == 'user')
        {
            return view('dashboard');
        }
        else
        {
             // admin dashboard
             $usersCount = User::where('usertype', 'user')->count();
             $booksCount = Book::count();
             $pendingOrders = Order::where('status', 'pending')->count();
             $deliveredOrders = Order::where('status', 'delivered')->count();
             $orders = Order::latest()->get();
             
             
             // Pass the statistics to the admin's home view
             return view('admin.home', compact('usersCount', 'booksCount', 'pendingOrders', 'deliveredOrders', 'orders'));
        }

    }

    public function page()
    {
        return view('admin.home');
    }

    // Method to manage users (list all users)
    public function manageUsers()
    {
        $users = User::all();  // Fetch all users
        return view('admin.manageUsers', compact('users'));
    }

    // Method to delete a user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();  // Delete the user from the database

        return redirect()->route('admin.manageUsers')->with('success', 'User deleted successfully.');
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('admin.home')->with('success', 'Order status updated successfully!');

    }
}
