<?php

namespace App\Services;

use App\Models\Package;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

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
    function neshanService(): void
    {
        $response = Http::withHeaders([
            'Api-Key' => 'service.515c4e65c6284d9bb3c7a5120c03f960',
        ])->get('https://api.neshan.org/v5/reverse', [
            'lat' => 36.2605,
            'lng' => 59.6168
        ]);

        $data = $response->json();
        $filePath = base_path('output.json');
        File::put($filePath, json_encode($data, JSON_PRETTY_PRINT));

    }

}
