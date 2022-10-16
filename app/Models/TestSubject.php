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

    public function direction()
    {
        return $this->belongsToMany(TestDirection::class, TestDirectionTestSubject::class, 'subject_id', 'direction_id');
    }

    public function preparations()
    {
        return $this->hasMany(TestSubjectPreparation::class, 'subject_id')->whereNull('parent_id');
    }

    public function classItems()
    {
        return $this->belongsToMany(TestClass::class, TestSubjectPreparationClass::class, 'preparation_id', 'class_id');
    }

    public function preparationChilds()
    {
        return $this->hasMany(TestSubjectPreparation::class, 'subject_id')->whereNotNull('parent_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(FullTestUserAnswer::class, 'subject_id');
    }

    public function scopeIsPedagogy($query)
    {
        return $query->where('is_pedagogy', 1);
    }





    protected $casts = [
        'is_pedagogy' => 'boolean'
    ];
}
