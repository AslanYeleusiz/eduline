<?php

namespace App\Http\Requests\Api\V1\User;

use App\Rules\UserGuardApiMatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UserPasswordSaveRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required', new UserGuardApiMatchOldPassword],
            'password' => 'required|confirmed|min:6',   
            'password_confirmation' => 'required|same:password|min:6',
            
        ];
    }
}
