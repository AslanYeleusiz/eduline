<?php

namespace App\Http\Resources\V1\Test;

use App\Models\FullTest;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FullTestFinishedResource extends JsonResource
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
            'is_started' => $this->is_started,
            'is_finished' => $this->is_finished,
            'start_date' => Carbon::create($this->start_date)->format('d.m.Y H:i:s'),
            'end_date' => Carbon::create($this->end_date)->format('d.m.Y H:i:s'),
            'total_time' => FullTest::FULL_TEST_TIME - $this->time,
            'score' => $this->score,
            'correct_answers_count' => $this->correct_answers_count,
            'incorrect_answers_count' => $this->incorrect_answers_count,
            'subjects_count' => $this->when(isset($this->subjects_count), $this->subjects_count),
            'subjects' => FullTestFinishedSubjectsResource::collection($this->whenLoaded('subjects')),
            'subject' => new FullTestFinishedSubjectsResource($this->when(isset($this->subject), $this->subject)),
            'sanat' => FullTestSanatResource::collection($this->sanat)
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
