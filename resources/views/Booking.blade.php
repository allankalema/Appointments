<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedBook - Doctor Appointment Booking</title>
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
        body {
            font-family: 'Poppins', sans-serif;
        }
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
</head>
<body class="bg-gray-50">
    <!-- Header/Navigation -->
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

    <!-- Hero Section -->
    <section class="hero-bg text-white py-16 md:py-24">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Book Your Doctor Appointment Online</h1>
                <p class="text-xl mb-8">Find the best doctors, book appointments online, and get the healthcare you deserve - all in one place.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <button class="bg-white text-primary font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-gray-100 transition">Find a Doctor</button>
                    <button class="bg-transparent border-2 border-white text-white font-semibold px-6 py-3 rounded-lg hover:bg-white hover:text-primary transition">Learn More</button>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-full">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Book an Appointment</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Select Department</label>
                            <select class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                <option>Cardiology</option>
                                <option>Dermatology</option>
                                <option>Neurology</option>
                                <option>Pediatrics</option>
                                <option>Orthopedics</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Select Doctor</label>
                            <select class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                <option>Dr. John Smith</option>
                                <option>Dr. Emily Johnson</option>
                                <option>Dr. Michael Brown</option>
                                <option>Dr. Sarah Williams</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Date & Time</label>
                            <input type="datetime-local" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <button class="w-full bg-primary text-white font-semibold px-4 py-2 rounded-lg hover:bg-dark transition">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">How It Works</h2>
            <p class="text-gray-600 text-center max-w-2xl mx-auto mb-12">Booking your medical appointment has never been easier. Just follow these simple steps.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-light rounded-xl p-6 text-center">
                    <div class="feature-icon bg-blue-100 text-primary text-2xl mb-4">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Find a Doctor</h3>
                    <p class="text-gray-600">Search by specialty, location, or doctor name to find the right healthcare professional for you.</p>
                </div>

                <div class="bg-light rounded-xl p-6 text-center">
                    <div class="feature-icon bg-blue-100 text-primary text-2xl mb-4">
                        <i class="far fa-calendar-check"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Book Appointment</h3>
                    <p class="text-gray-600">Choose a convenient date and time from the doctor's available slots and confirm your appointment.</p>
                </div>

                <div class="bg-light rounded-xl p-6 text-center">
                    <div class="feature-icon bg-blue-100 text-primary text-2xl mb-4">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Get Treatment</h3>
                    <p class="text-gray-600">Visit the doctor at the scheduled time, receive treatment, and get on the path to better health.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Our Expert Doctors</h2>
            <p class="text-gray-600 text-center max-w-2xl mx-auto mb-12">Highly qualified professionals dedicated to providing the best healthcare services.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Doctor" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Dr. John Smith</h3>
                        <p class="text-primary">Cardiologist</p>
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-600 ml-2">4.5 (120 reviews)</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Doctor" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Dr. Emily Johnson</h3>
                        <p class="text-primary">Dermatologist</p>
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-600 ml-2">4.9 (98 reviews)</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=764&q=80" alt="Doctor" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Dr. Michael Brown</h3>
                        <p class="text-primary">Neurologist</p>
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-gray-600 ml-2">4.0 (85 reviews)</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Doctor" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Dr. Sarah Williams</h3>
                        <p class="text-primary">Pediatrician</p>
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-600 ml-2">4.7 (142 reviews)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="bg-primary text-white font-semibold px-6 py-3 rounded-lg hover:bg-dark transition">View All Doctors</button>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">What Our Patients Say</h2>
            <p class="text-gray-600 text-center max-w-2xl mx-auto mb-12">Read about experiences from our patients who have used our booking system.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-light p-6 rounded-xl">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"The booking process was incredibly smooth. I found a specialist and got an appointment the same day. Highly recommended!"</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Patient" class="w-12 h-12 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="font-semibold">Robert Johnson</h4>
                            <p class="text-primary text-sm">Patient</p>
                        </div>
                    </div>
                </div>

                <div class="bg-light p-6 rounded-xl">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"I've been using this platform for all my family's healthcare needs. It saves me so much time and the reminders are very helpful."</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1552058544-f2b08422138a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=699&q=80" alt="Patient" class="w-12 h-12 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="font-semibold">Sarah Miller</h4>
                            <p class="text-primary text-sm">Patient</p>
                        </div>
                    </div>
                </div>

                <div class="bg-light p-6 rounded-xl">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"As a busy professional, I appreciate how easy it is to book appointments outside of regular office hours. The interface is intuitive and user-friendly."</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1567532939604-b6b5b0db1604?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Patient" class="w-12 h-12 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="font-semibold">James Wilson</h4>
                            <p class="text-primary text-sm">Patient</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Book Your Appointment?</h2>
            <p class="text-lg max-w-2xl mx-auto mb-8">Join thousands of satisfied patients who have experienced seamless healthcare booking.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <button class="bg-white text-primary font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-gray-100 transition">Sign Up Now</button>
                <button class="bg-transparent border-2 border-white text-white font-semibold px-6 py-3 rounded-lg hover:bg-white hover:text-primary transition">Contact Us</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
</body>
</html>
