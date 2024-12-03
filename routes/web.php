<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');



// Define the route for getting the cart data
Route::get('/cart', [CartController::class, 'getCart'])->name('cart.get');
Route::prefix('cart')->group(function () {
    // View cart contents
    Route::get('/', [CartController::class, 'index'])->name('cart.index');

    // Add an item to the cart
    Route::post('/add/{productId}', [CartController::class, 'add'])->name('cart.add');

    // Update the quantity of an item
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');

    // Remove an item from the cart
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');

    // Clear the entire cart
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Get the cart data (e.g., for AJAX requests)
    Route::get('/get', [CartController::class, 'getCart'])->name('cart.get');
});


//Route::middleware(['auth', 'check.cart'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
//});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']); // Only accessible by admin users
    // Add other admin routes here
});

// Home routes
Route::get('/',[HomeController::class,'home'])->name('home');

 // Shop routes
Route::get('/shop',[ShopController::class,'shop'])->name('shop');
Route::get('/fullshop',[ShopController::class,'fullShop'])->name('fullshop');
Route::get('/catshop',[ShopController::class,'catShop'])->name('catshop');
Route::get('/dogshop',[ShopController::class,'dogShop'])->name('dogshop');
Route::get('/productx',[ShopController::class,'productPage'])->name('product');

//About us page route
Route::get('/why', function () {
    return view('newpages.newwhy');
})->name('why');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('admin/dashboard',[HomeController::class,'index'])->
    middleware(['auth','admin']);
