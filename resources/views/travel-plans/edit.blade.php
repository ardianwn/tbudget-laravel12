@extends('layouts.app')

@section('title', 'Edit Rencana Perjalanan')

@section('content')
<div class="container max-w-6xl mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8 text-center md:text-left">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Edit Rencana Perjalanan</h1>
        <div class="w-20 h-1 bg-blue-500 mx-auto md:mx-0 mb-4"></div>
        <p class="text-lg text-gray-600">Perbarui detail perjalanan Anda ke Blitar</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 transition-all hover:shadow-xl">
        <form action="{{ route('travel-plans.update', $travelPlan) }}" method="POST" id="editTravelPlanForm">
            @csrf
            @method('PUT')
            
            <!-- Form Content -->
            <div class="p-6 md:p-8">
                <!-- Plan Name -->
                <div class="mb-8">
                    <label for="name" class="block text-lg font-semibold text-gray-700 mb-3">Nama Rencana</label>
                    <input type="text" name="name" id="name" 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all @error('name') border-red-500 @enderror" 
                           value="{{ old('name', $travelPlan->name) }}" 
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
                                   value="{{ old('start_date', $travelPlan->start_date->format('Y-m-d')) }}" required>
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
                                   value="{{ old('end_date', $travelPlan->end_date->format('Y-m-d')) }}" required>
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
                               value="{{ old('budget', $travelPlan->budget) }}" 
                               min="0" step="10000" placeholder="500000" required>
                    </div>
                    @error('budget')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-2">* Biaya termasuk akomodasi, transportasi, dan tiket masuk</p>
                </div>

                <!-- Destinations -->
                <div class="mb-6">
                    <label class="block text-lg font-semibold text-gray-700 mb-3">Destinasi Wisata</label>
                    <p class="text-gray-500 mb-4">Pilih tempat-tempat menarik yang ingin Anda kunjungi:</p>
                    
                    <div id="destination-container" class="space-y-4">
                        <!-- Loading state will be inserted here via JavaScript -->
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
                <a href="{{ route('travel-plans.show', $travelPlan) }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <button type="submit" id="submit-button"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-lg shadow-md hover:from-green-600 hover:to-green-700 transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
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
                    class="destination-select w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all"
                    required>
                <option value="">Pilih Destinasi...</option>
            </select>
        </div>
        <button type="button" class="remove-destination ml-3 text-red-500 hover:text-red-700 transition-colors">
            <i class="fas fa-trash-alt text-lg"></i>
        </button>
    </div>
</div>

<!-- No Destinations Template -->
<div id="no-destinations-template" class="hidden">
    <div class="text-center py-8 text-gray-400">
        <i class="fas fa-map-marker-alt text-4xl mb-3"></i>
        <p class="text-lg">Belum ada destinasi dipilih</p>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .destination-item {
        animation: fadeIn 0.3s ease-out forwards;
    }
    
    /* Select2 custom styling */
    .select2-container--default .select2-selection--single {
        height: 48px;
        border: 2px solid #e2e8f0 !important;
        border-radius: 12px !important;
        padding: 8px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 32px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px;
    }
    .select2-dropdown {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        margin-top: 4px;
    }
    .select2-search--dropdown {
        padding: 12px;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px;
    }
    .select2-results__option {
        padding: 12px;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #3b82f6;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', async function() {
        const destinationContainer = document.getElementById('destination-container');
        const template = document.getElementById('destination-template').innerHTML;
        const addButton = document.getElementById('add-destination');
        
        // Show loading state
        destinationContainer.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin mr-2"></i> Memuat data...</div>';
        
        try {
            // Load tourism data first
            const response = await fetch('/api/tourisms');
            if (!response.ok) throw new Error('Failed to load tourism data');
            const tourisms = await response.json();
            
            // Clear loading state
            destinationContainer.innerHTML = '';
            
            // Load existing destinations
            const existingDestinations = @json($travelPlan->destinations);
            
            if (existingDestinations.length > 0) {
                existingDestinations.forEach(destination => {
                    addDestinationItem(tourisms, destination.tourism_id);
                });
            } else {
                // Add empty destination item if no existing destinations
                addDestinationItem(tourisms);
            }
            
            // Add destination button handler
            addButton.addEventListener('click', () => addDestinationItem(tourisms));
            
            // Remove destination handler
            destinationContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-destination')) {
                    const item = e.target.closest('.destination-item');
                    item.classList.add('opacity-0', 'translate-x-4');
                    setTimeout(() => {
                        item.remove();
                        if (destinationContainer.children.length === 0) {
                            addDestinationItem(tourisms);
                        }
                    }, 300);
                }
            });
            
        } catch (error) {
            console.error('Error:', error);
            destinationContainer.innerHTML = `
                <div class="p-4 bg-red-50 text-red-600 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span class="font-semibold">Gagal memuat data destinasi</span>
                    </div>
                    <p class="text-sm">Silakan coba muat ulang halaman</p>
                </div>
            `;
        }
    });

    function addDestinationItem(tourisms, selectedId = null) {
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = document.getElementById('destination-template').innerHTML;
        const item = tempDiv.firstElementChild;
        
        const select = item.querySelector('select');
        
        // Add options
        select.innerHTML = '<option value="">Pilih Destinasi...</option>';
        tourisms.forEach(tourism => {
            const option = document.createElement('option');
            option.value = tourism.id;
            option.textContent = tourism.name;
            option.selected = tourism.id == selectedId;
            select.appendChild(option);
        });
        
        document.getElementById('destination-container').appendChild(item);
    }
</script>
@endpush