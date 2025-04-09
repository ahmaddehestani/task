<?php

namespace App\Services;

use App\Models\Package;

class TravelPackageService
{
    function index(int $limit=15)
    {
        return Package::query()->with(['bookings'])->paginate($limit);
    }
    function store(array $payload)
    {
        return Package::create($payload);
    }

}
