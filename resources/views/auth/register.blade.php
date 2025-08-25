@extends('base')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Doctor Booking System</title>
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

        .step-indicator {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 30px;
        }

        .step-indicator::before {
            content: '';
            position: absolute;
            height: 3px;
            width: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: #E5E7EB;
            z-index: 1;
        }

        .step {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            border: 3px solid #E5E7EB;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #9CA3AF;
            position: relative;
            z-index: 2;
        }

        .step.active {
            border-color: #3B82F6;
            background: #3B82F6;
            color: white;
        }

        .step.completed {
            border-color: #10B981;
            background: #10B981;
            color: white;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 py-8">
    <div class="absolute top-0 left-0 w-full h-1/2 bg-primary z-0"></div>

    <div class="relative z-10 w-full max-w-2xl">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center shadow-lg">
                    <i class="fas fa-user-plus text-primary text-2xl"></i>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-white">Create Account</h1>
            <p class="text-blue-100 mt-2">Join our doctor booking platform as a patient or doctor</p>
        </div>

        <!-- Registration Card -->
        <div class="bg-white rounded-xl card-shadow p-8">
            <!-- Step Indicator -->
            <div class="step-indicator mb-8">
                <div class="step active" id="step1">1</div>
                <div class="step" id="step2">2</div>
                <div class="step" id="step3">3</div>
            </div>

            <form method="POST" action="{{ route('register') }}" id="registrationForm">
                @csrf

                <!-- Step 1: Personal Information -->
                <div class="form-step active" id="formStep1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input id="first_name" name="first_name" type="text" :value="old('first_name')" required autofocus
                                    class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200"
                                    placeholder="Enter your first name">
                            </div>
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-red-500 text-xs" />
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input id="last_name" name="last_name" type="text" :value="old('last_name')" required
                                    class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200"
                                    placeholder="Enter your last name">
                            </div>
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-red-500 text-xs" />
                        </div>

                        <!-- Username -->
                        <div class="md:col-span-2">
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-at text-gray-400"></i>
                                </div>
                                <input id="username" name="username" type="text" :value="old('username')" required
                                    class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200"
                                    placeholder="Choose a username">
                            </div>
                            <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-500 text-xs" />
                        </div>

                        <!-- Phone -->
                        <div class="md:col-span-2">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input id="phone" name="phone" type="text" :value="old('phone')"
                                    class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200"
                                    placeholder="Enter your phone number">
                            </div>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-500 text-xs" />
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="button" class="next-btn bg-primary hover:bg-primaryDark text-white font-medium py-2 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Next <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Account Details -->
                <div class="form-step" id="formStep2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Role -->
                        <div class="md:col-span-2">
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">I am a</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-tag text-gray-400"></i>
                                </div>
                                <select id="role" name="role" class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200" required>
                                    <option value="">-- Select Role --</option>
                                    <option value="patient" {{ old('role') == 'patient' ? 'selected' : '' }}>Patient</option>
                                    <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-500 text-xs" />
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" :value="old('email')" required
                                    class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200"
                                    placeholder="Enter your email">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" required autocomplete="new-password"
                                    class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200"
                                    placeholder="Create a password">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                                    class="pl-10 w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:ring-2 focus:ring-primaryLight focus:border-primaryLight outline-none transition duration-200"
                                    placeholder="Confirm your password">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs" />
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" class="prev-btn bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="button" class="next-btn bg-primary hover:bg-primaryDark text-white font-medium py-2 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Next <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Review & Submit -->
                <div class="form-step" id="formStep3">
                    <div class="bg-blue-50 p-4 rounded-lg mb-6">
                        <h3 class="font-medium text-primary">Please review your information</h3>
                        <p class="text-sm text-gray-600 mt-1">Make sure all details are correct before submitting</p>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mb-6">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">First Name:</span>
                            <span id="review-first_name" class="font-medium"></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Last Name:</span>
                            <span id="review-last_name" class="font-medium"></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Username:</span>
                            <span id="review-username" class="font-medium"></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Phone:</span>
                            <span id="review-phone" class="font-medium"></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Role:</span>
                            <span id="review-role" class="font-medium"></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Email:</span>
                            <span id="review-email" class="font-medium"></span>
                        </div>
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="terms" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded" required>
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            I agree to the <a href="#" class="text-primary hover:underline">Terms of Service</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" class="prev-btn bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="submit" id="registerButton" class="bg-primary hover:bg-primaryDark text-white font-medium py-2 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary flex items-center">
                            <span id="buttonText">Create Account</span>
                            <div id="loader" class="loader hidden ml-2"></div>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Login Prompt -->
            <div class="mt-6 text-center pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary font-medium hover:text-primaryDark">Log in</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Multi-step form functionality
        document.addEventListener('DOMContentLoaded', function() {
            const formSteps = document.querySelectorAll('.form-step');
            const steps = document.querySelectorAll('.step');
            let currentStep = 0;

            // Show current step
            function showStep(stepIndex) {
                formSteps.forEach((step, index) => {
                    step.classList.toggle('active', index === stepIndex);
                });

                steps.forEach((step, index) => {
                    step.classList.remove('active', 'completed');
                    if (index < stepIndex) {
                        step.classList.add('completed');
                    } else if (index === stepIndex) {
                        step.classList.add('active');
                    }
                });
            }

            // Next button click
            document.querySelectorAll('.next-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Validate current step before proceeding
                    let isValid = true;
                    const currentInputs = formSteps[currentStep].querySelectorAll('input[required], select[required]');

                    currentInputs.forEach(input => {
                        if (!input.value.trim()) {
                            isValid = false;
                            input.classList.add('border-red-500');
                        } else {
                            input.classList.remove('border-red-500');
                        }
                    });

                    if (isValid) {
                        if (currentStep === 1) {
                            // Update review information
                            document.getElementById('review-first_name').textContent = document.getElementById('first_name').value;
                            document.getElementById('review-last_name').textContent = document.getElementById('last_name').value;
                            document.getElementById('review-username').textContent = document.getElementById('username').value;
                            document.getElementById('review-phone').textContent = document.getElementById('phone').value || 'Not provided';
                            document.getElementById('review-role').textContent = document.getElementById('role').options[document.getElementById('role').selectedIndex].text;
                            document.getElementById('review-email').textContent = document.getElementById('email').value;
                        }

                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            // Previous button click
            document.querySelectorAll('.prev-btn').forEach(button => {
                button.addEventListener('click', function() {
                    currentStep--;
                    showStep(currentStep);
                });
            });

            // Form submission
            document.getElementById('registrationForm').addEventListener('submit', function() {
                const button = document.getElementById('registerButton');
                const buttonText = document.getElementById('buttonText');
                const loader = document.getElementById('loader');

                button.disabled = true;
                buttonText.classList.add('hidden');
                loader.classList.remove('hidden');
            });
        });
    </script>
</body>
</html>

@endsection
