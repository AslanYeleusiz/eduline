<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'full_name' => 'required|min:3',
            'password' => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required',
            'email' => 'required|email|min:5|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
        ];
    }
}
