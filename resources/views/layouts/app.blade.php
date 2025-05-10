<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blitar Travel Budget') }} - @yield('title', 'Home')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://img.icons8.com/fluency/48/worldwide-location.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Memuat jQuery terlebih dahulu -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Memuat Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>



    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional styles -->
    @stack('styles')

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #1e293b;
            --light: #f8fafc;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        
        h1, h2, h3, h4 {
            font-family: 'Poppins', serif;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }
        
        .nav-link {
            position: relative;
            padding-bottom: 4px;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after {
            width: 100%;
        }
        
        .mobile-menu {
            transition: all 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }
        
        .mobile-menu.open {
            max-height: 500px;
        }
        
        .alert {
            transition: all 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen flex flex-col">
    <!-- Header/Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container w-[85%] mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-2 rounded-lg group-hover:rotate-12 transition-transform">
                    <img src="https://img.icons8.com/fluency/48/worldwide-location.png" alt="Logo" class="w-8 h-8">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Blitar Travel Budget</h1>
                    <p class="text-xs text-gray-500">Explore & Plan Your Blitar Adventure</p>
                </div>
            </a>
            
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-link text-gray-700 hover:text-blue-600 transition-colors font-medium">Beranda</a>
                <a href="{{ route('map') }}" class="nav-link text-gray-700 hover:text-blue-600 transition-colors font-medium">Peta Interaktif</a>
                <a href="{{ route('destinations') }}" class="nav-link text-gray-700 hover:text-blue-600 transition-colors font-medium">Destinasi Wisata</a>
                
                @auth
                    @auth
                        @unless(auth()->user()->is_admin)
                            <a href="{{ route('travel-plans.index') }}" class="nav-link text-gray-700 hover:text-blue-600 transition-colors font-medium">Rencana Saya</a>
                        @endunless
                        
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="nav-link text-gray-700 hover:text-blue-600 transition-colors font-medium">Admin</a>
                        @endif
                    @endauth
                    
                    <div class="relative group">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200">
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600 transition-colors">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary px-6 py-2 rounded-lg font-medium">Mulai Sekarang</a>
                @endauth
            </div>
            
            <!-- Mobile menu button -->
            <button class="lg:hidden text-gray-700 focus:outline-none" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </nav>
        
        <!-- Mobile menu -->
        <div class="mobile-menu lg:hidden bg-white border-t" id="mobile-menu">
            <div class="container w-[85%] mx-auto px-6 py-3 space-y-3">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-green-600 transition-colors font-medium">Beranda</a>
                <a href="{{ route('map') }}" class="block py-2 text-gray-700 hover:text-green-600 transition-colors font-medium">Peta Interaktif</a>
                <a href="{{ route('destinations') }}" class="block py-2 text-gray-700 hover:text-green-600 transition-colors font-medium">Destinasi Wisata</a>
                <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-green-600 transition-colors font-medium">Tentang Kami</a>
                
                @auth
                    @auth
                        @unless(auth()->user()->is_admin)
                            <a href="{{ route('travel-plans.index') }}" class="block py-2 text-gray-700 hover:text-green-600 transition-colors font-medium">Rencana Saya</a>
                        @endunless
                        
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="block py-2 text-gray-700 hover:text-green-600 transition-colors font-medium">Admin</a>
                        @endif
                    @endauth
                    
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 text-gray-700 hover:text-red-600 transition-colors font-medium">Logout</button>
                    </form>
                @else
                    <div class="pt-2">
                        <a href="{{ route('login') }}" class="btn btn-primary w-full text-center py-2 rounded-lg font-medium">Mulai Sekarang</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="container mx-auto px-6 mt-4 animate-fade-in">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-green-500"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="container mx-auto px-6 mt-4 animate-fade-in">
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container w-[85%] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-2 rounded-lg">
                            <img src="https://img.icons8.com/fluency/48/worldwide-location.png" alt="Logo" class="w-8 h-8">
                        </div>
                        <h3 class="text-xl font-bold">Blitar Travel Budget</h3>
                    </div>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Aplikasi untuk perencanaan wisata ke Blitar dengan mudah dan terjangkau. Temukan destinasi terbaik, buat rencana perjalanan, dan kelola budget dengan fitur canggih kami.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Navigasi</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('map') }}" class="text-gray-300 hover:text-green-300 transition-colors">Peta Wisata</a></li>
                        <li><a href="{{ route('destinations') }}" class="text-gray-300 hover:text-green-300 transition-colors">Destinasi</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-green-300 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-green-300 transition-colors">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Kontak Kami</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-green-300"></i>
                            <a href="mailto:info@blitartravel.com" class="text-gray-300 hover:text-green-300 transition-colors">info@blitartravel.com</a>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 text-green-300"></i>
                            <a href="tel:+6281234567890" class="text-gray-300 hover:text-green-300 transition-colors">+62 812-3456-7890</a>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-green-300"></i>
                            <span class="text-gray-300">Jl. Wisata Blitar No. 123, Jawa Timur</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Blitar Travel Budget. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- Mobile menu script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('open');
        });
    </script>
    
    <!-- Additional scripts -->
    @stack('scripts')
</body>
</html>