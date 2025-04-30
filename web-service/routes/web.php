<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', action: function () {
    return view('pages.auth.login');
});

Route::view('landing', 'pages.landing.index')->name('landing');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'pages.dashboard.admin.dashboard')->name('dashboard');
    
    // Prediction Routes
    Route::get('/predictions', [PredictionController::class, 'index'])->name('predictions.index');
    Route::post('/predictions', [PredictionController::class, 'predict'])->name('predictions.predict');
    Route::get('/predictions/result', [PredictionController::class, 'result'])->name('predictions.result');
    
    // Admin Routes - User Management
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
        Route::resource('users', UserController::class);
    });
});
