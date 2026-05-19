<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Vehicle::active()->with(['photos' => fn($q) => $q->orderBy('sort_order')]);

        if ($request->filled('brand')) {
            $query->filterByBrand($request->input('brand'));
        }

        if ($request->filled('seats')) {
            $query->filterBySeats($request->input('seats'));
        }

        if ($request->filled('min_price')) {
            $query->filterByPriceRange((float) $request->min_price, null);
        }
        if ($request->filled('max_price')) {
            $query->filterByPriceRange(null, (float) $request->max_price);
        }

        if ($request->boolean('available')) {
            $query->available();
        }

        match ($request->input('sort')) {
            'harga_rendah' => $query->orderBy('price_per_day', 'asc'),
            'harga_tinggi' => $query->reorder()->orderBy('price_per_day', 'desc'),
            'populer'      => $query->reorder()->orderByDesc('avg_rating'),
            default        => $query->latest(),
        };

        $vehicles = $query->paginate(12)->withQueryString();

        $brands = Vehicle::active()->distinct()->pluck('brand')->sort()->values();
        $seats  = Vehicle::active()->distinct()->pluck('seats')->sort()->values();

        return view('vehicles', compact('vehicles', 'brands', 'seats'));
    }

    public function show(Vehicle $vehicle): View
    {
        $vehicle->load(['photos', 'ratings' => fn($q) => $q->with('user')->latest()->limit(10)]);
        $vehicle->loadCount('ratings');
        $isAvailable = $vehicle->is_active &&
            !$vehicle->orders()
                ->whereIn('status', array_map(
                    fn($s) => $s->value,
                    \App\Enums\OrderStatus::blockingDeletion()
                ))
                ->exists();

        return view('vehicle-details', compact('vehicle', 'isAvailable'));
    }

    public function search(Request $request): View
    {
        $query = Vehicle::active()->with(['photos' => fn($q) => $q->orderBy('sort_order')]);

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        $vehicles = $query->paginate(12)->withQueryString();

        return view('search', compact('vehicles'));
    }
}
