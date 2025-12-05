<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::middleware(['check.auth.admin'])->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    });

    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth.custom'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.pages.dashboard');
        })->name('admin.dashboard');
    });

    Route::middleware(['permission:manage_users'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/user/upgrade', [UserController::class, 'upgrade']);
        Route::post('/user/updateStatus', [UserController::class, 'updateStatus']);
    });

    Route::middleware(['permission:manage_categories'])->group(function () {        
        Route::get('/categories/add', [CategoryController::class, 'showFormAddCate'])->name('admin.category.showAddCateForm');
        Route::post('/categories/add', [CategoryController::class, 'addCategory'])->name('admin.category.add');

        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::post('/categories/update', [CategoryController::class, 'updateCategory']);
        Route::post('/categories/delete', [CategoryController::class, 'deleteCategory']);
    });

    Route::middleware(['permission:manage_products'])->group(function () {        
        Route::get('/product/add', [ProductController::class, 'showFormAddProduct'])->name('admin.product.showAddProductForm');
        Route::post('/product/add', [ProductController::class, 'addProduct'])->name('admin.product.add');
        
        Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
        Route::post('/product/update', [ProductController::class, 'updateProduct']);
        Route::post('/product/delete', [ProductController::class, 'deleteProduct']);
    });

    Route::middleware(['permission:manage_orders'])->group(function () {        
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.order.index');
    });
});
