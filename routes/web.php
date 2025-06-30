<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleAuthController;
use Symfony\Component\Routing\Loader\Configurator\Traits\LocalizedRouteTrait;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/foods', function () {
    return view('foods');
})->name('foods');

Route::get('/charity', function () {
    return view('charity');
})->name('charity');

Route::get('/activity', function(){
    return view('activity');
})->name('activity');

// CART

Route::get('/cart', [CartController::class,'show'])->name('show.cart');

Route::middleware(['auth', 'twofactor'])->group(function () {
    // DELETE SOON!
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/test', function () {
        return "You are currently authenticated!";
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('update.profile');

    Route::post('/profile-image', [AuthController::class, 'updateProfileImage'])->name('update.profile.image');

    Route::post('/login-as-restaurant', [AuthController::class, 'redirectToRestaurantLogin'])->name('login.as.restaurant');

    Route::post('/delete-account', [AuthController::class, 'deleteAccount'])->name('delete.account');

});

Route::middleware('auth')->group(function () {

    // TWO-FACTOR AUTH
    Route::get('/two-factor', [AuthController::class, 'twoFactorVerification'])->name('twofactor.verif');
    Route::post('/two-factor', [AuthController::class, 'twoFactorSubmit'])->name('twofactor.submit');
    Route::post('/two-factor-resend', [AuthController::class, 'twoFactorResend'])->name('twofactor.resend');
    
});

Route::middleware('guest')->group(function () {

    // LOCAL AUTH
    Route::get('/login', function () {
        return view('login');
    })->name('selection.login');

    Route::get('/login-customer', function () {
        return view('login-customer');
    })->name('show.login');

    Route::get('/register-customer', function () {
        return view('register-customer');
    })->name('show.register');
    
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    // GOOGLE AUTH
    Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');


    // RESTAURANTS
    Route::get('/login-restaurant', function () {
        return view('login-restaurant');
    })->name('show.login.restaurant');

    Route::get('/register-restaurant', function () {
        return view('register-restaurant');
    })->name('show.register.restaurant');

    Route::post('/login-restaurant', [AuthController::class, 'loginRestaurant'])->name('login.restaurant');
    Route::post('/register-restaurant', [AuthController::class, 'registerRestaurant'])->name('register.restaurant');

    
    // ADMIN
    Route::get('/approve-registration/{id}', [AuthController::class, 'approveRegistration'])->name('approve.registration');

});