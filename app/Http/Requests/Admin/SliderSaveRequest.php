<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderSaveRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image.kk' => 'required',
            'image.ru' => 'required',
            'link' => 'required_without:linkToAdvice',
            'linkToAdvice' => 'required_without:link',
            'in_app' => 'required',
        ];
    }
}
