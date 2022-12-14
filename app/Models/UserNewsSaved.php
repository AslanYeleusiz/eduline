<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNewsSaved extends Model
{
    use HasFactory;

    public function newsSaves()
    {
        return $this->belongsTo(News::class, 'news_id');
    }

}
