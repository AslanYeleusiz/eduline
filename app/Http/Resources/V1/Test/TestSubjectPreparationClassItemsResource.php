<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectPreparationClassItemsResource extends JsonResource
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
            'preparations_count' => $this->when(isset($this->preparations_count), $this->preparations_count),
            'preparations' => TestSubjectPreparationResource::collection($this->whenLoaded('preparations'))
        ];
    }
}
