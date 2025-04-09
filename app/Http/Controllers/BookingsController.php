<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingsResource;
use App\Models\Bookings;
use App\Http\Requests\StoreBookingsRequest;
use App\Http\Requests\UpdateBookingsRequest;
use App\Services\BookingsService;

class BookingsController extends BaseApiController
{
    public function __construct(private readonly BookingsService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->resultWithAdditional(BookingsResource::collection($this->service->index()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingsRequest $request)
    {
        $model=$this->service->store($request->validated());
        return $this->successResponse(BookingsResource::make($model));
    }

    /**
     * Display the specified resource.
     */
    public function show(Bookings $bookings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingsRequest $request, Bookings $bookings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookings $bookings)
    {
        //
    }
}
