<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tourism;
use App\Models\User;
use App\Models\TravelPlan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_destinations' => Tourism::count(),
            'total_travel_plans' => TravelPlan::count(),
            'recent_plans' => TravelPlan::with('user')->latest()->take(5)->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 