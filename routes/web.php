<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\sales_reportController;
use App\Http\Controllers\inventory_reportController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\student_loanController;
use App\Http\Controllers\staff_loanController;
use App\Http\Controllers\changesController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\historyController;
use App\Http\Controllers\AuthController;

// Public routes
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
    Route::get('/admin/sales', [salesController::class, 'sales'])->name('sales');
    Route::get('/admin/new_sales', [salesController::class, 'new_sales'])->name('new_sales');
    Route::get('/admin/inventory', [inventoryController::class, 'inventory'])->name('inventory');
    Route::get('/admin/sales_report', [sales_reportController::class, 'sales_report'])->name('sales_report');
    Route::get('/admin/inventory_report', [inventory_reportController::class, 'inventory_report'])->name('inventory_report');
    Route::get('/admin/loans/staff_loan', [staff_loanController::class, 'staff_loan'])->name('staff_loan');
    Route::get('/admin/loans/student_loan', [student_loanController::class, 'student_loan'])->name('student_loan');
    Route::get('/admin/loans/changes', [changesController::class, 'changes'])->name('changes');
    Route::get('/admin/profile', [profileController::class, 'profile'])->name('profile');
    Route::get('/admin/history', [historyController::class, 'history'])->name('history');
});

// Manager-only routes
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/reports', [HomeController::class, 'reports'])->name('reports');
    Route::post('/manager/reports/generate', [HomeController::class, 'generateReport'])->name('reports.generate');
});