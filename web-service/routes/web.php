<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Admin\CheckupDataController;
use App\Http\Controllers\Admin\DietProgramController;
use App\Http\Controllers\Admin\ConsultationScheduleController;
use App\Http\Controllers\Admin\LlmContextController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\ProgramEnrollmentController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::redirect('/', '/login');
Route::view('landing', 'pages.landing.index')->name('landing');

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    // Route::get('/register', 'showRegister')->name('register');
    // Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Prediction Routes
    Route::controller(PredictionController::class)->prefix('predictions')->name('predictions.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'predict')->name('predict');
        Route::get('/result', 'result')->name('result');
        Route::post('/save', 'saveResult')->name('saveResult');
        Route::post('/customer', 'storeCustomer')->name('storeCustomer');
        Route::get('/cancel', 'cancelPrediction')->name('cancel');
    });

    // Program Enrollment Routes
    Route::resource('enrollments', ProgramEnrollmentController::class);
    Route::controller(ProgramEnrollmentController::class)->prefix('enrollments')->name('enrollments.')->group(function () {
        Route::get('/{enrollment}/checkup', 'createCheckup')->name('create-checkup');
        Route::post('/{enrollment}/checkup', 'storeCheckup')->name('store-checkup');
    });

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Resource Routes
    Route::resources([
        'checkups' => CheckupDataController::class,
        'diet-programs' => DietProgramController::class,
        'consultation-schedules' => ConsultationScheduleController::class,
        'llm-contexts' => LlmContextController::class,
    ]);

    // Reports Routes
    Route::controller(ReportController::class)->prefix('reports')->name('reports.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/export', 'exportPdf')->name('export');
    });

    // Account Settings Routes
    Route::controller(AccountSettingsController::class)->prefix('account')->name('account.')->group(function () {
        Route::get('/settings', 'index')->name('settings');
        Route::put('/profile', 'updateProfile')->name('profile.update');
        Route::put('/password', 'updatePassword')->name('password.update');
        Route::delete('/profile-photo', 'deleteProfilePhoto')->name('profile-photo.delete');
    });
});
