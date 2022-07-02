<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectOptionTestStartedResource extends JsonResource
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
            'option' => new TestSubjectOptionResource($this->whenLoaded('option')),
            'subject' => new TestSubjectResource($this->whenLoaded('subject')),
            'user_answers' => FullTestUserAnswersResource::collection($this->whenLoaded('userAnswers'))
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
