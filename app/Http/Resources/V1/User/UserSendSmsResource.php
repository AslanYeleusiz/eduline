<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSendSmsResource extends JsonResource
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
            'user_exists' => $this->resource['userExists'],
            'status' => $this->resource['smsVerification']->status,
            // 'is_send_sms' => true
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
