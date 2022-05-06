<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodeSaveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required',
            'discount_percentage' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ];
    }
}
