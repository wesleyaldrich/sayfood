<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    // DELETE SOON!
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/test', function () {
        return "You are currently authenticated!";
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', function () {
        return view('login');
    })->name('show.login');

    Route::get('/register', function () {
        return view('register');
    })->name('show.register');
    
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});