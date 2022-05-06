<?php

namespace App\Http\Requests\Api\V1\Material;

use Illuminate\Foundation\Http\FormRequest;

class MyMaterialDeleteRequest extends FormRequest
{
  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment_when_deleted' => 'required|min:3'
        ];
    }
}
