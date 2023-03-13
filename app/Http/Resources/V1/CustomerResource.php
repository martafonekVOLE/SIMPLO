<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
          'id' => $this->id,
          'email' => $this->email,
          'firstName' => $this->firstname,
          'surname' => $this->surname,
          'age' =>  $this->age,
          'category' => CategoryResource::collection($this->whenLoaded('categories'))
        ];
    }
}
