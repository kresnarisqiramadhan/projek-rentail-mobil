<?php

namespace LuxeDrive\Core\Repositories;

interface VehicleRepositoryInterface
{
    public function all();
    public function find($id);
}
