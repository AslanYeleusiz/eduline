<?php

namespace App\Http\Resources\V1\Test;

use App\Models\TestSubjectPreparation;
use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectResource extends JsonResource
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
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
