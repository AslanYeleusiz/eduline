<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeSubjectBy($query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }

    public function subject()
    {
        return $this->belongsTo(TestSubject::class, 'subject_id');
    }

    protected $casts = [
        'answers' => 'json',
        'is_active' => 'boolean'
    ];
}
