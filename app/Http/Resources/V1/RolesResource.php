<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class RolesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        $language = $request->header('Accept-Language');
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
