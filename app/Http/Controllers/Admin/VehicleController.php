<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(): View
    {
        $vehicles = Vehicle::with('photos')->latest()->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create(): View
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'type'          => 'required|string|max:255',
            'plate_number'  => 'required|string|max:50|unique:vehicles',
            'price_per_day' => 'required|numeric|min:0',
            'condition'     => 'nullable|string|max:255',
            'is_active'     => 'boolean',
        ]);

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(Vehicle $vehicle): View
    {
        $vehicle->load('photos', 'orders');
        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle): View
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'type'          => 'required|string|max:255',
            'plate_number'  => 'required|string|max:50|unique:vehicles,plate_number,' . $vehicle->id,
            'price_per_day' => 'required|numeric|min:0',
            'condition'     => 'nullable|string|max:255',
            'is_active'     => 'boolean',
        ]);

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        if (!$vehicle->canBeDeleted()) {
            return back()->withErrors(['error' => 'Kendaraan tidak dapat dihapus karena masih memiliki pesanan aktif.']);
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }
}
