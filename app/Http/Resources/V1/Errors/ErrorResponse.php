<?php

namespace App\Http\Resources\V1\Errors;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
    
    
    public function with($request)
    {
        return ['status' => false];
    }
}
