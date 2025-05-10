<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transportation;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    public function index()
    {
        $transportations = Transportation::paginate(15);
        return view('admin.transportations.index', compact('transportations'));
    }

    public function create()
    {
        return view('admin.transportations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'departure_times' => 'required|array'
        ]);

        Transportation::create($validated);
        return redirect()->route('admin.transportations.index')
            ->with('success', 'Rute transportasi berhasil ditambahkan');
    }

    public function edit(Transportation $transportation)
    {
        return view('admin.transportations.edit', compact('transportation'));
    }

    public function update(Request $request, Transportation $transportation)
    {
        $validated = $request->validate([
            'route_name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'departure_times' => 'required|array'
        ]);

        $transportation->update($validated);
        return redirect()->route('admin.transportations.index')
            ->with('success', 'Rute transportasi berhasil diperbarui');
    }

    public function destroy(Transportation $transportation)
    {
        $transportation->delete();
        return redirect()->route('admin.transportations.index')
            ->with('success', 'Rute transportasi berhasil dihapus');
    }
} 