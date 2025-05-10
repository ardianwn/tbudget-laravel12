<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    public function index()
    {
        $transportations = Transportation::all();
        return view('transportation.index', compact('transportations'));
    }

    public function getRoutes()
    {
        $routes = Transportation::all();
        return response()->json($routes);
    }
} 