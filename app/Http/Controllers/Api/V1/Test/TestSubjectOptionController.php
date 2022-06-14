<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Test\TestSubjectOptionFinishedResource;
use App\Http\Resources\V1\Test\TestSubjectOptionsResource;
use App\Models\TestSubject;
use App\Models\TestSubjectOption;
use Illuminate\Http\Request;

class TestSubjectOptionController extends Controller
{
    public function index($id)
    {
        $options = TestSubjectOption::subjectBy($id)->get();
        return TestSubjectOptionsResource::collection($options)
            ->additional(['status' => true]);
    }

    public function store($subjectId, $optionId)
    {
        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::with(['questions' => fn ($query) => $query->isActive()->limit($subject->questions_count)])
            ->subjectBy($subject->id)
            ->findOrFail($optionId);
        return new TestSubjectOptionsResource(compact('subject', 'option'));
    }


    public function finish($subjectId, $optionId, Request $request)
    {
        //[questions => ['question_id' => id, 'number']]
        $time = $request->input('time', 0);

        $subject = TestSubject::findOrFail($subjectId);
        $option = TestSubjectOption::with(['questions' => fn ($query) => $query->isActive()->limit($subject->questions_count)])
            ->subjectBy($subject->id)
            ->findOrFail($optionId);
        $userQuestionAnswers = $request->questions;
        $result = $this->getScoreTestOption($option, $request->questions);
        return new TestSubjectOptionFinishedResource(compact('result', 'option','subject', 'time'));
    }

    protected function getScoreTestOption($option, $userQuestionAnswers)
    {
        $score = 0;
        $correctAnswerCount = 0;
        $incorrectAnswerCount = 0;
        $userAnswers = [];
        foreach($option->questions as $question) {
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
