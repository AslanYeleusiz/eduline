<?php

namespace App\Http\Resources\V1\News;

use App\Http\Resources\V1\NewsComment\NewsCommentsResource;
use App\Http\Resources\V1\NewsType\NewsTypeResource;
use App\Models\News;
use App\Services\V1\NewsCommentService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class NewsItemResource extends JsonResource
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
            'lat_title' => $this->slug($this->title),
            // https://eduline.kz/news/{{lat_title}}-{{id}}.html -- path

            'description' => $this->description,
            'image' => $this->image ? Storage::disk('public')->url(News::IMAGE_PATH . $this->image) : null,
            'view' => $this->view,
            'comments' => NewsCommentsResource::collection(NewsCommentService::commentsTree($this->whenLoaded('comments'))),
            'comments_count' => $this->when(isset($this->comments_count), $this->comments_count),
            'news_type' => new NewsTypeResource( $this->whenLoaded('newsType')),
            'is_saved' => $this->when(isset($this->is_saved), (bool) $this->is_saved),
            'created_at' => $this->created_at?->diffForHumans(),
        ];
    }


    public function with($request)
    {
        return ['status' => true];
    }
}
