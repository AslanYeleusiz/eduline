<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsSaveRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title.kk' => 'required',
            'title.ru' => 'required',
            'short_description.kk' => 'required',
            'short_description.ru' => 'required',
            'description.kk' => 'required',
            'description.ru' => 'required',
            'news_types_id' => 'required',
        ];
    }
}
