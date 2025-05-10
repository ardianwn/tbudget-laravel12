class MapService {
    constructor(getMarkerColor) {
        this.baseUrl = '/api/map';
        this.getMarkerColor = getMarkerColor || ((type) => '#22c55e'); // Default to green if no color function provided
    }

    async getAllPoints() {
        try {
            const response = await fetch(`${this.baseUrl}/points`);
            const data = await response.json();
            console.log('Received data from API:', data);
            return data;
        } catch (error) {
            console.error('Error fetching points:', error);
            return { type: 'FeatureCollection', features: [] };
        }
    }

    async getLocalRoutes() {
        const response = await fetch(`${this.baseUrl}/local-routes`);
        return await response.json();
    }

    async getTransportationRoutes() {
        const response = await fetch(`${this.baseUrl}/transportation-routes`);
        return await response.json();
    }

    async getFilteredPoints(filters) {
        const queryString = new URLSearchParams(filters).toString();
        const response = await fetch(`${this.baseUrl}/filtered-points?${queryString}`);
        return await response.json();
    }

    async getNearbyPoints(lat, lng, radius) {
        const response = await fetch(`${this.baseUrl}/nearby-points?latitude=${lat}&longitude=${lng}&radius=${radius}`);
        return await response.json();
    }
}

// Inisialisasi map dan layer groups
const initMap = () => {
    const map = L.map('map').setView([-8.0983, 112.1681], 13);
    
    L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}", {
        attribution: "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community"
    }).addTo(map);

    const layers = {
        tourism: L.layerGroup(),
        accommodations: L.layerGroup(),
        restaurants: L.layerGroup(),
        religious: L.layerGroup(),
        historical: L.layerGroup(),
        temple: L.layerGroup(),
        monument: L.layerGroup(),
        beach: L.layerGroup(),
        mountain: L.layerGroup(),
        park: L.layerGroup(),
        camping: L.layerGroup(),
        agrotourism: L.layerGroup(),
        rest_area: L.layerGroup(),
        culinary: L.layerGroup(),
        localRoutes: L.layerGroup(),
        transportation: L.layerGroup()
    };

    return { map, layers };
};

// Fungsi untuk membuat popup destinasi
const createPopupContent = (feature) => {
    const props = feature.properties;
    console.log('Creating popup for feature:', feature);
    
    let popupContent = `<div class="popup-content">`;
    
    // Tambahkan gambar jika tersedia
    if (props.image) {
        popupContent += `<div class="popup-image-container mb-2">
            <img src="${props.image}" alt="${props.name}" class="w-full h-32 object-cover rounded-md" 
                 onerror="this.onerror=null; this.src='https://source.unsplash.com/600x400/?${encodeURIComponent(props.type)},${encodeURIComponent('tourism')}';">
        </div>`;
    } else {
        // Gunakan gambar default jika tidak ada gambar tersedia
        popupContent += `<div class="popup-image-container mb-2">
            <img src="https://source.unsplash.com/600x400/?${encodeURIComponent(props.type)},${encodeURIComponent('tourism')}" 
                 alt="${props.name}" class="w-full h-32 object-cover rounded-md">
        </div>`;
    }
    
    popupContent += `<h5 class="font-semibold text-lg mb-1">${props.name}</h5>`;

    if (props.description) {
        popupContent += `<p class="text-sm mb-2">${props.description}</p>`;
    }

    if (props.entrance_fee) {
        const feeText = props.entrance_fee === 0 ? 'Gratis' : `Rp ${props.entrance_fee.toLocaleString()}`;
        popupContent += `<p class="text-sm mb-1"><span class="font-medium">Tiket Masuk:</span> ${feeText}</p>`;
    }

    if (props.facilities) {
        // Check if facilities is an array, if not, try to parse it or convert it
        let facilitiesArray = props.facilities;
        
        if (!Array.isArray(facilitiesArray)) {
            // If it's a string that looks like JSON, try to parse it
            if (typeof facilitiesArray === 'string' && 
                (facilitiesArray.startsWith('[') || facilitiesArray.startsWith('{'))) {
                try {
                    facilitiesArray = JSON.parse(facilitiesArray);
                } catch (e) {
                    console.warn('Failed to parse facilities JSON:', e);
                }
            }
            
            // If it's still not an array, make it one
            if (!Array.isArray(facilitiesArray)) {
                facilitiesArray = [facilitiesArray].filter(item => item !== null && item !== undefined);
            }
        }
        
        // Now we can safely use array methods
        if (facilitiesArray.length > 0) {
            popupContent += `<p class="text-sm mb-1"><span class="font-medium">Fasilitas:</span> ${facilitiesArray.join(', ')}</p>`;
        }
    }

    popupContent += `<button 
        class="select-destination bg-green-600 text-white px-3 py-1 rounded-md text-sm mt-2 w-full"
        data-id="${props.id}"
        data-name="${props.name}"
        data-fee="${props.entrance_fee || 0}">
        <i class="fas fa-plus-circle"></i> Tambahkan ke Budget
    </button>`;

    popupContent += `</div>`;
    return popupContent;
};

// Fungsi untuk membuat popup rute transportasi
const createRoutePopupContent = (route) => {
    const props = route.properties;
    return `<div class="popup-content">
        <h5 class="font-semibold text-lg mb-1">${props.name}</h5>
        <p class="text-sm mb-1"><span class="font-medium">Jenis:</span> ${props.type}</p>
        <p class="text-sm mb-1"><span class="font-medium">Harga:</span> Rp ${props.price.toLocaleString()}</p>
        <p class="text-sm mb-1"><span class="font-medium">Frekuensi:</span> ${props.frequency}</p>
    </div>`;
};

// Load dan tampilkan data
const loadMapData = async (map, layers, mapService) => {
    try {
        // Load tourism points
        const points = await mapService.getAllPoints();
        points.features.forEach(feature => {
            const props = feature.properties;
            const type = props.type.toLowerCase();
            
            // Buat marker
            const marker = L.circleMarker([
                feature.geometry.coordinates[1],
                feature.geometry.coordinates[0]
            ], {
                radius: 8,
                fillColor: mapService.getMarkerColor(type),
                color: '#fff',
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            }).bindPopup(createPopupContent(feature));

            // Tambahkan ke layer yang sesuai
            if (layers[type]) {
                layers[type].addLayer(marker);
            } else {
                // Jika tidak ada layer khusus, tambahkan ke layer tourism
                layers.tourism.addLayer(marker);
            }
        });

        // Load local routes
        const localRoutes = await mapService.getLocalRoutes();
        localRoutes.features.forEach(route => {
            const polyline = L.polyline(
                route.geometry.coordinates.map(coord => [coord[1], coord[0]]),
                { 
                    color: mapService.getMarkerColor(route.properties.type),
                    weight: 3,
                    opacity: 0.7,
                    dashArray: '5, 10'
                }
            ).bindPopup(createRoutePopupContent(route));
            layers.localRoutes.addLayer(polyline);
        });

        // Load transportation routes
        const transportationRoutes = await mapService.getTransportationRoutes();
        transportationRoutes.features.forEach(route => {
            if (route.geometry.coordinates && route.geometry.coordinates.length > 0) {
                // Create a polyline for the route
                const polyline = L.polyline(
                    route.geometry.coordinates.map(coord => [coord[1], coord[0]]),
                    { 
                        color: mapService.getMarkerColor(route.properties.type.toLowerCase()),
                        weight: 4,
                        opacity: 0.8
                    }
                ).bindPopup(`
                    <div class="popup-content">
                        <h5 class="font-semibold text-lg mb-1">${route.properties.name}</h5>
                        <p class="text-sm mb-1"><span class="font-medium">Jenis:</span> ${route.properties.type}</p>
                        <p class="text-sm mb-1"><span class="font-medium">Harga:</span> Rp ${route.properties.price.toLocaleString()}</p>
                        <p class="text-sm mb-1"><span class="font-medium">Durasi:</span> ${route.properties.duration_minutes} menit</p>
                        <p class="text-sm mb-1"><span class="font-medium">Jadwal:</span> ${route.properties.departure_times.join(', ')}</p>
                    </div>
                `);
                
                layers.transportation.addLayer(polyline);
            } else {
                console.warn('No coordinates found for transportation route:', route.properties.id);
            }
        });

        // Add all layers to map by default except transportation
        Object.entries(layers).forEach(([name, layer]) => {
            if (name !== 'transportation' && name !== 'localRoutes') {
                map.addLayer(layer);
            }
        });

    } catch (error) {
        console.error('Error loading map data:', error);
    }
};

// Kalkulator budget perjalanan
class BudgetCalculator {
    constructor() {
        this.selectedDestinations = [];
        this.accommodationCosts = {
            'budget': 200000,     // per malam
            'standard': 450000,   // per malam
            'luxury': 900000      // per malam
        };
        this.foodCosts = {
            'local': 75000,       // per orang per hari
            'mixed': 150000,      // per orang per hari
            'upscale': 300000     // per orang per hari
        };
        this.transportationCosts = {
            'public': 0,           // biaya dasar per trip
            'rental-motor': 70000, // per hari
            'rental-car': 350000,  // per hari
            'taxi': 0              // biaya dasar per trip
        };
        this.fuelConsumption = {
            'rental-motor': 0.05,  // liter per km
            'rental-car': 0.12     // liter per km
        };
        this.fuelPrice = 10000;    // Rp per liter
    }

    addDestination(destination) {
        if (!this.selectedDestinations.some(d => d.id === destination.id)) {
            this.selectedDestinations.push(destination);
            return true;
        }
        return false;
    }

    removeDestination(destinationId) {
        this.selectedDestinations = this.selectedDestinations.filter(d => d.id !== destinationId);
    }

    calculateBudget(days, travelers, accommodationType, foodType, transportationType) {
        // Biaya akomodasi
        const accommodationCost = this.accommodationCosts[accommodationType] * days;
        
        // Biaya makanan
        const foodCost = this.foodCosts[foodType] * days * travelers;
        
        // Biaya transportasi
        let transportationCost = 0;
        let transportationDetails = [];
        
        // Sewa kendaraan jika menggunakan rental
        if (transportationType === 'rental-motor' || transportationType === 'rental-car') {
            transportationCost += this.transportationCosts[transportationType] * days;
            const vehicleType = transportationType === 'rental-motor' ? 'Motor' : 'Mobil';
            transportationDetails.push({
                description: `Sewa ${vehicleType} (${days} hari)`,
                cost: this.transportationCosts[transportationType] * days
            });
        }
        
        // Biaya tiket masuk atraksi
        let attractionCost = 0;
        let attractionDetails = [];
        
        if (this.selectedDestinations.length > 0) {
            this.selectedDestinations.forEach(dest => {
                const destCost = dest.fee * travelers;
                attractionCost += destCost;
                attractionDetails.push({
                    name: dest.name,
                    cost: destCost,
                    description: `${travelers} orang x Rp ${dest.fee.toLocaleString()}`
                });
            });
        } else {
            attractionCost = 50000 * days * travelers;
            attractionDetails.push({
                name: 'Perkiraan biaya atraksi',
                cost: attractionCost,
                description: `${days} hari x ${travelers} orang x Rp 50.000`
            });
        }
        
        // Total budget
        const totalCost = accommodationCost + foodCost + transportationCost + attractionCost;
        
        return {
            accommodationCost,
            foodCost,
            transportationCost,
            transportationDetails,
            attractionCost,
            attractionDetails,
            totalCost
        };
    }
}
