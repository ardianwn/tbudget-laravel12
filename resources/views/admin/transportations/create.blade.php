@extends('layouts.app')

@section('title', 'Tambah Transportasi Baru')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <a href="{{ route('admin.transportations.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                    Tambah Transportasi Baru
                </h1>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <form action="{{ route('admin.transportations.store') }}" method="POST" id="transportationForm">
                @csrf
                
                <!-- Form Header -->
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-gray-50">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-bus text-blue-500 mr-2"></i>
                        Informasi Transportasi
                    </h2>
                </div>
                
                <!-- Form Content -->
                <div class="p-6 space-y-6">
                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Rute -->
                        <div class="space-y-2">
                            <label for="route_name" class="block text-sm font-medium text-gray-700 flex items-center">
                                Nama Rute <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" name="route_name" id="route_name" 
                                   value="{{ old('route_name') }}" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2"
                                   placeholder="Masukkan nama rute">
                            @error('route_name')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Tipe Transportasi -->
                        <div class="space-y-2">
                            <label for="type" class="block text-sm font-medium text-gray-700 flex items-center">
                                Jenis Transportasi <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="type" id="type" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2">
                                <option value="">Pilih Jenis</option>
                                <option value="bus" {{ old('type') == 'bus' ? 'selected' : '' }}>Bus</option>
                                <option value="train" {{ old('type') == 'train' ? 'selected' : '' }}>Kereta Api</option>
                                <option value="minibus" {{ old('type') == 'minibus' ? 'selected' : '' }}>Minibus</option>
                                <option value="ferry" {{ old('type') == 'ferry' ? 'selected' : '' }}>Kapal Ferry</option>
                                <option value="airplane" {{ old('type') == 'airplane' ? 'selected' : '' }}>Pesawat</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Harga -->
                        <div class="space-y-2">
                            <label for="price" class="block text-sm font-medium text-gray-700 flex items-center">
                                Harga (Rp) <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" name="price" id="price" 
                                       value="{{ old('price') }}" min="0" required
                                       class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2">
                            </div>
                            @error('price')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Durasi -->
                        <div class="space-y-2">
                            <label for="duration_minutes" class="block text-sm font-medium text-gray-700 flex items-center">
                                Durasi Perjalanan (menit) <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" name="duration_minutes" id="duration_minutes" 
                                       value="{{ old('duration_minutes') }}" min="1" required
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">menit</span>
                                </div>
                            </div>
                            @error('duration_minutes')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Jam Keberangkatan -->
                        <div class="md:col-span-2 space-y-2">
                            <label for="departure_times" class="block text-sm font-medium text-gray-700 flex items-center">
                                Jam Keberangkatan <span class="text-gray-400 text-xs ml-2">(pisahkan dengan koma)</span>
                            </label>
                            <input type="text" name="departure_times" id="departure_times" 
                                   value="{{ old('departure_times') }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2"
                                   placeholder="Contoh: 08:00, 12:30, 18:45">
                            @error('departure_times')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Koordinat Rute -->
                        <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-medium text-gray-700 flex items-center">
                                    <i class="fas fa-route text-blue-500 mr-2"></i>
                                    Titik Rute (Koordinat)
                                </h3>
                                <button type="button" onclick="addCoordinate()" class="text-xs text-blue-600 hover:text-blue-800 flex items-center">
                                    <i class="fas fa-plus-circle mr-1"></i> Tambah Titik
                                </button>
                            </div>
                            
                            <div class="space-y-4" id="coordinates-container">
                                @php
                                    $coordinates = old('coordinates', [['lat' => '', 'lng' => '']]);
                                @endphp
                                
                                @foreach($coordinates as $index => $coord)
                                <div class="coordinate-group grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                    <div class="md:col-span-5">
                                        <label class="block text-xs text-gray-500 mb-1">Latitude</label>
                                        <input type="text" 
                                               name="coordinates[{{ $index }}][lat]" 
                                               value="{{ $coord['lat'] ?? '' }}"
                                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-200 px-3 py-2 coordinate-input"
                                               placeholder="Contoh: -6.175392">
                                    </div>
                                    <div class="md:col-span-5">
                                        <label class="block text-xs text-gray-500 mb-1">Longitude</label>
                                        <input type="text" 
                                               name="coordinates[{{ $index }}][lng]" 
                                               value="{{ $coord['lng'] ?? '' }}"
                                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-200 px-3 py-2 coordinate-input"
                                               placeholder="Contoh: 106.827153">
                                    </div>
                                    <div class="md:col-span-2 flex justify-end">
                                        @if($index > 0)
                                        <button type="button" onclick="removeCoordinate(this)" class="text-red-500 hover:text-red-700 text-sm flex items-center">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            @error('coordinates')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                            
                            <div class="mt-4 flex items-center text-sm text-gray-500">
                                <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                                Gunakan format desimal. Contoh: -6.175392 (latitude), 106.827153 (longitude)
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                    <div class="text-sm text-gray-500 flex items-center">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                        Kolom dengan tanda <span class="text-red-500 ml-1">*</span> wajib diisi
                    </div>
                    <div class="flex space-x-3">
                        <button type="reset" class="btn-secondary px-6 py-2 rounded-lg text-gray-700 flex items-center justify-center border border-gray-300 hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-undo mr-2"></i> Reset
                        </button>
                        <button type="submit" class="btn-primary px-6 py-2 rounded-lg text-white flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-200">
                            <i class="fas fa-save mr-2"></i> Simpan Transportasi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        transform: translateY(-1px);
    }
    
    .btn-secondary {
        transition: all 0.2s ease;
    }
    
    .btn-secondary:hover {
        background-color: #f3f4f6;
    }
    
    .coordinate-input {
        transition: all 0.2s ease;
    }
    
    .coordinate-input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    
    @media (max-width: 768px) {
        .coordinate-group {
            gap: 2;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Add new coordinate field
    function addCoordinate() {
        const container = document.getElementById('coordinates-container');
        const index = document.querySelectorAll('.coordinate-group').length;
        
        const html = `
        <div class="coordinate-group grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="md:col-span-5">
                <label class="block text-xs text-gray-500 mb-1">Latitude</label>
                <input type="text" 
                       name="coordinates[${index}][lat]" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-200 px-3 py-2 coordinate-input"
                       placeholder="Contoh: -6.175392">
            </div>
            <div class="md:col-span-5">
                <label class="block text-xs text-gray-500 mb-1">Longitude</label>
                <input type="text" 
                       name="coordinates[${index}][lng]" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-200 px-3 py-2 coordinate-input"
                       placeholder="Contoh: 106.827153">
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="button" onclick="removeCoordinate(this)" class="text-red-500 hover:text-red-700 text-sm flex items-center">
                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                </button>
            </div>
        </div>`;
        
        container.insertAdjacentHTML('beforeend', html);
    }
    
    // Remove coordinate field
    function removeCoordinate(button) {
        const group = button.closest('.coordinate-group');
        group.remove();
        
        // Reindex remaining coordinates
        const groups = document.querySelectorAll('.coordinate-group');
        groups.forEach((group, index) => {
            group.querySelector('[name*="[lat]"]').name = `coordinates[${index}][lat]`;
            group.querySelector('[name*="[lng]"]').name = `coordinates[${index}][lng]`;
        });
    }
    
    // Form validation
    document.getElementById('transportationForm').addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validate required fields
        const requiredFields = ['route_name', 'type', 'price', 'duration_minutes'];
        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        // Validate coordinates
        const coordinateInputs = document.querySelectorAll('.coordinate-input');
        coordinateInputs.forEach(input => {
            if (input.value.trim() && !isValidCoordinate(input.value)) {
                input.classList.add('border-red-500');
                isValid = false;
            } else {
                input.classList.remove('border-red-500');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Harap isi semua kolom wajib dan pastikan koordinat valid!');
        }
    });
    
    // Simple coordinate validation
    function isValidCoordinate(value) {
        return /^-?\d{1,3}\.\d+$/.test(value);
    }
</script>
@endpush
@endsection