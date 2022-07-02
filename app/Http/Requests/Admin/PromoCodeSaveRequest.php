<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodeSaveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required',
            'day' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ];
    }
}
