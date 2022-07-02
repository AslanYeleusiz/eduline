<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubjectOption extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'subject_id'];

    public function scopeSubjectBy($query, $id)
    {
        return $query->where('subject_id', $id);
    }

    public function subject()
    {
        return $this->belongsTo(TestSubject::class, 'subject_id');
    }

    public function questions()
    {
        return $this->belongsToMany( TestQuestion::class, TestSubjectOptionQuestion::class, 'option_id','question_id')->withPivot('id','number');
    }
}
