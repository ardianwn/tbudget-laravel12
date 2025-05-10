<?php

namespace App\Http\Controllers;

use App\Models\Tourism;
use App\Models\TravelPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TourismController extends Controller
{
    /**
     * Display paginated list of tourisms for frontend
     */
    public function index(Request $request)
    {
        $query = Tourism::query();
        
        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        // Type filter
        if ($request->has('type') && !empty($request->type)) {
            $query->where('type', $request->type);
        }
        
        // Price filter
        if ($request->has('price') && !empty($request->price)) {
            switch ($request->price) {
                case 'free':
                    $query->where('entrance_fee', 0);
                    break;
                case 'cheap':
                    $query->where('entrance_fee', '>', 0)
                          ->where('entrance_fee', '<=', 25000);
                    break;
                case 'medium':
                    $query->where('entrance_fee', '>', 25000)
                          ->where('entrance_fee', '<=', 50000);
                    break;
                case 'expensive':
                    $query->where('entrance_fee', '>', 50000);
                    break;
            }
        }
        
        // Sort options
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('entrance_fee', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('entrance_fee', 'desc');
                    break;
                case 'popular':
                default:
                    $query->orderBy('id', 'desc');
                    break;
            }
        } else {
            $query->orderBy('id', 'desc');
        }
        
        $tourisms = $query->paginate(12)->withQueryString();
        return view('tourism.index', compact('tourisms'));
    }

    /**
     * Display single tourism view
     */
    public function show(Tourism $tourism)
    {
        $userTravelPlans = [];
        if (Auth::check()) {
            $userTravelPlans = User::find(Auth::id())->travelPlans()
                ->select('id', 'name', 'start_date', 'end_date', 'budget')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Get nearby destinations within 10km radius, excluding current tourism
        $nearbyTourisms = null;
        if ($tourism->latitude && $tourism->longitude) {
            $nearbyTourisms = Tourism::select(
                '*',
                DB::raw('(
                    6371 * acos(
                        cos(radians(?)) * cos(radians(latitude)) *
                        cos(radians(longitude) - radians(?)) +
                        sin(radians(?)) * sin(radians(latitude))
                    )
                ) AS distance')
            )
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('id', '!=', $tourism->id)
            ->having('distance', '<', 10)
            ->orderBy('distance', 'asc')
            ->limit(3)
            ->setBindings([$tourism->latitude, $tourism->longitude, $tourism->latitude, 10])
            ->get();
        }

        // Format address if not available or incomplete
        if (empty($tourism->address)) {
            $addressParts = [];
            if ($tourism->location) {
                $addressParts[] = $tourism->location;
            }
            $addressParts[] = "Blitar";
            $addressParts[] = "Jawa Timur";
            $tourism->address = implode(', ', $addressParts);
        }

        return view('tourism.show', compact('tourism', 'userTravelPlans', 'nearbyTourisms'));
    }

    /**
     * API endpoint for destination selection in travel plans
     */
    public function apiIndex(Request $request)
    {
        $query = Tourism::query();
        
        // Search filter for API
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Return minimal data needed for select2
        $tourisms = $query->select('id', 'name', 'image', 'location', 'entrance_fee')
            ->orderBy('name')
            ->get();
            
        return response()->json($tourisms);
    }

    /**
     * Get destinations for a specific travel plan
     */
    public function getTravelPlanDestinations(TravelPlan $travelPlan)
    {
        $destinations = $travelPlan->destinations()
            ->with('tourism:id,name,image')
            ->get()
            ->map(function ($destination) {
                return [
                    'id' => $destination->tourism_id,
                    'name' => $destination->tourism->name,
                    'image' => $destination->tourism->image
                ];
            });
            
        return response()->json($destinations);
    }

    /**
     * Map view
     */
    public function map()
    {
        return view('map');
    }

    /**
     * GeoJSON data for map
     */
    public function getMapData()
    {
        $tourisms = Tourism::select('id', 'name', 'type', 'latitude', 'longitude', 'entrance_fee', 'image')
            ->get()
            ->map(function ($tourism) {
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [$tourism->longitude, $tourism->latitude]
                    ],
                    'properties' => [
                        'id' => $tourism->id,
                        'name' => $tourism->name,
                        'type' => $tourism->type,
                        'entrance_fee' => $tourism->entrance_fee,
                        'image' => $tourism->image,
                        'details_url' => route('tourisms.show', $tourism->id)
                    ]
                ];
            });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $tourisms
        ]);
    }
}