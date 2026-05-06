<?php

namespace LuxeDrive\Core\Services;

use LuxeDrive\Core\Repositories\VehicleRepositoryInterface;

class VehicleService
{
    protected $repository;

    public function __construct(VehicleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllVehicles()
    {
        return $this->repository->all();
    }
}
