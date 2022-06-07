<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Test\TestSubjectOptionsResource;
use App\Models\TestSubjectOption;
use Illuminate\Http\Request;

class TestSubjectOptionController extends Controller
{
    public function index($id)
    {
        $options = TestSubjectOption::subjectBy($id)->get();
        return TestSubjectOptionsResource::collection($options)
        ->additional(['status' => true]);
    }

    public function start($subjectId, $optionId)
    {
        $options = TestSubjectOption::with(['questions' => fn($query) => $query->isActive()])
        ->withCount(['questions'=> fn($query) => $query->isActive()])
        ->subjectBy($subjectId)
        ->findOrFail($optionId);
        return new TestSubjectOptionsResource($options);
    }

    // public function

    public function finish()
    {
        //[['question_id' => id, 'number']]

    }
}
