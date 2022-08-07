<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class FullTestStartedResource extends JsonResource
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
            'time' => $this->time,
            'is_started' => $this->is_started,
            'is_finished' => $this->is_finished,
            'subjects' => FullTestSubjectsResource::collection($this->whenLoaded('subjects')),
            'subject' => new FullTestSubjectsResource($this->whenLoaded('subject'))
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
