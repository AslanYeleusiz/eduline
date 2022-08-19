<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestTrainer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $casts = [
        'description' => 'json',
    ];
}
