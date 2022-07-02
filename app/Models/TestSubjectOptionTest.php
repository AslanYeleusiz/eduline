<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubjectOptionTest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(TestSubject::class, 'subject_id');
    }

    public function option()
    {
        return $this->belongsTo(TestSubjectOption::class, 'option_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(TestSubjectOptionTestUserAnswer::class, 'test_id');
    }


    public function scopeIsFinished($query)
    {
        return $query->where('is_finished', 1);
    }

    public function scopeIsNotFinished($query)
    {
        return $query->where('is_finished', 0);
    }


    public function scopeFindWithOptionAndUserAnswers($query, $id)
    {
        return $query->with(['option','subject',
         'userAnswers' => fn($query) => $query->with('question')
        ])->findOrFail($id);
    }

    protected $casts = [
        'is_started' => 'boolean',
        'is_finished' => 'boolean',
    ];
}
