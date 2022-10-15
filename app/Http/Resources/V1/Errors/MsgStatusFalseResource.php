<?php

namespace App\Http\Resources\V1\Errors;

use Illuminate\Http\Resources\Json\JsonResource;

class MsgStatusFalseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message' => $this->resource
        ];
    }

    public function with($request)
    {
        return ['status' => false];
    }
}
