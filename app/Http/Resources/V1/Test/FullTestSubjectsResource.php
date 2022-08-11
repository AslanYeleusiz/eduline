<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class FullTestSubjectsResource extends JsonResource
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
            'id' =>  $this->id,
            'name' => $this->name,
            'is_pedagogy' => $this->is_pedagogy,
			'user_answers' => FullTestUserAnswersResource::collection($this->whenLoaded('userAnswers')),
			'questions_count' => $this->when(isset($this->questions_count), $this->questions_count),
			'questions_answered_count' => $this->when(isset($this->questions_answered_count), $this->questions_answered_count),
        ];
    }
}
