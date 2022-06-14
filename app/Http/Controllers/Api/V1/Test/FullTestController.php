<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\Test\FullTestFinishedResource;
use App\Http\Resources\V1\Test\FullTestResource;
use App\Http\Resources\V1\Test\FullTestStartedResource;
use App\Models\FullTest;
use App\Models\FullTestUserAnswer;
use App\Models\TestQuestionAppeal;
use App\Services\V1\FullTestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FullTestController extends Controller
{

    public function __construct(public FullTestService $testService)
    {
    }

    public function saveAnswer($testId, Request $request)
    {

        $questionId = $request->question_id;
        $answerNumber = $request->answer_number;

        $userAnswer = FullTestUserAnswer::where('question_id', $questionId)
            ->where('test_id', $testId)
            ->firstOrFail();
            
        DB::beginTransaction();
        $userAnswer->answer = $answerNumber;
        $userAnswer->save();
        FullTest::where('id', $testId)->update(['time' => $request->time]);
        DB::commit();
        return new MessageResource(__('message.success.saved'));
    }

    public function finish($uuid)
    {
        $test = FullTest::findWithSubjectsAndUserAnswers($uuid);
        $this->testService->saveFinish($test);
        return new MessageResource(__('message.success.saved'));
    }

    public function result($testId)
    {
        $test = FullTest::with('subjects')->withCount('subjects')->isFinished()->findOrFail($testId);
        return new FullTestFinishedResource($test);
    }

    public function show($testId)
    {
        $test = FullTest::findWithSubjectsAndUserAnswers($testId);
        if ($test->is_finished) {
            return new FullTestFinishedResource($test);
        }
        if ($test->is_started) {
            return new FullTestStartedResource($test);
        }
        $test = $this->testService->start($test);
        return new FullTestStartedResource($test);
        // return new UbtTestStartedResource($test);
    }

    public function testQuestionAppeal($testId, Request $request)
    {
        //required question_id, type, comment? 
        $questionId = $request->question_id;
        $questionAppeal = new TestQuestionAppeal();
        $questionAppeal->question_id = $questionId;
        $questionAppeal->test_id = $testId;
        $questionAppeal->type = $request->type;
        $questionAppeal->comment = $request->comment;
        $user = auth()->guard('api')->user();
        if(!empty($user)) {
            $questionAppeal->user_id = $user->id;
        }
        $questionAppeal->save();
        return new MessageResource(__('message.success.saved'));
    }

    public function store(Request $request)
    {
        $test = $this->testService->create($request->direction_id, $request->subject_id);
        return new FullTestResource($test);
        // return new UbtTestResource($test);
    }
}
