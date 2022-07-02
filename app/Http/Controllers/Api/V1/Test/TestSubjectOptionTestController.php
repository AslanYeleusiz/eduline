<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\Test\FullTestResource;
use App\Http\Resources\V1\Test\FullTestStartedResource;
use App\Http\Resources\V1\Test\TestSubjectOptionTestFinishedResource;
use App\Http\Resources\V1\Test\TestSubjectOptionTestStartedResource;
use App\Models\TestSubjectOptionTest;
use App\Models\TestSubjectOptionTestUserAnswer;
use App\Services\V1\TestByOptionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestSubjectOptionTestController extends Controller
{

    public $testService;
    public function __construct(TestByOptionService $testService)
    {
        $this->testService = $testService;
    }

    public function show($testId)
    {
        $test = TestSubjectOptionTest::findWithOptionAndUserAnswers($testId);
        if ($test->is_finished) {
            return new TestSubjectOptionTestFinishedResource($test);
        }
        if ($test->is_started) {
            return new TestSubjectOptionTestStartedResource($test);
            return new FullTestStartedResource($test);
        }
        $test = $this->testService->start($test);
        return new TestSubjectOptionTestStartedResource($test);
    }

    public function store($subjectId, $optionId)
    {
        $test = $this->testService->create($subjectId, $optionId);
        return new FullTestResource($test);
    }

    public function results(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $tests = TestSubjectOptionTest::isFinished()
        ->with(['option', 'subject'])
        ->when($fromDate, fn ($query) => $query->whereDate('start_date', '>=', Carbon::create($fromDate)))
        ->when($toDate, fn ($query) => $query->whereDate('start_date', '<=', Carbon::create($toDate)))
        ->paginate($request->input('per_page', 20))
        ->appends($request->except('page'));
        return TestSubjectOptionTestFinishedResource::collection($tests)->additional(['status' => true]);
    }

    public function saveUserAnswer($testId, Request $request)
    {
        $questionId = $request->question_id;
        $answerNumber = $request->answer_number;

        $userAnswer = TestSubjectOptionTestUserAnswer::where('question_id', $questionId)
            ->where('test_id', $testId)
            ->firstOrFail();

        DB::beginTransaction();
        $userAnswer->answer = $answerNumber;
        $userAnswer->save();
        TestSubjectOptionTest::where('id', $testId)
        ->update(['time' => $request->time]);
        DB::commit();
        return new MessageResource(__('message.success.saved'));
    }

    public function finish($testId)
    {
        $test = TestSubjectOptionTest::findWithOptionAndUserAnswers($testId);
        $this->testService->saveFinish($test);
        return new MessageResource(__('message.success.saved'));
    }
}
