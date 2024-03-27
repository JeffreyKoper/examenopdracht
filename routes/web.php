<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/products', [ProductController::class, 'productspage'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'singleProduct'])->name('product.details');

Route::get('/add_review', [ReviewController::class, 'show'])->name('review.submit');
Route::post('/add_review', [ReviewController::class, 'store'])->middleware(['auth', 'verified'])->name('review.create');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/add_to_cart', [CartController::class, 'create'])->middleware(['auth', 'verified']);
Route::get('/cart', [CartController::class, 'cartpage'])->name('cart');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
