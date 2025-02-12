<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;


Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');


Route::post('/basket/remove/{index}', [BasketController::class, 'remove'])->name('basket.remove');

Route::post('/basket/add', [BasketController::class, 'addToBasket'])->name('basket.add');
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

// additional shop pages
Route::get('/dogclothes',[ShopController::class,'dogClothes'])->name('dogclothes');
Route::get('/catclothes',[ShopController::class,'catClothes'])->name('catclothes');

//Login routes
Route::get('/loginpage',[LoginController::class,'login'])->name('loginpage');
Route::get('/signup',[LoginController::class,'signUp'])->name('signup');

//About us page route
Route::get('/why', function () {
    return view('newpages.newwhy');
})->name('why');

//Contact us routes
Route::get('/contact', [ContactController::class, 'showContact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submitContact'])->name('submitContact');

Route::get('/search', 'SearchController@index');



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


//Admin dashboard route
Route::get('admin/dashboard',[HomeController::class,'index'])->
    middleware(['auth','admin']);

//Admin customers page route
Route::get('/admin/customers',[AdminUserController::class,'adminCustomers'])->
middleware(['auth','admin'])->name('admin.customers');

//Admin view and edit user page route. Takes the user ID as a parameter and appends it to the url
Route::get('/user/{user}', [AdminProfileController::class, 'showUser'])->
middleware(['auth','admin'])->name('profile.show');

Route::patch('/user/{user}', [AdminProfileController::class, 'update'])->
middleware(['auth','admin'])->name('adminprofile.edit');


