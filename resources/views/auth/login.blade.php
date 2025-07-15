@extends('layouts.preloader')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Duka Letu</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-6 md:p-12 shadow-xl rounded-xl flex gap-8 items-center max-w-5xl w-full">
        
        <!-- Login Form -->
        <div class="w-full md:w-1/2">
            <form method="POST" action="{{ route('authenticate') }}" class="space-y-6">
                @csrf
                <h2 class="text-2xl font-bold text-center">Sign in</h2>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium mb-1" for="email">Username / Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-person text-md text-black px-3"></i>
                        </span>
                        <input type="text" name="login" id="username" required
                            class="pl-10 w-full rounded-md bg-gray-200 py-2 px-3 outline-none focus:ring-2 ring-blue-500"/>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium mb-1" for="password">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            🔒
                        </span>
                        <input type="password" name="password" id="password" required
                               class="pl-10 pr-10 w-full rounded-md bg-gray-200 py-2 px-3 outline-none focus:ring-2 ring-blue-500"/>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                            👁️
                        </span>
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit"
                        class="w-full bg-gray-600 text-white py-2 rounded-md hover:bg-gray-700">
                    Login
                </button>

                <!-- Forgot -->
                <div class="text-right">
                    <a href="#" class="text-sm text-blue-600 hover:underline">Forget Password?</a>
                </div>
            </form>
        </div>

        <!-- Image & Welcome Text -->
        <div class="hidden md:flex md:w-1/2 flex-col items-center justify-center text-center">
            <h1 class="text-xl font-bold mb-4">Welcome to Duka Letu<br>Chuo Chogo</h1>
            <img src="{{ asset('images/login.jpg') }}" alt="Cart" class="w-64">
        </div>
    </div>

</body>
</html>
