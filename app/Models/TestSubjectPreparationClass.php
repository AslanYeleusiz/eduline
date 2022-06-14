<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TestSubjectPreparationClass extends Pivot
{
    use HasFactory;
    protected $table= 'test_subject_preparation_classes';
    protected $fillable = ['number', 'subject_id', 'class_id'];
}
