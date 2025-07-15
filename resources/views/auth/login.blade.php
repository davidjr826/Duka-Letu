@extends('layouts.preloader')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Duka Letu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Flasher Notyf CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@flasher/flasher-notyf@1.2.4/dist/flasher-notyf.min.css">
    <style>
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .error-input {
            border-color: #ef4444;
            background-color: #fef2f2;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-6 md:p-12 shadow-xl rounded-xl flex gap-8 items-center max-w-5xl w-full">
        
        <!-- Login Form -->
        <div class="w-full md:w-1/2">
            <form method="POST" action="{{ route('authenticate') }}" class="space-y-6" id="loginForm">
                @csrf
                <h2 class="text-2xl font-bold text-center">Sign in</h2>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium mb-1" for="username">Username / Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-person text-md text-black px-3"></i>
                        </span>
                        <input type="text" name="login" id="username" required
                            class="pl-10 w-full rounded-md bg-gray-200 py-2 px-3 outline-none focus:ring-2 ring-blue-500"/>
                    </div>
                    <p id="username-error" class="error-message hidden"></p>
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
                        <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 password-toggle">
                            <span class="eye-open">👁️</span>
                            <span class="eye-closed hidden">👁️</span>
                        </button>
                    </div>
                    <p id="password-error" class="error-message hidden"></p>
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-gray-600 text-white py-2 rounded-md hover:bg-gray-700">
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

    <!-- Flasher Noty JS -->
    <script src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.2.4/dist/flasher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@flasher/flasher-notyf@1.2.4/dist/flasher-notyf.min.js"></script>

    <script>
        // Password toggle functionality
        document.querySelector('.password-toggle').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = this.querySelector('.eye-open');
            const eyeClosed = this.querySelector('.eye-closed');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        });

        // Form validation with Flasher Noty
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset previous errors
            document.querySelectorAll('.error-message').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });
            
            document.querySelectorAll('.error-input').forEach(el => {
                el.classList.remove('error-input');
            });

            // Validate inputs
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            let isValid = true;

            // Username validation
            if (!username.value.trim()) {
                // showError(username, 'username-error', 'Username or email is required');
                flasher.notyf.error('Username or email is required');
                isValid = false;
            }

            // Password validation
            if (!password.value.trim()) {
                // showError(password, 'password-error', 'Password is required');
                flasher.notyf.error('Password is required');
                isValid = false;
            } else if (password.value.length < 4) {
                // showError(password, 'password-error', 'Password must be at least 6 characters');
                flasher.notyf.error('Password must be at least 6 characters');
                isValid = false;
            }

            If valid, submit the form
            if (isValid) {
                flasher.notyf.success('Please wait..');
                this.submit();
            }
        });

        function showError(inputElement, errorElementId, message) {
            const errorElement = document.getElementById(errorElementId);
            inputElement.classList.add('error-input');
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }

        // Display server-side flash messages
        @if(session('success'))
            flasher.notyf.success("{{ session('success') }}");
        @endif
        
        @if(session('error'))
            flasher.notyf.error("{{ session('error') }}");
        @endif
        
        @if($errors->any())
            @foreach($errors->all() as $error)
                flasher.notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>
</body>
</html>