<?php

use App\Http\Controllers\TourismController;
use App\Http\Controllers\TravelPlanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TourismController as AdminTourismController;
use App\Http\Controllers\Admin\TransportationController as AdminTransportationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Auth routes - mendefinisikan secara eksplisit untuk Laravel 12
Route::middleware('guest')->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    // Register
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    
    // Password Reset
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Auth routes yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
    // Email Verification
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')
        ->middleware(['signed']);
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend')
        ->middleware(['throttle:6,1']);
    
    // Password Confirmation
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::resource('travel-plans', TravelPlanController::class);
    
    // Quick travel plan creation from tourism page
    Route::post('travel-plans/quick-store', [TravelPlanController::class, 'quickStore'])->name('travel-plans.quick-store');
    
    // Add destination to existing travel plan
    Route::post('travel-plans/{travelPlan}/add-destination', [TravelPlanController::class, 'addDestination'])->name('travel-plans.add-destination');
    
    // Review routes
    Route::post('/destinations/{tourism}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Public routes
Route::get('/map', [TourismController::class, 'map'])->name('map');
Route::get('/destinations', [TourismController::class, 'index'])->name('destinations');
Route::get('/destinations/{tourism}', [TourismController::class, 'show'])->name('destinations.show');
Route::get('/tourisms', [TourismController::class, 'apiIndex']);
Route::get('/travel-plans/{travelPlan}/destinations', [TourismController::class, 'getTravelPlanDestinations']);

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tourisms', AdminTourismController::class);
    Route::resource('transportations', AdminTransportationController::class);
});
