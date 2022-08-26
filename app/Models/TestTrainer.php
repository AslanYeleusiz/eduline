<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestTrainer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(TestSubject::class, 'test_subject_id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    public $casts = [
        'subject' => 'json',
        'description' => 'json',
    ];
}
