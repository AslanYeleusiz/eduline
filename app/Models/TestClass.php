<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class TestClass extends Model
{
    use HasFactory, HasTranslations;

    protected  $fillable = ['name'];
    public $translatable = ['name'];

    public function preparations()
    {
        // return $this->hasMany(TestSubjectPreparationClass::class, 'class_id');
        return $this->belongsToMany(TestSubjectPreparation::class,
         TestSubjectPreparationClass::class, 'class_id', 'preparation_id');
    }

    protected $casts = [
        'name' => 'json',
    ];



}
