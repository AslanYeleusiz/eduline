<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class FullTestFinishedUserAnswersResource extends JsonResource
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
            'answer' => $this['answer'],
            'question' => new FullTestFinishedQuestionResource($this['question']),
        ];
    }
    
    public function with($request)
    {
        return ['status' => true];
    }
}
