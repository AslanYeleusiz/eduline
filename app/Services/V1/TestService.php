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

class TestService
{
    public static function getScoreTestNotSaved($questions, $userQuestionAnswers)
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
                        $userAnswer = $userQuestionAnswer['answer'];
                        if (
                            !empty($userQuestionAnswer['answer']) && !empty($correctAnswer)
                            && ($correctAnswer['number'] == $userQuestionAnswer['answer'])
                        ) {
                            $score++;
                            $correctAnswerCount++;
                        } else {
                            $incorrectAnswerCount++;
                        }
                    }
                }
            }
            $userAnswers[] = [
                'answer' => $userAnswer,
                'question' => $question,
            ];
        }
        return compact('score', 'correctAnswerCount', 'incorrectAnswerCount', 'userAnswers');
    }

    public static function getScoreAndAnswersCount($userAnswers): array
    {
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
