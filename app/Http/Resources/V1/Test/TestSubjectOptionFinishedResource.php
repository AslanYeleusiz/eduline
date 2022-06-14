<?php

namespace App\Http\Resources\V1\Test;

use App\Models\FullTest;
use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectOptionFinishedResource extends JsonResource
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
            'total_time' => FullTest::OPTION_TEST_TIME - $this->resource['time'] ?? 0,
            'score' => $this->resource['result']['score'],
            'correct_answers_count' => $this->resource['result']['correctAnswerCount'],
            'incorrect_answers_count' =>  $this->resource['result']['incorrectAnswerCount'],
            'user_answers' => TestFinishedUserAnswersResource::collection($this->resource['result']['userAnswers']),
            'questions_count' => $this->resource['subject']->questions_count
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
