<?php

use App\Http\Controllers\Clients\CartController;
use App\Http\Controllers\Clients\AccountController;
use App\Http\Controllers\Clients\AuthController;
use App\Http\Controllers\Clients\CheckoutController;
use App\Http\Controllers\Clients\ContactController;
use App\Http\Controllers\Clients\ForgotPasswordController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Clients\OrderController;
use App\Http\Controllers\Clients\ProductController;
use App\Http\Controllers\Clients\ResetPasswordController;
use App\Http\Controllers\Clients\ReviewController;
use App\Http\Controllers\Clients\SearchController;
use App\Http\Controllers\Clients\WishlistController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/about', function () {
        return view('clients.pages.about');
    })->name('about');

    Route::get('/service', function () {
        return view('clients.pages.service');
    })->name('service');

    Route::get('/team', function () {
        return view('clients.pages.team');
    })->name('team');

    Route::get('/faq', function () {
        return view('clients.pages.faq');
    })->name('faq');


    //guest
    Route::middleware('guest')->group(function () {

        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('post-register');

        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('post-login');

        Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
    });


    Route::get('/activate/{token}', [AuthController::class, 'activate'])->name('activate');


    Route::middleware(['auth.custom'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::prefix('account')->group(function () {
            Route::get('/', [AccountController::class, 'index'])->name('account');
            Route::put('/update', [AccountController::class, 'update'])->name('account.update');
            Route::post('/change-password', [AccountController::class, 'changePassword'])->name('account.change-password');

            Route::post('/addresses', [AccountController::class, 'addAddress'])->name('account.addresses.add');
            Route::put('/addresses/{id}', [AccountController::class, 'updateDefaultAddress'])->name('account.addresses.update');
            Route::delete('/addresses/{id}', [AccountController::class, 'deleteAddress'])->name('account.addresses.delete');
        });

        //Cart
        Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
        Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
        Route::post('/cart/delete-cart', [CartController::class, 'deleteCartItem'])->name('cart.deleteItem');

        //Checkout
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::get('/checkout/get-address', [CheckoutController::class, 'getAddress'])->name('checkout.getAddress');
        Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
        Route::post('/checkout/paypal', [CheckoutController::class, 'placeOrderPaypal'])->name('checkout.placeOrderPaypal');

        //Order detail
        Route::get('/order/{id}', [OrderController::class, 'showOrder'])->name('order.show');
        Route::post('/order/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');

        //Review
        Route::post('/review', [ReviewController::class, 'createReview']);
        Route::get('/review/{product}', [ReviewController::class, 'index']);

        //Wishlist
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
        Route::post('wishlist/add', [WishlistController::class, 'addToWishList']);
        Route::post('wishlist/remove', [WishlistController::class, 'removeWishListItem']);
    });

    //Product
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');

    //Product Detail
    Route::get('/product/{slug}', [ProductController::class, 'detail'])->name('products.detail');

    //MiniCart
    Route::get('/mini-cart', [CartController::class, 'loadMiniCart'])->name('cart.mini');
    Route::post('/cart/delete', [CartController::class, 'deleteMiniCart'])->name('cart.delete');

    //Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact');

    //Search
    Route::get('/search', [SearchController::class, 'index'])->name('search');
});

require __DIR__ . '/admin.php';
