<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar_path' => $this->avatar_path,
            'trips' => $this->trips()->orderBy('id', 'DESC')->limit(5)->get(),
            'distance' => $this->walkedDistance(),
            'numOfTrips' => count($this->trips),
            'time' => $this->timeOnHills()

        ];
    }
}
