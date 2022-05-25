<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestDirection extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function subjects()
    {
        return $this->belongsToMany(TestSubject::class, 'test_direction_test_subjects', 'direction_id', 'subject_id');
    }

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
