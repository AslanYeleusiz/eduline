<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Subscription extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    protected $casts = [
        'name' => 'json',
        'is_discount' => 'boolean',
        'is_active' => 'boolean',
    ];
}
