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

    public function scopeFindWithSubjectsAndUserAnswers($query, $id)
    {
        return $query->with(['subjects' => fn($query) => $query->with(
            [
                'userAnswers' => fn($query) => $query->where('test_id', $id)->with('question')
            ])->withCount(['userAnswers as questions_answered_count' => fn($query) => $query->where('test_id', $id)->whereNotNull('answer')])
        ])->findOrFail($id);
    }





    protected $casts = [
        'is_started' => 'boolean',
        'is_finished' => 'boolean',
    ];
}
