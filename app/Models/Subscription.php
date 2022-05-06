<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    protected $casts = [
        'is_discount' => 'boolean',
        'is_active' => 'boolean',
    ];
}
