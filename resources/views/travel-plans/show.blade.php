@extends('layouts.app')

@section('title', $travelPlan->name)

@section('content')
<div class="container w-[85%] mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $travelPlan->name }}</h1>
            <div class="flex items-center text-gray-600">
                <i class="far fa-calendar-alt mr-2"></i>
                {{ \Carbon\Carbon::parse($travelPlan->start_date)->format('d M Y') }} - 
                {{ \Carbon\Carbon::parse($travelPlan->end_date)->format('d M Y') }}
                <span class="mx-2">•</span>
                {{ \Carbon\Carbon::parse($travelPlan->start_date)->diffInDays($travelPlan->end_date) + 1 }} hari
            </div>
        </div>
        
        <div class="mt-4 md:mt-0 flex space-x-3">
            <a href="{{ route('travel-plans.edit', $travelPlan) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('travel-plans.destroy', $travelPlan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rencana ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-money-bill-wave text-green-500 mr-2"></i> Informasi Budget
            </h2>
            
            <div class="space-y-3">
                <div>
                    <p class="text-gray-600 text-sm">Total Budget:</p>
                    <p class="text-xl font-bold text-gray-800">{{ number_format($travelPlan->budget, 0, ',', '.') }} IDR</p>
                </div>
                
                <div>
                    <p class="text-gray-600 text-sm">Durasi Perjalanan:</p>
                    <p class="font-medium text-gray-800">
                        {{ \Carbon\Carbon::parse($travelPlan->start_date)->diffInDays($travelPlan->end_date) + 1 }} hari
                    </p>
                </div>
                
                <div>
                    <p class="text-gray-600 text-sm">Budget per Hari:</p>
                    <p class="font-medium text-gray-800">
                        {{ number_format($travelPlan->budget / ((\Carbon\Carbon::parse($travelPlan->start_date)->diffInDays($travelPlan->end_date)) + 1), 0, ',', '.') }} IDR
                    </p>
                </div>
            </div>
        </div>
        
        <div class="md:col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-map-marked-alt text-blue-500 mr-2"></i> Destinasi Wisata
            </h2>
            
            @if(count($travelPlan->destinations) > 0)
                <div class="space-y-4">
                    @foreach($travelPlan->destinations as $destination)
                        <div class="flex items-start border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-blue-800 font-bold">{{ $destination->order }}</span>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800">{{ $destination->tourism->name }}</h3>
                                <p class="text-gray-600 text-sm">{{ $destination->tourism->address }}</p>
                                <div class="mt-2 flex items-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                                        {{ $destination->tourism->category }}
                                    </span>
                                    <span class="mx-2 text-gray-300">•</span>
                                    <span class="text-gray-500 text-sm">
                                        <i class="fas fa-ticket-alt mr-1 text-yellow-500"></i>
                                        {{ number_format($destination->tourism->ticket_price, 0, ',', '.') }} IDR
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Belum ada destinasi yang ditambahkan.</p>
            @endif
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-route text-purple-500 mr-2"></i> Peta Rute Perjalanan
        </h2>
        
        <div id="map-container" class="h-96 rounded-lg overflow-hidden border border-gray-200">
            <div id="plan-map" class="w-full h-full"></div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map
    const map = L.map('plan-map').setView([-8.0983, 112.1681], 12); // Blitar coordinates

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Destinations data
    const destinations = @json($travelPlan->destinations);
    
    if (destinations.length > 0) {
        const markers = [];
        const routeCoordinates = [];
        
        // Add markers for each destination
        destinations.forEach(destination => {
            if (destination.tourism && destination.tourism.latitude && destination.tourism.longitude) {
                const lat = parseFloat(destination.tourism.latitude);
                const lng = parseFloat(destination.tourism.longitude);
                
                if (!isNaN(lat) && !isNaN(lng)) {
                    routeCoordinates.push([lat, lng]);
                    
                    // Create marker
                    const marker = L.marker([lat, lng]).addTo(map);
                    
                    // Create popup content
                    const popupContent = `
                        <div class="font-medium">${destination.order}. ${destination.tourism.name}</div>
                        <div class="text-sm text-gray-600">${destination.tourism.address}</div>
                        <div class="text-sm mt-1">
                            <span class="font-medium">Tiket:</span> ${destination.tourism.ticket_price.toLocaleString('id-ID')} IDR
                        </div>
                    `;
                    
                    // Add popup to marker
                    marker.bindPopup(popupContent);
                    
                    markers.push(marker);
                }
            }
        });
        
        // Add polyline for the route
        if (routeCoordinates.length > 1) {
            L.polyline(routeCoordinates, {
                color: '#4F46E5',
                weight: 3,
                opacity: 0.7,
                lineJoin: 'round'
            }).addTo(map);
        }
        
        // Fit bounds to show all markers
        if (markers.length > 0) {
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.1));
        }
    } else {
        document.getElementById('map-container').innerHTML = `
            <div class="w-full h-full flex items-center justify-center">
                <p class="text-gray-500">Tidak ada destinasi untuk ditampilkan pada peta.</p>
            </div>
        `;
    }
});
</script>
@endpush 