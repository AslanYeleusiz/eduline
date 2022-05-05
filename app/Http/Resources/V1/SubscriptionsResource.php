<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionsResource extends JsonResource
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
            'duration' => $this->duration,
            'price' => (int) $this->price,
            'is_discount' => $this->is_discount,
            'discount_percentage' => (int) $this->discount_percentage > 101 ? 0 : (int) $this->discount_percentage,
        ];
    }
    
    public function with($request)
    {
        return ['status' => true];
    }
}
