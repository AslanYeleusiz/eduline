<?php

namespace App\Http\Requests\Api\V1\Sms;

use Illuminate\Foundation\Http\FormRequest;

class SendSmsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone' => 'required'
        ];
    }
}
