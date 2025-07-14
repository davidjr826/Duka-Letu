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
    public function dashboard() {
        return view('admin.dashboard');
    }
    public function products() {
        return view('admin.products');
    }
}
