@extends('layouts.app')

@section('title', 'Manage Destinations')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Kelola Destinasi Wisata</h1>
                <p class="text-gray-600 mt-1">Daftar lengkap destinasi wisata yang terdaftar dalam sistem</p>
            </div>
            <a href="{{ route('admin.tourisms.create') }}" 
               class="btn-primary px-6 py-3 rounded-lg text-white flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Destinasi
            </a>
        </div>

        <!-- Success Notification -->
        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-8 rounded-lg flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400 text-xl mr-3 mt-0.5"></i>
            </div>
            <div>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Search and Filter Section -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <form action="{{ route('admin.tourisms.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Destinasi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="search" id="search" placeholder="Cari berdasarkan nama/lokasi..." 
                                   value="{{ request('search') }}"
                                   class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2">
                        </div>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Filter Tipe</label>
                        <select name="type" id="type" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 px-4 py-2">
                            <option value="">Semua Tipe</option>
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
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-white flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-200">
                            <i class="fas fa-filter mr-2"></i> Terapkan
                        </button>
                        <a href="{{ route('admin.tourisms.index') }}" class="btn-secondary px-4 py-2 rounded-lg text-gray-700 flex items-center justify-center border border-gray-300 hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-sync-alt mr-2"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Destinations Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    Nama Destinasi
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="ml-1 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-sort{{ request('sort') == 'name' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    Harga Tiket
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'entrance_fee', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="ml-1 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-sort{{ request('sort') == 'entrance_fee' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($tourisms as $tourism)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $tourism->name }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($tourism->description, 30) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $tourism->type === 'alam' ? 'bg-green-100 text-green-800' : 
                                       ($tourism->type === 'sejarah' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($tourism->type === 'budaya' ? 'bg-purple-100 text-purple-800' :
                                       ($tourism->type === 'religi' ? 'bg-blue-100 text-blue-800' :
                                       'bg-red-100 text-red-800'))) }}">
                                    {{ ucfirst($tourism->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $tourism->location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp {{ number_format($tourism->entrance_fee, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    <a href="{{ route('admin.tourisms.show', $tourism) }}" 
                                       class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50 transition-colors"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.tourisms.edit', $tourism) }}" 
                                       class="text-green-600 hover:text-green-900 p-2 rounded-full hover:bg-green-50 transition-colors"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.tourisms.destroy', $tourism) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition-colors"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-map-marked-alt text-4xl text-gray-300 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-700">Tidak ada destinasi wisata</h3>
                                    <p class="text-sm text-gray-500 mt-1">Mulai dengan menambahkan destinasi baru</p>
                                    <a href="{{ route('admin.tourisms.create') }}" class="btn-primary px-6 py-2 rounded-lg text-white mt-4 inline-flex items-center">
                                        <i class="fas fa-plus-circle mr-2"></i> Tambah Destinasi
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($tourisms->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between">
                <div class="text-sm text-gray-500 mb-4 md:mb-0">
                    Menampilkan {{ $tourisms->firstItem() }} sampai {{ $tourisms->lastItem() }} dari {{ $tourisms->total() }} destinasi
                </div>
                <div class="pagination">
                    {{ $tourisms->withQueryString()->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

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
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        color: #374151;
        transition: all 0.2s ease;
    }
    
    .btn-secondary:hover {
        background-color: #f9fafb;
        border-color: #d1d5db;
    }
    
    /* Pagination styling */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .pagination li {
        margin: 0 2px;
    }
    
    .pagination li a, 
    .pagination li span {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 14px;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease;
    }
    
    .pagination li a:hover {
        background-color: #f3f4f6;
        color: #1d4ed8;
        border-color: #d1d5db;
    }
    
    .pagination .active span {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
    
    .pagination .disabled span {
        color: #9ca3af;
        background-color: #f3f4f6;
        border-color: #e5e7eb;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .pagination li a, 
        .pagination li span {
            padding: 4px 8px;
            font-size: 12px;
        }
        
        .pagination li {
            margin: 0 1px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Confirm before delete
    document.querySelectorAll('form[method="POST"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus destinasi ini?')) {
                e.preventDefault();
            }
        });
    });

    // Live search (optional - bisa diimplementasikan dengan AJAX)
    document.getElementById('search').addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            this.form.submit();
        }
    });
</script>
@endpush