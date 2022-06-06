<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    use HasFactory;

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function childs()
    {
        return $this->hasMany(NewsComment::class, 'parent_id', 'id');
    }

    public function thisUserLiked()
    {
        return $this->hasOne(NewsCommentLike::class)
            ->where('user_id', auth()->check() ? auth()->user()->id : 0);

    }
    public function thisLikes()
    {
        return $this->hasMany(NewsCommentLike::class);

    }
}
