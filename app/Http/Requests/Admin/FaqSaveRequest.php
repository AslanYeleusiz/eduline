<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqSaveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'question' => 'required',
            'answer' => 'required'
        ];
    }
}
