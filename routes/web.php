<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;

Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');



Route::get('/basket', [BasketController::class, 'showBasket'])->name('basket');

Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/store-basket', [BasketController::class, 'storeBasket'])->name('basket.store');
Route::get('/checkout', [BasketController::class, 'checkout'])->name('checkout.index');

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

//Contact us page route
Route::get('/contact', function () {
    return view('newpages.newcontact');
})->name('contact');

//Login routes
Route::get('/loginpage',[LoginController::class,'login'])->name('loginpage');
Route::get('/signup',[LoginController::class,'signUp'])->name('signup');

Route::get('/products/filter', 'ProductController@filter');

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
