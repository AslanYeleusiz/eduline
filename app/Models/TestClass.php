<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestClass extends Model
{
    use HasFactory;

    protected  $fillable = ['name'];

    public function preparations()
    {
        return $this->hasMany(TestSubjectPreparationClass::class, 'class_id');
    }
    


}
