<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'id' => $this->resource->id,
            'room_id' => $this->resource->room_id,
            'user_id' => $this->resource->user_id,
            'summ' => $this->resource->summ,
            'available' => $this->resource->available,
            'start' => $this->resource->start->format('d-m-Y'),
            'end' => $this->resource->end->format('d-m-Y'),
        ];
    }
}
