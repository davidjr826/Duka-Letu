<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // showWelcomePage
    public function login() {
        return view('auth.login');
    }
    // Dashboard
    public function adminDashboard() {

        $user = auth()->user();
        return view('admin.dashboard', compact('user'));

    }
    public function products() {
        return view('admin.products');
    }

    public function welcome() {
        return view('admin.products');
    }

    
}
