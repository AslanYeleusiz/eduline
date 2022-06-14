<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectPreparationResource extends JsonResource
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
            'video_link' => $this->video_link,
        ];
    }
     
    public function with($request)
    {
        return ['status' => true];
    }

}
