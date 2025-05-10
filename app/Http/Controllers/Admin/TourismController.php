<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tourism;
use App\Http\Requests\TourismRequest;
use Illuminate\Support\Facades\Storage;

class TourismController extends Controller
{
    public function index()
    {
        $query = Tourism::query();

        // Handle search
        if (request()->has('search')) {
            $searchTerm = request('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('location', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Handle type filter
        if (request()->has('type') && request('type') !== '') {
            $query->where('type', request('type'));
        }

        // Handle sorting
        $sort = request('sort', 'created_at');
        $direction = request('direction', 'desc');
        
        $allowedSortFields = ['name', 'entrance_fee', 'created_at'];
        if (in_array($sort, $allowedSortFields)) {
            $query->orderBy($sort, $direction);
        }

        $tourisms = $query->paginate(15)->withQueryString();
        return view('admin.tourisms.index', compact('tourisms'));
    }

    public function create()
    {
        return view('admin.tourisms.create');
    }

    public function store(TourismRequest $request)
    {
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }
        
        // Handle facilities
        $data['facilities'] = $this->processFacilities($data['facilities'] ?? '');
        
        Tourism::create($data);
        
        return redirect()->route('admin.tourisms.index')
            ->with('success', 'Destinasi wisata berhasil ditambahkan');
    }

    public function show(Tourism $tourism)
    {
        return view('admin.tourisms.show', compact('tourism'));
    }

    public function edit(Tourism $tourism)
    {
        return view('admin.tourisms.edit', compact('tourism'));
    }

    public function update(TourismRequest $request, Tourism $tourism)
    {
        $data = $request->validated();
        
        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            $this->deleteImage($tourism->image);
            
            // Upload new image
            $data['image'] = $this->uploadImage($request->file('image'));
        }
        
        // Handle facilities
        $data['facilities'] = $this->processFacilities($data['facilities'] ?? '');
        
        $tourism->update($data);
        
        return redirect()->route('admin.tourisms.index')
            ->with('success', 'Destinasi wisata berhasil diperbarui');
    }

    public function destroy(Tourism $tourism)
    {
        // Delete associated image
        $this->deleteImage($tourism->image);
        
        $tourism->delete();
        
        return redirect()->route('admin.tourisms.index')
            ->with('success', 'Destinasi wisata berhasil dihapus');
    }

    /**
     * Upload image to storage
     */
    private function uploadImage($image)
    {
        $filename = 'tourism_' . time() . '.' . $image->getClientOriginalExtension();
        return $image->storeAs('tourisms', $filename, 'public');
    }

    /**
     * Delete image from storage
     */
    private function deleteImage($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    /**
     * Process facilities string to array
     */
    private function processFacilities($facilities)
    {
        if (empty($facilities)) {
            return [];
        }

        if (is_string($facilities)) {
            return array_map('trim', explode(',', $facilities));
        }

        return $facilities;
    }
}