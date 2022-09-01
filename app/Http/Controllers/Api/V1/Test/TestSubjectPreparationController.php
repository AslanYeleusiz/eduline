<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\Test\TestSubjectPreparationByTitleResource;
use App\Http\Resources\V1\Test\TestSubjectPreparationClassesResource;
use App\Http\Resources\V1\Test\TestSubjectPreparationClassResource;
use App\Http\Resources\V1\Test\TestSubjectPreparationResource;
use App\Http\Resources\V1\Test\TestSubjectPreparationTestFinishedResource;
use App\Http\Resources\V1\Test\TestSubjectPreparationTestStartResource;
use App\Models\TestClass;
use App\Models\TestQuestion;
use App\Models\TestSubject;
use App\Models\TestSubjectPreparation;
use App\Models\TestSubjectPreparationAppeal;
use App\Models\TestSubjectPreparationOrder;
use App\Services\V1\TestService;
use Illuminate\Http\Request;

class TestSubjectPreparationController extends Controller
{
    public function preparationsByTitle($subjectId)
    {
        $subject = TestSubject::with(['preparations' => function ($query) use ($subjectId) {
            return $query->where('test_subject_preparations.subject_id', $subjectId)
                ->whereNull('test_subject_preparations.parent_id')->with(['childs' => function ($query) use ($subjectId) {
                    return $query->where('test_subject_preparations.subject_id', $subjectId);
                }]);
        }])->findOrFail($subjectId);
        // return TestSubjectPreparationClassesResource::collection(compact('subject', 'classItems'));
        return new TestSubjectPreparationByTitleResource($subject);
    }

    public function preparationClasses($subjectId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $classItems = TestClass::withCount(['preparations' => function ($query) use ($subjectId) {
            return $query->where('test_subject_preparations.subject_id', $subjectId)->whereNotNull('test_subject_preparations.parent_id');
        }])->whereHas('preparations', function ($query) use ($subjectId) {
            return $query->where('test_subject_preparations.subject_id', $subjectId)->whereNotNull('test_subject_preparations.parent_id');
        })->get();


        return new TestSubjectPreparationClassesResource(compact('subject', 'classItems'));
    }

    public function preparationClass($subjectId, $classId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $classItem = TestClass::with(['preparations' => function ($query) use ($subjectId) {
            return $query->where('test_subject_preparations.subject_id', $subjectId)->whereNotNull('test_subject_preparations.parent_id');
        }])->findOrFail($classId);

        return new TestSubjectPreparationClassResource(compact('subject', 'classItem'));
    }


    public function preparation($subjectId, $preparationId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $preparation = TestSubjectPreparation::subjectBy($subject->id)->withCount(['questions' => fn ($query) => $query->isActive()])->findOrFail($preparationId);
//        dd($preparation->questions_count);

//        $preparation = TestSubjectPreparation::subjectBy($subjectId)->findOrFail($preparationId);
//        $questions = TestQuestion::isActive()->whereHas('preparations', function ($query) use ($preparationId) {
//            return $query->where('test_subject_preparations.id', $preparationId);
//        })->inRandomOrder()->limit(20)->get();

        return new TestSubjectPreparationResource($preparation);
    }

    public function preparationOrderStore($subjectId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $order = new TestSubjectPreparationOrder();
        $order->subject_id = $subject->id;
        $order->user_id = auth()->guard('api')->user()->id;
        $order->save();
        return new MessageResource(__('message.success.saved'));
    }

    public function preparationAppeal($subjectId, $preparationId, Request $request)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $preparation = TestSubjectPreparation::subjectBy($subject->id)->findOrFail($preparationId);

        $preparationAppeal = new TestSubjectPreparationAppeal();
        $preparationAppeal->preparation_id = $preparation->id;
        $preparationAppeal->type = $request->type;
        $preparationAppeal->comment = $request->comment;
        $user = auth()->guard('api')->user();
        if (!empty($user)) {
            $preparationAppeal->user_id = $user->id;
        }
        $preparationAppeal->save();
        return new MessageResource(__('message.success.saved'));
    }

    public function preparationTestStart($subjectId, $preparationId)
    {
        $preparation = TestSubjectPreparation::subjectBy($subjectId)->findOrFail($preparationId);
        $questions = TestQuestion::isActive()->whereHas('preparations', function ($query) use ($preparationId) {
            return $query->where('test_subject_preparations.id', $preparationId);
        })->inRandomOrder()->limit(20)->get();
        $userAnswers = [];
        foreach ($questions as $question) {
            $userAnswers[] = [
                'answer' => null,
                'question' => $question,
            ];
        }

        return new TestSubjectPreparationTestStartResource(compact('preparation', 'userAnswers'));
    }

    public function preparationTestFinish($subjectId, $preparationId, Request $request)
    {
        $time = $request->input('time', 0);

        $preparation = TestSubjectPreparation::subjectBy($subjectId)->findOrFail($preparationId);
        $userQuestionAnswers = $request->questions;
        $questionIds = [];
        foreach($userQuestionAnswers as $userQuestionAnswer) {
            $questionIds[] = $userQuestionAnswer['question_id'];
        }
        $questions = TestQuestion::whereIn('id', $questionIds)->get();
        $result = TestService::getScoreTestNotSaved($questions, $request->questions);
        return new TestSubjectPreparationTestFinishedResource(compact('result', 'preparation', 'time'));
    }
}
