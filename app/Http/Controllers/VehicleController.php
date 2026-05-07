<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    // ──────────────────────────────────────────────────────────────────────────
    // FR-B04, FR-B05: Vehicle list with filters (accessible without login)
    // ──────────────────────────────────────────────────────────────────────────
    public function index(Request $request): View
    {
        $query = Vehicle::active()->with(['photos' => fn($q) => $q->orderBy('sort_order')]);

        // FR-B05: Filter by type/brand
        if ($request->filled('type')) {
            $query->filterByType($request->type);
        }

        // FR-B05: Filter by price range
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->filterByPriceRange(
                $request->filled('min_price') ? (float) $request->min_price : null,
                $request->filled('max_price') ? (float) $request->max_price : null,
            );
        }

        $vehicles = $query->paginate(12)->withQueryString();
        $types    = Vehicle::active()->distinct()->pluck('type')->sort()->values();

        return view('vehicles.index', compact('vehicles', 'types'));
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-B06: Vehicle detail (accessible without login)
    // ──────────────────────────────────────────────────────────────────────────
    public function show(Vehicle $vehicle): View
    {
        if (!$vehicle->is_active) {
            abort(404);
        }

        $vehicle->load(['photos', 'ratings' => fn($q) => $q->with('user')->latest()->limit(5)]);

        return view('vehicles.show', compact('vehicle'));
    }
}
