<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    public function toArray($request){
        return [
            'id' => $this->resource->id,
            'room_name' => $this->resource->room_name,
            'room_number' => $this->resource->room_number,
            'about_room' => $this->resource->about_room,
            'price_per_night' => $this->resource->price_per_night,
            'photo' => $this->resource->photo,
        ];
    }
}
