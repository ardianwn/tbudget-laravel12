@extends('layouts.app')

@section('title', $tourism->name)

@section('content')
<div class="container w-[85%] mx-auto px-4 py-8">
    <!-- Back Button & Header -->
    <div class="mb-8">
        <a href="{{ route('destinations') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke daftar destinasi
        </a>
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight">{{ $tourism->name }}</h1>
                <div class="flex items-center mt-3 space-x-3">
                    <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-medium">
                        {{ ucfirst($tourism->type) }}
                    </span>
                    <span class="text-gray-600 flex items-center">
                        <i class="fas fa-map-marker-alt mr-1.5 text-gray-400"></i> 
                        {{ $tourism->location ?? 'Blitar' }}
                    </span>
                </div>
            </div>
            
            <div class="flex items-center space-x-2">
                <span class="text-yellow-500 text-xl">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas {{ $i <= ($tourism->rating ?? 4) ? 'fa-star' : 'fa-star-half-alt' }}"></i>
                    @endfor
                </span>
                <span class="text-gray-600 font-medium">{{ number_format($tourism->rating ?? 4.5, 1) }}</span>
            </div>
        </div>
    </div>
    
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="w-full lg:w-2/3">
            <!-- Image Gallery -->
            <div class="mb-8 rounded-xl overflow-hidden shadow-md">
                <div class="relative h-80 md:h-96 bg-gray-100 rounded-t-xl overflow-hidden">
                    <img src="{{ $tourism->image ? asset('storage/' . $tourism->image) : 'https://source.unsplash.com/1200x800/?'.urlencode($tourism->type).','.urlencode('tourism') }}" 
                         alt="{{ $tourism->name }}" 
                         class="w-full h-full object-cover transition-opacity duration-300 hover:opacity-95">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-4">
                        <p class="text-white font-medium">{{ $tourism->short_description ?? 'Destinasi wisata di Blitar' }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-2 p-2 bg-white rounded-b-xl">
                    @foreach($tourism->galleries as $gallery)
                        <div class="h-20 md:h-24 bg-gray-200 rounded overflow-hidden cursor-pointer hover:opacity-90 transition-opacity">
                            <img src="{{ asset('storage/' . $gallery->image) }}" 
                                 alt="{{ $tourism->name }} Gallery {{ $loop->iteration }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    @endforeach
                    @for ($i = $tourism->galleries->count() + 1; $i <= 4; $i++)
                        <div class="h-20 md:h-24 bg-gray-200 rounded overflow-hidden cursor-pointer hover:opacity-90 transition-opacity">
                            <img src="https://source.unsplash.com/300x200/?{{ urlencode($tourism->type) }},{{ urlencode('tourism') }},{{ $i }}" 
                                 alt="{{ $tourism->name }} {{ $i }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    @endfor
                </div>
            </div>
            
            <!-- Description -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Tentang {{ $tourism->name }}</h2>
                </div>
                <div class="p-6">
                    <div class="prose max-w-none text-gray-700">
                        <p class="mb-4">{{ $tourism->description ?? 'Tidak ada deskripsi yang tersedia untuk destinasi wisata ini.' }}</p>
                        
                        @if(!empty($tourism->history))
                            <h3 class="text-lg font-semibold mt-6 mb-3 text-gray-800">Sejarah</h3>
                            <p class="mb-4">{{ $tourism->history }}</p>
                        @endif
                        
                        @if(!empty($tourism->cultural_significance))
                            <h3 class="text-lg font-semibold mt-6 mb-3 text-gray-800">Nilai Budaya</h3>
                            <p>{{ $tourism->cultural_significance }}</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Facilities -->
            @if(!empty($tourism->facilities))
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="border-b border-gray-100 px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-800">Fasilitas</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($tourism->facilities as $facility)
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3 flex-shrink-0"></i>
                                    <span class="text-gray-700">{{ $facility }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Reviews -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <div class="border-b border-gray-100 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Ulasan Pengunjung</h2>
                    <div class="flex items-center space-x-2">
                        <div class="text-yellow-500 text-xl">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= ($tourism->rating ?? 0) ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                            @endfor
                        </div>
                        <span class="font-medium">{{ number_format($tourism->rating ?? 0, 1) }}/5</span>
                    </div>
                </div>
                <div class="p-6">
                    @auth
                        <!-- Review Form -->
                        <div class="mb-8 border-b border-gray-100 pb-8">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Tulis Ulasan Anda</h3>
                            <form action="/destinations/{{ $tourism->id }}/reviews" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                    <div class="flex items-center space-x-2" id="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="rating" value="{{ $i }}" class="hidden rating-input" required>
                                                <i class="fas fa-star text-2xl text-gray-300 star-icon hover:text-yellow-500 transition-colors"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Ulasan Anda</label>
                                    <textarea id="content" name="content" rows="4" 
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                                            placeholder="Bagikan pengalaman Anda mengunjungi tempat ini..." required minlength="10"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Ulasan
                                </button>
                            </form>
                        </div>
                    @endauth

                    <!-- Reviews List -->
                    @if($tourism->reviews && $tourism->reviews->count() > 0)
                        <div class="space-y-6">
                            @foreach($tourism->reviews as $review)
                                <div class="pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold">
                                                {{ substr($review->user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="font-medium text-gray-800">{{ $review->user->name }}</h4>
                                                <span class="text-sm text-gray-500">{{ $review->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div class="text-yellow-500">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                                @endfor
                                            </div>
                                            @if(auth()->id() === $review->user_id)
                                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-gray-700">{{ $review->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-comment-alt text-gray-400 text-xl"></i>
                            </div>
                            <p class="text-gray-500 mb-4">Belum ada ulasan untuk destinasi ini.</p>
                            
                            @guest
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    Login untuk menulis ulasan
                                </a>
                            @endguest
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="w-full lg:w-1/3">
            <!-- Quick Info -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h3 class="font-semibold text-gray-800">Informasi Tiket</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-ticket-alt mr-3 text-blue-500"></i>
                                <span>Harga Tiket</span>
                            </div>
                            <span class="font-medium">
                                @if($tourism->entrance_fee == 0)
                                    <span class="text-green-600">Gratis</span>
                                @else
                                    Rp {{ number_format($tourism->entrance_fee, 0, ',', '.') }}
                                @endif
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-clock mr-3 text-blue-500"></i>
                                <span>Jam Buka</span>
                            </div>
                            <span class="font-medium">{{ $tourism->opening_hours ?? '08:00 - 17:00' }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-calendar-alt mr-3 text-blue-500"></i>
                                <span>Hari Buka</span>
                            </div>
                            <span class="font-medium">{{ $tourism->open_days ?? 'Setiap hari' }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-hourglass-half mr-3 text-blue-500"></i>
                                <span>Durasi Kunjungan</span>
                            </div>
                            <span class="font-medium">{{ $tourism->visit_duration ?? '±2 jam' }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('map') }}?highlight={{ $tourism->id }}" class="btn btn-secondary w-full flex items-center justify-center">
                            <i class="fas fa-map-marked-alt mr-2"></i> Lihat di Peta
                        </a>
                        
                        @auth
                            <button type="button" class="btn btn-primary w-full flex items-center justify-center" onclick="openTravelPlanModal()">
                                <i class="fas fa-plus mr-2"></i> Tambahkan ke Rencana
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block text-center text-sm text-blue-600 hover:text-blue-800 mt-2">
                                Login untuk menambahkan ke rencana perjalanan
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            
            <!-- Location -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h3 class="font-semibold text-gray-800">Lokasi</h3>
                </div>
                <div class="p-0 overflow-hidden">
                    <div class="h-48 bg-gray-200" id="minimap"></div>
                    <div class="p-4">
                        <p class="text-gray-600 flex items-start">
                            <i class="fas fa-map-marker-alt text-red-500 mr-3 mt-1 flex-shrink-0"></i>
                            {{ $tourism->address ?? 'Alamat tidak tersedia' }}
                        </p>
                        
                        <div class="mt-4">
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($tourism->name . ' Blitar') }}" 
                               target="_blank" 
                               class="btn btn-outline-primary w-full flex items-center justify-center">
                                <i class="fas fa-directions mr-2"></i> Petunjuk Arah
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Nearby -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h3 class="font-semibold text-gray-800">Destinasi Terdekat</h3>
                </div>
                <div class="p-6">
                    @if($nearbyTourisms && $nearbyTourisms->count() > 0)
                        <div class="space-y-4">
                            @foreach($nearbyTourisms as $nearby)
                                <a href="{{ route('destinations.show', $nearby) }}" class="flex items-start space-x-3 group">
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="{{ $nearby->image ? asset('storage/' . $nearby->image) : 'https://source.unsplash.com/100x100/?'.urlencode($nearby->type) }}" 
                                             alt="{{ $nearby->name }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800 group-hover:text-blue-600 transition-colors">{{ $nearby->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ number_format($nearby->distance, 1) }} km</p>
                                        <div class="flex items-center mt-1 space-x-2">
                                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">
                                                {{ ucfirst($nearby->type) }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                @if($nearby->entrance_fee == 0)
                                                    Gratis
                                                @else
                                                    Rp {{ number_format($nearby->entrance_fee, 0, ',', '.') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="mx-auto w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <p class="text-gray-500 text-sm">Tidak ada destinasi terdekat dalam radius 10 km</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Travel Plan Modal -->
<div id="travel-plan-modal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
            <h3 class="text-lg font-semibold">Tambahkan ke Rencana Perjalanan</h3>
            <button type="button" onclick="closeTravelPlanModal()" class="text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="p-6">
            <div class="mb-6">
                <h4 class="font-medium text-gray-800 mb-2">Pilih Rencana Perjalanan</h4>
                
                <div id="existing-plans-container" class="space-y-3 max-h-60 overflow-y-auto">
                    @if(isset($userTravelPlans) && count($userTravelPlans) > 0)
                        @foreach($userTravelPlans as $plan)
                            <div class="border border-gray-200 rounded-lg p-3 hover:bg-blue-50 transition-colors cursor-pointer" 
                                 onclick="addToExistingPlan({{ $plan->id }})">
                                <div class="flex justify-between items-start">
                                    <h5 class="font-medium text-gray-800">{{ $plan->name }}</h5>
                                    <span class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded">
                                        {{ number_format($plan->budget, 0, ',', '.') }} IDR
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    <i class="far fa-calendar-alt mr-1"></i> 
                                    {{ $plan->start_date->format('Y-m-d') }} - {{ $plan->end_date->format('Y-m-d') }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4" id="no-plans-message">
                            <p class="text-gray-500">Anda belum memiliki rencana perjalanan.</p>
                        </div>
                    @endif
                </div>
                
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <h4 class="font-medium text-gray-800 mb-2">Atau buat rencana baru</h4>
                    
                    <form id="quick-plan-form" method="POST" action="{{ route('travel-plans.quick-store') }}">
                        @csrf
                        <input type="hidden" name="tourism_id" value="{{ $tourism->id }}">
                        
                        <div class="mb-4">
                            <label for="plan-name" class="block text-gray-700 text-sm font-medium mb-1">Nama Rencana</label>
                            <input type="text" id="plan-name" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Contoh: Liburan ke Blitar" required>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="plan-start-date" class="block text-gray-700 text-sm font-medium mb-1">Tanggal Mulai</label>
                                <input type="date" id="plan-start-date" name="start_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                            </div>
                            <div>
                                <label for="plan-end-date" class="block text-gray-700 text-sm font-medium mb-1">Tanggal Selesai</label>
                                <input type="date" id="plan-end-date" name="end_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="plan-budget" class="block text-gray-700 text-sm font-medium mb-1">Budget (IDR)</label>
                            <input type="number" id="plan-budget" name="budget" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Masukkan budget perjalanan" min="0" step="10000" required>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 text-white rounded-lg px-4 py-2 font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <i class="fas fa-plus-circle mr-2"></i> Buat Rencana Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn {
        @apply px-4 py-2.5 rounded-lg font-medium transition duration-200 flex items-center justify-center;
    }
    
    .btn-primary {
        @apply bg-blue-600 text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50;
    }
    
    .btn-secondary {
        @apply bg-gray-100 text-gray-800 hover:bg-gray-200 focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50;
    }
    
    .btn-outline-primary {
        @apply border border-blue-600 text-blue-600 hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50;
    }
    
    .prose {
        @apply text-gray-700 leading-relaxed;
    }
    
    .prose h3 {
        @apply text-lg font-semibold text-gray-800 mt-6 mb-3;
    }
    
    .prose p {
        @apply mb-4;
    }
</style>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize mini map
        const map = L.map('minimap').setView(
            [{{ $tourism->latitude ?? '-8.0976' }}, {{ $tourism->longitude ?? '112.1678' }}], 
            14
        );
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Custom icon
        const icon = L.icon({
            iconUrl: 'https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/images/marker-icon.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowUrl: 'https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/images/marker-shadow.png',
            shadowSize: [41, 41]
        });
        
        const marker = L.marker(
            [{{ $tourism->latitude ?? '-8.0976' }}, {{ $tourism->longitude ?? '112.1678' }}],
            {icon: icon}
        ).addTo(map).bindPopup('<b>{{ $tourism->name }}</b>');
        
        // Set default dates for the form
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        document.getElementById('plan-start-date').value = formatDate(today);
        document.getElementById('plan-end-date').value = formatDate(tomorrow);
        
        // Default plan name based on tourism name
        document.getElementById('plan-name').value = 'Perjalanan ke {{ $tourism->name }}';

        // Rating stars functionality
        const ratingContainer = document.getElementById('rating-stars');
        if (ratingContainer) {
            const stars = ratingContainer.querySelectorAll('.star-icon');
            const inputs = ratingContainer.querySelectorAll('.rating-input');

            // Function to set stars color
            function setStarsColor(rating) {
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add('text-yellow-500');
                        star.classList.remove('text-gray-300');
                    } else {
                        star.classList.remove('text-yellow-500');
                        star.classList.add('text-gray-300');
                    }
                });
            }

            // Handle star click
            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    const rating = index + 1;
                    inputs[index].checked = true;
                    setStarsColor(rating);
                });

                // Handle hover effects
                star.addEventListener('mouseenter', () => {
                    setStarsColor(index + 1);
                });
            });

            // Reset stars on mouse leave if no rating is selected
            ratingContainer.addEventListener('mouseleave', () => {
                const selectedRating = Array.from(inputs).findIndex(input => input.checked) + 1;
                setStarsColor(selectedRating);
            });
        }
    });
    
    // Travel Plan Modal Functions
    function openTravelPlanModal() {
        document.getElementById('travel-plan-modal').classList.remove('hidden');
    }
    
    function closeTravelPlanModal() {
        document.getElementById('travel-plan-modal').classList.add('hidden');
    }
    
    function addToExistingPlan(planId) {
        // Create a form to submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/travel-plans/${planId}/add-destination`;
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Add tourism ID
        const tourismIdInput = document.createElement('input');
        tourismIdInput.type = 'hidden';
        tourismIdInput.name = 'tourism_id';
        tourismIdInput.value = '{{ $tourism->id }}';
        
        form.appendChild(csrfToken);
        form.appendChild(tourismIdInput);
        
        document.body.appendChild(form);
        
        // Show a loading overlay
        const loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        loadingOverlay.innerHTML = `
            <div class="bg-white p-4 rounded-lg shadow-xl flex items-center">
                <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mr-3"></div>
                <span>Menambahkan ke rencana perjalanan...</span>
            </div>
        `;
        document.body.appendChild(loadingOverlay);
        
        // Submit the form
        form.submit();
    }
    
    // Helper Functions
    function formatDate(date) {
        const d = new Date(date);
        let month = '' + (d.getMonth() + 1);
        let day = '' + d.getDate();
        const year = d.getFullYear();
        
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        
        return [year, month, day].join('-');
    }
    
    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
</script>
@endpush
@endsection