<?php

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileSaveRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required',
            // 'iin' => 'required|min:3|max:255',
            // 'birthday' => 'required',
            // 'sex' => 'required',
        ];
    }
}
