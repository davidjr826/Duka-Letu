<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Flasher\Notyf\Laravel\Facade\Notyf;
use App\Http\Controllers\AuthController;
use App\Models\User;

class HomeController extends Controller
{
    // showWelcomePage
    public function login() {
        return view('auth.login');
    }

    // Dashboard
    public function adminDashboard() {
    $user = auth()->user();

    $productCount = Product::count(); // Count all products

    
    
    

    return view('admin.dashboard', compact('user', 'productCount'));
}



public function products()
{
    $user = auth()->user();
    $products = Product::select([
        'id',
        'name',
        'cost_price as buying',
        'price as selling',
        'quantity'
    ])->get();

    // Debug output - remove this after checking
    // dd($products->toArray());

    return view('admin.products', [
        'user' => $user,
        'products' => $products
    ]);
}

    public function welcome() {
        return view('admin.products');
    }

    
}
