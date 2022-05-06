<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class MaterialCommentSaveRequest extends FormRequest
{
  
    public function rules()
    {
        return [
            'text' => 'required|min:3',
        ];
    }
}
