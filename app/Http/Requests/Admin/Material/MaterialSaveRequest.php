<?php

namespace App\Http\Requests\Admin\Material;

use Illuminate\Foundation\Http\FormRequest;

class MaterialSaveRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'file_name' => 'required',
            'subject_id' => 'required',
            'direction_id' => 'required',
            'class_id' => 'required',
            'user_id' => 'required',
            'date' => 'required',
        ];
    }
}
