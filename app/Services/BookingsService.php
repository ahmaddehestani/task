<?php

namespace App\Services;

use App\Models\Bookings;

class BookingsService
{
    function index(int $limit=15)
    {
        return Bookings::query()->with(['package'])->paginate($limit);
    }
    function store(array $payload)
    {
        return Bookings::create($payload);
    }

}
