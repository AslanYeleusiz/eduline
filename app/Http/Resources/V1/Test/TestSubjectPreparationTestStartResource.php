<?php

namespace App\Http\Resources\V1\Test;

use App\Models\FullTest;
use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectPreparationTestStartResource extends JsonResource
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
            'id' => $this->resource['preparation']->id,
            'name' => $this->resource['preparation']->name,
            'time' => FullTest::OPTION_TEST_TIME,
            'questions_count' => $this->resource['questions']->count(),
            'questions' => TestQuestionsResource::collection($this->resource['questions']),
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
