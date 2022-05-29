<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubjectPreparationClass extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'subject_id', 'class_id'];
}
