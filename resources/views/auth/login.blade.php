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

    <div class="bg-white p-6 md:p-12 shadow-xl rounded-xl flex flex-col gap-y-8 items-center max-w-5xl w-full">
        <h1 class="text-4xl font-bold">Welcome to Duka Letu Chuo Chogo</h1>

        <div class="bg-white rounded-xl flex flex-row gap-8 items-center w-full">
            <!-- Login Form -->
            <div class="w-full md:w-1/2">
                <form method="POST" action="{{ route('authenticate') }}" class="space-y-6" id="loginForm">
                    @csrf
                    <h2 class="text-2xl font-bold text-start">Sign in</h2>

                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-medium mb-1" for="username">Username / Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-user text-md text-gray-600"></i>
                            </span>
                            <input type="text" name="login" id="username"
                                class="pl-10 w-full rounded-md bg-gray-200 py-2.5 px-3 outline-none focus:ring-2 ring-blue-500"/>
                        </div>
                        <p id="username-error" class="error-message hidden"></p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium mb-1" for="password">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fa-solid fa-lock text-gray-600"></i>
                            </span>
                            <input type="password" name="password" id="password" 
                                class="pl-10 pr-10 w-full rounded-md bg-gray-200 py-2.5 px-3 outline-none focus:ring-2 ring-blue-500"/>
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i id="toggleIcon" class="fa-solid fa-eye text-gray-600 cursor-pointer"></i>
                            </button>
                        </div>
                        <p id="password-error" class="error-message hidden"></p>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full bg-gray-600 text-white py-2.5 rounded-md hover:bg-gray-700">
                        Login
                    </button>

                    <!-- Forgot -->
                    <div class="text-left">
                        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
                    </div>
                </form>
            </div>

            <!-- Image & Welcome Text -->
            <div class="hidden md:flex md:w-1/2 flex-col items-center justify-center text-center">
                <img src="{{ asset('images/karolina.png') }}" alt="Cart" class="size-96 object-contain w-full">
            </div>
        </div>
    </div>

    <!-- Flasher Noty JS -->
    <script src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.2.4/dist/flasher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@flasher/flasher-notyf@1.2.4/dist/flasher-notyf.min.js"></script>

    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            document.querySelectorAll('.error-message').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });

            document.querySelectorAll('.error-input').forEach(el => {
                el.classList.remove('error-input');
            });

            const username = document.getElementById('username');
            const password = document.getElementById('password');
            let isValid = true;

            if (!username.value.trim()) {
                flasher.notyf.error('Username or email is required');
                isValid = false;
            }

            if (!password.value.trim()) {
                flasher.notyf.error('Password is required');
                isValid = false;
            } else if (password.value.length < 4) {
                flasher.notyf.error('Password must be at least 6 characters');
                isValid = false;
            }

            if (isValid) {
                flasher.notyf.success('Please wait..');
                this.submit();
            }
        });

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
