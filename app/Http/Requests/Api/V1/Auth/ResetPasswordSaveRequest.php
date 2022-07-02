<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => 'required',
            'hash' => 'required',
            // 'code' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
