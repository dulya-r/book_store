<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken('student-token')->plainTextToken;
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logged out successfully'
    ]);
});

//Shop API

Route::get('/shop', [ShopController::class, 'showShop']);


// Cart Routes 

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add/{book}', [CartController::class, 'addToCart']);
    Route::delete('/cart/remove/{cart_id}', [CartController::class, 'removeFromCart']);
});


// Order Routes 

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout']);
    Route::post('/checkout', [OrderController::class, 'storeCheckoutDetails']);
    Route::post('/order', [OrderController::class, 'placeOrder']);
});

//Admin Routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers']);
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser']);
    Route::put('/admin/order/update-status/{orderId}', [AdminController::class, 'updateOrderStatus']);
    Route::get('/admin/manage-books', [BookController::class, 'index']);
    Route::post('/admin/book/store', [BookController::class, 'store']);
    Route::get('/admin/book/edit/{book}', [BookController::class, 'edit']);
    Route::put('/admin/update-book/{id}', [BookController::class, 'update']);
    Route::delete('/admin/book/delete/{book}', [BookController::class, 'destroy']);
});
