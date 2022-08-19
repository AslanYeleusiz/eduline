<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'image' => $this->image,
            //https://eduline.kz/public/storage/images/sliders/{{image}}
            'link' => $this->link,
            //cілтеме
            'linkToAdvice' => $this->linkToAdvice,
            // linkToAdvice -> personal_advice  жеке кенестің id-сі
            'in_app' => $this->in_app,
            // false or true
            'created_at' => $this->created_at,
        ];
    }
}
