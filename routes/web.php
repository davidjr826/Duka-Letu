<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

// Public routes
// Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});

// Authentication routes
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes (all roles)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [HomeController::class, 'updateProfile'])->name('profile.update');
    
    // Dashboard route that redirects based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'manager' => redirect()->route('reports'),
            default => redirect()->route('profile'),
        };
    })->name('dashboard');
});

// Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [HomeController::class, 'users'])->name('users');
    Route::post('/admin/users/create', [HomeController::class, 'createUser'])->name('users.create');
    Route::post('/admin/users/update/{id}', [HomeController::class, 'updateUser'])->name('users.update');
    Route::delete('/admin/users/delete/{id}', [HomeController::class, 'deleteUser'])->name('users.delete');
    Route::get('/admin/products', [HomeController::class, 'products'])->name('products');
});

// Manager-only routes
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/reports', [HomeController::class, 'reports'])->name('reports');
    Route::post('/manager/reports/generate', [HomeController::class, 'generateReport'])->name('reports.generate');
});