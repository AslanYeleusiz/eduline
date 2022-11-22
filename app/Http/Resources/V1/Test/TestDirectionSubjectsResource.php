<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class TestDirectionSubjectsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_pedagogy' => $this->is_pedagogy,
            'is_soon' => $this->is_soon,
            'visible' => $this->visible,
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
