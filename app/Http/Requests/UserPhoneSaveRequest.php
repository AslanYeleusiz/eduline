<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UserPhoneSaveRequest extends FormRequest
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
    #[ArrayShape(['phone' => "string", 'code' => "string"])] public function rules(): array
    {
        return [
            'phone' => 'required|unique:users,phone,' . auth()->id(),
            'code' => 'required|min:4|max:4'
        ];
    }
}
