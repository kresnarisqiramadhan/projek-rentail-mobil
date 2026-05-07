<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/vehicles', function () { return view('vehicles'); })->name('vehicles');
Route::get('/experience', function () { return view('experience'); })->name('experience');
Route::get('/locations', function () { return view('locations'); })->name('locations');
Route::get('/support', function () { return view('support'); })->name('support');
Route::get('/search', function () { return view('search'); })->name('search');

// Auth Routes (Frontend only)
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/register', function () { return view('register'); })->name('register');

// Checkout & Payment
Route::get('/checkout', function () { return view('checkout'); })->name('checkout');
Route::get('/payment', function () { return view('payment'); })->name('payment');

// Profile Routes
Route::prefix('profile')->group(function () {
    Route::get('/', function () { return view('profile'); })->name('profile');
    Route::get('/rentals', function () { return view('profile.rentals'); })->name('profile.rentals');
    Route::get('/favorites', function () { return view('profile.favorites'); })->name('profile.favorites');
    Route::get('/settings', function () { return view('profile.settings'); })->name('profile.settings');
});

Route::get('/vehicles/{id}', function ($id) { return view('vehicle-details', ['id' => $id]); })->name('vehicle.details');
