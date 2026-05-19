<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class HomeController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::active()
            ->with(['photos' => fn($q) => $q->orderBy('sort_order')])
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('vehicles'));
    }
}
