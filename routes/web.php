<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('cars/{car}/rent', [CarController::class, 'rent'])->name('cars.rent');
    Route::resource('cars', CarController::class);

    Route::get('payment-received/{rent}', PaymentController::class)->name('payment_received');
    Route::get('rents', RentController::class)->name('rents.index');
    Route::resource('rates', RateController::class)->only('create', 'store');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('banned/{user}', [UserController::class, 'banned'])->name('users.banned');
    Route::get('unbanned/{user}', [UserController::class, 'unbanned'])->name('users.unbanned');
});

require __DIR__ . '/auth.php';
