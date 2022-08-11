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
