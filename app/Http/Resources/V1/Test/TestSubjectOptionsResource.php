<?php

namespace App\Http\Resources\V1\Test;

use App\Models\FullTest;
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
            'id' => $this->resource['subject']->id,
            'name' => $this->resource['subject']->name,
            'option_id' => $this->resource['option']->id,
            'option_name' => $this->resource['option']->name,
            'time' => FullTest::OPTION_TEST_TIME,
            // 'questions' => $this->whenLoaded('questions'),
            'questions' => TestQuestionsResource::collection($this->resource['option']->questions),
            'questions_count' => $this->resource['subject']->questions_count
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
