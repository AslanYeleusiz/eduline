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
}
