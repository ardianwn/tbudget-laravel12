@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section - Enhanced with parallax effect -->
<section class="relative overflow-hidden min-h-screen flex items-center">
    <div class="absolute inset-0 z-0">
        <!-- Multiple background images for parallax effect -->
        <div class="absolute inset-0 bg-[url('https://source.unsplash.com/1600x900/?blitar,indonesia,panorama')] bg-cover bg-center bg-no-repeat transform group-hover:scale-105 transition-transform duration-1000"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-blue-800/60 to-black/50"></div>
    </div>
    
    <div class="container mx-auto px-6 lg:px-8 py-24 relative z-10 text-white">
        <div class="w-[85%] mx-auto animate-fade-in-up">
            <span class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 text-white py-2 px-4 rounded-full text-sm font-semibold mb-6 shadow-lg">
                <i class="fas fa-award mr-2"></i> Destinasi Terbaik 2025
            </span>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight tracking-tight">
                Temukan Keindahan <span class="text-yellow-400">Blitar</span> yang Memukau
            </h1>
            <p class="text-xl md:text-2xl opacity-90 mb-10 text-gray-100 font-light leading-relaxed">
                Rencanakan perjalanan wisata ke Blitar dengan mudah dan sesuai budget. Temukan tempat-tempat menarik dan tersembunyi di kota bersejarah ini melalui panduan lengkap kami.
            </p>
            
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('map') }}" class="btn-primary px-8 py-4 rounded-xl text-lg font-semibold shadow-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl flex items-center justify-center">
                    <i class="fas fa-map-marked-alt mr-3 text-xl"></i> Lihat Peta Wisata
                </a>
                <a href="{{ route('destinations') }}" class="btn-secondary px-8 py-4 rounded-xl text-lg font-semibold shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl flex items-center justify-center">
                    <i class="fas fa-compass mr-3 text-xl"></i> Jelajahi Destinasi
                </a>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#popular-destinations" class="text-white hover:text-yellow-300 transition-colors">
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </div>
    
    <!-- Wave SVG with animation -->
    <div class="absolute bottom-0 left-0 w-full">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full h-auto fill-current text-gray-50">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,53.3C1120,53,1280,75,1360,85.3L1440,96L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

<!-- Destinasi Populer - Enhanced card design -->
<section id="popular-destinations" class="py-20 bg-gray-50">
    <div class="container w-[85%] mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block text-blue-600 font-medium mb-3">EXPLORE BLITAR</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-5">Destinasi Populer di Blitar</h2>
            <div class="w-24 h-1.5 bg-gradient-to-r from-blue-500 to-yellow-400 mx-auto mb-6 rounded-full"></div>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                Temukan tempat wisata terbaik yang wajib dikunjungi saat di Blitar untuk pengalaman perjalanan yang tak terlupakan
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Candi Penataran -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-500 hover:shadow-2xl">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('storage/tourisms/tourism_1746544415.jpg') }}" alt="Candi Penataran"
                         class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <span class="absolute top-4 right-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white text-xs px-3 py-1 rounded-full font-semibold shadow-md">
                        <i class="fas fa-landmark mr-1"></i> Candi
                    </span>
                </div>
                <div class="bg-white p-6 relative">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Candi Penataran</h3>
                        <div class="flex items-center text-yellow-500">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-gray-600 font-medium">4.8</span>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-500 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        <span class="text-sm">Kecamatan Nglegok, Blitar</span>
                    </div>
                    <p class="text-gray-600 mb-5 line-clamp-3 leading-relaxed">
                        Candi Hindu terbesar di Jawa Timur dengan arsitektur megah dan nilai sejarah tinggi. Dibangun pada abad ke-12, menjadi bukti peradaban masa lalu yang memukau.
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <span class="text-green-600 font-bold flex items-center">
                            <i class="fas fa-ticket-alt mr-2"></i> Rp 10.000
                        </span>
                        <a href="{{ route('destinations') }}" class="text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center group transition-colors">
                            Lihat Detail <i class="fas fa-arrow-right ml-2 transform transition-transform group-hover:translate-x-1 duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Makam Bung Karno -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-500 hover:shadow-2xl">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('storage/tourisms/tourism_1746544765.png') }}" alt="Makam Bung Karno" 
                         class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <span class="absolute top-4 right-4 bg-gradient-to-r from-red-600 to-red-500 text-white text-xs px-3 py-1 rounded-full font-semibold shadow-md">
                        <i class="fas fa-history mr-1"></i> Sejarah
                    </span>
                </div>
                <div class="bg-white p-6 relative">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Makam Bung Karno</h3>
                        <div class="flex items-center text-yellow-500">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-gray-600 font-medium">4.9</span>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-500 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        <span class="text-sm">Kecamatan Sananwetan, Blitar</span>
                    </div>
                    <p class="text-gray-600 mb-5 line-clamp-3 leading-relaxed">
                        Kompleks pemakaman Presiden pertama Indonesia dengan arsitektur megah dan museum informatif. Tempat untuk mengenang jasa dan pemikiran Soekarno.
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <span class="text-green-600 font-bold flex items-center">
                            <i class="fas fa-ticket-alt mr-2"></i> Gratis
                        </span>
                        <a href="{{ route('destinations') }}" class="text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center group transition-colors">
                            Lihat Detail <i class="fas fa-arrow-right ml-2 transform transition-transform group-hover:translate-x-1 duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Pantai Tambakrejo -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg transition-all duration-500 hover:shadow-2xl">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('storage/tourisms/tourism_1746545087.jpg') }}" alt="Pemandangan Pantai Tambakrejo"
                         class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <span class="absolute top-4 right-4 bg-gradient-to-r from-teal-600 to-teal-500 text-white text-xs px-3 py-1 rounded-full font-semibold shadow-md">
                        <i class="fas fa-umbrella-beach mr-1"></i> Pantai
                    </span>
                </div>
                <div class="bg-white p-6 relative">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Pantai Tambakrejo</h3>
                        <div class="flex items-center text-yellow-500">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-gray-600 font-medium">4.7</span>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-500 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        <span class="text-sm">Kecamatan Wonotirto, Blitar</span>
                    </div>
                    <p class="text-gray-600 mb-5 line-clamp-3 leading-relaxed">
                        Pantai dengan pemandangan indah dan kuliner laut segar yang menjadi favorit wisatawan. Tempat ideal untuk menikmati sunset dan aktivitas pantai.
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <span class="text-green-600 font-bold flex items-center">
                            <i class="fas fa-ticket-alt mr-2"></i> Rp 15.000
                        </span>
                        <a href="{{ route('destinations') }}" class="text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center group transition-colors">
                            Lihat Detail <i class="fas fa-arrow-right ml-2 transform transition-transform group-hover:translate-x-1 duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-16">
            <a href="{{ route('destinations') }}" class="btn-primary px-10 py-4 rounded-xl inline-flex items-center text-lg font-semibold shadow-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                Lihat Semua Destinasi <i class="fas fa-arrow-right ml-3 text-xl"></i>
            </a>
        </div>
    </div>
</section>

<!-- Fitur Utama - Enhanced with icons and hover effects -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="container w-[85%] mx-auto px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <span class="inline-block text-blue-600 font-medium mb-3">FITUR UNGGULAN</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-5">Rencanakan Perjalanan dengan Mudah</h2>
            <div class="w-24 h-1.5 bg-gradient-to-r from-blue-500 to-yellow-400 mx-auto mb-6 rounded-full"></div>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                Fitur-fitur canggih yang membantu Anda merencanakan perjalanan wisata ke Blitar secara detail dan efisien
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Peta Interaktif -->
            <div class="group relative bg-white rounded-2xl p-8 text-center transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 border border-gray-100 hover:border-blue-100">
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-blue-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg transform transition-transform group-hover:rotate-6 group-hover:scale-110">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-blue-600 transition-colors">Peta Interaktif</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Temukan lokasi destinasi wisata, hotel, dan restoran di Blitar dengan peta interaktif yang mudah digunakan dan informatif.
                    </p>
                    <a href="{{ route('map') }}" class="inline-flex items-center text-blue-600 font-semibold group-hover:text-blue-800 transition-colors">
                        Buka Peta <i class="fas fa-chevron-right ml-2 transform transition-transform group-hover:translate-x-1 duration-300"></i>
                    </a>
                </div>
            </div>
            
            <!-- Kalkulator Budget -->
            <div class="group relative bg-white rounded-2xl p-8 text-center transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 border border-gray-100 hover:border-green-100">
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-green-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg transform transition-transform group-hover:rotate-6 group-hover:scale-110">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-green-600 transition-colors">Kalkulator Budget</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Estimasikan biaya perjalanan termasuk transportasi, akomodasi, dan tiket masuk dengan perhitungan akurat.
                    </p>
                    <a href="{{ route('map') }}" class="inline-flex items-center text-green-600 font-semibold group-hover:text-green-800 transition-colors">
                        Hitung Budget <i class="fas fa-chevron-right ml-2 transform transition-transform group-hover:translate-x-1 duration-300"></i>
                    </a>
                </div>
            </div>
            
            <!-- Rencana Perjalanan -->
            <div class="group relative bg-white rounded-2xl p-8 text-center transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 border border-gray-100 hover:border-purple-100">
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-purple-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg transform transition-transform group-hover:rotate-6 group-hover:scale-110">
                        <i class="fas fa-route"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-purple-600 transition-colors">Rencana Perjalanan</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Buat dan simpan rencana perjalanan wisata dengan rute optimal untuk pengalaman wisata yang efisien.
                    </p>
                    <a href="{{ route('map') }}" class="inline-flex items-center text-purple-600 font-semibold group-hover:text-purple-800 transition-colors">
                        Buat Rencana <i class="fas fa-chevron-right ml-2 transform transition-transform group-hover:translate-x-1 duration-300"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative elements with animation -->
    <div class="absolute top-10 left-10 w-32 h-32 bg-blue-100 rounded-full opacity-30 blur-2xl animate-float-1"></div>
    <div class="absolute bottom-10 right-10 w-40 h-40 bg-green-100 rounded-full opacity-30 blur-2xl animate-float-2"></div>
    <div class="absolute top-1/2 left-1/2 w-60 h-60 bg-yellow-100 rounded-full opacity-20 blur-3xl -translate-x-1/2 -translate-y-1/2 animate-pulse-slow"></div>
</section>

<!-- Cerita Wisatawan - Enhanced testimonial section -->
<section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50 relative overflow-hidden">
    <div class="container w-[85%] mx-auto px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <span class="inline-block text-blue-600 font-medium mb-3">TESTIMONIAL</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-5">Cerita dari Para Wisatawan</h2>
            <div class="w-24 h-1.5 bg-gradient-to-r from-blue-500 to-yellow-400 mx-auto mb-6 rounded-full"></div>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                Pengalaman mereka mengunjungi Blitar dan menggunakan aplikasi kami untuk perjalanan mereka
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Testimonial 1 -->
            <div class="group bg-white p-8 rounded-2xl shadow-lg transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-100 rounded-full opacity-10"></div>
                <div class="flex items-start mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex-shrink-0 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                        AW
                    </div>
                    <div class="ml-5">
                        <h4 class="text-xl font-bold text-gray-800">Anita Wijaya</h4>
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-600 ml-2 text-sm font-medium">5.0</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-calendar-alt mr-1"></i> April 2025
                        </p>
                    </div>
                </div>
                <div class="relative">
                    <i class="fas fa-quote-left text-blue-100 text-6xl absolute -top-2 -left-2 opacity-50"></i>
                    <p class="text-gray-600 relative z-10 leading-relaxed pl-6">
                        "Kunjungan ke Blitar sangat berkesan! Saya menggunakan aplikasi ini untuk merencanakan perjalanan dan sangat membantu. Makam Bung Karno dan Candi Penataran adalah highlight perjalanan saya. Kuliner lokalnya juga sangat enak, terutama soto dan pecel Blitar!"
                    </p>
                </div>
                <div class="mt-6 pt-6 border-t border-gray-100 flex items-center">
                    <i class="fas fa-heart text-red-500 mr-2"></i>
                    <span class="text-sm text-gray-500">12 orang menyukai ulasan ini</span>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="group bg-white p-8 rounded-2xl shadow-lg transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-green-100 rounded-full opacity-10"></div>
                <div class="flex items-start mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex-shrink-0 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                        BS
                    </div>
                    <div class="ml-5">
                        <h4 class="text-xl font-bold text-gray-800">Budi Santoso</h4>
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-500">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-600 ml-2 text-sm font-medium">4.5</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-calendar-alt mr-1"></i> Maret 2025
                        </p>
                    </div>
                </div>
                <div class="relative">
                    <i class="fas fa-quote-left text-green-100 text-6xl absolute -top-2 -left-2 opacity-50"></i>
                    <p class="text-gray-600 relative z-10 leading-relaxed pl-6">
                        "Perjalanan keluarga ke Blitar menjadi lebih mudah dengan adanya kalkulator budget di aplikasi ini. Pantai Tambakrejo sangat cocok untuk anak-anak dan suasananya sangat menyenangkan. Kami juga mengunjungi Kebun Teh Wonotirto yang pemandangannya spektakuler!"
                    </p>
                </div>
                <div class="mt-6 pt-6 border-t border-gray-100 flex items-center">
                    <i class="fas fa-heart text-red-500 mr-2"></i>
                    <span class="text-sm text-gray-500">8 orang menyukai ulasan ini</span>
                </div>
            </div>
        </div>
        
        <!-- More testimonials button -->
        <div class="text-center mt-16">
            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-lg transition-colors">
                <i class="fas fa-comment-alt mr-2"></i> Lihat Lebih Banyak Testimonial
            </a>
        </div>
    </div>
    
    <!-- Decorative elements with animation -->
    <div class="absolute top-1/4 left-1/3 w-12 h-12 bg-yellow-300 rounded-full opacity-20 animate-float-3"></div>
    <div class="absolute top-3/4 left-1/4 w-8 h-8 bg-blue-300 rounded-full opacity-20 animate-float-4"></div>
    <div class="absolute top-1/2 right-1/4 w-10 h-10 bg-green-300 rounded-full opacity-20 animate-float-5"></div>
    <div class="absolute bottom-1/4 right-1/3 w-14 h-14 bg-purple-300 rounded-full opacity-20 animate-float-6"></div>
</section>

<!-- CTA Section - Enhanced with gradient and animation -->
<section class="py-20 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white relative overflow-hidden">
    <div class="container mx-auto px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Siap Menjelajahi Keindahan Blitar?</h2>
            <p class="text-xl opacity-90 mb-10 leading-relaxed">
                Mulai rencanakan perjalanan wisata Anda sekarang dan temukan keindahan Blitar yang tersembunyi dengan panduan lengkap dari kami
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('map') }}" class="btn-secondary px-10 py-4 rounded-xl text-lg font-semibold shadow-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl flex items-center justify-center">
                    <i class="fas fa-map-marked-alt mr-3 text-xl"></i> Jelajahi Peta
                </a>
                <a href="{{ route('destinations') }}" class="btn-accent px-10 py-4 rounded-xl text-lg font-semibold shadow-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl flex items-center justify-center">
                    <i class="fas fa-compass mr-3 text-xl"></i> Temukan Destinasi
                </a>
            </div>
            
            <div class="mt-12 flex items-center justify-center space-x-4">
                <div class="flex -space-x-2">
                    <img class="w-10 h-10 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/32.jpg" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/men/75.jpg" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/68.jpg" alt="User">
                </div>
                <p class="text-blue-200 font-medium">
                    <span class="font-bold text-white">5,000+</span> wisatawan telah menggunakan aplikasi kami
                </p>
            </div>
        </div>
    </div>
    
    <!-- Decorative elements with animation -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
        <div class="absolute top-10 left-10 w-40 h-40 bg-blue-500 rounded-full opacity-20 blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-10 right-10 w-60 h-60 bg-indigo-500 rounded-full opacity-20 blur-3xl animate-pulse-slow delay-500"></div>
        <div class="absolute top-1/3 right-1/4 w-20 h-20 bg-yellow-300 rounded-full opacity-20 blur-xl animate-float-7"></div>
        <div class="absolute bottom-1/4 left-1/3 w-16 h-16 bg-white rounded-full opacity-10 blur-xl animate-float-8"></div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Custom button styles */
    .btn-primary {
        background: linear-gradient(to right, #3b82f6, #2563eb);
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background: linear-gradient(to right, #2563eb, #1d4ed8);
    }
    
    .btn-secondary {
        background: white;
        color: #1e40af;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background: #f3f4f6;
    }
    
    .btn-accent {
        background: linear-gradient(to right, #f59e0b, #f97316);
        color: #1f2937;
        transition: all 0.3s ease;
    }
    
    .btn-accent:hover {
        background: linear-gradient(to right, #f97316, #ea580c);
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    .animate-float-1 {
        animation: float 8s ease-in-out infinite;
    }
    
    .animate-float-2 {
        animation: float 7s ease-in-out infinite 1s;
    }
    
    .animate-float-3 {
        animation: float 6s ease-in-out infinite 0.5s;
    }
    
    .animate-float-4 {
        animation: float 5s ease-in-out infinite 1.5s;
    }
    
    .animate-float-5 {
        animation: float 7s ease-in-out infinite 0.7s;
    }
    
    .animate-float-6 {
        animation: float 6s ease-in-out infinite 1.2s;
    }
    
    .animate-float-7 {
        animation: float 5s ease-in-out infinite 0.3s;
    }
    
    .animate-float-8 {
        animation: float 6s ease-in-out infinite 0.9s;
    }
    
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 0.3; }
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 6s ease-in-out infinite;
    }
    
    /* Responsive refinements */
    @media (max-width: 640px) {
        .container {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        
        .text-4xl {
            font-size: 2rem;
            line-height: 2.5rem;
        }
        
        .text-5xl {
            font-size: 2.25rem;
            line-height: 2.5rem;
        }
    }
    
    /* Card hover effect */
    .card-hover-effect {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .card-hover-effect:hover {
        box-shadow: 0 14px 28px rgba(0,0,0,0.1), 0 10px 10px rgba(0,0,0,0.08);
        transform: translateY(-5px);
    }
    
    /* Line clamp for text */
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush