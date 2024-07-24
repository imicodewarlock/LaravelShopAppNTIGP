<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('auth.login.show');
    Route::post('login/verify', [AuthController::class, 'login'])->name('auth.login.verify');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::prefix('dashboard')->middleware([AuthMiddleware::class])->group(function() {

    Route::get('home', function() {
        return view('dashboard.home.index');
    })->name('dashboard.index');

    // Route::resource('users', UserController::class)->middleware('role:editor,supervisor,admin');

    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('role:editor,supervisor,admin');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('role:admin');
    Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('role:admin');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('role:editor,supervisor,admin');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('role:editor,supervisor,admin');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('role:editor,supervisor,admin');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('role:editor,supervisor,admin');
    Route::post('users/activate/{user}', [UserController::class, 'activate'])->name('users.activate')->middleware('role:editor,supervisor,admin');

    // Route::resource('product-categories', ProductCategoryController::class)->middleware('role:editor,supervisor,admin');

    Route::get('product-categories', [ProductCategoryController::class, 'index'])->name('product-categories.index')->middleware('role:editor,supervisor,admin');
    Route::get('product-categories/create', [ProductCategoryController::class, 'create'])->name('product-categories.create')->middleware('role:admin');
    Route::post('product-categories', [ProductCategoryController::class, 'store'])->name('product-categories.store')->middleware('role:admin');
    Route::get('product-categories/{product_category}', [ProductCategoryController::class, 'show'])->name('product-categories.show')->middleware('role:editor,supervisor,admin');
    Route::get('product-categories/{product_category}/edit', [ProductCategoryController::class, 'edit'])->name('product-categories.edit')->middleware('role:editor,supervisor,admin');
    Route::put('product-categories/{product_category}', [ProductCategoryController::class, 'update'])->name('product-categories.update')->middleware('role:editor,supervisor,admin');
    Route::delete('product-categories/{product_category}', [ProductCategoryController::class, 'destroy'])->name('product-categories.destroy')->middleware('role:editor,supervisor,admin');
    Route::post('product-categories/activate/{product_category}', [ProductCategoryController::class, 'activate'])->name('product-categories.activate')->middleware('role:admin');

    // Route::resource('products', ProductController::class)->middleware('role:editor')->middleware('role:editor,supervisor,admin');

    Route::get('products', [ProductController::class, 'index'])->name('products.index')->middleware('role:editor,supervisor,admin');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create')->middleware('role:editor');
    Route::post('products', [ProductController::class, 'store'])->name('products.store')->middleware('role:editor');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show')->middleware('role:editor,supervisor,admin');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('role:supervisor');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('role:supervisor');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('role:editor,supervisor,admin');
    Route::post('products/activate/{product}', [ProductController::class, 'activate'])->name('products.activate')->middleware('role:editor');

    Route::get('/unauthorized', function() {
        return view('dashboard.auth.unauthorized');
    })->name('auth.unauthorized');

});

