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

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
