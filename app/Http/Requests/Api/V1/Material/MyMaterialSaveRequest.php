<?php

namespace App\Http\Requests\Api\V1\Material;

use Illuminate\Foundation\Http\FormRequest;

class MyMaterialSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'direction_id' => 'required',
            'subject_id' => 'required',
            'class_id' => 'required',
        ];
    }
}
