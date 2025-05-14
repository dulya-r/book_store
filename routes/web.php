<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Route::prefix('api')
//     ->middleware('api')
//     ->group(base_path('routes/api.php'));

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/shop', [ShopController::class, 'showShop'])->name('shop');


Route::get('/services', function () {
    return view('services');
})->name('services');

 


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


//admin routes
Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
// Route::get('/adminpage',[AdminController::class, 'page'])->middleware(['auth','admin']);
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::put('/admin/order/update-status/{orderId}', [AdminController::class, 'updateOrderStatus'])->name('admin.updateOrderStatus');

});


//book routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/manage-books', [BookController::class, 'index'])->name('admin.manageBooks');
    Route::get('/admin/book/create', [BookController::class, 'create'])->name('admin.createBook');
    Route::post('/admin/book/store', [BookController::class, 'store'])->name('admin.storeBook');
    Route::get('/admin/book/edit/{book}', [BookController::class, 'edit'])->name('admin.editBook');
    Route::put('/admin/update-book/{id}', [BookController::class, 'update'])->name('admin.updateBook');
    Route::delete('/admin/book/delete/{book}', [BookController::class, 'destroy'])->name('admin.deleteBook');
});






// book routes for public view
Route::resource('books', BookController::class);

//cart routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{book}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{cart_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'storeCheckoutDetails'])->name('checkout.store');
    Route::post('/order', [OrderController::class, 'placeOrder'])->name('order.place');
});
