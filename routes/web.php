<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', function () {
        return view('login');
    })->name('show.login');

    Route::get('/register', function () {
        return view('register');
    })->name('show.register');

});