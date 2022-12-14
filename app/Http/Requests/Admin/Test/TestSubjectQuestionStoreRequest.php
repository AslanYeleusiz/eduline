<?php

namespace App\Http\Requests\Admin\Test;

use Illuminate\Foundation\Http\FormRequest;

class TestSubjectQuestionStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'text' => 'required',
            'correct_answer_number' => 'required',
            'answers' => 'required|array',
            'answers.*.text' => 'required',
        ];
    }
}
