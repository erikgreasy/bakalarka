<?php

namespace App\Http\Resources;

use App\Hill;
use Illuminate\Http\Resources\Json\JsonResource;

class HillResource extends JsonResource
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
            'height' => $this->height,
            'trips' => $this->trips,
            'favoriteOrder' => $this->favoriteOrder() + 1
        ];
    }
}
