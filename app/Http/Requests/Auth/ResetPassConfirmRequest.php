<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ResetPassConfirmRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['phone' => "string", 'password' => "string"])] public function rules(): array
    {
        return [
            'password' => 'required|min:6|same:password_confirm',
            'password_confirm' => 'required'
        ];
    }
}
