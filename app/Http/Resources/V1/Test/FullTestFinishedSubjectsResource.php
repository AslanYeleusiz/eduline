<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class FullTestFinishedSubjectsResource extends JsonResource
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
            'user_answers' => FullTestFinishedUserAnswersResource::collection($this->userAnswers)
            ];
    }
    
    public function with($request)
    {
        return ['status' => true];
    }

}
