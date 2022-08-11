<?php


namespace App\Services\V1;

use App\Exceptions\ErrorException;
use App\Models\FullTest;
use App\Models\FullTestUserAnswer;
use App\Models\TestDirection;
use App\Models\TestQuestion;
use Exception;
use Illuminate\Support\Facades\DB;

class FullTestService
{
    public function create($directionId, $subjectId)
    {
        $user = auth()->guard('api')->user();
        $direction = TestDirection::with('subjects')->findOrFail($directionId);
        $subjectChoice = $direction->subjects->firstOrFail(function ($value) use ($subjectId) {
            return $value->id == $subjectId;
        });
        $subjectPedagogy = $direction->subjects->firstOrFail(function ($value) {
            return $value->is_pedagogy == 1;
        });
        DB::beginTransaction();
        $test = new FullTest();
        $test->user_id = $user->id;
        $test->time = FullTest::FULL_TEST_TIME;
        $test->save();
        $test->subjects()->attach([$subjectChoice->id, $subjectPedagogy->id]);
        DB::commit();
        return $test;
    }

    public function start($test)
    {
        DB::beginTransaction();
        $test = $this->getRandQuestionsAndInsertUserAnswer($test);
        $test->is_started = true;
        $test->start_date = now();
        $test->save();
        DB::commit();
        return $test;
    }


    public function getRandQuestionsAndInsertUserAnswer($test)
    {
        foreach ($test->subjects as $key => $subject) {
            $question = TestQuestion::limitSubjectQuestions($subject->id, $subject->questions_count);
			
            if ($key === 0) {
                $query = clone $question;
            } else {
                $query->union($question);
            }
        }

        $questions = $query->get();


        foreach ($test->subjects as $subject) {
            $questionCount = $questions->filter(fn ($question) => $question->subject_id == $subject->id)->count();
            if ($questionCount < $subject->questions_count) {
                $insufficientQuestions = TestQuestion::limitSubjectQuestions($subject->id, $subject->questions_count - $questionCount)->get();
                $questions = $questions->merge($insufficientQuestions);
            }
        }

        $userAnswers = $this->insertRandQuestions($test, $questions);

        foreach ($test->subjects as $subject) {
            $subject->userAnswers = collect($userAnswers)->filter(fn ($userAnswer) => $userAnswer['subject_id'] == $subject->id);
        }
        return $test;
    }

    public function insertRandQuestions($test, $questions): array
    {
        $userAnswers = [];
        $userAnswersWithQuestion = [];
        foreach ($questions as $question) {
            $userAnswers[] = [
                'test_id' => $test->id,
                'subject_id' => $question->subject_id,
                'question_id' => $question->id,
            ];
            $userAnswersWithQuestion[] = [
                'test_id' => $test->id,
                'subject_id' => $question->subject_id,
                'question_id' => $question->id,
                'answer' => null,
                'question' => $question,
            ];
        }
        FullTestUserAnswer::insert($userAnswers);
        return $userAnswersWithQuestion;
    }

    public function saveFinish($test)
    {
        //        $test = UbtTest::findWithSubjectsAndUserAnswers($id);
        $result = $this->getScoreAndAnswersCount($test);
        $test->is_finished = true;
        $test->score = $result['score'];
        $test->correct_answers_count = $result['correctAnswerCount'];
        $test->incorrect_answers_count = $result['incorrectAnswerCount'];
        $test->end_date = now();
        $test->save();
        return $test;
    }


    public function getScoreAndAnswersCount($test): array
    {
        //        $id = '11625915148i';
        //        $test = UbtTest::findWithSubjectsAndUserAnswers($id);
        $userAnswers = array_merge_recursive(...$test->subjects->pluck('userAnswers')->toArray());
        $score = 0;
        $correctAnswerCount = 0;
        $incorrectAnswerCount = 0;
        foreach ($userAnswers as $userAnswer) {
            $correctAnswer = null;
            foreach ($userAnswer['question']['answers'] as $answer) {
                if ($answer['is_correct']) {
                    $correctAnswer = $answer;
                }
            }
            if (
                !empty($userAnswer['answer']) && !empty($correctAnswer)
                && ($correctAnswer['number'] == $userAnswer['answer'])
            ) {
                $score++;
                $correctAnswerCount++;
            } else {
                $incorrectAnswerCount++;
            }
        }
        return compact('score', 'correctAnswerCount', 'incorrectAnswerCount');
    }
}
