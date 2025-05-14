<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Cartpage extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

public function loadCart()
{
    $user = Auth::user();
    $this->cartItems = Cart::where('user_id', $user->id)->with('book')->get(); 
    $this->total = $this->cartItems->sum('subtotal'); 
}


    public function removeItem($id)
    {
        Cart::where('id', $id)->delete();
        $this->loadCart(); 
    }

    public function render()
    {
        return view('livewire.cartpage');
    }
}
