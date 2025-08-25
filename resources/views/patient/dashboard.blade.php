<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard | Medical Booking System</title>
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
                        secondary: '#10B981',
                        lightBg: '#F0F9FF'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            width: 250px;
            transition: all 0.3s ease;
        }

        .main-content {
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                height: 100vh;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }

            .overlay.active {
                display: block;
            }
        }

        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .notification-dot {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: #EF4444;
            color: white;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .appointment-status {
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-confirmed {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .status-completed {
            background-color: #E0E7FF;
            color: #3730A3;
        }

        .status-cancelled {
            background-color: #FEE2E2;
            color: #991B1B;
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">
    <!-- Mobile overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar bg-primary text-white fixed md:relative flex flex-col flex-shrink-0">
        <!-- Logo -->
        <div class="p-5 border-b border-primaryLight">
            <div class="flex items-center">
                <i class="fas fa-heartbeat text-2xl mr-3"></i>
                <span class="text-xl font-bold">MedBooker</span>
            </div>
        </div>

        <!-- User Profile -->
        <div class="p-5 border-b border-primaryLight flex items-center">
            <div class="w-12 h-12 rounded-full bg-white text-primary flex items-center justify-center font-bold text-lg">
                JS
            </div>
            <div class="ml-3">
                <p class="font-semibold">John Smith</p>
                <p class="text-xs text-blue-100">Patient</p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex-1 p-2">
            <a href="#" class="flex items-center p-3 rounded-lg bg-primaryDark text-white mb-1">
                <i class="fas fa-home mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="flex items-center p-3 rounded-lg text-blue-100 hover:bg-primaryDark hover:text-white mb-1">
                <i class="fas fa-calendar-check mr-3"></i>
                <span>My Appointments</span>
            </a>
            <a href="#" class="flex items-center p-3 rounded-lg text-blue-100 hover:bg-primaryDark hover:text-white mb-1">
                <i class="fas fa-user-md mr-3"></i>
                <span>Doctors</span>
            </a>
            <a href="#" class="flex items-center p-3 rounded-lg text-blue-100 hover:bg-primaryDark hover:text-white mb-1">
                <i class="fas fa-prescription mr-3"></i>
                <span>Prescriptions</span>
            </a>
            <a href="#" class="flex items-center p-3 rounded-lg text-blue-100 hover:bg-primaryDark hover:text-white mb-1">
                <i class="fas fa-file-medical mr-3"></i>
                <span>Medical Records</span>
            </a>
            <a href="#" class="flex items-center p-3 rounded-lg text-blue-100 hover:bg-primaryDark hover:text-white mb-1">
                <i class="fas fa-cog mr-3"></i>
                <span>Settings</span>
            </a>
        </div>

        <!-- Logout -->
        <div class="p-5 border-t border-primaryLight">
            <a href="#" class="flex items-center text-blue-100 hover:text-white">
                <i class="fas fa-sign-out-alt mr-3"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-1 flex flex-col overflow-hidden">
        <!-- Top Header -->
        <header class="bg-white border-b border-gray-200">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center">
                    <button id="menu-toggle" class="text-gray-500 focus:outline-none md:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="ml-2 text-xl font-semibold">Patient Dashboard</h1>
                </div>

                <div class="flex items-center">
                    <!-- Notifications -->
                    <div class="relative mr-4">
                        <button class="text-gray-500 focus:outline-none">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="notification-dot">2</span>
                        </button>
                    </div>

                    <!-- New Appointment Button -->
                    <a href="#" class="bg-primary hover:bg-primaryDark text-white px-4 py-2 rounded-lg font-medium mr-4 hidden md:block">
                        <i class="fas fa-plus-circle mr-2"></i> New Appointment
                    </a>

                    <!-- User Menu -->
                    <div class="relative">
                        <button class="flex items-center focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                JS
                            </div>
                            <span class="ml-2 text-gray-700 hidden md:block">John</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-lightBg">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-primary to-primaryDark text-white rounded-xl p-6 mb-6 card-shadow">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold">Welcome, John!</h2>
                        <p class="mt-2">You have <span class="font-bold">3 upcoming appointments</span>.</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="#" class="bg-white text-primary px-4 py-2 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                            <i class="fas fa-plus-circle mr-2"></i> Book Appointment
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-xl p-5 card-shadow dashboard-card transition duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-blue-100 text-primary">
                            <i class="fas fa-calendar-check text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Upcoming Appointments</p>
                            <h3 class="text-2xl font-bold">3</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 card-shadow dashboard-card transition duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-green-100 text-secondary">
                            <i class="fas fa-stethoscope text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Doctors Visited</p>
                            <h3 class="text-2xl font-bold">5</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 card-shadow dashboard-card transition duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-amber-100 text-amber-500">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Pending Appointments</p>
                            <h3 class="text-2xl font-bold">1</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 card-shadow dashboard-card transition duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-purple-100 text-purple-500">
                            <i class="fas fa-history text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Total Appointments</p>
                            <h3 class="text-2xl font-bold">12</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Upcoming Appointments -->
                <div class="bg-white rounded-xl p-5 card-shadow">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="font-semibold text-lg">Upcoming Appointments</h3>
                        <a href="#" class="text-primary text-sm font-medium">View All</a>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Dr. Sarah Johnson</p>
                                    <p class="text-xs text-gray-500">Routine Checkup</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">10:00 AM</p>
                                <p class="text-xs text-gray-500">Oct 15, 2023</p>
                                <span class="appointment-status status-confirmed mt-1 inline-block">
                                    Confirmed
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Dr. Michael Chen</p>
                                    <p class="text-xs text-gray-500">Dental Cleaning</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">2:30 PM</p>
                                <p class="text-xs text-gray-500">Oct 18, 2023</p>
                                <span class="appointment-status status-confirmed mt-1 inline-block">
                                    Confirmed
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Dr. Emily Williams</p>
                                    <p class="text-xs text-gray-500">Consultation</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">11:15 AM</p>
                                <p class="text-xs text-gray-500">Oct 22, 2023</p>
                                <span class="appointment-status status-pending mt-1 inline-block">
                                    Pending
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Doctors -->
                <div class="bg-white rounded-xl p-5 card-shadow">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="font-semibold text-lg">My Doctors</h3>
                        <a href="#" class="text-primary text-sm font-medium">View All</a>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Dr. Robert Brown</p>
                                    <p class="text-xs text-gray-500">Last visit: 2 weeks ago</p>
                                </div>
                            </div>
                            <a href="#" class="text-primary hover:text-primaryDark">
                                <i class="fas fa-calendar-plus"></i>
                            </a>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Dr. Lisa Anderson</p>
                                    <p class="text-xs text-gray-500">Last visit: 1 month ago</p>
                                </div>
                            </div>
                            <a href="#" class="text-primary hover:text-primaryDark">
                                <i class="fas fa-calendar-plus"></i>
                            </a>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Dr. James Wilson</p>
                                    <p class="text-xs text-gray-500">Last visit: 3 months ago</p>
                                </div>
                            </div>
                            <a href="#" class="text-primary hover:text-primaryDark">
                                <i class="fas fa-calendar-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl p-5 card-shadow">
                <h3 class="font-semibold text-lg mb-5">Quick Actions</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="#" class="flex flex-col items-center p-4 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-primary flex items-center justify-center mb-2">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <span class="text-sm font-medium">Book Appointment</span>
                    </a>

                    <a href="#" class="flex flex-col items-center p-4 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                        <div class="w-12 h-12 rounded-full bg-green-100 text-secondary flex items-center justify-center mb-2">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <span class="text-sm font-medium">Find Doctors</span>
                    </a>

                    <a href="#" class="flex flex-col items-center p-4 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                        <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-500 flex items-center justify-center mb-2">
                            <i class="fas fa-prescription"></i>
                        </div>
                        <span class="text-sm font-medium">Prescriptions</span>
                    </a>

                    <a href="#" class="flex flex-col items-center p-4 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                        <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-500 flex items-center justify-center mb-2">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <span class="text-sm font-medium">Medical Records</span>
                    </a>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.getElementById('overlay').classList.toggle('active');
        });

        // Close sidebar when clicking overlay
        document.getElementById('overlay').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        });
    </script>
</body>
</html>
