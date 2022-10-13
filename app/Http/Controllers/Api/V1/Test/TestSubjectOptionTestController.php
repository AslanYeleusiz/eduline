<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Exceptions\Handlers\ModelNotFoundExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\Test\FullTestResource;
use App\Http\Resources\V1\Test\FullTestStartedResource;
use App\Http\Resources\V1\Test\TestSubjectOptionTestFinishedResource;
use App\Http\Resources\V1\Test\TestSubjectOptionTestStartedResource;
use App\Models\TestOptionQuestionAppeal;
use App\Models\TestSubjectOptionTest;
use App\Models\TestSubjectOptionTestUserAnswer;
use App\Services\V1\TestByOptionService;
use App\Services\V1\TestService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $test = TestSubjectOptionTest::findWithOption($testId);
        if ($test->is_finished) {

            return new TestSubjectOptionTestFinishedResource($test);
        }
        if ($test->is_started) {
            return new TestSubjectOptionTestStartedResource($test);
        }
        $test = $this->testService->start($test);
		$test->loadCount(['userAnswers as questions_answered_count' => function($query) {
			$query->whereNotNull('answer');
		}, 'userAnswers as questions_count']);
        return new TestSubjectOptionTestStartedResource($test);
    }

    public function appeal($testId, Request $request)
    {
        $questionId = $request->question_id;
        $questionAppeal = new TestOptionQuestionAppeal();
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

    public function result($testId)
    {
        $test = TestSubjectOptionTest::findWithOptionAndUserAnswers($testId);
    if (!$test->is_finished) {
        return throw new ModelNotFoundException();
    }
        [$test->topic_know_well, $test->topic_prepare_for] = TestService::getUserAnswersAnalytics($test->userAnswers);
        $test->result = TestService::getScoreAndAnswersCount($test->userAnswers->toArray());
        unset($test->userAnswers);
        return new TestSubjectOptionTestFinishedResource($test);
    }


    public function showWithUserAnswers($testId)
    {
        $test = TestSubjectOptionTest::findWithOptionAndUserAnswers($testId);
        if ($test->is_finished) {
            return new TestSubjectOptionTestFinishedResource($test);
        }
        if ($test->is_started) {
            return new TestSubjectOptionTestStartedResource($test);
//            return new FullTestStartedResource($test);
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
		$request->validate([
		'question_id' => 'required',
			'answer_number' => 'required',
			'time' => 'required'
		]);
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
