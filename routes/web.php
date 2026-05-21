<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\{
    HomeController,
    VehicleController,
    BookingController,
    PaymentController,
    Auth\AuthController,
    ProfileController,
    OrderController,
    NotificationController,
};
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    VehicleController as AdminVehicleController,
    OrderController as AdminOrderController,
    ReportController as AdminReportController,
    SettingController as AdminSettingController,
};

// Public Routes (Guest)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles');
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicle.details');
Route::view('/experience', 'experience')->name('experience');
Route::view('/locations', 'locations')->name('locations');
Route::view('/support', 'support')->name('support');
Route::get('/search', [VehicleController::class, 'search'])->name('search');
Route::view('/terms', 'terms')->name('terms');
Route::view('/faq', 'faq')->name('faq');
Route::view('/privacy', 'privacy')->name('privacy');

// Auth
Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', fn() => view('register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Google Auth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

// Authenticated + Active User Routes
Route::middleware(['auth', 'active'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/rentals', [ProfileController::class, 'rentals'])->name('profile.rentals');
    Route::get('/profile/favorites', [ProfileController::class, 'favorites'])->name('profile.favorites');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Inbox
    Route::get('/inbox', [NotificationController::class, 'index'])->name('inbox');
    Route::get('/inbox/{notification}', [NotificationController::class, 'show'])->name('inbox.show');
    Route::post('/inbox/{notification}/read', [NotificationController::class, 'markRead'])->name('inbox.read');
    Route::post('/inbox/read-all', [NotificationController::class, 'markAllRead'])->name('inbox.read-all');

    // Checkout & Payment views
    Route::get('/checkout/{order?}', [BookingController::class, 'checkout'])->name('checkout');
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment');

    // Booking actions
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::patch('/booking/{order}/dates', [BookingController::class, 'modifyDates'])->name('booking.modify');
    Route::post('/booking/{order}/rating', [BookingController::class, 'submitRating'])->name('booking.rating');

    // Payment actions
    Route::post('/payment/{order}/proof', [PaymentController::class, 'uploadProof'])->name('payment.upload');
    Route::post('/payment/{order}/refund', [PaymentController::class, 'requestRefund'])->name('payment.refund');
});

// Admin Routes
Route::middleware(['auth', 'active', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Vehicle Management
    Route::resource('/vehicles', AdminVehicleController::class)->names([
        'index' => 'vehicles.index',
        'create' => 'vehicles.create',
        'store' => 'vehicles.store',
        'show' => 'vehicles.show',
        'edit' => 'vehicles.edit',
        'update' => 'vehicles.update',
        'destroy' => 'vehicles.destroy',
    ]);

    // Order Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/verify-payment', [AdminOrderController::class, 'verifyPayment'])->name('orders.verify-payment');
    Route::patch('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

    // Reports & Charts
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [AdminReportController::class, 'export'])->name('reports.export');

    // System Settings / Configuration
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
