<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAdviceOrder extends Model
{
    use HasFactory;

    public function personalAdvice()
    {
        return $this->belongsTo(PersonalAdvice::class, 'personal_advice_id');
    }
}
