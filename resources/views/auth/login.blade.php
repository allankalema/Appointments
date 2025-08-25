@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Doctor Booking System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E40AF',
                        primaryLight: '#3B82F6',
                        primaryDark: '#1E3A8A',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .loader {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.15);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="absolute top-0 left-0 w-full h-1/2 bg-primary z-0"></div>

    <div class="relative z-10 w-full max-w-md">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center shadow-lg">
                    <i class="fas fa-user-md text-primary text-2xl"></i>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-white">Patient Login</h1>
            <p class="text-blue-100 mt-2">Access your doctor booking portal</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-xl card-shadow p-8">
            <!-- Session Status -->
            <div class="mb-6 p-3 rounded-lg bg-blue-50 text-primary text-sm">
                <x-auth-session-status class="mb-4" :status="session('status')" />
            </div>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email Address -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" name="email" type="email" :value="old('email')" required autofocus autocomplete="username"
                            class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200"
                            placeholder="Enter your email">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200"
                            placeholder="Enter your password">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-primary hover:text-primaryDark font-medium" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" id="loginButton" class="w-full bg-primary hover:bg-primaryDark text-white font-medium py-3 px-4 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary flex items-center justify-center">
                    <span id="buttonText">Log In</span>
                    <div id="loader" class="loader hidden"></div>
                </button>
            </form>

            <!-- Sign Up Prompt -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-primary font-medium hover:text-primaryDark">Sign up</a>
                </p>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="text-center mt-6">
            <p class="text-xs text-blue-100">Secure patient portal for booking doctor appointments</p>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const button = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const loader = document.getElementById('loader');

            button.disabled = true;
            buttonText.classList.add('hidden');
            loader.classList.remove('hidden');
        });
    </script>
</body>
</html>
@endsection
