<?php

namespace App\Http\Resources\V1\User;

use App\Models\SmsVerification;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSendCodeEmailResource extends JsonResource
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
            'status' => $this->resource['smsVerification']->is_verified ? SmsVerification::STATUS_VERIFIED : SmsVerification::STATUS_PENDING,
            'is_send_code' => true
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
