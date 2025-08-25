
@extends('base')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard | Medical Booking System</title>
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
    </style>
</head>
<body class="bg-gray-100 flex h-screen">
    <!-- Mobile overlay -->
    <div class="overlay" id="overlay"></div>
    <!-- Main Content -->
    <div class="main-content flex-1 flex flex-col overflow-hidden">
        <!-- Top Header -->
        <header class="bg-white border-b border-gray-200">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center">
                    <button id="menu-toggle" class="text-gray-500 focus:outline-none md:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="ml-2 text-xl font-semibold">Doctor Dashboard</h1>
                </div>

                <div class="flex items-center">
                    <!-- Notifications -->
                    <div class="relative mr-4">
                        <button class="text-gray-500 focus:outline-none">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="notification-dot">3</span>
                        </button>
                    </div>

                    <!-- User Menu -->
                    <div class="relative">
                        <button class="flex items-center focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                            </div>
                            <span class="ml-2 text-gray-700 hidden md:block">Dr. {{ auth()->user()->first_name }}</span>
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
                        <h2 class="text-2xl font-bold">Welcome, Dr. {{ auth()->user()->first_name }}!</h2>
                        <p class="mt-2">You have <span class="font-bold">5 appointments</span> scheduled for today.</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button class="bg-white text-primary px-4 py-2 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                            View Schedule
                        </button>
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
                            <p class="text-gray-500 text-sm">Today's Appointments</p>
                            <h3 class="text-2xl font-bold">5</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 card-shadow dashboard-card transition duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-green-100 text-secondary">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Total Patients</p>
                            <h3 class="text-2xl font-bold">42</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 card-shadow dashboard-card transition duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-amber-100 text-amber-500">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Pending Actions</p>
                            <h3 class="text-2xl font-bold">3</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 card-shadow dashboard-card transition duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-purple-100 text-purple-500">
                            <i class="fas fa-star text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Satisfaction Rate</p>
                            <h3 class="text-2xl font-bold">96%</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">John Smith</p>
                                    <p class="text-xs text-gray-500">Routine Checkup</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">10:00 AM</p>
                                <p class="text-xs text-gray-500">Today</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Emma Johnson</p>
                                    <p class="text-xs text-gray-500">Consultation</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">11:30 AM</p>
                                <p class="text-xs text-gray-500">Today</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Michael Brown</p>
                                    <p class="text-xs text-gray-500">Follow-up</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">2:15 PM</p>
                                <p class="text-xs text-gray-500">Today</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Sarah Williams</p>
                                    <p class="text-xs text-gray-500">New Patient</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">4:00 PM</p>
                                <p class="text-xs text-gray-500">Today</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Patients -->
                <div class="bg-white rounded-xl p-5 card-shadow">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="font-semibold text-lg">Recent Patients</h3>
                        <a href="#" class="text-primary text-sm font-medium">View All</a>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Robert Davis</p>
                                    <p class="text-xs text-gray-500">Last visit: 2 days ago</p>
                                </div>
                            </div>
                            <button class="text-primary hover:text-primaryDark">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Jennifer Lee</p>
                                    <p class="text-xs text-gray-500">Last visit: 3 days ago</p>
                                </div>
                            </div>
                            <button class="text-primary hover:text-primaryDark">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Thomas Wilson</p>
                                    <p class="text-xs text-gray-500">Last visit: 4 days ago</p>
                                </div>
                            </div>
                            <button class="text-primary hover:text-primaryDark">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-blue-50 transition duration-150">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">Lisa Anderson</p>
                                    <p class="text-xs text-gray-500">Last visit: 5 days ago</p>
                                </div>
                            </div>
                            <button class="text-primary hover:text-primaryDark">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
@endsection
