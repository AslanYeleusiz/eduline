<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class FullTestQuestionResource extends JsonResource
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
                'text' => $this->text,
                'answers' => FullTestQuestionAnswersResource::collection($this->answers),
            ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
