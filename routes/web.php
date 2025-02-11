<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('landing','pages.landing.index')->name('landing');
Route::view('login','pages.auth.login')->name('login');
Route::view('dashboard','pages.dashboard.admin.dashboard')->name('dashboard');
