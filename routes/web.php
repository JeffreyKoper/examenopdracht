<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/products', [ProductController::class, 'productspage'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'singleProduct'])->name('product.details');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/add_review', [ReviewController::class, 'show'])->name('review.submit');
Route::post('/add_review', [ReviewController::class, 'store'])->middleware(['auth', 'verified'])->name('review.create');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/contact/admin', [ContactController::class, 'showAdmin'])->middleware(['auth', 'verified'])->name('contact.admin');
Route::get('/contact/admin/{id}', [ContactController::class, 'showAdminReply'])->middleware(['auth', 'verified'])->name('contact.adminInfo');
Route::get('/contact/message/{id}', [ContactController::class, 'showReply'])->middleware(['auth', 'verified'])->name('contact.info');
Route::post('/contact/admin/{id}/update', [ContactController::class, 'updateAdminReply'])->name('contact.update');
Route::post('/sendMessage', [ContactController::class, 'create'])->middleware(['auth', 'verified']);

Route::post('/add_to_cart', [CartController::class, 'create'])->middleware(['auth', 'verified']);
Route::get('/cart', [CartController::class, 'cartpage'])->name('cart');
Route::post('/confirmPayment', [CartController::class, 'confirmPayment'])->name('confirm_payment');



Route::get('/dashboard', [ProfileController::class, "singleUserDashboard"])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/dashboard/user_save', [ProfileController::class, "singleUserUpdate"])->middleware(['auth', 'verified'])->name('user.update');
Route::post('/dashboard/user_delete', [ProfileController::class, "singleUserDelete"])->middleware(['auth', 'verified'])->name('user.delete');
Route::post('/dashboard/user_create', [ProfileController::class, "create"])->middleware(['auth', 'verified'])->name('user.create');

Route::get('/check_promo_code', [PromotionController::class, "checkPromoCode"])->name('check_promo_code');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
