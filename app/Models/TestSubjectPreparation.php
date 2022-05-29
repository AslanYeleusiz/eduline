<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubjectPreparation extends Model
{
    use HasFactory;

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function scopeSubjectBy($query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }
    
    public function scopeIsParent($query)
    {
        return $query->whereNull('parent_id');
    }
}
