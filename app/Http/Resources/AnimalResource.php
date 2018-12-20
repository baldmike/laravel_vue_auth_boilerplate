<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
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
            'species' => $this->species,
            'breed' => $this->breed,
            'name' => $this->name,
            'source' => $this->source,
            'microchip_number' => $this->microchip_number,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'description' => $this->description,
            'weight'=> $this->weight,
            'fixed' => $this->fixed,
            'profile_photo' => $this->profile_photo,
        ];
    }
}
