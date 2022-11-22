<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Test\TestSubjectPreparationTestFinishedResource;
use App\Http\Resources\V1\Test\TestSubjectPreparationTestStartResource;
use App\Http\Resources\V1\Test\TestSubjectTestFinishedResource;
use App\Http\Resources\V1\Test\TestSubjectTestStartResource;
use App\Http\Resources\V1\Test\TestSubjectResource;
use App\Models\TestQuestion;
use App\Models\TestSubject;
use App\Models\TestLanguage;
use App\Services\V1\TestService;
use Illuminate\Http\Request;

class TestSubjectController extends Controller
{
    public function index(Request $request)
    {
        $languageId = $request->language_id ?? TestLanguage::first()->id;
        $subjects = TestSubject::where('language_id', $languageId)
            ->where('id', '!=', 2)
            ->get();
        return TestSubjectResource::collection($subjects);
    }

    public function testStart($subjectId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $questions = TestQuestion::isActive()
        ->subjectBy($subject->id)
        ->inRandomOrder()->limit($subject->questions_count)->get();

        $userAnswers = [];
        foreach ($questions as $question) {
            $userAnswers[] = [
                'answer' => null,
                'question' => $question,
            ];
        }

        return new TestSubjectTestStartResource(compact('subject', 'userAnswers'));
    }

    public function testFinish($subjectId, Request $request)
    {
        $time = $request->input('time', 0);

        $subject = TestSubject::findOrFail($subjectId);
        $userQuestionAnswers = $request->questions;
        $questionIds = [];
        foreach($userQuestionAnswers as $userQuestionAnswer) {
            $questionIds[] = $userQuestionAnswer['question_id'];
        }
        $questions = TestQuestion::subjectBy($subject->id)->whereIn('id', $questionIds)->get();

        $result = TestService::getScoreTestNotSaved($questions, $request->questions);
        return new TestSubjectTestFinishedResource(compact('result',
        'subject', 'time'));
    }
}
