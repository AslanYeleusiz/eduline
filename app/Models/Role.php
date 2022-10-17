<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const DEFAULT_ROLE = 5;

    const ADMIN_ROLE = 1;
    public $guarded = [];

    public function scopeIsGeneral($query)
    {
        return $query->where('is_general', 1);
    }

    public function scopeIsNotGeneral($query)
    {
        return $query->where('is_general', 0);
    }

    public $casts = [
        'name' => 'json',
        'is_general' => 'boolean',
    ];
}
