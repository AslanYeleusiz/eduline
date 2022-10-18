<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FullTest extends Model
{
    use HasFactory;

    public const FULL_TEST_TIME = 13800;
    public const OPTION_TEST_TIME = 3600;

    public function subjects()
    {
        return $this->belongsToMany(TestSubject::class, FullTestSubject::class,
            'test_id', 'subject_id')->withPivot('correct_answers_count', 'incorrect_answers_count');
    }

    public function scopeIsFinished($query)
    {
        return $query->where('is_finished', 1);
    }

    public function scopeIsNotFinished($query)
    {
        return $query->where('is_finished', 0);
    }

    public function scopeFindWithSubjects($query, $id)
    {
        return $query->with(['subjects' => fn($query) => $query->withCount(['userAnswers as questions_answered_count' => function($query) use ($id) {
            $query->where('test_id', $id)->whereNotNull('answer');
        }])
        ])->findOrFail($id);
    }

    public function scopeFindWithSubjectsAndDirection($query, $id)
    {
        return $query->with(['subjects' => fn($query) => $query->with(['direction' => fn($query) => $query->first()])->withCount(['userAnswers as questions_answered_count' => fn($query) => $query->where('test_id', $id)->whereNotNull('answer')])
        ])->findOrFail($id);
    }



    public function scopeFindWithSubjectsAndUserAnswers($query, $id, $isLoadPreparations = false)
    {
        return $query->with(['subjects' => fn($query) => $query->with(
            [
                'userAnswers' => fn($query) => $query->where('test_id', $id)
                    ->when($isLoadPreparations, fn($query) => $query->with('question.preparations:id,title'))
                    ->when(!$isLoadPreparations, fn($query) => $query->with('question')),
                'direction' => fn($query) => $query->first()
            ])->withCount(['userAnswers as questions_answered_count' => fn($query) => $query->where('test_id', $id)->whereNotNull('answer')])
        ])->findOrFail($id);
    }

    protected $casts = [
        'is_started' => 'boolean',
        'is_finished' => 'boolean',
    ];
}
