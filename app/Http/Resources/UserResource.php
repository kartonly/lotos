<?php


namespace App\Http\Resources;



use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        if ($this->resource != null){
        if ($this->resource->birth_date != null){
            $date = $this->resource->birth_date->format('d-m-Y');
        } else {
            $date = $this->resource->birth_date;
        }

        return [
            'id' => $this->resource->id,
            'email' => $this->resource->email,
            'last_name' => $this->resource->last_name,
            'first_name' => $this->resource->first_name,
            'second_name' => $this->resource->second_name,
            'gender' => $this->resource->gender,
            'birth_date' => $date,
            'roles' => $this->resource->userRoles(),
            'permissions' => $this->resource->userPermissions(),
            'phone' => $this->resource->phone
        ];} else {
            return [];
        }
    }
}
