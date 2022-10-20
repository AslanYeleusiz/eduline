<?php

namespace App\Http\Resources\V1\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class FullTestSanatResource extends JsonResource
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
            'name' => $this['name'],
            'subjects' => $this['subjects'],
            'pass_score' => $this['pass_score'],
            'is_passing' => $this['is_passing'],
            'passing_desc' => $this['passing_desc'],
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
