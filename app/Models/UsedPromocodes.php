<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedPromocodes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'promo_code_id'
    ];
}
