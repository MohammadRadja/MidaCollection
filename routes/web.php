<?php

use App\Http\Controllers\Admin\AdminBuyerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserFinishController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\PasswordReset;

// Guest Routes ==========================================================
Route::get('/', [HomeController::class, 'index'])->middleware('guest');
Route::get('home/new-product/read', [HomeController::class, 'read_product'])->middleware('guest');

Route::prefix('product')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->middleware('guest');
    Route::get('/read', [ProductController::class, 'read_product'])->middleware('guest');
    Route::get('/detail/{id}', [ProductController::class, 'show'])->middleware('guest');
    Route::post('/search', [ProductController::class, 'search'])->middleware('guest')->name('guest.search');
});

// User Routes ==========================================================
Route::prefix('my')->middleware('auth')->group(function() {
    Route::get('/home', [UserHomeController::class, 'index']);
    Route::get('/new-product/read', [UserHomeController::class, 'read_new_product']);
    Route::get('/', [UserHomeController::class, 'index']);
    
    Route::prefix('product')->group(function() {
        Route::get('/', [UserProductController::class, 'index']);
        Route::get('/read', [UserProductController::class, 'read']);
        Route::get('/detail/{id}', [UserProductController::class, 'show']);
        Route::get('/modal-cart/{id}', [UserProductController::class, 'modal_cart']);
        Route::post('/search', [UserProductController::class, 'search'])->name('search');
    });

    Route::prefix('cart')->group(function() {
        Route::get('/', [UserCartController::class, 'index']);
        Route::get('/read', [UserCartController::class, 'read']);
        Route::post('/store', [UserCartController::class, 'store'])->name('cart.store');
        Route::get('/destroy/{id}', [UserCartController::class, 'destroy']);
        Route::post('/address', [UserCartController::class, 'alamat']);
    });

    Route::prefix('order')->group(function() {
        Route::get('/', [UserOrderController::class, 'index']);
        Route::get('/read', [UserOrderController::class, 'read']);
        Route::post('/store', [UserOrderController::class, 'store']);
        Route::post('/finish/{id}', [UserOrderController::class, 'finish']);
        Route::post('/cancel/{id}', [UserOrderController::class, 'cancel']);
        Route::post('/delete/{id}', [UserOrderController::class, 'destroy']);
    });

    Route::get('/finish', [UserFinishController::class, 'index']);
    Route::get('/finish/read', [UserFinishController::class, 'read']);
});

// Admin Routes ==========================================================
Route::prefix('my')->middleware('auth')->group(function() {
    Route::get('/home', [AdminHomeController::class, 'index']);
    Route::prefix('dashboard')->group(function() {
        Route::get('/product', [AdminDashboardController::class, 'product']);
        Route::get('/products', [AdminDashboardController::class, 'getProducts']);
        Route::post('/add-product', [AdminDashboardController::class, 'store'])->name('product.store');
        Route::get('/product/show/{id}', [AdminDashboardController::class, 'show']);
        Route::get('/product/edit/{id}', [AdminDashboardController::class, 'edit']);
        Route::post('/product/update/{id}', [AdminDashboardController::class, 'update']);
        Route::delete('/product/destroy/{id}', [AdminDashboardController::class, 'destroy']);
        Route::get('/users', [AdminUserController::class, 'index']);
        Route::get('/users/read', [AdminUserController::class, 'read']);
        Route::get('/buyer', [AdminBuyerController::class, 'index']);
        Route::get('/buyer/read', [AdminBuyerController::class, 'read']);
        Route::get('/buyer/detail/{id}', [AdminBuyerController::class, 'show']);
        Route::post('/buyer/confirm/{id}', [AdminBuyerController::class, 'confirm']);
        Route::post('/buyer/reject/{id}', [AdminBuyerController::class, 'reject']);
    });
});

// Authentication Routes ==========================================================
Route::prefix('auth')->group(function() {
    Route::get('login', [AuthenticationController::class, 'showLoginForm'])->middleware('guest');
    Route::get('register', [AuthenticationController::class, 'showRegistrationForm'])->middleware('guest');
    Route::post('register', [AuthenticationController::class, 'register'])->middleware('guest');
    Route::post('login', [AuthenticationController::class, 'login'])->middleware('guest')->name('login');
    Route::post('logout', [AuthenticationController::class, 'logout'])->middleware('auth')->name('logout');

    
    Route::get('forgot-password', [AuthenticationController::class, 'showForgotPasswordForm'])->middleware('guest')->name('password.request');
    Route::post('forgot-password', [AuthenticationController::class, 'handleForgotPassword'])->middleware('guest')->name('password.email');
});
