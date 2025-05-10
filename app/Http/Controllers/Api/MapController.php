<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tourism;
use App\Models\LocalRoute;
use App\Models\Transportation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MapController extends Controller
{
    public function getAllPoints()
    {
        try {
            // Mengambil semua titik wisata dengan koordinat
            $tourisms = Tourism::select('id', 'name', 'type', 'description', 'latitude', 'longitude', 'entrance_fee', 'facilities', 'image')
                ->get();

            // Log untuk debug
            Log::info('Tourism data retrieved: ' . $tourisms->count() . ' records');
            Log::info('Sample tourism data:', ['first_item' => $tourisms->first()]);

            $features = $tourisms->map(function ($tourism) {
                // Log gambar untuk setiap item
                Log::info('Tourism item image: ' . $tourism->id . ' - ' . $tourism->image);
                
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
                        'description' => $tourism->description,
                        'entrance_fee' => $tourism->entrance_fee,
                        'facilities' => $tourism->facilities,
                        'marker_type' => $tourism->type,
                        'image' => $tourism->image ? asset('storage/' . $tourism->image) : null
                    ]
                ];
            });

            $response = [
                'type' => 'FeatureCollection',
                'features' => $features
            ];

            // Log respons final
            Log::info('Response features count: ' . count($features));

            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Error in getAllPoints: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getLocalRoutes()
    {
        try {
            $routes = LocalRoute::all();
            
            $features = $routes->map(function ($route) {
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'LineString',
                        'coordinates' => $route->coordinates
                    ],
                    'properties' => [
                        'id' => $route->id,
                        'name' => $route->name,
                        'type' => $route->type,
                        'price' => $route->price,
                        'frequency' => $route->frequency
                    ]
                ];
            });

            return response()->json([
                'type' => 'FeatureCollection',
                'features' => $features
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getLocalRoutes: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getTransportationRoutes()
    {
        try {
            $routes = Transportation::all();
            
            $features = $routes->map(function ($route) {
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'LineString',
                        'coordinates' => $route->coordinates
                    ],
                    'properties' => [
                        'id' => $route->id,
                        'name' => $route->route_name,
                        'type' => $route->type,
                        'price' => $route->price,
                        'duration_minutes' => $route->duration_minutes,
                        'departure_times' => $route->departure_times
                    ]
                ];
            });

            return response()->json([
                'type' => 'FeatureCollection',
                'features' => $features
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getTransportationRoutes: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getFilteredPoints(Request $request)
    {
        try {
            $query = Tourism::query();

            if ($request->has('type')) {
                $query->where('type', $request->type);
            }

            if ($request->has('price_min') && $request->has('price_max')) {
                $query->whereBetween('entrance_fee', [$request->price_min, $request->price_max]);
            }

            $points = $query->get();

            $features = $points->map(function ($tourism) {
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
                        'description' => $tourism->description,
                        'entrance_fee' => $tourism->entrance_fee,
                        'facilities' => $tourism->facilities,
                        'image' => $tourism->image ? asset('storage/' . $tourism->image) : null
                    ]
                ];
            });

            return response()->json([
                'type' => 'FeatureCollection',
                'features' => $features
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getFilteredPoints: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getNearbyPoints(Request $request)
    {
        try {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $radius = $request->radius ?? 5;

            $points = Tourism::selectRaw("
                id, name, type, description, latitude, longitude, entrance_fee, facilities, image,
                (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance",
                [$latitude, $longitude, $latitude]
            )
                ->having('distance', '<=', $radius)
                ->orderBy('distance')
                ->get();

            $features = $points->map(function ($tourism) {
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
                        'description' => $tourism->description,
                        'entrance_fee' => $tourism->entrance_fee,
                        'facilities' => $tourism->facilities,
                        'distance' => round($tourism->distance, 2),
                        'image' => $tourism->image ? asset('storage/' . $tourism->image) : null
                    ]
                ];
            });

            return response()->json([
                'type' => 'FeatureCollection',
                'features' => $features
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getNearbyPoints: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}