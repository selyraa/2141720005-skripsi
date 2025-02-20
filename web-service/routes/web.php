<?php

use App\Http\Controllers\PredictionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('landing','pages.landing.index')->name('landing');
Route::view('login','pages.auth.login')->name('login');
Route::view('dashboard','pages.dashboard.admin.dashboard')->name('dashboard');

// Route::resource('predictions', PredictionController::class);

Route::get('/predictions', [PredictionController::class, 'index'])->name('predictions.index');
Route::post('/predictions', [PredictionController::class, 'predict'])->name('predictions.predict');
Route::get('/predictions/result', [PredictionController::class, 'result'])->name('predictions.result');
