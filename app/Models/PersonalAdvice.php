<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class PersonalAdvice extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    protected $guarded = [];

    public $translatable = ['title', 'description'];

    public function orders()
    {
        return $this->hasMany(PersonalAdviceOrder::class, 'personal_advice_id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function slug($date)
    {
        return Str::slug($date, '_');
    }

    protected $casts = [
        // 'id' => 'integer',
        'title' => 'json',
        'description' => 'json',
        'is_discount' => 'boolean',
        'is_active' => 'boolean',
    ];
}
