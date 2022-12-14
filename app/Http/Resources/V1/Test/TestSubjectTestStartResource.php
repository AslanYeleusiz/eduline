<?php

namespace App\Http\Resources\V1\Test;

use App\Models\FullTest;
use Illuminate\Http\Resources\Json\JsonResource;

class TestSubjectTestStartResource extends JsonResource
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
            'time' => FullTest::OPTION_TEST_TIME,
            'questions_count' => count($this->resource['userAnswers']),
//            'questions_count' => $this->resource['questions']->count(),
            'user_answers' => TestFinishedUserAnswersResource::collection($this->resource['userAnswers']),

//            'questions' => TestQuestionsResource::collection($this->resource['questions']),
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
