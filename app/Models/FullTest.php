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
        return $this->belongsToMany(TestSubject::class, FullTestSubject::class, 'test_id', 'subject_id');
    }

    public function subject()
    {
        return $this->belongsTo(TestSubject::class, FullTestSubject::class, 'test_id', 'subject_id');
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
        return $query->with(['subjects' => fn($query) => $query->with(
            [
                'userAnswers' => fn($query) => $query->where('test_id', $id)->withCount('userAnswers as questions_count')
            ])
        ])
        ->withCount('subjects')->findOrFail($id);
    }

    public function scopeFindWithSubjectsAndUserAnswers($query, $id)
    {
        return $query->with(['subjects' => fn($query) => $query->with(
            [
                'userAnswers' => fn($query) => $query->where('test_id', $id)->with('question')->withCount('userAnswers as questions_count')
            ])
        ])
        ->withCount('subjects')->findOrFail($id);
    }

    protected $casts = [
        'is_started' => 'boolean',
        'is_finished' => 'boolean',
    ];
}
