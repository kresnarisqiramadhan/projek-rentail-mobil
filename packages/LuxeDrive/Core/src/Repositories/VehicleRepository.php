<?php

namespace LuxeDrive\Core\Repositories;

use LuxeDrive\Core\Models\Vehicle;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function all()
    {
        return Vehicle::all();
    }

    public function find($id)
    {
        return Vehicle::find($id);
    }
}
