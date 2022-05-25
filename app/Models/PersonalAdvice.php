<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class PersonalAdvice extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    protected $guarded = [];

    public $translatable = ['title'];

    public function orders()
    {
        return $this->hasMany(PersonalAdviceOrder::class, 'personal_advice_id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    protected $casts = [
        // 'id' => 'integer',
        'title' => 'json',
        'is_discount' => 'boolean',
        'is_active' => 'boolean',
    ];
}
