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
            // link -> personal_advice  жеке кенестің базадағы id-сі
            'link_lat' => $this->slug($this->advice->title),
            // Ссылканын полный сілтемесі https://eduline.kz/{{link_lat}}-{{id}}
            'in_app' => $this->in_app,
            // false or true
            'created_at' => $this->created_at,
        ];
    }
}
