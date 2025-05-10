@extends('layouts.app')

@section('title', 'Tentang Kami - Blitar Travel Budget')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="relative bg-blue-600 text-white py-20 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://source.unsplash.com/1600x900/?blitar,tourism')] bg-cover bg-center opacity-20"></div>
        <div class="container w-[85%] mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Tentang Blitar Travel Budget</h1>
                <p class="text-xl text-blue-100 leading-relaxed">
                    Platform perencanaan wisata terintegrasi untuk mengeksplorasi keindahan Blitar dengan pengalaman tak terlupakan dan pengelolaan anggaran yang optimal.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container w-[85%] mx-auto px-4 py-16">
        <!-- About Us Section -->
        <div class="max-w-4xl mx-auto mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Siapa Kami?</h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-blue-500 to-green-500 mx-auto mb-6 rounded-full"></div>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    Blitar Travel Budget adalah platform digital yang didedikasikan untuk mempromosikan pariwisata Blitar sekaligus membantu wisatawan merencanakan perjalanan mereka dengan efisien. Kami menyediakan berbagai fitur canggih untuk memastikan pengalaman wisata Anda menyenangkan tanpa menguras kantong.
                </p>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Didirikan pada tahun 2025, kami telah membantu ribuan wisatawan lokal maupun mancanegara menemukan keindahan tersembunyi Blitar dan mengatur anggaran perjalanan mereka dengan tepat.
                </p>
            </div>
        </div>

        <!-- Our Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-20">
            <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-bullseye text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold">Misi Kami</h3>
                </div>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Menyediakan informasi wisata Blitar yang akurat dan terupdate</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Mempermudah perencanaan perjalanan dengan fitur lengkap</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Membantu wisatawan mengoptimalkan anggaran perjalanan</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                        <span>Mempromosikan destinasi wisata lokal Blitar</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-eye text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold">Visi Kami</h3>
                </div>
                <p class="text-gray-600 mb-4">
                    Menjadi platform perencanaan wisata terdepan di Jawa Timur yang menghubungkan wisatawan dengan kekayaan budaya dan alam Blitar.
                </p>
                <p class="text-gray-600">
                    Kami berkomitmen untuk terus mengembangkan teknologi yang memudahkan perjalanan wisatawan sekaligus mendukung pertumbuhan ekonomi lokal.
                </p>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="max-w-4xl mx-auto mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Mengapa Memilih Kami?</h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-blue-500 to-green-500 mx-auto mb-6 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-database text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Data Lengkap</h3>
                    <p class="text-gray-600 text-center">
                        Database wisata terlengkap di Blitar dengan 200+ destinasi, 150+ akomodasi, dan 100+ kuliner khas.
                    </p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-mobile-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Responsif</h3>
                    <p class="text-gray-600 text-center">
                        Platform yang dioptimalkan untuk semua perangkat, dari desktop hingga smartphone.
                    </p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-headset text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Dukungan 24/7</h3>
                    <p class="text-gray-600 text-center">
                        Tim customer service siap membantu Anda kapan saja melalui berbagai channel komunikasi.
                    </p>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-20">
            <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marked-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Peta Interaktif</h3>
                <p class="text-gray-600">
                    Navigasi mudah dengan peta digital yang menampilkan semua titik wisata, akomodasi, dan fasilitas umum di Blitar.
                </p>
            </div>

            <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calculator text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Kalkulator Budget</h3>
                <p class="text-gray-600">
                    Sistem penghitungan otomatis untuk transportasi, akomodasi, tiket masuk, dan pengeluaran lainnya.
                </p>
            </div>

            <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-route text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Rute Optimal</h3>
                <p class="text-gray-600">
                    Rekomendasi rute perjalanan berdasarkan lokasi, waktu, dan preferensi budget Anda.
                </p>
            </div>
        </div>
        <!-- Contact Section -->
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden mb-16">
            <div class="md:flex">
                <div class="md:w-1/2 bg-blue-600 p-8 text-white">
                    <h3 class="text-2xl font-bold mb-4">Hubungi Kami</h3>
                    <p class="mb-6 text-blue-100">
                        Kami selalu terbuka untuk pertanyaan, masukan, atau kerja sama. Tim kami akan merespons dalam waktu 24 jam.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium">Kantor Pusat</p>
                                <p>Jl. Wisata Blitar No. 123, Kota Blitar, Jawa Timur 66131</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium">Email</p>
                                <p>info@blitartravelbudget.com</p>
                                <p>support@blitartravelbudget.com</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium">Telepon</p>
                                <p>+62 812-3456-7890 (Customer Service)</p>
                                <p>+62 823-4567-8901 (Kerja Sama)</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-clock mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium">Jam Operasional</p>
                                <p>Senin-Jumat: 08.00-17.00 WIB</p>
                                <p>Sabtu: 08.00-15.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">Kirim Pesan</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>Pilih subjek...</option>
                                <option>Pertanyaan umum</option>
                                <option>Masukan/saran</option>
                                <option>Laporan masalah</option>
                                <option>Kerja sama bisnis</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pesan Anda</label>
                            <textarea rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection