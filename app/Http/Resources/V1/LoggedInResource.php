<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\V1\User\UserMeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LoggedInResource extends JsonResource
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
            'token_type' => "Bearer",
            'access_token' => $this->resource['token']['accessToken'],
            'expires_in' => $this->resource['token']['token']['expires_at'],
//            'is_admin' => $this->resource['isAdmin'],
            'user' => new UserMeResource($this->resource['user']),
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
