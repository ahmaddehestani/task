<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelPackagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'name'=>$this->price,
            'location'=>$this->location,
            'total_booking'=>$this->bookingsCount(),
            'customers'=>$this->whenLoaded('bookings',function (){
                return BookingsResource::collection($this->bookings);
            })
        ];
    }
}
