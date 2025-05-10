@extends('layouts.app')

@section('title', 'Buat Rencana Perjalanan')

@section('content')
<div class="container max-w-6xl mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8 text-center md:text-left">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Buat Rencana Perjalanan</h1>
        <div class="w-20 h-1 bg-blue-500 mx-auto md:mx-0 mb-4"></div>
        <p class="text-lg text-gray-600">Rencanakan perjalanan Anda ke Blitar dengan mudah</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 transition-all hover:shadow-xl">
        <form action="{{ route('travel-plans.store') }}" method="POST" id="createTravelPlanForm">
            @csrf
            
            <!-- Form Content -->
            <div class="p-6 md:p-8">
                <!-- Plan Name -->
                <div class="mb-8">
                    <label for="name" class="block text-lg font-semibold text-gray-700 mb-3">Nama Rencana</label>
                    <input type="text" name="name" id="name" 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all @error('name') border-red-500 @enderror" 
                           value="{{ old('name') }}" 
                           placeholder="Misal: Liburan Akhir Tahun ke Blitar" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Date Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="start_date" class="block text-lg font-semibold text-gray-700 mb-3">Tanggal Mulai</label>
                        <div class="relative">
                            <input type="date" name="start_date" id="start_date" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all @error('start_date') border-red-500 @enderror" 
                                   value="{{ old('start_date') }}" required>
                            <i class="fas fa-calendar-alt absolute right-4 top-4 text-gray-400"></i>
                        </div>
                        @error('start_date')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="end_date" class="block text-lg font-semibold text-gray-700 mb-3">Tanggal Selesai</label>
                        <div class="relative">
                            <input type="date" name="end_date" id="end_date" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all @error('end_date') border-red-500 @enderror" 
                                   value="{{ old('end_date') }}" required>
                            <i class="fas fa-calendar-alt absolute right-4 top-4 text-gray-400"></i>
                        </div>
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Budget -->
                <div class="mb-8">
                    <label for="budget" class="block text-lg font-semibold text-gray-700 mb-3">Anggaran (IDR)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-4 font-medium text-gray-500">Rp</span>
                        <input type="number" name="budget" id="budget" 
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all @error('budget') border-red-500 @enderror" 
                               value="{{ old('budget') }}" 
                               min="0" step="10000" placeholder="500000" required>
                    </div>
                    @error('budget')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-2">* Biaya termasuk akomodasi, transportasi, dan tiket masuk</p>
                </div>

                <!-- Destinations Section -->
                <div class="mb-6">
                    <label class="block text-lg font-semibold text-gray-700 mb-3">Destinasi Wisata</label>
                    <p class="text-gray-500 mb-4">Pilih tempat-tempat menarik yang ingin Anda kunjungi:</p>
                    
                    <div id="destination-container" class="space-y-4">
                        <!-- Default empty state -->
                        <div class="p-5 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl text-center">
                            <i class="fas fa-map-marker-alt text-3xl text-gray-400 mb-2"></i>
                            <p class="text-gray-500">Belum ada destinasi ditambahkan</p>
                        </div>
                    </div>
                    
                    <button type="button" id="add-destination" 
                            class="mt-6 inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg shadow-md hover:from-blue-600 hover:to-blue-700 transition-all transform hover:-translate-y-0.5">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Destinasi
                    </button>
                    
                    @error('destinations')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Form Footer -->
            <div class="px-6 py-5 bg-gray-50 border-t flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                <a href="{{ route('travel-plans.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-lg shadow-md hover:from-green-600 hover:to-green-700 transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i> Simpan Rencana
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Destination Template (Hidden) -->
<div id="destination-template" class="hidden">
    <div class="destination-item p-5 bg-gray-50 border-2 border-gray-200 rounded-xl flex items-center justify-between transition-all hover:border-blue-300 group">
        <div class="flex-1 mr-4">
            <select name="destinations[]" 
                    class="destination-select w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all appearance-none bg-white"
                    required>
                <option value="">Pilih Destinasi...</option>
                <!-- Options will be loaded via JavaScript -->
            </select>
        </div>
        <button type="button" class="remove-destination ml-3 text-red-500 hover:text-red-700 transition-colors group-hover:opacity-100 opacity-70">
            <i class="fas fa-trash-alt text-lg"></i>
        </button>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Custom styling for selects */
    .destination-select {
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
    }
    
    /* Animation for destination items */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .destination-item {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const destinationContainer = document.getElementById('destination-container');
        const template = document.getElementById('destination-template').innerHTML;
        const addButton = document.getElementById('add-destination');
        
        // Add destination item
        const addDestinationItem = () => {
            // Remove empty state if exists
            if (destinationContainer.querySelector('.bg-gray-50.border-dashed')) {
                destinationContainer.innerHTML = '';
            }
            
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = template;
            const item = tempDiv.firstElementChild;
            destinationContainer.appendChild(item);
            
            // Initialize select2 if available
            if (window.tourismData) {
                initializeSelect2(item.querySelector('select'));
            }
        };
        
        // Remove destination item
        destinationContainer.addEventListener('click', function(e) {
            if (e.target.closest('.remove-destination')) {
                const item = e.target.closest('.destination-item');
                item.classList.add('opacity-0', 'translate-x-4');
                setTimeout(() => {
                    item.remove();
                    // Show empty state if no destinations left
                    if (destinationContainer.children.length === 0) {
                        destinationContainer.innerHTML = `
                            <div class="p-5 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl text-center">
                                <i class="fas fa-map-marker-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">Belum ada destinasi ditambahkan</p>
                            </div>
                        `;
                    }
                }, 300);
            }
        });
        
        // Load tourism data from API
        const loadTourismData = async () => {
            try {
                // Hapus pesan error sebelumnya jika ada
                const existingError = destinationContainer.querySelector('.bg-red-50');
                if (existingError) {
                    existingError.remove();
                }

                const response = await fetch('/api/tourisms');
                if (!response.ok) throw new Error('Failed to load tourism data');
                
                window.tourismData = await response.json();
                
                // Initialize all existing selects
                document.querySelectorAll('.destination-select').forEach(select => {
                    initializeSelect2(select);
                });
            } catch (error) {
                console.error('Error loading tourism data:', error);
                
                // Hanya tampilkan error jika belum ada error yang ditampilkan
                if (!destinationContainer.querySelector('.bg-red-50')) {
                    const errorElement = document.createElement('div');
                    errorElement.className = 'p-3 bg-red-50 text-red-600 rounded-lg mb-4';
                    errorElement.innerHTML = `
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Gagal memuat daftar destinasi. Silahkan coba lagi.
                    `;
                    destinationContainer.prepend(errorElement);
                }
            }
        };
        
        // Initialize Select2 with tourism data
        const initializeSelect2 = (selectElement) => {
            if (!window.tourismData) return;
            
            // Clear existing options except the first one
            while (selectElement.options.length > 1) {
                selectElement.remove(1);
            }
            
            // Add new options
            window.tourismData.forEach(tourism => {
                const option = document.createElement('option');
                option.value = tourism.id;
                option.textContent = tourism.name;
                option.dataset.image = tourism.image || '';
                selectElement.appendChild(option);
            });
        };
        
        // Format select2 option display
        const formatDestinationOption = (destination) => {
            if (!destination.id) return destination.text;
            
            const imageUrl = destination.element.dataset.image 
                ? destination.element.dataset.image 
                : 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%239CA3AF"%3E%3Cpath d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/%3E%3C/svg%3E';
            
            return $(`
                <div class="flex items-center">
                    <img src="${imageUrl}" class="w-8 h-8 rounded-md mr-3 object-cover">
                    <span>${destination.text}</span>
                </div>
            `);
        };
        
        // Format selected item display
        const formatDestinationSelection = (destination) => {
            if (!destination.id) return destination.text;
            return destination.text;
        };
        
        // Initialize
        addButton.addEventListener('click', addDestinationItem);
        loadTourismData();
        
        // Add first destination by default
        addDestinationItem();
    });
</script>
@endpush
