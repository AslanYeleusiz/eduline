<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubjectOptionTestUserAnswer extends Model
{
    use HasFactory;

    protected  $guarded = [];

    public function question()
    {
        return $this->belongsTo(TestQuestion::class, 'question_id');
    }
}
