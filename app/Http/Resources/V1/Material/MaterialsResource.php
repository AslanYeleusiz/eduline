<?php

namespace App\Http\Resources\V1\Material;

use App\Http\Resources\V1\User\UserBasicInfo;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialsResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'download' => $this->download,
            'view' => $this->view,
            'created_at' => $this->created_at?->format('d.m.Y'),
            'user' => new UserBasicInfo($this->whenLoaded('user')),
            'subject' => new MaterialSubjectResource($this->whenLoaded('subject')),
            'direction' => new MaterialDirectionResource($this->whenLoaded('direction')),
            'class' => new MaterialClassResource($this->whenLoaded('direction')),
            // 'certificate_url' => route('download')
        ];
    }
      
    public function with($request)
    {
        return ['status' => true];
    }
}
