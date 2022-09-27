<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory;
    const IMAGE_PATH = 'images/sliders/';
    protected $guarded = [];

    public function advice()
    {
        return $this->belongsTo(PersonalAdvice::class, 'linkToAdvice');
    }

    public $casts = [
        'image' => 'json'
    ];
    public function slug($date)
    {
        return Str::slug($date, '_');
    }
}
