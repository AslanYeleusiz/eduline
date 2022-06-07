<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectOptionsResource extends JsonResource
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
            // 'questions' => $this->whenLoaded('questions'),
            'questions' => TestQuestionsResource::collection($this->whenLoaded('questions')),
            'questions_count' => $this->when(isset($this->questions_count), $this->questions_count)
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
