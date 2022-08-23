<?php


namespace App\Services\V1;

use App\Exceptions\ErrorException;
use App\Models\FullTest;
use App\Models\FullTestUserAnswer;
use App\Models\TestDirection;
use App\Models\TestQuestion;
use App\Models\TestSubject;
use App\Models\TestSubjectOption;
use App\Models\TestSubjectOptionTest;
use App\Models\TestSubjectOptionTestUserAnswer;
use Exception;
use Illuminate\Support\Facades\DB;

class TestByOptionService
{

    public function create($subjectId, $optionId)
    {
        $user = auth()->guard('api')->user();
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::subjectBy($subjectId)->where('id', $optionId)->firstOrFail();
        DB::beginTransaction();
        $test = new TestSubjectOptionTest();
        $test->user_id = $user->id;
        $test->subject_id = $subject->id;
        $test->time = FullTest::OPTION_TEST_TIME;
        $test->option_id = $option->id;
        $test->save();
        DB::commit();
        return $test;
    }

    public function start($test)
    {
        DB::beginTransaction();
        [$test, $userAnswers] = $this->getRandQuestionsAndInsertUserAnswer($test);
        $test->is_started = true;
        $test->start_date = now();
        $test->save();
        DB::commit();
        $test->userAnswers = $userAnswers;
        return $test;
    }


    public function getRandQuestionsAndInsertUserAnswer($test)
    {
        $test->option->load(['questions' => fn ($query) => $query->orderByPivot('number')-> $query->isActive()->limit($test->subject->questions_count)]);
        $questions = $test->option->questions;
        $userAnswers = $this->insertRandQuestions($test, $questions);

        $userAnswers = collect($userAnswers);
        return [$test, $userAnswers];
    }

    public function insertRandQuestions($test, $questions): array
    {
        $userAnswers = [];
        $userAnswersWithQuestion = [];
        foreach ($questions as $question) {
            $userAnswers[] = [
                'test_id' => $test->id,
                'question_id' => $question->id,
            ];
            $userAnswersWithQuestion[] = [
                'test_id' => $test->id,
                'question_id' => $question->id,
                'answer' => null,
                'question' => $question,
            ];
        }
        TestSubjectOptionTestUserAnswer::insert($userAnswers);
        return $userAnswersWithQuestion;
    }

    public function saveFinish($test)
    {
        //        $test = UbtTest::findWithSubjectsAndUserAnswers($id);
        $result = TestService::getScoreAndAnswersCount($test->userAnswers->toArray());
        $test->is_finished = true;
        $test->score = $result['score'];
        $test->correct_answers_count = $result['correctAnswerCount'];
        $test->incorrect_answers_count = $result['incorrectAnswerCount'];
        $test->end_date = now();
        $test->save();
        return $test;
    }
}
