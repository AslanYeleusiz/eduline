<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class NewsType extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['name'];

    public function news()
    {
        return $this->hasMany(News::class, 'news_types_id');
    }

    public $casts = [
        'name' => 'json',   
        'is_main' => 'boolean'
    ];
}
