<?php

namespace App\Http\Resources\V1\NewsComment;

use App\Http\Resources\V1\User\UserBasicInfo;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsCommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $childrens = NewsCommentsResource::collection($this->children);
        return [
            'id' => $this->id,
            'text' => $this->text,
            'children' => $childrens,
            'childrens_count' => $childrens->count(),
            'likes_count' => $this->likes_count,
            'is_liked' => (bool) $this->is_liked,
            'user' => new UserBasicInfo($this->whenLoaded('user')),
        ];
    }
}
