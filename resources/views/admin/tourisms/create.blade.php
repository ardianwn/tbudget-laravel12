@extends('layouts.app')

@section('title', 'Add New Destination')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <a href="{{ route('admin.tourisms.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                    Tambah Destinasi Baru
                </h1>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <form action="{{ route('admin.tourisms.store') }}" method="POST" enctype="multipart/form-data" id="tourismForm">
                @csrf
                
                <!-- Form Header -->
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-gray-50">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                        Informasi Destinasi Wisata
                    </h2>
                </div>
                
                <!-- Form Content -->
                <div class="p-6 space-y-6">
                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Destinasi -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 flex items-center">
                                Nama Destinasi <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2"
                                   placeholder="Masukkan nama destinasi">
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Tipe Destinasi -->
                        <div class="space-y-2">
                            <label for="type" class="block text-sm font-medium text-gray-700 flex items-center">
                                Kategori <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="type" id="type" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2">
                                <option value="">Pilih Kategori</option>
                                <option value="tourism" {{ old('type') == 'tourism' ? 'selected' : '' }}>Umum</option>
                                <option value="park" {{ old('type') == 'park' ? 'selected' : '' }}>Taman</option>
                                <option value="historical" {{ old('type') == 'historical' ? 'selected' : '' }}>Sejarah</option>
                                <option value="beach" {{ old('type') == 'beach' ? 'selected' : '' }}>Pantai</option>
                                <option value="agrotourism" {{ old('type') == 'agrotourism' ? 'selected' : '' }}>Agrowisata</option>
                                <option value="monument" {{ old('type') == 'monument' ? 'selected' : '' }}>Monumen</option>
                                <option value="religious" {{ old('type') == 'religious' ? 'selected' : '' }}>Religi</option>
                                <option value="culinary" {{ old('type') == 'culinary' ? 'selected' : '' }}>Kuliner</option>
                                <option value="rest_area" {{ old('type') == 'rest_area' ? 'selected' : '' }}>Rest Area</option>
                                <option value="accommodation" {{ old('type') == 'accommodation' ? 'selected' : '' }}>Akomodasi</option>
                                <option value="mountain" {{ old('type') == 'mountain' ? 'selected' : '' }}>Gunung</option>
                                <option value="camping" {{ old('type') == 'camping' ? 'selected' : '' }}>Camping</option>
                                <option value="temple" {{ old('type') == 'temple' ? 'selected' : '' }}>Candi</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Lokasi -->
                        <div class="space-y-2">
                            <label for="location" class="block text-sm font-medium text-gray-700 flex items-center">
                                Lokasi/Alamat <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2"
                                   placeholder="Masukkan lokasi destinasi">
                            @error('location')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Harga Tiket -->
                        <div class="space-y-2">
                            <label for="entrance_fee" class="block text-sm font-medium text-gray-700">
                                Harga Tiket Masuk (Rp)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" name="entrance_fee" id="entrance_fee" 
                                       value="{{ old('entrance_fee', 0) }}" min="0"
                                       class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2">
                            </div>
                            @error('entrance_fee')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Fasilitas -->
                        <div class="space-y-2">
                            <label for="facilities" class="block text-sm font-medium text-gray-700 flex items-center">
                                Fasilitas <span class="text-gray-400 text-xs ml-2">(pisahkan dengan koma)</span>
                            </label>
                            <input type="text" name="facilities" id="facilities" value="{{ old('facilities') }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2"
                                   placeholder="Contoh: Parkir, Toilet, Mushola">
                            @error('facilities')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Deskripsi -->
                        <div class="md:col-span-2 space-y-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 flex items-center">
                                Deskripsi Destinasi <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="description" id="description" rows="5" required
                                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2"
                                      placeholder="Masukkan deskripsi lengkap destinasi">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Koordinat -->
                        <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-sm font-medium text-gray-700 flex items-center">
                                    <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                                    Koordinat Lokasi
                                </h3>
                                <button type="button" id="getLocationBtn" class="text-xs text-blue-600 hover:text-blue-800 flex items-center">
                                    <i class="fas fa-location-arrow mr-1"></i> Dapatkan Lokasi Saat Ini
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Latitude -->
                                <div class="space-y-2">
                                    <label for="latitude" class="block text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Latitude <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="latitude" id="latitude" required
                                           value="{{ old('latitude', '-8.0976') }}"
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2">
                                    @error('latitude')
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Longitude -->
                                <div class="space-y-2">
                                    <label for="longitude" class="block text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Longitude <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="longitude" id="longitude" required
                                           value="{{ old('longitude', '112.1678') }}"
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2">
                                    @error('longitude')
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div id="map" class="mt-4 h-64 rounded-lg border border-gray-300 hidden"></div>
                        </div>
                        
                        <!-- Upload Gambar -->
                        <div class="md:col-span-2 space-y-4">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center" id="uploadContainer">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-camera text-3xl text-gray-400 mb-3"></i>
                                    <h3 class="text-sm font-medium text-gray-700">
                                        Upload Foto Destinasi
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Format: JPG, PNG, JPEG maksimal 2MB
                                    </p>
                                    <div class="mt-4">
                                        <input type="file" name="image" id="image" class="hidden" accept="image/jpeg,image/png">
                                        <label for="image" class="cursor-pointer bg-blue-50 text-blue-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-100 transition duration-200">
                                            Pilih File
                                        </label>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="text-red-500 text-xs italic mt-3">{{ $message }}</p>
                                @enderror
                            </div>
                            <div id="imagePreview" class="hidden mt-4">
                                <div class="relative inline-block">
                                    <img id="previewImage" src="#" alt="Preview" class="h-40 rounded-lg shadow-sm">
                                    <button type="button" id="removeImageBtn" class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 transform translate-x-1/2 -translate-y-1/2">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
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
                            <i class="fas fa-save mr-2"></i> Simpan Destinasi
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
    
    /* Animations */
    input, select, textarea, button {
        transition: all 0.2s ease-in-out;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .flex-col-mobile {
            flex-direction: column;
        }
        
        .space-x-3 {
            margin-right: 0;
            margin-bottom: 0.75rem;
        }
    }
    
    #map {
        z-index: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    // Image Preview Handler
    document.getElementById('image').addEventListener('change', function(e) {
        const [file] = e.target.files;
        if (file) {
            const preview = document.getElementById('previewImage');
            preview.src = URL.createObjectURL(file);
            document.getElementById('imagePreview').classList.remove('hidden');
            document.getElementById('uploadContainer').classList.add('hidden');
        }
    });
    
    // Remove Image Handler
    document.getElementById('removeImageBtn').addEventListener('click', function() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('uploadContainer').classList.remove('hidden');
    });
    
    // Get Current Location
    document.getElementById('getLocationBtn').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
                    document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
                    alert('Lokasi berhasil diperbarui!');
                },
                function(error) {
                    alert('Gagal mendapatkan lokasi: ' + error.message);
                }
            );
        } else {
            alert('Browser tidak mendukung geolocation');
        }
    });
    
    // Form Validation
    document.getElementById('tourismForm').addEventListener('submit', function(e) {
        let valid = true;
        
        // Check required fields
        const requiredFields = ['name', 'type', 'location', 'description', 'latitude', 'longitude'];
        requiredFields.forEach(field => {
            const element = document.getElementById(field);
            if (!element.value.trim()) {
                element.classList.add('border-red-500');
                valid = false;
            } else {
                element.classList.remove('border-red-500');
            }
        });
        
        if (!valid) {
            e.preventDefault();
            alert('Harap isi semua kolom yang wajib diisi!');
        }
    });
</script>
@endpush
@endsection