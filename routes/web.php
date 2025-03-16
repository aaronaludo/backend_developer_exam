<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/register', [AuthenticationController::class, 'register'])->name('register');

Route::post('/login', [AuthenticationController::class, 'loginProcess'])->name('login.process');
Route::post('/register', [AuthenticationController::class, 'registerProcess'])->name('register.process');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/edit-profile', [AccountController::class, 'editProfile'])->name('edit-profile');
    Route::get('/change-password', [AccountController::class, 'changePassword'])->name('change-password');
    
    Route::post('/edit-profile', [AccountController::class, 'editProfileProcess'])->name('edit-profile.process');
    Route::post('/change-password', [AccountController::class, 'changePasswordProcess'])->name('change-password.process');

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::get('/{id}', [ProductController::class, 'view'])->name('products.view');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/product_image/{id}', [ProductController::class, 'delete_product_image'])->name('products.delete_product_image');
        Route::post('/create', [ProductController::class, 'createProcess'])->name('products.create.process');
        Route::post('/{id}/edit', [ProductController::class, 'editProcess'])->name('products.edit.process');
        Route::delete('/{id}', [ProductController::class, 'delete'])->name('products.delete');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('/{id}', [CategoryController::class, 'view'])->name('categories.view');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/create', [CategoryController::class, 'createProcess'])->name('categories.create.process');
        Route::post('/{id}/edit', [CategoryController::class, 'editProcess'])->name('categories.edit.process');
        Route::delete('/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    });

    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});