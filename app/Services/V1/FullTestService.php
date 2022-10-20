<?php


namespace App\Services\V1;

use App\Exceptions\ErrorException;
use App\Models\FullTest;
use App\Models\FullTestSubject;
use App\Models\FullTestUserAnswer;
use App\Models\TestDirectionTestSubject;
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
            $questionCount = $questions->filter(fn($question) => $question->subject_id == $subject->id)->count();
            if ($questionCount < $subject->questions_count) {
                $insufficientQuestions = TestQuestion::limitSubjectQuestions($subject->id, $subject->questions_count - $questionCount)->get();
                $questions = $questions->merge($insufficientQuestions);
            }
        }

        $userAnswers = $this->insertRandQuestions($test, $questions);

        foreach ($test->subjects as $subject) {
            $subject->userAnswers = collect($userAnswers)->filter(fn($userAnswer) => $userAnswer['subject_id'] == $subject->id);
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
        DB::beginTransaction();
        foreach ($test->subjects as $subject) {
            $subjectResult = TestService::getScoreAndAnswersCount($subject->userAnswers->toArray());
            $subject->pivot->correct_answers_count = $subjectResult['correctAnswerCount'];
            $subject->pivot->incorrect_answers_count = $subjectResult['incorrectAnswerCount'];
            $subject->pivot->save();
        }

        $result = TestService::getScoreAndAnswersCount(array_merge_recursive(...$test->subjects->pluck('userAnswers')->toArray()));
        $test->is_finished = true;
        $test->score = $result['score'];
        $test->correct_answers_count = $result['correctAnswerCount'];
        $test->incorrect_answers_count = $result['incorrectAnswerCount'];
        $test->end_date = now();
        $test->save();

        DB::commit();
        return $test;
    }

    public function sanatCalc($test)
    {
        $sanattar = [
            [
                'name' => 'Педагог',
                'subjects' => null,
                'pass_score' => null,
                'is_passing' => false,
                'passing_desc' => null,
            ],
            [
                'name' => 'Педагог-модератор',
                'subjects' => null,
                'pass_score' => null,
                'is_passing' => false,
                'passing_desc' => null,
            ],
            [
                'name' => 'Педагог-сарапшы',
                'subjects' => null,
                'pass_score' => null,
                'is_passing' => false,
                'passing_desc' => null,
            ],
            [
                'name' => 'Педагог-зерттеуші',
                'subjects' => null,
                'pass_score' => null,
                'is_passing' => false,
                'passing_desc' => null,
            ],
            [
                'name' => 'Педагог-шебер',
                'subjects' => null,
                'pass_score' => null,
                'is_passing' => false,
                'passing_desc' => null,
            ]
        ];
        $direction_id = $test->subjects[0]->direction[0]->id;
        switch($direction_id){
            case 2:
            case 3: {
                $pan = 0.3;
                $ped = 0.5;
                break;
            }
            case 4:
            case 5: {
                $pan = 0.5;
                $ped = 0.3;
                break;
            }
        }
        foreach ($test->subjects as $subject) {
            if($subject->is_pedagogy){
                $ped_question_count = $subject->questions_count;
                $ped_name = $subject->name;
            }
            else {
                $pan_question_count = $subject->questions_count;
                $pan_name = $subject->name;
            }
        }
        foreach($sanattar as &$sanat){
            $sanat['subjects'] = [
                $pan_name, $ped_name
            ];
            $sanat['pass_score'] = [
                ceil($pan_question_count * $pan),
                ceil($ped_question_count * $ped),
            ];
            if($test->score >= $sanat['pass_score'][0] && $test->score >= $sanat['pass_score'][1]){
                $sanat['is_passing'] = true;
                $sanat['passing_desc'] = 'Сіздің балыңыз '.$sanat['name'].' санатына жетеді';
            }else{
                $sanat['is_passing'] = false;
                $sanat['passing_desc'] = 'Сіздің балыңыз '.$sanat['name'].' санатына жетпейді';
            }
            $pan = $pan + 0.1;
            $ped = $ped + 0.1;
        }
        $test->sanat = $sanattar;
        return $test;
    }
}
