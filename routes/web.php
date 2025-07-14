<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'login'])->name('login');
Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/products', [HomeController::class, 'products'])->name('products');
