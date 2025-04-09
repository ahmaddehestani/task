<?php

namespace App\Http\Controllers;

use App\Http\Resources\TravelPackagesResource;
use App\Models\Package;
use App\Http\Requests\StoreTravelPackagesRequest;
use App\Http\Requests\UpdateTravelPackagesRequest;
use App\Services\TravelPackageService;
use Illuminate\Http\Request;

class TravelPackagesController extends BaseApiController
{
    public function __construct(private  readonly TravelPackageService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->resultWithAdditional(TravelPackagesResource::collection($this->service->index()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelPackagesRequest $request)
    {
        $model=$this->service->store($request->validated());
        return $this->successResponse(TravelPackagesResource::make($model),'store success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return $this->successResponse(TravelPackagesResource::make($package->load('bookings')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelPackagesRequest $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }

    public function getDetails(): \Illuminate\Http\JsonResponse
    {
        $this->service->neshanService();
        return $this->successResponse([],'file create');
    }
}
