<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminInventoryController;
use App\Http\Controllers\Admin\AdminOrdersController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminProductCreationController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminViewOrderController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;


Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');


Route::post('/basket/remove/{index}', [BasketController::class, 'remove'])->name('basket.remove');
Route::post('/basket/add/{product}', [BasketController::class, 'addToBasket'])->name('basket.add');
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/store-basket', [BasketController::class, 'storeBasket'])->name('basket.store');
Route::get('/checkout', [BasketController::class, 'checkout'])->name('checkout.index');

//Route::middleware(['auth', 'check.cart'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
//});

Route::middleware(['admin'])->group(function () {
    //Route::get('/admin/dashboard', [AdminController::class, 'index']); // Only accessible by admin users
    // Add other admin routes here
});

// Home routes
Route::get('/',[HomeController::class,'home'])->name('home');

 // Shop routes
Route::get('/shop',[ShopController::class,'shop'])->name('shop');
Route::get('/fullshop',[ShopController::class,'fullShop'])->name('fullshop');
Route::get('/catshop',[ShopController::class,'catShop'])->name('catshop');
Route::get('/dogshop',[ShopController::class,'dogShop'])->name('dogshop');
//Route::get('/product/{product}',[ShopController::class,'productPage'])->name('product');

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


//Search page routes
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
// Route to handle the search functionality
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
// Route to filter products by category or brand
Route::get('/filter', [ProductController::class, 'filter'])->name('product.filter');
Route::get('/product/product{product_id}', [ProductController::class, 'searchShow'])->name('product.searchshow');



//Route::get('/search', 'SearchController@index');



//Route::get('/products/filter', 'ProductController@filter');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Admin only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', [AdminHomeController::class, 'home'])->name('admin.home');

    Route::get('admin/dashboard',[HomeController::class,'index']);
    //Admin customers page route
    Route::get('/admin/customers',[AdminUserController::class,'adminCustomers'])->name('admin.customers');
    //Admin view and edit user page route. Takes the user as a parameter and appends the ID it to the url. Also passes the user as a parameter to the controller.
    Route::get('/user/{user}', [AdminProfileController::class, 'showUser'])->name('profile.show');
    //Patch route that allows admin to edit other users.
    Route::patch('/user/{user}', [AdminProfileController::class, 'update'])->name('adminprofile.edit');
    //Deletes the selected user.
    Route::delete('/user/{user}', [AdminProfileController::class, 'destroy'])->name('adminprofile.destroy');
    //Inventory route
    Route::get('/admin/inventory',[AdminInventoryController::class,'inventory'])->name('admin.inventory');
    //Product creation page
    Route::get('admin/inventory/newproduct', [AdminInventoryController::class, 'addProduct'])->name('adminaddproduct.show');
    //Individual product route
    Route::get('admin/inventory/{product}', [AdminProductController::class, 'showProduct'])->name('adminproduct.show');
    //Change product image
    Route::patch('admin/inventory/{product}/image', [AdminProductController::class, 'editImage'])->name('adminimage.edit');
    //Update existing product
    Route::patch('admin/inventory/{product}', [AdminProductController::class, 'updateProduct'])->name('adminproduct.edit');
    //Delete product
    Route::delete('admin/inventory/{product}', [AdminProductController::class, 'destroyProduct'])->name('adminproduct.destroy');
    //Create a new product
    Route::post('admin/inventory/newproduct', [AdminProductCreationController::class, 'create'])->name('adminproduct.add');
    //Edit stock option
    Route::patch('admin/inventory/{option}/option', [AdminProductController::class, 'updateOption'])->name('adminoption.edit');
    //Add stock option
    Route::post('admin/inventory/{product}/option', [AdminProductController::class, 'addOption'])->name('adminoption.add');
    //Delete stock option
    Route::delete('admin/inventory/{option}/option', [AdminProductController::class, 'destroyOption'])->name('adminoption.delete');

    //Show orders page
    Route::get('/admin/orders',[AdminOrdersController::class,'orders'])->name('admin.orders');
    //Show specific order
    Route::get('/admin/order/{order}',[AdminViewOrderController::class,'showOrder'])->name('adminorder.show');
    //Update order message
    Route::patch('/admin/order/{order}/message',[AdminViewOrderController::class,'updateMessage'])->name('adminordermessage.update');
    //Process order
    Route::patch('/admin/order/{order}/process',[AdminViewOrderController::class,'process'])->name('adminorder.process');
    //Cancel order
    Route::patch('/admin/order/{order}/cancel',[AdminViewOrderController::class,'cancel'])->name('adminorder.cancel');

    //Confirm refund
    Route::patch('/admin/order/{returnItem}/confirm',[AdminViewOrderController::class,'confirmRefund'])->name('adminrefund.confirm');
    //Reject refund
    Route::patch('/admin/order/{returnItem}/reject',[AdminViewOrderController::class,'rejectRefund'])->name('adminrefund.reject');
});
