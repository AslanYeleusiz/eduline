<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class FullTestFinishedSubjectsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_pedagogy' => $this->is_pedagogy,
            'questions_count' => $this->when(isset($this->questions_count), function () {
                return $this->questions_count;
            }),
            'user_answers' => FullTestFinishedUserAnswersResource::collection($this->whenLoaded('userAnswers')),
            'result' => $this->when(isset($this->result), new FullTestSubjectResultResource($this->result)),
            'topic_know_well' => $this->when(isset($this->topic_know_well),$this->topic_know_well),
            'topic_prepare_for' => $this->when(isset($this->topic_know_well),$this->topic_prepare_for),
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }

}
