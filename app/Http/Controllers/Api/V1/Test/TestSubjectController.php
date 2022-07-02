<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Test\TestSubjectPreparationTestFinishedResource;
use App\Http\Resources\V1\Test\TestSubjectPreparationTestStartResource;
use App\Http\Resources\V1\Test\TestSubjectTestFinishedResource;
use App\Http\Resources\V1\Test\TestSubjectTestStartResource;
use App\Models\TestQuestion;
use App\Models\TestSubject;
use Illuminate\Http\Request;

class TestSubjectController extends Controller
{
    public function testStart($subjectId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $questions = TestQuestion::isActive()
        ->subjectBy($subject->id)
        ->inRandomOrder()->limit($subject->questions_count)->get();
        return new TestSubjectTestStartResource(compact('subject', 'questions'));
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
        $result = $this->getScoreTestOption($questions, $request->questions);
        return new TestSubjectTestFinishedResource(compact('result',
        'subject', 'time'));
    }

    protected function getScoreTestOption($questions, $userQuestionAnswers)
    {
        $score = 0;
        $correctAnswerCount = 0;
        $incorrectAnswerCount = 0;
        $userAnswers = [];
        foreach ($questions as $question) {
            $correctAnswer = null;
            $userAnswer = null;
            foreach ($question['answers'] as $answer) {
                if ($answer['is_correct']) {
                    $correctAnswer = $answer;
                }
            }
            if (empty($correctAnswer)) {
                $incorrectAnswerCount++;
            } else {
                foreach ($userQuestionAnswers as $userQuestionAnswer) {
                    if ($question->id == $userQuestionAnswer['question_id']) {
                        if (
                            !empty($userQuestionAnswer['answer']) && !empty($correctAnswer)
                            && ($correctAnswer['number'] == $userQuestionAnswer['answer'])
                        ) {
                            $userAnswer = $userQuestionAnswer['answer'];
                            $score++;
                            $correctAnswerCount++;
                        } else {
                            $incorrectAnswerCount++;
                        }
                    } else {
                        $question['answer'] = null;
                        $incorrectAnswerCount++;
                    }
                }
            }
            $userAnswers[] = [
                'answer' => $userAnswer,
                'question' => $question,
            ];
        }
        return compact('score', 'correctAnswerCount', 'incorrectAnswerCount',  'userAnswers');
    }
}
