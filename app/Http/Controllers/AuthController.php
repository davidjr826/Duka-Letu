<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Flasher\Notyf\Laravel\Facade\Notyf;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        return view('admin.dashboard');
    }


    
    //  * Handle the authentication request for user to login.
     
    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'login' => 'required|string',
        'password' => 'required|string',
    ]);

    $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
    if (Auth::attempt([
        $field => $credentials['login'],
        'password' => $credentials['password'],
        'is_active' => true
    ], $request->boolean('remember'))) {
        $request->session()->regenerate();
        // Add this line to set the success message
        $request->session()->flash('login_success', 'Welcome back! Login successful.');
        return redirect()->route('admin.dashboard');
    }
    
    // ... rest of your authentication logic ...
}

    

   public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Notyf::addSuccess('You have been logged out successfully.');
        return redirect('/');
    }

    public function register(Request $request) {
        // Registration logic here
        return view('auth.register');
    }

}

