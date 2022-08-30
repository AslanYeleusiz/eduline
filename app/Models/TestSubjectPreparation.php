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

    public function classItems()
    {
        return $this->belongsToMany(TestClass::class, TestSubjectPreparationClass::class, 'preparation_id', 'class_id');
    }

    public function scopeSubjectBy($query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }
    public function questions()
    {
        return $this->belongsToMany(TestQuestion::class,
            TestSubjectPreparationQuestion::class,  'preparation_id', 'question_id');
    }

    public function scopeIsParent($query)
    {
        return $query->whereNull('parent_id');
    }


}
