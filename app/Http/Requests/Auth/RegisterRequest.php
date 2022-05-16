<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['phone' => "string", 'full_name' => "string", 'email' => "string", 'password' => "string", 'password_confirmation' => "string", 'role_id' => "string"])]
    public function rules(): array
    {
        return [
            'phone' => 'required|min:9|unique:users,phone',
            'full_name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|min:4|same:password',
            'role_id' => 'required',
        ];
    }
}
