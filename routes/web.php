<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if(auth()->check()){
        return redirect()->route('dashboard');
    }
    return Inertia::render('Auth/Login');
});

Route::get('login', function () {
    return Inertia::render('Auth/Login');
})->name('login');


Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::get('logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');

    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});
