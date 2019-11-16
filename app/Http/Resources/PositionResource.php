<?php

namespace App\Http\Resources;

use App\Position;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Position */
class PositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'timestamp' => $this->time,
            'location_device' => $this->whenLoaded('Device', [
                'uuid' => $this->Device->uuid,
                'name' => $this->Device->name,
            ]),
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
            'altitude' => (float) $this->altitude,
            'speed' => (float) $this->speed,
            'is_approximate' => (bool) $this->is_from_gsm,
        ];
    }
}
