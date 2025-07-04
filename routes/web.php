<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeDishesController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TransactionController;

// UNPROTECTED ROUTES
Route::get('/', [HomeDishesController::class, 'show'])->name('home');

Route::get('/events', function () {
    return "Coming soon";
    // return view('charity');
})->name('events');

Route::get('/activity', [TransactionController::class, 'customerActivities'])->name('activity');

// CART
Route::get('/cart', [CartController::class,'show'])->name('show.cart');
Route::post('/cart/add/{food}', [CartController::class, 'store'])->name('add.cart');

Route::get('/foods', [FoodController::class, 'index'])->name('foods');

// ADMIN APPROVE RESTAURANT REGISTRATION (DELETE SOON)!
Route::get('/approve-registration/{id}', [AuthController::class, 'approveRegistration'])->name('approve.registration');

// FORGOT PASSWORD
Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// RESTAURANT
Route::get('/restaurant-home', function () {
    return view('restaurant-home');
})->name('restaurant-home');

Route::get('/restaurant-transactions', [TransactionController::class, 'index'])->name('restaurant-transactions');

Route::get('/restaurant-orders', [TransactionController::class, 'manageOrders'])->name('restaurant-orders');
Route::post('/restaurant-orders/{id}/accept', [TransactionController::class, 'acceptOrder'])->name('restaurant-orders.accept');
Route::post('/restaurant-orders/{id}/update-status', [TransactionController::class, 'updateStatus'])->name('restaurant-orders.update-status');


Route::get('/restaurant-foods', [RestaurantController::class, ('manageFood')])->name('manage.food.restaurant');
Route::post('/restaurant-foods/create', [RestaurantController::class,'store'])->name('create.food.restaurant');
Route::patch('/restaurant-foods/update/{id}', [RestaurantController::class, 'update'])->name('update.food.restaurant');
Route::delete('/restaurant-foods/delete/{id}', [RestaurantController::class, 'destroy'])->name('delete.food.restaurant');


Route::middleware(['auth', 'twofactor'])->group(function () {

    // LOGOUT
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // PROFILE
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

    // LOGIN SELECTION
    Route::get('/login', function () {
        return view('login');
    })->name('selection.login');

    // CUSTOMER LOCAL LOGIN
    Route::get('/login-customer', function () {
        return view('login-customer');
    })->name('show.login');

    // CUSTOMER LOCAL REGISTER
    Route::get('/register-customer', function () {
        return view('register-customer');
    })->name('show.register');
    
    // CUSTOMER LOCAL AUTH POST ROUTES
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    // GOOGLE AUTH (CUSTOMER ONLY)
    Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

    // RESTAURANT LOCAL LOGIN
    Route::get('/login-restaurant', function () {
        return view('login-restaurant');
    })->name('show.login.restaurant');

    // RESTAURANT LOCAL REGISTER
    Route::get('/register-restaurant', function () {
        return view('register-restaurant');
    })->name('show.register.restaurant');

    // RESTAURANT LOCAL AUTH POST ROUTES 
    Route::post('/login-restaurant', [AuthController::class, 'loginRestaurant'])->name('login.restaurant');
    Route::post('/register-restaurant', [AuthController::class, 'registerRestaurant'])->name('register.restaurant');

});
