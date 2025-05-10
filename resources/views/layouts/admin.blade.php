<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Blitar Travel Budget') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-10" id="sidebar">
        <div class="p-4 border-b border-gray-700">
            <div class="flex items-center space-x-3">
                <img src="https://img.icons8.com/fluency/48/worldwide-location.png" alt="Logo" class="w-10 h-10">
                <div>
                    <h2 class="text-lg font-semibold">Admin Panel</h2>
                    <p class="text-xs text-gray-400">Blitar Travel Budget</p>
                </div>
            </div>
        </div>
        
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 py-2 px-3 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }} transition-colors">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <i class="fas fa-tachometer-alt"></i>
                        </span>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.tourisms.index') }}" class="flex items-center space-x-3 py-2 px-3 rounded-md {{ request()->routeIs('admin.tourisms*') ? 'bg-gray-700' : 'hover:bg-gray-700' }} transition-colors">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <span>Destinasi Wisata</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.transportations.index') }}" class="flex items-center space-x-3 py-2 px-3 rounded-md {{ request()->routeIs('admin.transportations*') ? 'bg-gray-700' : 'hover:bg-gray-700' }} transition-colors">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <i class="fas fa-bus"></i>
                        </span>
                        <span>Transportasi</span>
                    </a>
                </li>
                
                <li class="pt-6 border-t border-gray-700">
                    <a href="{{ route('map') }}" class="flex items-center space-x-3 py-2 px-3 rounded-md hover:bg-gray-700 transition-colors">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span>Kembali ke Web</span>
                    </a>
                </li>
                
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 py-2 px-3 rounded-md hover:bg-gray-700 transition-colors text-left">
                            <span class="w-5 h-5 flex items-center justify-center">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Content -->
    <div class="md:ml-64 flex-1">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="container mx-auto p-4 flex items-center justify-between">
                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-700 focus:outline-none" id="sidebar-toggle">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <h1 class="text-lg font-medium text-gray-800">@yield('header', 'Dashboard')</h1>
                
                <div class="flex items-center space-x-3">
                    <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        <!-- Main content -->
        <main class="container mx-auto p-4">
            @if(session('success'))
                <div class="alert alert-success mb-6">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger mb-6">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
    
    <!-- Additional scripts -->
    @stack('scripts')
</body>
</html> 