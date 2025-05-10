<?php

use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Tourism;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Test route
Route::get('/test', [TestController::class, 'test']);

Route::prefix('map')->group(function () {
    Route::get('/points', [MapController::class, 'getAllPoints']);
    Route::get('/local-routes', [MapController::class, 'getLocalRoutes']);
    Route::get('/transportation-routes', [MapController::class, 'getTransportationRoutes']);
    Route::get('/filtered-points', [MapController::class, 'getFilteredPoints']);
    Route::get('/nearby-points', [MapController::class, 'getNearbyPoints']);
});

// Get all tourisms for travel plan form
Route::get('/tourisms', function () {
    try {
        $tourisms = Tourism::select('id', 'name', 'image', 'location', 'type')
                   ->orderBy('name')
                   ->get();
                   
        if ($tourisms->isEmpty()) {
            return response()->json([
                'message' => 'No tourism data available',
                'data' => []
            ], 200);
        }
        
        return response()->json($tourisms);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Failed to load tourism data',
            'message' => $e->getMessage()
        ], 500);
    }
});

// Get user's travel plans
Route::get('/travel-plans/user', function (Request $request) {
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }
    
    $user = User::find(Auth::id());
    return $user->travelPlans()->select('id', 'name', 'start_date', 'end_date', 'budget')->orderBy('created_at', 'desc')->get();
});
