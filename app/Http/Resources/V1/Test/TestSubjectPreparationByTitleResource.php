<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectPreparationByTitleResource extends JsonResource
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
            'subject' => new TestSubjectResource($this->resource),
            'preparations' => TestSubjectPreparationsResource::collection($this->whenLoaded('preparations'))
        ];
    } 
     
    public function with($request)
    {
        return ['status' => true];
    }
}
