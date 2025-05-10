@extends('layouts.app')

@section('title', 'Peta Wisata Blitar')

@section('content')
<div class="relative h-screen bg-gray-50">
    <!-- Floating Control Buttons -->
    <div class="absolute top-4 left-4 md:top-12 md:left-20 z-20 flex flex-col md:flex-row gap-2 md:gap-3">
        <button id="toggle-calculator" class="bg-white p-2 md:p-3 rounded-lg shadow-md hover:bg-blue-50 transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 group">
            <i class="fa-solid fa-calculator text-blue-600 text-base md:text-lg group-hover:text-blue-700"></i>
            <span class="sr-only">Budget Calculator</span>
            <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs font-medium text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Kalkulator Budget</span>
        </button>
        <button id="toggle-layers" class="bg-white p-2 md:p-3 rounded-lg shadow-md hover:bg-blue-50 transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 group">
            <i class="fa-solid fa-layer-group text-blue-600 text-base md:text-lg group-hover:text-blue-700"></i>
            <span class="sr-only">Layer Controls</span>
            <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs font-medium text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Layer Peta</span>
        </button>
        <button id="toggle-legend" class="bg-white p-2 md:p-3 rounded-lg shadow-md hover:bg-blue-50 transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 group">
            <i class="fa-solid fa-list text-blue-600 text-base md:text-lg group-hover:text-blue-700"></i>
            <span class="sr-only">Map Legend</span>
            <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs font-medium text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Legenda Peta</span>
        </button>
    </div>

    <!-- Peta -->
    <div id="map" class="h-screen z-0"></div>
    
    <!-- Info Panel -->
    <div id="layers-panel" class="absolute top-16 md:top-4 left-4 md:left-auto md:right-4 bg-white bg-opacity-95 p-4 md:p-6 rounded-xl shadow-xl w-[calc(100%-2rem)] md:w-80 lg:w-96 z-10 max-h-[calc(100vh-6rem)] md:max-h-[calc(100vh-5rem)] overflow-y-auto transition-all duration-300 border border-gray-200 hidden">
        <div class="flex items-center space-x-3 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-gray-200">
            <img src="https://img.icons8.com/fluency/48/worldwide-location.png" alt="GIS Logo" class="w-8 h-8 md:w-10 md:h-10">
            <div>
                <h3 class="text-base md:text-lg font-semibold text-blue-600">Blitar Travel Budget GIS</h3>
                <p class="text-xs text-gray-500">Jelajahi & Rencanakan Wisata Blitar dengan Mudah</p>
            </div>
        </div>
        
        <div class="mb-3 md:mb-4">
            <ul class="flex border-b">
                <li class="-mb-px mr-1">
                    <a class="inline-block py-1.5 md:py-2 px-3 md:px-4 text-xs md:text-sm text-blue-500 hover:text-blue-800 font-semibold border-b-2 border-blue-500 rounded-t transition-colors duration-200" href="#points" id="points-tab">Points</a>
                </li>
                <li class="mr-1">
                    <a class="inline-block py-1.5 md:py-2 px-3 md:px-4 text-xs md:text-sm text-gray-500 hover:text-blue-800 font-semibold rounded-t transition-colors duration-200" href="#economic" id="economic-tab">Economic</a>
                </li>
            </ul>
        </div>
        
        <div id="tab-content">
            <div id="points-content" class="active">
                <div class="space-y-2 md:space-y-3">
                    <div>
                        <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Wisata Umum</h6>
                        <div class="flex items-center justify-between bg-gray-50 p-1.5 md:p-2 rounded">
                            <div class="flex items-center">
                                <input type="checkbox" id="tourism-layer" class="form-checkbox h-3 w-3 md:h-4 md:w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                <label for="tourism-layer" class="ml-2 text-xs md:text-sm">Wisata Umum</label>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#22c55e]"></span>
                        </div>
                    </div>

                    <div>
                        <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Akomodasi & Kuliner</h6>
                        <div class="space-y-1.5 md:space-y-2">
                            <div class="flex items-center justify-between bg-gray-50 p-1.5 md:p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="accommodation-layer" class="form-checkbox h-3 w-3 md:h-4 md:w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="accommodation-layer" class="ml-2 text-xs md:text-sm">Penginapan</label>
                                </div>
                                <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#3b82f6]"></span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-1.5 md:p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="culinary-layer" class="form-checkbox h-3 w-3 md:h-4 md:w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="culinary-layer" class="ml-2 text-xs md:text-sm">Kuliner</label>
                                </div>
                                <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#f97316]"></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Wisata Alam</h6>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="beach-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="beach-layer" class="ml-2 text-sm">Pantai</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#0ea5e9]"></span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="mountain-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="mountain-layer" class="ml-2 text-sm">Gunung</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#84cc16]"></span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="park-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="park-layer" class="ml-2 text-sm">Taman</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#10b981]"></span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="camping-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="camping-layer" class="ml-2 text-sm">Camping</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#059669]"></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Sejarah & Budaya</h6>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="historical-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="historical-layer" class="ml-2 text-sm">Tempat Bersejarah</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#f59e0b]"></span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="temple-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="temple-layer" class="ml-2 text-sm">Candi</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#d97706]"></span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="monument-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="monument-layer" class="ml-2 text-sm">Monumen</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#b45309]"></span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="religious-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="religious-layer" class="ml-2 text-sm">Tempat Ibadah</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#8b5cf6]"></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Lainnya</h6>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="agrotourism-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="agrotourism-layer" class="ml-2 text-sm">Agrowisata</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#65a30d]"></span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="rest-area-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" checked>
                                    <label for="rest-area-layer" class="ml-2 text-sm">Rest Area</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#6b7280]"></span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" id="transportation-layer" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                                    <label for="transportation-layer" class="ml-2 text-sm">Rute Transportasi</label>
                                </div>
                                <span class="inline-block w-3 h-3 rounded-full bg-[#6366f1]"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="economic-content" class="hidden">
                <div id="economic-data" class="animate-pulse">
                    <div class="space-y-3 md:space-y-4">
                        <div class="h-3 md:h-4 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-2.5 md:h-3 bg-gray-200 rounded w-full"></div>
                        <div class="h-2.5 md:h-3 bg-gray-200 rounded w-5/6"></div>
                        <div class="h-2.5 md:h-3 bg-gray-200 rounded w-4/5"></div>
                        <div class="h-2.5 md:h-3 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-2.5 md:h-3 bg-gray-200 rounded w-5/6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Budget Calculator Panel -->
    <div id="calculator-panel" class="absolute top-16 md:top-4 left-4 md:left-auto md:right-4 bg-white bg-opacity-95 p-4 md:p-6 rounded-xl shadow-xl w-[calc(100%-2rem)] md:w-80 lg:w-96 z-10 max-h-[calc(100vh-6rem)] md:max-h-[calc(100vh-5rem)] overflow-y-auto transition-all duration-300 border border-gray-200 hidden">
        <div class="flex items-center justify-between mb-3 md:mb-4 pb-2 border-b border-gray-200">
            <h3 class="text-base md:text-lg font-semibold text-green-600 flex items-center">
                <i class="fas fa-calculator mr-2 text-sm md:text-base"></i>
                Kalkulator Budget
            </h3>
            <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 md:py-1 rounded-full">BETA</span>
        </div>
        
        <form id="budget-form" class="space-y-3 md:space-y-4">
            <div>
                <label for="duration" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Durasi (hari):</label>
                <input type="number" id="duration" class="w-full px-2 md:px-3 py-1.5 md:py-2 text-sm md:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" min="1" value="3">
            </div>
            
            <div>
                <label for="travelers" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Jumlah wisatawan:</label>
                <input type="number" id="travelers" class="w-full px-2 md:px-3 py-1.5 md:py-2 text-sm md:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" min="1" value="2">
            </div>
            
            <div>
                <label for="accommodation-type" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Tipe akomodasi:</label>
                <select id="accommodation-type" class="w-full px-2 md:px-3 py-1.5 md:py-2 text-sm md:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="budget">Budget (150k-300k/malam)</option>
                    <option value="standard" selected>Standard (300k-600k/malam)</option>
                    <option value="luxury">Luxury (600k+/malam)</option>
                </select>
            </div>
            
            <div>
                <label for="food-preference" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Preferensi makanan:</label>
                <select id="food-preference" class="w-full px-2 md:px-3 py-1.5 md:py-2 text-sm md:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="local">Makanan lokal (50k-100k/hari)</option>
                    <option value="mixed" selected>Campuran (100k-200k/hari)</option>
                    <option value="upscale">Premium (200k+/hari)</option>
                </select>
            </div>
            
            <div>
                <label for="transportation-type" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Transportasi lokal:</label>
                <select id="transportation-type" class="w-full px-2 md:px-3 py-1.5 md:py-2 text-sm md:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="public">Transportasi umum (Angkot/Ojek)</option>
                    <option value="rental-motor" selected>Sewa motor</option>
                    <option value="rental-car">Sewa mobil</option>
                    <option value="taxi">Taksi/Ojek online</option>
                </select>
            </div>
            
            <div>
                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Destinasi terpilih:</label>
                <div class="bg-blue-50 p-2 rounded text-xs flex items-start">
                    <i class="fas fa-info-circle mr-1 mt-0.5 text-blue-600"></i> 
                    <span class="text-blue-600">Klik pada marker hijau di peta, lalu klik "Tambahkan ke Budget" pada popup.</span>
                </div>
                <div id="selected-destinations" class="mt-2 max-h-28 md:max-h-40 overflow-y-auto border border-gray-200 rounded p-2">
                    <p class="text-xs md:text-sm text-gray-500 italic">Belum ada destinasi yang dipilih</p>
                </div>
            </div>
            
            <button type="button" id="calculate-btn" class="w-full flex justify-center py-1.5 md:py-2 px-3 md:px-4 border border-transparent rounded-md shadow-sm text-xs md:text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                <i class="fas fa-calculator mr-2"></i> Hitung Budget
            </button>
        </form>
        
        <div id="budget-result" class="mt-3 md:mt-4 hidden p-3 md:p-4 bg-gray-50 rounded-lg border border-gray-200">
            <!-- Budget results will be inserted here -->
        </div>
    </div>
    
    <!-- Legend Panel -->
    <div id="legend-panel" class="absolute top-16 md:top-4 left-4 md:left-auto md:right-4 bg-white bg-opacity-95 p-4 md:p-6 rounded-xl shadow-xl w-[calc(100%-2rem)] md:w-80 lg:w-96 z-10 max-h-[calc(100vh-6rem)] md:max-h-[calc(100vh-5rem)] overflow-y-auto transition-all duration-300 border border-gray-200 hidden">
        <div class="flex items-center space-x-3 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-gray-200">
            <div>
                <h3 class="text-base md:text-lg font-semibold text-blue-600 flex items-center">
                    <i class="fas fa-list-ul mr-2 text-sm md:text-base"></i>
                    Legenda Peta
                </h3>
                <p class="text-xs text-gray-500">Informasi marker & rute pada peta</p>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-3 md:gap-4">
            <div class="space-y-2 md:space-y-3">
                <div>
                    <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Wisata Umum</h6>
                    <div class="flex items-center justify-between bg-gray-50 p-1.5 md:p-2 rounded">
                        <div class="flex items-center">
                            <span class="text-xs md:text-sm">Wisata Umum</span>
                        </div>
                        <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#22c55e]"></span>
                    </div>
                </div>

                <div>
                    <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Akomodasi & Kuliner</h6>
                    <div class="space-y-1.5 md:space-y-2">
                        <div class="flex items-center justify-between bg-gray-50 p-1.5 md:p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Penginapan</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#3b82f6]"></span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-1.5 md:p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Kuliner</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#f97316]"></span>
                        </div>
                    </div>
                </div>

                <div>
                    <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Wisata Alam</h6>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Pantai</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#0ea5e9]"></span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Gunung</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#84cc16]"></span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Taman</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#10b981]"></span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Camping</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#059669]"></span>
                        </div>
                    </div>
                </div>

                <div>
                    <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Sejarah & Budaya</h6>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Tempat Bersejarah</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#f59e0b]"></span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Candi</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#d97706]"></span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Monumen</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#b45309]"></span>
                        </div>
                    </div>
                </div>

                <div>
                    <h6 class="font-medium text-xs md:text-sm text-gray-600 mb-1 md:mb-2">Lainnya</h6>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Tempat Ibadah</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#8b5cf6]"></span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Agrowisata</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#65a30d]"></span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Rest Area</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#6b7280]"></span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                            <div class="flex items-center">
                                <span class="text-xs md:text-sm">Transportasi</span>
                            </div>
                            <span class="inline-block w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#6366f1]"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/map-service.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add this function to determine marker color based on type
    function getMarkerColor(type) {
        const colorMap = {
            // Wisata Umum
            'tourism': '#22c55e',     // green-500
            
            // Akomodasi
            'accommodation': '#3b82f6', // blue-500
            
            // Kuliner
            'culinary': '#f97316',    // orange-500
            'restaurant': '#f97316',   // orange-500
            
            // Transportasi
            'bus': '#a855f7',         // purple-500
            'train': '#6366f1',       // indigo-500
            'travel': '#ef4444',      // red-500
            'local': '#14b8a6',       // teal-500
            
            // Tempat Ibadah & Sejarah
            'religious': '#8b5cf6',    // purple-500
            'historical': '#f59e0b',   // amber-500
            'temple': '#d97706',       // amber-600
            'monument': '#b45309',     // amber-700
            
            // Alam
            'beach': '#0ea5e9',       // sky-500
            'mountain': '#84cc16',     // lime-500
            'park': '#10b981',        // emerald-500
            'camping': '#059669',      // emerald-600
            
            // Lainnya
            'agrotourism': '#65a30d',  // lime-600
            'rest_area': '#6b7280'     // gray-500
        };
        return colorMap[type.toLowerCase()] || '#22c55e'; // default to green if type not found
    }

    // Tab handler
    const pointsTab = document.getElementById('points-tab');
    const economicTab = document.getElementById('economic-tab');
    const pointsContent = document.getElementById('points-content');
    const economicContent = document.getElementById('economic-content');
    
    pointsTab.addEventListener('click', function(e) {
        e.preventDefault();
        pointsContent.classList.remove('hidden');
        pointsContent.classList.add('active');
        economicContent.classList.add('hidden');
        economicContent.classList.remove('active');
        
        pointsTab.classList.add('text-blue-500', 'border-b-2', 'border-blue-500');
        economicTab.classList.remove('text-blue-500', 'border-b-2', 'border-blue-500');
        pointsTab.classList.remove('text-gray-500');
        economicTab.classList.add('text-gray-500');
    });
    
    economicTab.addEventListener('click', function(e) {
        e.preventDefault();
        economicContent.classList.remove('hidden');
        economicContent.classList.add('active');
        pointsContent.classList.add('hidden');
        pointsContent.classList.remove('active');
        
        economicTab.classList.add('text-blue-500', 'border-b-2', 'border-blue-500');
        pointsTab.classList.remove('text-blue-500', 'border-b-2', 'border-blue-500');
        economicTab.classList.remove('text-gray-500');
        pointsTab.classList.add('text-gray-500');
        
        // Load economic data if not loaded yet
        if (document.getElementById('economic-data').innerHTML.includes('Loading')) {
            loadEconomicData();
        }
    });
    
    // Initialize map
    const { map, layers } = initMap();
    const mapService = new MapService(getMarkerColor);
    const budgetCalculator = new BudgetCalculator();
    
    // Load map data
    loadMapData(map, layers, mapService);
    
    // Layer toggles
    const layerToggles = {
        'tourism-layer': 'tourism',
        'accommodation-layer': 'accommodation',
        'culinary-layer': 'culinary',
        'beach-layer': 'beach',
        'mountain-layer': 'mountain',
        'park-layer': 'park',
        'camping-layer': 'camping',
        'historical-layer': 'historical',
        'temple-layer': 'temple',
        'monument-layer': 'monument',
        'religious-layer': 'religious',
        'agrotourism-layer': 'agrotourism',
        'rest-area-layer': 'rest_area',
        'transportation-layer': 'transportation'
    };

    // Add event listeners for all layer toggles
    Object.entries(layerToggles).forEach(([elementId, layerName]) => {
        document.getElementById(elementId)?.addEventListener('change', function(e) {
            if (e.target.checked) {
                if (layerName === 'transportation') {
                    map.addLayer(layers.transportation);
                    map.addLayer(layers.localRoutes);
                    document.body.classList.add('transportation-active');
                } else {
                    map.addLayer(layers[layerName]);
                }
            } else {
                if (layerName === 'transportation') {
                    map.removeLayer(layers.transportation);
                    map.removeLayer(layers.localRoutes);
                    document.body.classList.remove('transportation-active');
                } else {
                    map.removeLayer(layers[layerName]);
                }
            }
        });
    });
    
    // Economic data loader
    function loadEconomicData() {
        // Show loading skeleton
        const economicDataDiv = document.getElementById('economic-data');
        economicDataDiv.innerHTML = `
            <div class="animate-pulse">
                <div class="h-3 md:h-4 bg-gray-200 rounded w-3/4 mb-3"></div>
                <div class="space-y-2">
                    <div class="h-2.5 md:h-3 bg-gray-200 rounded w-full"></div>
                    <div class="h-2.5 md:h-3 bg-gray-200 rounded w-5/6"></div>
                    <div class="h-2.5 md:h-3 bg-gray-200 rounded w-4/5"></div>
                    <div class="h-2.5 md:h-3 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-2.5 md:h-3 bg-gray-200 rounded w-5/6"></div>
                </div>
            </div>
        `;
        
        // Simulate API call delay
        setTimeout(() => {
            // Example economic data - in real app, this would come from the backend
            const economicData = {
                tourism_contribution_to_pdrb: 15.2,
                tourism_workforce: 12500,
                average_tourist_spending: 500000,
                hotel_occupancy_rate: 67.8,
                msme_count: 850,
                tourism_statistics: {
                    annual_visitors: 1200000,
                    domestic_visitors: 1150000,
                    international_visitors: 50000
                },
                year: 2023
            };
            
            const economicHtml = `
                <div class="animate-fade-in">
                    <h5 class="font-semibold mb-2 text-gray-700">Data Ekonomi Pariwisata (${economicData.year})</h5>
                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between">
                            <span class="text-gray-600">Kontribusi ke PDRB:</span>
                            <span class="font-medium">${economicData.tourism_contribution_to_pdrb}%</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Tenaga kerja:</span>
                            <span class="font-medium">${economicData.tourism_workforce.toLocaleString()} orang</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Pengeluaran wisatawan:</span>
                            <span class="font-medium">Rp ${economicData.average_tourist_spending.toLocaleString()}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Hunian hotel:</span>
                            <span class="font-medium">${economicData.hotel_occupancy_rate}%</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Jumlah UMKM:</span>
                            <span class="font-medium">${economicData.msme_count.toLocaleString()}</span>
                        </li>
                    </ul>
                    
                    <h6 class="font-semibold mt-4 mb-2 text-gray-700">Statistik Wisatawan</h6>
                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between">
                            <span class="text-gray-600">Pengunjung tahunan:</span>
                            <span class="font-medium">${economicData.tourism_statistics.annual_visitors.toLocaleString()}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Wisatawan domestik:</span>
                            <span class="font-medium">${economicData.tourism_statistics.domestic_visitors.toLocaleString()}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Wisatawan internasional:</span>
                            <span class="font-medium">${economicData.tourism_statistics.international_visitors.toLocaleString()}</span>
                        </li>
                    </ul>
                    
                    <div class="mt-4 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i> Data diperbarui terakhir: ${new Date().toLocaleDateString('id-ID')}
                    </div>
                </div>
            `;
            
            economicDataDiv.innerHTML = economicHtml;
        }, 1000);
    }
    
    // Add event delegation for "Add to Budget" button
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('select-destination')) {
            const id = e.target.getAttribute('data-id');
            const name = e.target.getAttribute('data-name');
            const fee = parseInt(e.target.getAttribute('data-fee'));
            
            const destination = { id, name, fee };
            if (budgetCalculator.addDestination(destination)) {
                updateSelectedDestinations();
                
                // Show success message with animation
                const successMsg = document.createElement('div');
                successMsg.className = 'text-green-600 text-xs mt-2 animate-fade-in';
                successMsg.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Berhasil ditambahkan ke budget!';
                e.target.parentNode.appendChild(successMsg);
                
                // Remove success message after 2 seconds
                setTimeout(() => {
                    successMsg.classList.add('animate-fade-out');
                    setTimeout(() => {
                        try {
                            successMsg.remove();
                        } catch (e) {
                            // Ignore if already removed
                        }
                    }, 300);
                }, 2000);
            } else {
                // Show already added message
                const warningMsg = document.createElement('div');
                warningMsg.className = 'text-orange-600 text-xs mt-2 animate-fade-in';
                warningMsg.innerHTML = '<i class="fas fa-exclamation-circle mr-1"></i> Sudah ada di daftar budget';
                e.target.parentNode.appendChild(warningMsg);
                
                // Remove warning message after 2 seconds
                setTimeout(() => {
                    warningMsg.classList.add('animate-fade-out');
                    setTimeout(() => {
                        try {
                            warningMsg.remove();
                        } catch (e) {
                            // Ignore if already removed
                        }
                    }, 300);
                }, 2000);
            }
        }
    });
    
    // Update selected destinations list
    function updateSelectedDestinations() {
        const container = document.getElementById('selected-destinations');
        
        if (budgetCalculator.selectedDestinations.length === 0) {
            container.innerHTML = '<p class="text-sm text-gray-500 italic py-2">Belum ada destinasi yang dipilih</p>';
            return;
        }
        
        let html = '<ul class="space-y-2">';
        budgetCalculator.selectedDestinations.forEach((dest, index) => {
            html += `
                <li class="bg-white rounded-md p-2 shadow-sm border border-gray-100 flex justify-between items-center animate-fade-in">
                    <div class="flex items-center">
                        <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                        <div>
                            <div class="font-medium text-sm">${dest.name}</div>
                            <div class="text-xs text-gray-500">Tiket: Rp ${dest.fee.toLocaleString()}/org</div>
                        </div>
                    </div>
                    <button type="button" class="remove-dest text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-50 transition-colors duration-200" data-index="${index}" title="Hapus">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </li>
            `;
        });
        html += '</ul>';
        
        container.innerHTML = html;
        
        // Add event listeners to remove buttons
        document.querySelectorAll('.remove-dest').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                budgetCalculator.selectedDestinations.splice(index, 1);
                updateSelectedDestinations();
                
                // Update budget result if visible
                if (!document.getElementById('budget-result').classList.contains('hidden')) {
                    document.getElementById('calculate-btn').click();
                }
            });
        });
    }
    
    // Budget calculation
    document.getElementById('calculate-btn').addEventListener('click', function() {
        const days = parseInt(document.getElementById('duration').value);
        const travelers = parseInt(document.getElementById('travelers').value);
        const accommodationType = document.getElementById('accommodation-type').value;
        const foodType = document.getElementById('food-preference').value;
        const transportationType = document.getElementById('transportation-type').value;
        
        const budget = budgetCalculator.calculateBudget(days, travelers, accommodationType, foodType, transportationType);
        
        // Format currency helper
        const formatCurrency = (amount) => {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount);
        };
        
        const resultHtml = `
            <div class="animate-fade-in">
                <h5 class="font-semibold mb-3 pb-2 border-b border-gray-200 text-gray-700">Perkiraan Anggaran</h5>
                <table class="w-full text-sm">
                    <tr>
                        <td class="py-1.5 text-gray-600">Penginapan (${days} malam):</td>
                        <td class="py-1.5 text-right font-medium">${formatCurrency(budget.accommodationCost)}</td>
                    </tr>
                    <tr>
                        <td class="py-1.5 text-gray-600">Makanan (${days} hari):</td>
                        <td class="py-1.5 text-right font-medium">${formatCurrency(budget.foodCost)}</td>
                    </tr>
                    <tr>
                        <td class="py-1.5 text-gray-600">Transportasi:</td>
                        <td class="py-1.5 text-right font-medium">${formatCurrency(budget.transportationCost)}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="py-1 pb-2">
                            <div class="text-xs text-gray-500 ml-4">
                                ${budget.transportationDetails.map(item => `${item.description}: ${formatCurrency(item.cost)}`).join('<br>')}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1.5 text-gray-600">Tiket Masuk (${budget.attractionDetails.length} tempat):</td>
                        <td class="py-1.5 text-right font-medium">${formatCurrency(budget.attractionCost)}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="py-1 pb-2">
                            <div class="text-xs text-gray-500 ml-4 max-h-20 overflow-y-auto">
                                ${budget.attractionDetails.map(item => `${item.name}: ${formatCurrency(item.cost)} (${item.description})`).join('<br>')}
                            </div>
                        </td>
                    </tr>
                    <tr class="font-semibold bg-green-50 text-green-800 border-t border-gray-200">
                        <td class="py-2">Total untuk ${travelers} orang:</td>
                        <td class="py-2 text-right">${formatCurrency(budget.totalCost)}</td>
                    </tr>
                    <tr class="bg-green-50 text-green-700">
                        <td class="pb-2 text-sm">Per orang:</td>
                        <td class="pb-2 text-right text-sm">${formatCurrency(Math.round(budget.totalCost / travelers))}</td>
                    </tr>
                </table>
                <div class="mt-3 flex items-center text-xs text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    <span>Estimasi berdasarkan harga rata-rata di Blitar</span>
                </div>
                <div class="mt-2 text-xs text-gray-400 text-right">
                    Diperbarui: ${new Date().toLocaleTimeString('id-ID')}
                </div>
            </div>
        `;
        
        const resultDiv = document.getElementById('budget-result');
        resultDiv.innerHTML = resultHtml;
        resultDiv.classList.remove('hidden');
        
        // Scroll to result if needed
        resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    // Panel toggle handlers
    const togglePanels = {
        'toggle-calculator': {
            panel: 'calculator-panel',
            className: 'hidden',
            button: document.getElementById('toggle-calculator')
        },
        'toggle-layers': {
            panel: 'layers-panel',
            className: 'hidden',
            button: document.getElementById('toggle-layers')
        },
        'toggle-legend': {
            panel: 'legend-panel',
            className: 'hidden',
            button: document.getElementById('toggle-legend')
        }
    };

    Object.entries(togglePanels).forEach(([buttonId, config]) => {
        const panel = document.getElementById(config.panel);
        const button = config.button;
        
        if (button && panel) {
            let isPanelVisible = false;
            
            button.addEventListener('click', () => {
                isPanelVisible = !isPanelVisible;
                panel.classList.toggle('hidden');
                button.classList.toggle('bg-blue-100');
                button.querySelector('i').classList.toggle('text-blue-700');
                
                // Sembunyikan panel lain
                Object.entries(togglePanels).forEach(([otherId, otherConfig]) => {
                    if (otherId !== buttonId) {
                        const otherPanel = document.getElementById(otherConfig.panel);
                        const otherButton = otherConfig.button;
                        if (otherPanel && !otherPanel.classList.contains('hidden')) {
                            otherPanel.classList.add('hidden');
                            otherButton.classList.remove('bg-blue-100');
                            otherButton.querySelector('i').classList.remove('text-blue-700');
                        }
                    }
                });
            });
        }
    });

    // Add panel-base class to all panels
    const panels = ['calculator-panel', 'layers-panel', 'legend-panel'];
    panels.forEach(panelId => {
        const panel = document.getElementById(panelId);
        if (panel) {
            panel.classList.add('panel-base');
        }
    });
});
</script>
@endpush

@push('styles')
<style>
    /* Custom styles for the map page */
    #map {
        width: 100%;
        height: 100vh;
        z-index: 1;
    }
    
    /* Leaflet zoom control positioning */
    .leaflet-top.leaflet-left {
        top: 12px !important;
        left: 12px !important;
    }
    
    @media (min-width: 768px) {
        .leaflet-top.leaflet-left {
            top: 32px !important;
            left: 20px !important;
        }
    }
    
    /* Animation classes */
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out forwards;
    }
    
    .animate-fade-out {
        animation: fadeOut 0.3s ease-in-out forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(5px); }
    }
    
    /* Scrollbar styling */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }
    
    /* Tooltip styles */
    [title] {
        position: relative;
    }
    
    [title]:hover::after {
        content: attr(title);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        white-space: nowrap;
        z-index: 100;
    }
    
    /* Popup styles */
    .popup-content {
        min-width: 200px;
        max-width: 280px;
    }
    
    .popup-image-container {
        overflow: hidden;
        border-radius: 0.375rem;
    }
    
    .popup-image-container img {
        transition: transform 0.3s ease;
    }
    
    .popup-image-container:hover img {
        transform: scale(1.05);
    }
</style>
@endpush