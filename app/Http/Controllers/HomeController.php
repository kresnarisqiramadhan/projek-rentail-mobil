<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LuxeDrive\Core\Services\VehicleService;

class HomeController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index()
    {
        $vehicles = $this->vehicleService->getAllVehicles();
        
        return view('home', compact('vehicles'));
    }
}
