<?php

use App\Http\Controllers\Admin\AdminDashboardController;
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
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

//newsletter route
route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');

Route::middleware('auth')->group(function () {
    //Payment routes
    Route::post('/payment/prepare', [PaymentController::class, 'prepareOrder'])->name('payment.prepare');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    //Basket routes
    Route::post('/basket/remove/{bitem}', [BasketController::class, 'removeItem'])->name('basket.removeItem');
    Route::patch('basket/quantity/{bitem}', [BasketController::class, 'quantity'])->name('basket.quantity.update');
    Route::post('/basket/add/{product}', [BasketController::class, 'addToBasket'])->name('basket.add');
    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
    Route::post('/store-basket', [BasketController::class, 'storeBasket'])->name('basket.store');

    //Checkout route
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

// Home routes
Route::get('/', [HomeController::class, 'home'])->name('home');

// Shop routes
Route::get('/shop/{animal}/{type}/{query}', [ShopController::class, 'shop'])->name('shop');

//Product page
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

//Terms and Privacy Policy routes
Route::view('/terms', 'static.terms')->name('terms');
Route::view('/privacy', 'static.privacy')->name('privacy');


//Login routes
Route::get('/loginpage', [LoginController::class, 'login'])->name('loginpage');
Route::get('/signup', [LoginController::class, 'signUp'])->name('signup');

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
Route::get('/filter', [ProductController::class, 'filterPage'])->name('filter.page');
Route::get('/filter/results', [ProductController::class, 'filterResults'])->name('filter.results');
Route::get('/product/{product_id}', [ProductController::class, 'searchShow'])->name('product.searchshow');

Route::middleware('auth')->group(function () {
    //Order page routes
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::patch('/orders/{order}', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::get('/orders/return/{orderItem}', [OrderController::class, 'returnForm'])->name('order.return');
    Route::post('/orders/return/{orderItem}/create', [OrderController::class, 'createReturn'])->name('order.createreturn');
    Route::get('/orders/return/create/address', [OrderController::class, 'returnAddress'])->name('order.return.address');

    //Review page routes
    Route::get('/orders/review/{orderItem}', [ReviewController::class, 'index'])->name('review.index');
    Route::post('/orders/reviews/{orderItem}', [ReviewController::class, 'store'])->name('review.store');
    Route::patch('/orders/reviews/{orderItem}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/orders/reviews/{orderItem}', [ReviewController::class, 'destroy'])->name('review.destroy');

    //Return page
    Route::get('/returns', [ReturnController::class, 'index'])->name('return.index');

    //Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//Admin only routes
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'home'])->name('admin.dashboard');

    //Admin customers page route
    Route::get('/admin/customers', [AdminUserController::class, 'adminCustomers'])->name('admin.customers');
    //Admin view and edit user page route. Takes the user as a parameter and appends the ID it to the url. Also passes the user as a parameter to the controller.
    Route::get('/user/{user}', [AdminProfileController::class, 'showUser'])->name('profile.show');
    //Patch route that allows admin to edit other users.
    Route::patch('/user/{user}', [AdminProfileController::class, 'update'])->name('adminprofile.edit');
    //Deletes the selected user.
    Route::delete('/user/{user}', [AdminProfileController::class, 'destroy'])->name('adminprofile.destroy');

    //Inventory route
    Route::get('/admin/inventory', [AdminInventoryController::class, 'inventory'])->name('admin.inventory');
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
    //Delete review
    Route::delete('admin/inventory/{review}/review', [AdminProductController::class, 'destroyReview'])->name('adminreview.destroy');
    //Create a new product
    Route::post('admin/inventory/newproduct', [AdminProductCreationController::class, 'create'])->name('adminproduct.add');


    //Edit stock option
    Route::patch('admin/inventory/{option}/option', [AdminProductController::class, 'updateOption'])->name('adminoption.edit');
    //Add stock option
    Route::post('admin/inventory/{product}/option', [AdminProductController::class, 'addOption'])->name('adminoption.add');
    //Delete stock option
    Route::delete('admin/inventory/{option}/option', [AdminProductController::class, 'destroyOption'])->name('adminoption.delete');

    //Show orders page
    Route::get('/admin/orders', [AdminOrdersController::class, 'orders'])->name('admin.orders');
    //Show specific order
    Route::get('/admin/order/{order}', [AdminViewOrderController::class, 'showOrder'])->name('adminorder.show');
    //Update order message
    Route::patch('/admin/order/{order}/message', [AdminViewOrderController::class, 'updateMessage'])->name('adminordermessage.update');
    //Process order
    Route::patch('/admin/order/{order}/process', [AdminViewOrderController::class, 'process'])->name('adminorder.process');
    //Cancel order
    Route::patch('/admin/order/{order}/cancel', [AdminViewOrderController::class, 'cancel'])->name('adminorder.cancel');

    //Confirm refund
    Route::patch('/admin/order/{returnItem}/confirm', [AdminViewOrderController::class, 'confirmRefund'])->name('adminrefund.confirm');
    //Reject refund
    Route::patch('/admin/order/{returnItem}/reject', [AdminViewOrderController::class, 'rejectRefund'])->name('adminrefund.reject');


});

