@extends('layouts.app')

@section('title', 'Rencana Perjalanan Saya')

@section('content')
<div class="min-h-screen bg-gray-50 ">
    <div class="container w-[85%] mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Rencana Perjalanan Saya</h1>
                <p class="text-gray-600 mt-1">Kelola semua rencana perjalanan Anda di Blitar</p>
            </div>
            <a href="{{ route('travel-plans.create') }}" class="btn-primary px-6 py-3 rounded-lg text-white flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                <i class="fas fa-plus-circle mr-2"></i> Buat Rencana Baru
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

        <!-- Plans Grid -->
        @if(count($plans) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($plans as $plan)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-blue-100">
                <!-- Plan Header -->
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex justify-between items-start">
                        <h2 class="text-xl font-bold text-gray-800 truncate">{{ $plan->name }}</h2>
                        <span class="bg-blue-50 text-blue-700 text-xs font-semibold py-1 px-2.5 rounded-full whitespace-nowrap">
                            {{ number_format($plan->budget, 0, ',', '.') }} IDR
                        </span>
                    </div>
                    
                    <!-- Date Info -->
                    <div class="flex items-center text-gray-500 text-sm mt-3">
                        <div class="flex items-center mr-4">
                            <i class="far fa-calendar text-blue-400 mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($plan->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($plan->end_date)->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock text-blue-400 mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($plan->start_date)->diffInDays($plan->end_date) + 1 }} hari</span>
                        </div>
                    </div>
                </div>
                
                <!-- Plan Details -->
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-500">Budget per hari</span>
                        <span class="text-sm font-semibold text-blue-600">
                            @php
                                $days = \Carbon\Carbon::parse($plan->start_date)->diffInDays($plan->end_date) + 1;
                                $dailyBudget = $plan->budget / $days;
                            @endphp
                            {{ number_format($dailyBudget, 0, ',', '.') }} IDR
                        </span>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Terkumpul</span>
                            <span>75%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex justify-between border-t border-gray-100 pt-4">
                        <a href="{{ route('travel-plans.show', $plan) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center px-3 py-1.5 rounded-lg hover:bg-blue-50 transition-colors">
                            <i class="fas fa-eye mr-2"></i> Detail
                        </a>
                        <a href="{{ route('travel-plans.edit', $plan) }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium flex items-center px-3 py-1.5 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-pencil-alt mr-2"></i> Edit
                        </a>
                        <form action="{{ route('travel-plans.destroy', $plan) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors" onclick="return confirm('Hapus rencana ini?')">
                                <i class="fas fa-trash-alt mr-2"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $plans->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm p-8 text-center max-w-2xl mx-auto">
            <div class="w-40 h-40 mx-auto mb-6">
                <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/128/external-travel-plan-travel-agency-flaticons-flat-flat-icons.png" alt="No Plans" class="w-full h-full object-contain">
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Rencana Perjalanan</h3>
            <p class="text-gray-600 mb-6">Mulai petualangan Anda di Blitar dengan membuat rencana perjalanan pertama</p>
            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <a href="{{ route('travel-plans.create') }}" class="btn-primary px-6 py-3 rounded-lg text-white flex items-center justify-center shadow-md hover:shadow-lg transition-all">
                    <i class="fas fa-plus-circle mr-2"></i> Buat Rencana Baru
                </a>
                {{-- <a href="{{ route('travel-guides') }}" class="btn-secondary px-6 py-3 rounded-lg border border-blue-600 text-blue-600 flex items-center justify-center hover:bg-blue-50 transition-colors">
                    <i class="fas fa-compass mr-2"></i> Lihat Panduan Wisata
                </a> --}}
            </div>
        </div>
        @endif
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
    }
    
    .btn-secondary {
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        transform: translateY(-1px);
    }
    
    .plan-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .plan-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    /* Pagination styling */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }
    
    .pagination li {
        margin: 0 4px;
    }
    
    .pagination li a, 
    .pagination li span {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease;
    }
    
    .pagination li a:hover {
        background-color: #f3f4f6;
        color: #1d4ed8;
    }
    
    .pagination .active span {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .plan-actions {
            flex-direction: column;
            gap: 8px;
        }
        
        .plan-actions a, 
        .plan-actions button {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush