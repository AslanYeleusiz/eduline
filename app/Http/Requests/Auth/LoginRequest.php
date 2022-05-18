<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['phone' => "string", 'password' => "string"])] public function rules(): array
    {
        return [
            'phone' => 'required',
            'password' => 'required'
        ];
    }
}
