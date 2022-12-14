<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

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

    public function slug($date)
    {
        return Str::slug($date, '_');
    }

    public function thisUserSaved()
    {

//        $userCheck = !request()->expectsJson() ? auth()->check() : auth()->guard('api')->check();
//
//
//        $userId = $userCheck ? (!request()->expectsJson() ? auth()->user()->id : auth()->guard('api')->user()->id) : 0;
//        return $this->hasOne(UserNewsSaved::class)
//            ->where('user_id', $userId);
        return $this->hasOne(UserNewsSaved::class)
            ->where('user_id', auth()->check() ? auth()->user()->id : 0)
            ->orderBy('created_at');
    }

    public $casts = [
        'created_at' => 'datetime:d.m.y',
        'title'  => 'json',
        'short_description' => 'json',
        'description' => 'json',
        'image' => 'json',
    ];
}
