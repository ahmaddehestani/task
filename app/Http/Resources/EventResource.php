<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'event_name'=>$this->event_name,
            'payload'=>$this->payload,
            'ip_address'=>$this->ip_address,
            'user_agent'=>$this->user_agent,
            'platform'=>$this->platform,
            'user'=>$this->whenLoaded('user',function (){
                return UserResource::make($this->user);
            }),

        ];
    }
}
