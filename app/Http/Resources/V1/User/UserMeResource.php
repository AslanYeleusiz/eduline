<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\V1\CardsResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserMeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'place_work' => $this->place_work,
            'avatar' => $this->avatar ? Storage::disk('public')->url(User::IMAGE_PATH . $this->avatar) : null,
            'phone' => $this->phone,
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
