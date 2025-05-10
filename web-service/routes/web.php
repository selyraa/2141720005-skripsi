<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\ProgramEnrollmentController;
use App\Http\Controllers\Admin\CheckupDataController;
use App\Http\Controllers\Admin\ConsultationScheduleController;
use App\Http\Controllers\Admin\DietProgramController;
use App\Http\Controllers\Admin\LlmContextController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group.
|
*/

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
    // Dashboard Route - based on role
    Route::get('dashboard', function() {
        $user = Auth::user();
        if ($user->role && $user->role->name === 'pelanggan') {
            return redirect()->route('customer.dashboard');
        }
        return app(DashboardController::class)->index();
    })->name('dashboard');
    
    // Customer Routes
    Route::prefix('customer')->name('customer.')->group(function() 
    {
        Route::get('dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
    });

    // Prediction Routes
    Route::prefix('predictions')->name('predictions.')->controller(PredictionController::class)->group(function () 
    {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'predict')->name('predict');
        Route::get('/result', 'result')->name('result');
        Route::post('/save', 'saveResult')->name('saveResult');
        Route::post('/customer', 'storeCustomer')->name('storeCustomer');
        Route::get('/cancel', 'cancelPrediction')->name('cancel');
    });

    // Program Enrollment Routes
    Route::resource('enrollments', ProgramEnrollmentController::class);
    Route::prefix('enrollments')->name('enrollments.')->controller(ProgramEnrollmentController::class)->group(function () 
    {
        Route::get('/{enrollment}/checkup', 'createCheckup')->name('create-checkup');
        Route::post('/{enrollment}/checkup', 'storeCheckup')->name('store-checkup');
    });

    // Management User Routes
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
    Route::prefix('reports')->name('reports.')->controller(ReportController::class)->group(function () 
    {
        Route::get('/', 'index')->name('index');
        Route::post('/export', 'exportPdf')->name('export');
    });

    // Account Settings Routes
    Route::prefix('account')->name('account.')->controller(AccountSettingsController::class)->group(function () 
    {
        Route::get('/settings', 'index')->name('settings');
        Route::put('/profile', 'updateProfile')->name('profile.update');
        Route::put('/password', 'updatePassword')->name('password.update');
        Route::delete('/profile-photo', 'deleteProfilePhoto')->name('profile-photo.delete');
    });
});
