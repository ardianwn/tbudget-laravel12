<?php

namespace App\Http\Controllers;

use App\Models\LocalRoute;
use Illuminate\Http\Request;

class LocalRouteController extends Controller
{
    public function index()
    {
        $localRoutes = LocalRoute::all();
        return view('local-routes.index', compact('localRoutes'));
    }

    public function getRoutes()
    {
        $routes = LocalRoute::all();
        return response()->json($routes);
    }
} 