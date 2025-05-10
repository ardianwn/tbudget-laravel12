@extends('layouts.app')

@section('title', $tourism->name)

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
                    Detail Destinasi: <span class="text-blue-600">{{ $tourism->name }}</span>
                </h1>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.tourisms.edit', $tourism) }}" 
                   class="btn-primary px-4 py-2 rounded-lg text-white flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('admin.tourisms.destroy', $tourism) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger px-4 py-2 rounded-lg text-white flex items-center">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Image Section -->
            @if($tourism->image)
            <div class="w-full h-64 md:h-96 bg-gray-100 relative">
                <img src="{{ asset('storage/' . $tourism->image) }}" 
                     alt="{{ $tourism->name }}"
                     class="w-full h-full object-cover">
            </div>
            @endif

            <!-- Details Section -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Dasar</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-600">Nama Destinasi</label>
                                <p class="mt-1 text-gray-800">{{ $tourism->name }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Kategori</label>
                                <p class="mt-1">
                                    <span class="px-2 py-1 text-sm font-semibold rounded-full 
                                        {{ $tourism->type === 'alam' ? 'bg-green-100 text-green-800' : 
                                           ($tourism->type === 'sejarah' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($tourism->type === 'budaya' ? 'bg-purple-100 text-purple-800' :
                                           ($tourism->type === 'religi' ? 'bg-blue-100 text-blue-800' : 
                                           'bg-red-100 text-red-800'))) }}">
                                        {{ ucfirst($tourism->type) }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Lokasi</label>
                                <p class="mt-1 text-gray-800">{{ $tourism->location }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Harga Tiket</label>
                                <p class="mt-1 text-gray-800">
                                    @if($tourism->entrance_fee == 0)
                                        <span class="text-green-600 font-medium">Gratis</span>
                                    @else
                                        Rp {{ number_format($tourism->entrance_fee, 0, ',', '.') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Tambahan</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-600">Fasilitas</label>
                                @if($tourism->facilities && count($tourism->facilities) > 0)
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach($tourism->facilities as $facility)
                                            <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm">
                                                {{ $facility }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="mt-1 text-gray-500">Tidak ada fasilitas yang tercatat</p>
                                @endif
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Koordinat</label>
                                <div class="mt-1 flex items-center space-x-4">
                                    <p class="text-gray-800">
                                        <span class="font-medium">Lat:</span> {{ $tourism->latitude ?? '-' }}
                                    </p>
                                    <p class="text-gray-800">
                                        <span class="font-medium">Long:</span> {{ $tourism->longitude ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi</h2>
                    <div class="prose max-w-none">
                        {{ $tourism->description ?? 'Tidak ada deskripsi tersedia.' }}
                    </div>
                </div>

                <!-- Created/Updated Info -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                        <p>Dibuat: {{ $tourism->created_at->format('d/m/Y H:i') }}</p>
                        <p>Diperbarui: {{ $tourism->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection