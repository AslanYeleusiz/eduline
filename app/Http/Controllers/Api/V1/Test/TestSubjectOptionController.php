<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Test\TestSubjectOptionResource;
use App\Models\TestSubjectOption;

class TestSubjectOptionController extends Controller
{
    public function index($id)
    {
        $options = TestSubjectOption::subjectBy($id)->get();
        return TestSubjectOptionResource::collection($options)
            ->additional(['status' => true]);
    }
}
