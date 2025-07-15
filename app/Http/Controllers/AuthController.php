<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        'login' => 'required|string',  // This can be either username or email
        'password' => 'required|string',
     ]);

        // Determine if the input is email or username
     $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        if (Auth::attempt([
            $field => $credentials['login'],
            'password' => $credentials['password'],
            'is_active' => true
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        else { 
        // If the user is not active, throw an exception
        if (Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']])) {
            abort(403, 'Your account is inactive. Please contact support.');
        }
        // If authentication fails, throw a validation exception


        throw ValidationException::withMessages([
        'username' => __('auth.failed'),
        'password' => __('auth.failed'),
        ]);
    }

    }

    

    public function logout(Request $request)
    {
    // Clear all authentication data
    Auth::logout();
    
    // Invalidate the session
    $request->session()->invalidate();
    
    // Regenerate CSRF token
    $request->session()->regenerateToken();
    
    // Clear browser cache and prevent caching of protected pages
    return redirect('/login')
           ->withHeaders([
               'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
               'Pragma' => 'no-cache',
               'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT',
           ]);
    }

    public function register(Request $request) {
        // Registration logic here
        return view('auth.register');
    }

}

