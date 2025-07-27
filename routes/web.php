<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/setting', function () {
    return view('setting');
})->middleware(['auth', 'verified'])->name('setting');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/orders/confirm/{order}', [OrderController::class, 'confirm'])->name('orders.confirm');
Route::post('/orders/cancel/{order}', [OrderController::class, 'cancel'])->name('orders.cancel');
Route::get('/auth/{provider}', [SocialController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialController::class, 'callback']);

Route::get('/books/export', [BookController::class, 'export'])->name('books.export');

Route::resource('orders', OrderController::class);
Route::resource('categories', CategoryController::class);
Route::resource('books', BookController::class);

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['vi', 'en'])) {
        session()->put('locale', $locale);
    } else {
        return redirect()->back()->with('error', 'Ngôn ngữ không hợp lệ');
    }
    return redirect()->back()->with('success', 'Đã thay đổi ngôn ngữ');
})->name('change.locale');
Route::get('/home/autocomplete', [HomeController::class, 'autocomplete'])->name('home.autocomplete');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/home/{book}', [HomeController::class, 'show'])->name('home.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/promotions', [HomeController::class, 'promotions'])->name('home.promotions');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/payment', [CartController::class, 'payment'])->name('cart.payment');

Route::get('/cart/success', [CartController::class, 'success'])->name('cart.success');



Route::get('/payment/return', [OrderController::class, 'handlePaymentReturn'])->name('payment.return');
Route::post('/payment/ipn', [OrderController::class, 'handlePaymentIPN'])->name('payment.ipn');

require __DIR__ . '/auth.php';
