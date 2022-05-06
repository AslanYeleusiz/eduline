<?php

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserPhoneSaveRequest extends FormRequest
{

    public function rules()
    {
        return [
            'phone' => 'required|unique:users,phone,' . auth()->guard('api')->user()->id,
            'code' => 'required|min:4|max:4'
        ];
    }
}
