<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalAdviceResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'is_discount' => $this->is_discount,
            'discount_percentage' => (int) $this->discount_percentage < 101 ? $this->discount_percentage : 0,
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
