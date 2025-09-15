<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::get('/buy', [BuyController::class, 'index'])->name('buy.index');
    Route::get('/cart', [BuyController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [BuyController::class, 'add'])->name('cart.add');
    Route::post('/cart/increase/{id}', [BuyController::class, 'increaseQuantity'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [BuyController::class, 'decreaseQuantity'])->name('cart.decrease');
    Route::get('/payment-success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment-failure', [PaymentController::class, 'failure'])->name('payment.failure');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place', [CheckoutController::class, 'place'])->name('checkout.place');
});

require __DIR__ . '/auth.php';
