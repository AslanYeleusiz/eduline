<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory,HasTranslations;
    const IMAGE_PATH = 'images/sliders/';
    protected $guarded = [];

    public function advice()
    {
        return $this->belongsTo(PersonalAdvice::class, 'link');
    }
    public $translatable = ['image'];
    public $casts = [
        'image' => 'json'
    ];

}
