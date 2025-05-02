<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Admin\CheckupDataController;
use App\Http\Controllers\ProgramEnrollmentController;
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
    Route::post('/predictions/save', [PredictionController::class, 'saveResult'])->name('predictions.saveResult');
    
    // Program Enrollment Routes
    Route::get('/enrollments', [ProgramEnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('/enrollments/create', [ProgramEnrollmentController::class, 'create'])->name('enrollments.create');
    Route::post('/enrollments', [ProgramEnrollmentController::class, 'store'])->name('enrollments.store');
    Route::get('/enrollments/{enrollment}', [ProgramEnrollmentController::class, 'show'])->name('enrollments.show');
    Route::get('/enrollments/{enrollment}/edit', [ProgramEnrollmentController::class, 'edit'])->name('enrollments.edit');
    Route::put('/enrollments/{enrollment}', [ProgramEnrollmentController::class, 'update'])->name('enrollments.update');
    Route::delete('/enrollments/{enrollment}', [ProgramEnrollmentController::class, 'destroy'])->name('enrollments.destroy');
    Route::get('/enrollments/{enrollment}/checkup', [ProgramEnrollmentController::class, 'createCheckup'])->name('enrollments.create-checkup');
    Route::post('/enrollments/{enrollment}/checkup', [ProgramEnrollmentController::class, 'storeCheckup'])->name('enrollments.store-checkup');
    
    // Admin Routes - User Management
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
        Route::resource('users', UserController::class);
    });
    
    // Checkup Data Routes
    Route::resource('checkups', CheckupDataController::class);

    // Account Settings Routes
    Route::get('/account/settings', [AccountSettingsController::class, 'index'])->name('account.settings');
    Route::put('/account/profile', [AccountSettingsController::class, 'updateProfile'])->name('account.profile.update');
    Route::put('/account/password', [AccountSettingsController::class, 'updatePassword'])->name('account.password.update');
    Route::delete('/account/profile-photo', [AccountSettingsController::class, 'deleteProfilePhoto'])->name('account.profile-photo.delete');
});
