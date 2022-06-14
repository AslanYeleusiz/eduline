<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

  
    public function subject()
    {
        return $this->belongsTo(TestSubject::class, 'subject_id');
    }

    public function preparations()
    {
        return $this->belongsToMany(TestSubjectPreparation::class,
         TestSubjectPreparationQuestion::class, 'question_id', 'preparation_id');
    }

    public function scopeLimitSubjectQuestions($query, $subjectId, $limit)
    {
        return $query->where('subject_id', $subjectId)->orderByRaw('RAND()')->limit($limit)->isActive();
    }
    
    public function scopeSubjectBy($query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    protected $casts = [
        'answers' => 'json',
        'is_active' => 'boolean'
    ];
}
