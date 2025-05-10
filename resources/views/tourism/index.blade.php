@extends('layouts.app')

@section('title', 'Destinasi Wisata Blitar')

@section('content')
<div class="container w-[85%] mx-auto px-4 py-8">
    <!-- Page Header with Gradient Background -->
    <div class="bg-gradient-to-r from-blue-600 to-green-600 rounded-xl shadow-md overflow-hidden mb-8">
        <div class="p-6 md:p-8 text-white">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Destinasi Wisata Blitar</h1>
                    <p class="text-blue-100 opacity-90">Jelajahi keindahan dan kekayaan wisata Kota Blitar</p>
                </div>
                
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('map') }}" class="btn btn-white btn-with-icon">
                        <i class="fas fa-map-marked-alt mr-2"></i> Lihat Peta Wisata
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Search & Filter Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
        <form action="{{ route('destinations') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <!-- Search Input -->
            <div class="md:col-span-4">
                <label for="search" class="form-label">Cari Destinasi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" id="search" class="form-input pl-10" placeholder="Nama destinasi..." value="{{ request('search') }}">
                </div>
            </div>
            
            <!-- Type Filter -->
            <div class="md:col-span-2">
                <label for="type" class="form-label">Kategori</label>
                <select name="type" id="type" class="form-input">
                    <option value="">Semua Kategori</option>
                    <option value="tourism" {{ request('type') == 'tourism' ? 'selected' : '' }}>Umum</option>
                    <option value="park" {{ request('type') == 'park' ? 'selected' : '' }}>Taman</option>
                    <option value="historical" {{ request('type') == 'historical' ? 'selected' : '' }}>Sejarah</option>
                    <option value="beach" {{ request('type') == 'beach' ? 'selected' : '' }}>Pantai</option>
                    <option value="agrotourism" {{ request('type') == 'agrotourism' ? 'selected' : '' }}>Agrowisata</option>
                    <option value="monument" {{ request('type') == 'monument' ? 'selected' : '' }}>Monumen</option>
                    <option value="religious" {{ request('type') == 'religious' ? 'selected' : '' }}>Religi</option>
                    <option value="culinary" {{ request('type') == 'culinary' ? 'selected' : '' }}>Kuliner</option>
                    <option value="rest_area" {{ request('type') == 'rest_area' ? 'selected' : '' }}>Rest Area</option>
                    <option value="accommodation" {{ request('type') == 'accommodation' ? 'selected' : '' }}>Akomodasi</option>
                    <option value="mountain" {{ request('type') == 'mountain' ? 'selected' : '' }}>Gunung</option>
                    <option value="camping" {{ request('type') == 'camping' ? 'selected' : '' }}>Camping</option>
                    <option value="temple" {{ request('type') == 'temple' ? 'selected' : '' }}>Candi</option>
                </select>
            </div>
            
            <!-- Price Filter -->
            <div class="md:col-span-2">
                <label for="price" class="form-label">Harga Tiket</label>
                <select name="price" id="price" class="form-input">
                    <option value="">Semua Harga</option>
                    <option value="free" {{ request('price') == 'free' ? 'selected' : '' }}>Gratis</option>
                    <option value="cheap" {{ request('price') == 'cheap' ? 'selected' : '' }}>&lt; Rp 25.000</option>
                    <option value="medium" {{ request('price') == 'medium' ? 'selected' : '' }}>Rp 25.000-50.000</option>
                    <option value="expensive" {{ request('price') == 'expensive' ? 'selected' : '' }}>&gt; Rp 50.000</option>
                </select>
            </div>
            
            <!-- Sort Filter -->
            <div class="md:col-span-2">
                <label for="sort" class="form-label">Urutkan</label>
                <select name="sort" id="sort" class="form-input">
                    <option value="popular" {{ request('sort') == 'popular' || !request('sort') ? 'selected' : '' }}>Populer</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                </select>
            </div>
            
            <!-- Submit Button -->
            <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="btn btn-primary flex-1 btn-with-icon">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                @if(request()->anyFilled(['search', 'type', 'price', 'sort']))
                    <a href="{{ route('destinations') }}" class="btn btn-outline-primary aspect-square p-0 flex items-center justify-center">
                        <i class="fas fa-redo"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
    
    <!-- Destinations Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tourisms as $tourism)
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 group">
                <!-- Image with Badge -->
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $tourism->image ? asset('storage/' . $tourism->image) : 'https://source.unsplash.com/600x400/?'.urlencode($tourism->type).','.urlencode('tourism') }}" 
                         alt="{{ $tourism->name }}" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    <span class="absolute top-4 right-4 bg-white text-gray-800 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                        {{ ucfirst($tourism->type) }}
                    </span>
                </div>
                
                <!-- Card Content -->
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-800">{{ $tourism->name }}</h3>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">
                            @if($tourism->entrance_fee == 0)
                                Gratis
                            @else
                                Rp {{ number_format($tourism->entrance_fee, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $tourism->description ?? 'Deskripsi belum tersedia' }}</p>
                    
                    <!-- Facilities -->
                    @if($tourism->facilities && is_array($tourism->facilities) && count($tourism->facilities) > 0)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(array_slice($tourism->facilities, 0, 3) as $facility)
                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-1 text-xs"></i> {{ $facility }}
                            </span>
                        @endforeach
                        @if(count($tourism->facilities) > 3)
                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full">
                                +{{ count($tourism->facilities) - 3 }} lainnya
                            </span>
                        @endif
                    </div>
                @else
                    <p class="text-gray-600 text-sm mb-4">Fasilitas tidak tersedia</p>
                @endif
                
                    
                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                        <a href="{{ route('destinations.show', $tourism) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center group">
                            Detail <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                        </a>
                        
                        <a href="{{ route('map') }}?highlight={{ $tourism->id }}" class="text-gray-600 hover:text-gray-800 text-sm flex items-center">
                            <i class="fas fa-map-marker-alt mr-1"></i> Peta
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-span-full py-12 text-center">
                <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-map-marked-alt text-3xl text-blue-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada destinasi ditemukan</h3>
                <p class="text-gray-600 mb-4">Coba ubah filter pencarian Anda atau lihat peta wisata kami</p>
                
                <div class="flex justify-center space-x-3">
                    <a href="{{ route('destinations') }}" class="btn btn-outline-primary">
                        <i class="fas fa-redo mr-2"></i> Reset Filter
                    </a>
                    <a href="{{ route('map') }}" class="btn btn-primary">
                        <i class="fas fa-map-marked-alt mr-2"></i> Lihat Peta
                    </a>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Custom Pagination -->
    @if($tourisms->hasPages())
        <div class="mt-10 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan {{ $tourisms->firstItem() }} sampai {{ $tourisms->lastItem() }} dari {{ $tourisms->total() }} hasil
            </div>
            
            <div class="flex flex-wrap gap-2">
                <!-- Previous Button -->
                @if($tourisms->onFirstPage())
                    <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                        &laquo; Sebelumnya
                    </span>
                @else
                    <a href="{{ $tourisms->previousPageUrl() }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        &laquo; Sebelumnya
                    </a>
                @endif

                <!-- Page Numbers -->
                @foreach($tourisms->getUrlRange(max(1, $tourisms->currentPage() - 2), min($tourisms->currentPage() + 2, $tourisms->lastPage())) as $page => $url)
                    @if($page == $tourisms->currentPage())
                        <span class="px-4 py-2 bg-blue-600 text-white rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                <!-- Next Button -->
                @if($tourisms->hasMorePages())
                    <a href="{{ $tourisms->nextPageUrl() }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Selanjutnya &raquo;
                    </a>
                @else
                    <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                        Selanjutnya &raquo;
                    </span>
                @endif
            </div>
        </div>
    @endif
</div>

<style>
    .form-input {
        @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200;
    }
    
    .form-label {
        @apply block text-sm font-medium text-gray-700 mb-1;
    }
    
    .btn {
        @apply px-5 py-2.5 rounded-lg font-medium transition duration-200 flex items-center justify-center;
    }
    
    .btn-primary {
        @apply bg-blue-600 text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50;
    }
    
    .btn-outline-primary {
        @apply border border-blue-600 text-blue-600 hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50;
    }
    
    .btn-white {
        @apply bg-white text-gray-800 hover:bg-gray-50 focus:ring-2 focus:ring-gray-200 shadow-sm;
    }
    
    .btn-with-icon {
        @apply inline-flex items-center;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection