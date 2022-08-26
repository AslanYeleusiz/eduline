<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'subject.kk' => 'required',
            'subject.ru' => 'required',
            'price' => 'required',
            'description.kk' => 'required',
            'description.ru' => 'required',
        ];
    }
}
