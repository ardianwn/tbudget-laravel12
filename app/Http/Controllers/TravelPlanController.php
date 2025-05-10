<?php

namespace App\Http\Controllers;

use App\Models\TravelPlan;
use App\Models\Tourism;
use App\Models\User;
use App\Http\Requests\TravelPlanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelPlanController extends Controller
{
    public function index()
    {
        $plans = User::find(Auth::id())
                    ->travelPlans()
                    ->with(['destinations.tourism'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);
        
        return view('travel-plans.index', compact('plans'));
    }

    public function create()
    {
        return view('travel-plans.create');
    }

    public function store(TravelPlanRequest $request)
    {
        $plan = User::find(Auth::id())->travelPlans()->create($request->validated());

        foreach ($request->destinations as $index => $destinationId) {
            $plan->destinations()->create([
                'tourism_id' => $destinationId,
                'order' => $index + 1
            ]);
        }

        return redirect()->route('travel-plans.show', $plan)
            ->with('success', 'Rencana perjalanan berhasil dibuat');
    }

    public function show(TravelPlan $travelPlan)
    {
        // Authorization check
        if ($travelPlan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $travelPlan->load(['destinations' => function($query) {
            $query->orderBy('order', 'asc');
        }, 'destinations.tourism']);
        
        return view('travel-plans.show', compact('travelPlan'));
    }

    public function edit(TravelPlan $travelPlan)
    {
        // Authorization check
        if ($travelPlan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $travelPlan->load(['destinations' => function($query) {
            $query->orderBy('order', 'asc');
        }, 'destinations.tourism']);
        
        return view('travel-plans.edit', compact('travelPlan'));
    }

    public function update(TravelPlanRequest $request, TravelPlan $travelPlan)
    {
        // Authorization check
        if ($travelPlan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $travelPlan->update($request->validated());
        
        // Sync destinations
        $travelPlan->destinations()->delete();
        
        foreach ($request->destinations as $index => $destinationId) {
            $travelPlan->destinations()->create([
                'tourism_id' => $destinationId,
                'order' => $index + 1
            ]);
        }

        return redirect()->route('travel-plans.show', $travelPlan)
            ->with('success', 'Rencana perjalanan berhasil diperbarui');
    }

    public function destroy(TravelPlan $travelPlan)
    {
        // Authorization check
        if ($travelPlan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $travelPlan->delete();
        return redirect()->route('travel-plans.index')
            ->with('success', 'Rencana perjalanan berhasil dihapus');
    }
    
    /**
     * Quick create a travel plan from tourism page
     */
    public function quickStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'budget' => 'required|numeric|min:0',
            'tourism_id' => 'required|exists:tourisms,id'
        ]);
        
        // Create travel plan
        $plan = User::find(Auth::id())->travelPlans()->create([
            'name' => $validated['name'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'budget' => $validated['budget']
        ]);
        
        // Add destination
        $plan->destinations()->create([
            'tourism_id' => $validated['tourism_id'],
            'order' => 1
        ]);
        
        return redirect()->route('travel-plans.show', $plan)
            ->with('success', 'Rencana perjalanan berhasil dibuat');
    }
    
    /**
     * Add a destination to an existing travel plan
     */
    public function addDestination(Request $request, TravelPlan $travelPlan)
    {
        // Authorization check
        if ($travelPlan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'tourism_id' => 'required|exists:tourisms,id'
        ]);
        
        // Find the highest order
        $maxOrder = $travelPlan->destinations()->max('order') ?? 0;
        
        // Create destination
        $travelPlan->destinations()->create([
            'tourism_id' => $request->tourism_id,
            'order' => $maxOrder + 1
        ]);
        
        return redirect()->route('travel-plans.show', $travelPlan)
            ->with('success', 'Destinasi berhasil ditambahkan ke rencana perjalanan');
    }
}