<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;

Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::middleware(['web', 'App\Http\Middleware\SetLocale'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('animals', AnimalController::class);
        Route::post('/animals/{animal}/inquire', [AnimalController::class, 'inquire'])->name('animals.inquire');
    });
});
