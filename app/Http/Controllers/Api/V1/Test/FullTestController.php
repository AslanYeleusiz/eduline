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
use App\Models\TestSubjectPreparationQuestion;
use App\Models\TestSubjectPreparation;
use App\Services\V1\FullTestService;
use App\Services\V1\TestService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class FullTestController extends Controller
{
    public $testService;

    public function __construct(FullTestService $testService)
    {
        $this->testService = $testService;
    }

    public function saveAnswer($testId, Request $request)
    {
        $questionId = $request->question_id;
        $answerNumber = $request->answer_number;
        $request->validate([
            'question_id' => 'required',
            'answer_number' => 'required',
            'time' => 'required'
        ]);

        $userAnswer = FullTestUserAnswer::where('question_id', $questionId)
            ->where('test_id', $testId)
            ->whereHas('test', fn($query) => $query->isNotFinished())
            ->firstOrFail();

        DB::beginTransaction();
        $userAnswer->answer = $answerNumber;
        $userAnswer->save();
        FullTest::where('id', $testId)->update(['time' => $request->time]);
        DB::commit();
        return new MessageResource(__('message.success.saved'));
    }

    public function finish($testId)
    {
        $test = FullTest::findWithSubjectsAndUserAnswers($testId);
        $this->testService->saveFinish($test);
        return new MessageResource(__('message.success.saved'));
    }

    public function result($testId)
    {
        $test = FullTest::findWithSubjectsAndUserAnswers($testId, true);
        foreach ($test->subjects as $subject) {
            [$subject->topic_know_well, $subject->topic_prepare_for] = TestService::getUserAnswersAnalytics($subject->userAnswers);
            $subject->result = TestService::getScoreAndAnswersCount($subject->userAnswers->toArray());
            unset($subject->userAnswers);
        }
        return new FullTestFinishedResource($test);
    }


    public function results(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $tests = FullTest::withCount('subjects')
            ->isFinished()
            ->with('subjects', function ($query) {
                return $query->where('is_pedagogy', 0);
            })
            ->when($fromDate, fn($query) => $query->whereDate('start_date', '>=', Carbon::create($fromDate)))
            ->when($toDate, fn($query) => $query->whereDate('start_date', '<=', Carbon::create($toDate)))
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return FullTestFinishedResource::collection($tests)->additional(['status' => true]);
    }

    public function show($testId)
    {
        $test = FullTest::findWithSubjects($testId);

        if ($test->is_finished) {
            return new FullTestFinishedResource($test);
        }
        if ($test->is_started) {
            return new FullTestStartedResource($test);
        }
        $test = $this->testService->start($test);
        return new FullTestStartedResource($test);
    }

    public function showTestSubject($testId, $subjectId)
    {

        $test = FullTest::FindWithSubjectsAndUserAnswers($testId);
        $test->subject = $test->subjects->where('id', $subjectId)->first();
        unset($test->subjects);
        if ($test->is_finished) {
            return new FullTestFinishedResource($test);
        }

        if ($test->is_started) {
            return new FullTestStartedResource($test);
        }
        $test = $this->testService->start($test);
        return new FullTestStartedResource($test);
    }

    public function testQuestionAppeal($testId, Request $request)
    {
        $questionId = $request->question_id;
        $questionAppeal = new TestQuestionAppeal();
        $questionAppeal->question_id = $questionId;
        $questionAppeal->test_id = $testId;
        $questionAppeal->type = $request->type;
        $questionAppeal->comment = $request->comment;
        $user = auth()->guard('api')->user();
        if (!empty($user)) {
            $questionAppeal->user_id = $user->id;
        }
        $questionAppeal->save();
        return new MessageResource(__('message.success.saved'));
    }

    public function store($directionId, $subjectId)
    {
        $test = $this->testService->create($directionId, $subjectId);
        return new FullTestResource($test);
    }
}
