<?php

namespace App\Http\Resources\V1\Test;

use App\Models\FullTest;
use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectPreparationTestFinishedResource extends JsonResource
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
            'total_time' => FullTest::OPTION_TEST_TIME - $this->resource['time'] ?? 0,
            'score' => $this->resource['result']['score'],
            'correct_answers_count' => $this->resource['result']['correctAnswerCount'],
            'incorrect_answers_count' =>  $this->resource['result']['incorrectAnswerCount'],
            'questions_count' => count($this->resource['result']['userAnswers']),
            'user_answers' => TestFinishedUserAnswersResource::collection($this->resource['result']['userAnswers']),
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
