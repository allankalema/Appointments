<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MedBook - Doctor Appointment Booking')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#0ea5e9',
                        accent: '#3b82f6',
                        light: '#f0f7ff',
                        dark: '#1e40af'
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero-bg {
            background: linear-gradient(rgba(37, 99, 235, 0.85), rgba(37, 99, 235, 0.9)), url('https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1932&q=80');
            background-size: cover;
            background-position: center;
        }
        .feature-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto;
        }
    </style>

    {{-- place additional head content from child views --}}
    @stack('head')
</head>
<body class="bg-gray-50">
    {{-- Header/Navigation --}}
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-stethoscope text-primary text-2xl mr-2"></i>
                <span class="text-xl font-bold text-primary">MedBook</span>
            </div>

            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-primary transition">Home</a>
                <a href="#" class="text-gray-700 hover:text-primary transition">Doctors</a>
                <a href="#" class="text-gray-700 hover:text-primary transition">Services</a>
                <a href="#" class="text-gray-700 hover:text-primary transition">About</a>
                <a href="#" class="text-gray-700 hover:text-primary transition">Contact</a>
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('login') }}" class="bg-white text-primary border border-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition">Sign In</a>

                <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-dark transition">Sign Up</a>
            </div>
        </div>
    </header>

    {{-- Main content area to be provided by child views --}}
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-stethoscope text-primary text-2xl mr-2"></i>
                        <span class="text-xl font-bold">MedBook</span>
                    </div>
                    <p class="text-gray-400">Simplifying healthcare appointment booking for doctors and patients.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Find a Doctor</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Services</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                            <span class="text-gray-400">123 Medical Ave, Health City</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-primary mr-2"></i>
                            <span class="text-gray-400">(123) 456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-primary mr-2"></i>
                            <span class="text-gray-400">info@medbook.com</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-gray-400 mb-4">Subscribe to our newsletter for updates</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-lg w-full focus:outline-none text-gray-800">
                        <button class="bg-primary px-4 py-2 rounded-r-lg hover:bg-dark transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">© 2023 MedBook. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>

    {{-- place additional scripts from child views --}}
    @stack('scripts')
</body>
</html>
