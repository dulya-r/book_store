<div>
    <div class="container mx-auto px-4 py-6 bg-purple-50">
    <h1 class="text-3xl font-semibold mb-6 text-purple-600 text-center">My Cart</h1>

    <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-purple-600 text-white">
                <th class="py-2 px-4 text-center">Product</th>
                <th class="py-2 px-4 text-center">Quantity</th>
                <th class="py-2 px-4 text-center">Subtotal</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr class="border-b hover:bg-purple-50">
                    <td class="py-2 px-4 text-center">{{ $item->book->title }}</td>
                    <td class="py-2 px-4 text-center">{{ $item->quantity }}</td>
                    <td class="py-2 px-4 text-center">{{ $item->subtotal }}</td>
                    <td class="py-2 px-4 text-center">
                        <button wire:click="removeItem({{ $item->id }})" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            Remove
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <strong class="text-xl">Total: </strong><span class="text-lg font-semibold">{{ $total }}</span>
    </div>

    <a href="{{ route('checkout') }}" class="mt-4 inline-block bg-purple-600 text-white py-2 px-6 rounded-lg hover:bg-purple-700">Proceed to Checkout</a>
    <a href="{{ route('shop') }}" class="mt-4 inline-block bg-purple-600 text-white py-2 px-6 rounded-lg hover:bg-purple-700">Back to Shop</a>
</div>

</div>
