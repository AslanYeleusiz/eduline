<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubject extends Model
{
    use HasFactory;

    protected $fillable = ['test_language_id', 'name'];

    public function language()
    {
        return $this->belongsTo(TestLanguage::class, 'language_id');
    }

    public function questions()
    {
        return $this->hasMany(TestQuestion::class, 'subject_id');
    }

    protected $casts = [
        'is_pedagogy' => 'boolean'
    ];
}
