<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FullTestUserAnswer extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(TestQuestion::class, 'question_id','id');
    }
    public function test()
    {
        return $this->belongsTo(FullTest::class, 'test_id','id');
    }

    protected $casts = [
        'answers' => 'array'
    ];
}
