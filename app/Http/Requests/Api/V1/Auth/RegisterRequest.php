<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|min:3|max:60',
            'password' => 'required|min:6|max:16|same:password_confirmation',
            'password_confirmation' => 'required',
            'email' => 'required|email|min:5|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'code' => 'required'
        ];
    }
}
