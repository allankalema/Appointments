<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedBook - @yield('title')</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        primaryDark: '#2563EB',
                        dark: '#1E40AF'
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .sidebar.open {
            transform: translateX(0);
        }
        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <i class="fas fa-stethoscope text-primary text-2xl mr-2"></i>
                <span class="text-xl font-bold text-primary">MedBook</span>
            </div>

            <!-- Desktop Navigation (visible on medium screens and up) -->
            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-primary transition">Home</a>
                <a href="#" class="text-gray-700 hover:text-primary transition">Doctors</a>
                <a href="#" class="text-gray-700 hover:text-primary transition">Services</a>
                <a href="#" class="text-gray-700 hover:text-primary transition">About</a>
                <a href="#" class="text-gray-700 hover:text-primary transition">Contact</a>
            </div>

            <!-- Auth Buttons (visible when not logged in) -->
            <div id="authButtons" class="hidden md:flex space-x-4">
                <a href="{{ route('login') }}" class="bg-white text-primary border border-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition">Sign In</a>
                <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primaryDark transition">Sign Up</a>
            </div>

            <!-- Profile Dropdown (visible when logged in) -->
            <div id="profileDropdownContainer" class="hidden relative">
                <button id="profileDropdownButton" class="flex items-center text-gray-700 hover:text-primary focus:outline-none">
                    <i class="fas fa-user-circle text-2xl"></i>
                </button>
                <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden z-50">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"><i class="fas fa-user mr-2"></i>Profile</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"><i class="fas fa-cog mr-2"></i>Settings</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                </div>
            </div>

            <!-- Mobile menu button -->
            <button id="mobileMenuButton" class="md:hidden text-gray-700 hover:text-primary focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Sidebar -->
    <div class="sidebar fixed top-0 left-0 h-full w-64 bg-white shadow-lg z-40 md:hidden">
        <div class="p-4 border-b">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-stethoscope text-primary text-2xl mr-2"></i>
                    <span class="text-xl font-bold text-primary">MedBook</span>
                </div>
                <button id="closeSidebar" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <nav class="p-4 overflow-y-auto" style="height: calc(100% - 80px);">
            <ul class="space-y-2">
                <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-calendar-check mr-2"></i>Appointments</a></li>
                <li id="doctorsMenuItem" class="hidden"><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-user-md mr-2"></i>Doctors</a></li>
                <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-prescription mr-2"></i>Prescriptions</a></li>
                <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-file-medical mr-2"></i>Records</a></li>
                <li class="relative">
                    <button id="profileSubmenuButton" class="w-full text-left py-2 px-4 text-gray-700 hover:bg-gray-100 rounded flex justify-between items-center">
                        <span><i class="fas fa-user mr-2"></i>Profile</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <ul id="profileSubmenu" class="pl-6 mt-1 hidden">
                        <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded">View Profile</a></li>
                        <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded">Edit Profile</a></li>
                        <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded">Change Password</a></li>
                    </ul>
                </li>
                <li id="statisticsMenuItem" class="hidden"><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-chart-line mr-2"></i>Statistics</a></li>
                <li id="patientsMenuItem" class="hidden"><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-users mr-2"></i>Patients</a></li>
                <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-concierge-bell mr-2"></i>Services</a></li>
                <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-info-circle mr-2"></i>About</a></li>
                <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-phone mr-2"></i>Contact</a></li>
                <li><a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
            </ul>
        </nav>
    </div>
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

    <!-- Main Content Area -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Content block that can be overridden by extending templates -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-auto">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-heartbeat text-primary text-2xl mr-2"></i>
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
                        <button class="bg-primary px-4 py-2 rounded-r-lg hover:bg-primaryDark transition">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate user login state (in a real app, this would come from your backend)
            const isLoggedIn = false; // Change to true to see logged in state
            const userRole = 'doctor'; // Change to 'patient' to see patient view

            // Elements
            const authButtons = document.getElementById('authButtons');
            const profileDropdownContainer = document.getElementById('profileDropdownContainer');
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const closeSidebar = document.getElementById('closeSidebar');
            const sidebar = document.querySelector('.sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const profileDropdownButton = document.getElementById('profileDropdownButton');
            const profileDropdown = document.getElementById('profileDropdown');
            const profileSubmenuButton = document.getElementById('profileSubmenuButton');
            const profileSubmenu = document.getElementById('profileSubmenu');
            const doctorsMenuItem = document.getElementById('doctorsMenuItem');
            const statisticsMenuItem = document.getElementById('statisticsMenuItem');
            const patientsMenuItem = document.getElementById('patientsMenuItem');
            const defaultContent = document.getElementById('defaultContent');

            // Check if content has been provided by extending template
            const contentBlock = document.querySelector('[data-content]');
            if (contentBlock) {
                defaultContent.classList.add('hidden');
            }

            // Set initial UI state based on login status
            if (isLoggedIn) {
                authButtons.classList.add('hidden');
                profileDropdownContainer.classList.remove('hidden');

                // Show/hide menu items based on user role
                if (userRole === 'doctor') {
                    doctorsMenuItem.classList.remove('hidden');
                    statisticsMenuItem.classList.remove('hidden');
                    patientsMenuItem.classList.remove('hidden');
                }
            } else {
                authButtons.classList.remove('hidden');
                profileDropdownContainer.classList.add('hidden');
            }

            // Mobile sidebar toggle
            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.add('open');
                sidebarOverlay.classList.remove('hidden');
            });

            closeSidebar.addEventListener('click', function() {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.add('hidden');
            });

            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.add('hidden');
            });

            // Profile dropdown toggle
            profileDropdownButton.addEventListener('click', function() {
                profileDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!profileDropdownContainer.contains(event.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });

            // Profile submenu toggle in sidebar
            profileSubmenuButton.addEventListener('click', function() {
                profileSubmenu.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>
