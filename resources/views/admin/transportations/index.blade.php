@extends('layouts.app')

@section('title', 'Manage Transportation')

@section('content')
<div class="container w-[85%] mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Transportasi</h1>
        <a href="{{ route('admin.transportations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Tambah Rute
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Rute</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($transportations as $transportation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transportation->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $transportation->route_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($transportation->type == 'bus')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Bus</span>
                                @elseif($transportation->type == 'angkot')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Angkot</span>
                                @elseif($transportation->type == 'kereta')
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Kereta</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">{{ ucfirst($transportation->type) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp {{ number_format($transportation->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transportation->duration_minutes }} menit
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if(is_array($transportation->departure_times))
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($transportation->departure_times as $time)
                                            <span class="px-2 py-0.5 bg-gray-100 text-gray-800 rounded text-xs">{{ $time }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex space-x-2">
                                <a href="{{ route('admin.transportations.edit', $transportation) }}" class="text-green-600 hover:text-green-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.transportations.destroy', $transportation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus rute ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 bg-gray-50">
            {{ $transportations->links() }}
        </div>
    </div>
</div>
@endsection 