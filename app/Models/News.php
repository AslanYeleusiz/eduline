<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    const IMAGE_PATH = 'images/news/';

    public $guarded = [];

    public $translatable = ['title', 'short_description', 'description', 'image'];

    public function newsType()
    {
        return $this->belongsTo(NewsType::class, 'news_types_id');
    }

    public function comments()
    {
        return $this->hasMany(NewsComment::class, 'news_id', 'id');
    }

    public function thisUserSaved()
    {

        $userCheck = !request()->expectsJson() ? auth()->check() : auth()->guard('api')->check();


        $userId = $userCheck ? (!request()->expectsJson() ? auth()->user()->id : auth()->guard('api')->user()->id) : 0;
        return $this->hasOne(UserNewsSaved::class)
            ->where('user_id', $userId);
    }

    public $casts = [
        'created_at' => 'datetime:d.m.y',
        'title'  => 'json',
        'short_description' => 'json',
        'description' => 'json',
        'image' => 'json',
    ];
}
